<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Models\UsersTransactions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Models\ReferredUsersTransactions;
use YooKassa\Model\Notification\NotificationCanceled;
use YooKassa\Model\Notification\NotificationEventType;
use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\Notification\NotificationWaitingForCapture;

class YooKassaController extends Controller
{
    private $authService = null;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    // --> YooKassa Callback for different states
    public function callback()
    {
        $source = file_get_contents("php://input");
        $requestBody = json_decode($source, true);
        Log::error($requestBody);

        if (isset($requestBody["event"])) {
            if ($requestBody["event"] === NotificationEventType::PAYMENT_SUCCEEDED) {
                $notification = new NotificationSucceeded($requestBody);
            } elseif ($requestBody["event"] === NotificationEventType::PAYMENT_WAITING_FOR_CAPTURE) {
                $notification = new NotificationWaitingForCapture($requestBody);
            } elseif ($requestBody["event"] === NotificationEventType::PAYMENT_CANCELED) {
                $notification = new NotificationCanceled($requestBody);
            } else {
                return;
            }
        } else {
            return;
        }
        $payment = $notification->getObject();

        // capture `waiting_for_capture` state and send notification to `succeeded` state
        if (isset($payment->status) && $payment->status === "waiting_for_capture") {
            $this->authService->getClient()->capturePayment([
                "amount" => $payment->amount,
            ], $payment->id, uniqid("", true));
        }

        // `canceled` state
        if ($payment && isset($payment->status) && $payment->status === "canceled") {
            // delete from db
            $metadata = (object)$payment->metadata;
            if (isset($metadata->transaction_id)) {
                $transactionId = (int)$metadata->transaction_id;
                $table = $this->getTable($metadata->table);
                $transaction = $table::find($transactionId);

                if ($transaction) {
                    $transaction->status = "canceled";
                    $transaction->save();
                }
            }
        }

        // `succeeded` state
        if (isset($payment->status) && $payment->status === "succeeded") {
            if ((bool)$payment->paid === true) {
                $metadata = (object)$payment->metadata;
                if (isset($metadata->transaction_id)) {
                    $transactionId =  (int)$metadata->transaction_id;
                    $table = $this->getTable($metadata->table);
                    $transaction = $table::find($transactionId);
                    $transaction->status = "succeeded";
                    $transaction->payment_method_id = $payment->payment_method->id;
                    $transaction->save();

                    // user + 30 days
                    $user = User::where("uuid", $transaction->uuid)->first();
                    $user->days_left = (int)$user->days_left + 30;
                    $user->save();
                }
            }
        }
    }

    // --> Referral payment
    public function referral_payment(Request $request)
    {

        // make sure that link is either with referral id or not
        if ($request->referral_id !== null) {
            // make sure the user who pays is not the user with referral
            if ($request->user()?->referral_id === User::where("referral_id", $request->referral_id)->first()->referral_id) {
                return redirect()->route("error")->withErrors(["error" => "Sorry, you can't use your own referral link"]);
            } else {
                Cache::put("referral_id", ["link" => (string)$request->referral_id, "isExpired" => "false"], 1200); // 20 minutes
            }
        }

        // make sure that user is registered
        $response = $this->authService->checkUserState("register", "confirmation");
        if ($response === "confirmation") {
            return redirect()->route($response);
        } elseif ($response === "register") {
            return redirect()->route($response);
        }

        // get referral data
        $referral = Cache::get("referral_id");
        $referral_id = $referral["link"];

        // make sure that user wasn"t preveously referred
        if (!$this->authService->isReferred()) {
            return redirect()->route("error")->withErrors(["error" => "Your session is gone, please try again later"]);
        }

        // check if referral data exists
        if (isset($referral_id)) {

            // check if referral id is real
            $user = User::where("referral_id", $referral_id)->first();
            if (isset($user->id)) {
                // add to database + create request to yookassa
                $amount = 10000;
                $descriprtion = "Marathon Payment 10K";

                $transaction = ReferredUsersTransactions::create([
                    "email" => $request->user()?->email,
                    "telegram_id" => $request->user()?->telegram_id,
                    "uuid" => $request->user()?->uuid,
                    "referral_id" => $referral_id,
                    "amount" => $amount,
                    "description" => $descriprtion,
                    "ip" => $request->ip(),
                ]);

                // make sure that user isn't a payer already (in order to don't change his referred_status on 1)
                if (!ReferredUsersTransactions::where('uuid', $request->user()->uuid)->exists() || !UsersTransactions::where('uuid', $request->user()->uuid)->exists()) {
                    // set User as referred
                    $user = User::where("uuid", $request->user()?->uuid)->first();
                    $user->is_referred = 1;
                    $user->save();
                }


                if ($transaction) {
                    $payment = $this->authService->createPayment($amount, $descriprtion, [
                        "transaction_id" => $transaction->id,
                        "table" => "ReferredUsersTransactions",
                    ]);
                    $transaction->yookassa_transaction_id = $payment->id;
                    $transaction->status = $payment->status;
                    $transaction->save();

                    // set referral id as expired, since user created request
                    Cache::put("referral_id", ["link" => $referral_id, "isExpired" => "true"]);
                    return redirect()->away($payment->getConfirmation()->getConfirmationUrl());
                }
            } else {
                return redirect()->route("error")->withErrors(["error" => "Your referral id is incorrect"]);
            }
        } else {
            return redirect()->route("error")->withErrors(["error" => "Your session is gone, please try again later"]);
        }
    }

    /* ------------- PRIVATE ------------- */
    // Private Get Table From String
    private function getTable($str)
    {
        $table = null;
        if ($str === "UsersTransactions") {
            $table = UsersTransactions::class;
        } elseif ($str === "ReferredUsersTransactions") {
            $table = ReferredUsersTransactions::class;
        }
        return $table;
    }
}
