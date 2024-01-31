<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Services\ModelService;
use App\Models\UsersTransactions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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

    public function pay_3000(Request $request)
    {
        // create transaction
        $user = Auth::user();
        $modelService = new ModelService();
        $transactionUrl = $modelService->createTransaction(
            $user->uuid,
            $user->email,
            $user->telegram_id,
            $request->ip(),
            3000,
            "Месячная оплата",
        );

        return redirect()->away($transactionUrl);
    }


    // --> YooKassa Callback for different states
    public function callback(Request $request)
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
                $transaction = UsersTransactions::find($transactionId);

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
                // tg instance
                $tg = new TelegramController();

                if (isset($metadata->transaction_id)) {
                    $transactionId =  (int)$metadata->transaction_id;
                    $transaction = UsersTransactions::find($transactionId);
                    $transaction->status = "succeeded";
                    $transaction->payment_method_id = $payment->payment_method->id;
                    $transaction->save();

                    // user + 30 days
                    $user = User::where("uuid", $transaction->uuid)->first();
                    $user->days_left = (int)$user->days_left + 30;
                    $user->save();
                    // unban if banned
                    $tg->unbanChatMember(config("services.telegram.group_id"), $user->telegram_id);
                }
                // handle recurrent payments
                if ($metadata->isRecurrent) {
                    // add to database
                    $user = User::where("uuid", $metadata->uuid)->first();
                    $transaction = UsersTransactions::create([
                        "uuid" => $user->uuid,
                        "yookassa_transaction_id" => $payment->id,
                        "status" => "succeeded",
                        "amount" => $payment->amount->value,
                        "description" => $payment->description,
                        "ip" => $request->ip(),
                    ]);
                    $transaction->payment_method_id = $payment->payment_method->id;
                    $transaction->save();
                    $user->days_left = (int)$user->days_left + 30;
                    $user->save();
                    // unban if banned
                    $tg->unbanChatMember(config("services.telegram.group_id"), $user->telegram_id);
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

        // make sure that user is logged in
        if (!Auth::check()) {
            return redirect()->route("login");
        }
        // make sure that user has verified telegram_id
        if (!Auth::user()->telegram_id) {
            return redirect()->route("confirmation");
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
            if (User::where("referral_id", $referral_id)->first()) {

                // create transaction
                $user = Auth::user();
                $modelService = new ModelService();

                // make sure that user isn't a payer already (in order to don't change his referred_status on 1)
                if (!UsersTransactions::where('uuid', $user->uuid)->exists()) {
                    $transactionUrl = $modelService->createTransaction(
                        $user->uuid,
                        $user->email,
                        $user->telegram_id,
                        $request->ip(),
                        10000,
                        "Реферальная оплата",
                        $referral_id,
                    );
                    // set referral id as expired, since user created request
                    Cache::put("referral_id", ["link" => $referral_id, "isExpired" => "true"]);
                    return redirect()->away($transactionUrl);
                }
                return redirect()->route("error")->withErrors(["error" => "You had some transactions already"]);
            } else {
                return redirect()->route("error")->withErrors(["error" => "Your referral id is incorrect"]);
            }
        } else {
            return redirect()->route("error")->withErrors(["error" => "Your session is gone, please try again later"]);
        }
    }
}
