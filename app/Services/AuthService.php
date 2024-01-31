<?php

namespace App\Services;

use YooKassa\Client;
use App\Models\UsersTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthService
{
    public function authenticateUser($email, $password, $remember, $this_)
    {
        $credentials = compact('email', 'password');
        if (Auth::attempt($credentials, $remember)) {

            // check if user has verified telegram id
            if (auth()->user()->telegram_id === null) {
                return redirect()->route("telegram-verification");
            }

            session()->regenerate();
            return redirect()->route("dashboard");
        }
        // if credentials are not correct
        $this_->addError(
            'email',
            'Предоставленные вами учетные данные не совпадают с нашими записями.'
        );
    }


    // check if user was reffered on the website
    public function isReferred(): bool
    {
        // check if user had successful transactions before - if so - restrict him, if not - give him chance even though he was registered before
        $hasSuccessfulTransaction =
            UsersTransactions::where('uuid', auth()->user()->uuid)
            ->where('status', 'succeeded')
            ->exists();

        if ($hasSuccessfulTransaction) {
            return false;
        }

        // check if referral exists
        $referral = Cache::get("referral_id");
        $referral_link = $referral["link"] ?? null;
        $referral_is_expired = $referral["isExpired"] ?? null;
        if (($referral && $referral_link) && $referral_is_expired !== "true") {
            return true;
        }
        return false;
    }


    // Get YooKassa Client Object
    public function getClient(): Client
    {
        $client = new Client();
        $client->setAuth(config("services.yookassa.shop_id"), config("services.yookassa.secret_key"));
        return $client;
    }


    // Create YooKassa Payment
    public function createPayment(float $amount, string $description, array $options = [])
    {
        $authService = new AuthService();
        $client = $authService->getClient();
        $payment = $client->createPayment([
            "amount" => [
                "value" => $amount,
                "currency" => "RUB",
            ],
            "capture" => false,
            "confirmation" => [
                "type" => "redirect",
                "return_url" => route("dashboard"),
            ],
            "metadata" => $options,
            "description" => $description,
            "save_payment_method" => true,
        ], uniqid("", true));

        return $payment;
    }
}
