<?php

namespace App\Services;

use YooKassa\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthService
{
    private $request = null;

    public function __construct()
    {
        $this->request = new Request();
    }

    /* ------------- FOR COMMON USE ------------- */
    // check if user was reffered on the website
    public function isReferred(): bool
    {
        $referral = Cache::get("referral_id");
        $referral_link = $referral["link"] ?? null;
        $referral_is_expired = $referral["isExpired"] ?? null;
        if (($referral && $referral_link) && $referral_is_expired !== "true") {
            return true;
        }
        return false;
    }


    // Check current user state
    public function checkUserState(string $ifUnauthorizedURI, string $ifUnverifiedURI)
    {
        if (Auth::check()) {
            if (auth()->user()->is_telegram_id_verified === 1) {
                return null;
            } else {
                return $ifUnverifiedURI;
            }
        } else {
            return $ifUnauthorizedURI;
        }
    }

    /* ------------- FOR EMAIL ------------- */
    // Display an email verification notice.
    public function notice(string $redirectTo = "dashboard")
    {
        if ($this->request->user() === null) {
            return redirect()->route('register');
        }
        return $this->request->user()->hasVerifiedEmail()
            ? redirect()->route($redirectTo) : view('auth.verify-email');
    }

    // Resent verificaiton email to user.
    public function resend(Request $request)
    {
        $request->user()?->sendEmailVerificationNotification();
        return back()
            ->withSuccess('A fresh verification link has been sent to your email address.');
    }


    // Private Get YooKassa Client Object
    public function getClient(): Client
    {
        $client = new Client();
        $client->setAuth(config("services.yookassa.shop_id"), config("services.yookassa.secret_key"));
        return $client;
    }


    // Private Get YooKassa Create Payment
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
