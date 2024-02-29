<?php

namespace App\Services;

use Exception;
// use App\Models\Admin;
use YooKassa\Client;
use App\Models\UsersTransactions;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthService
{

    public function handleError($func, $this_, $key = "server")
    {
        try {
            $func();
        } catch (Exception $e) {
            $error = $e->getMessage();
            if (strpos($error, 'SQL') !== false) {
                $this_->addError($key, "Пожалуйста проверьте интернет соединение. Попробуйте позже. Если ничего не помогло напишите нам в <a href='/support'>поддержку</a>." . " Ошибка сервера: " . $error);
            } else {
                $this_->addError($key, $error);
            }
        }
    }

    public function check()
    {
        // in case if admin
        if (Auth::guard('admin')->check()) {
            return redirect()->route("admin.panel");
        }

        /*
        In case if user want to login - redirect him back to confirmation
        1. Telegram must be unverified
        2. Must be logged in
        */
        if (Auth::check() && Auth::user()->telegram_id === null) {
            return redirect()->route("telegram.verify");
        }

        if (Auth::check() && Auth::user()->telegram_id !== null) {
            return redirect()->route("dashboard");
        }
    }

    public function authenticateAdmin($telegram_username, $password, $ip, $remember, $this_)
    {
        $credentials = compact('telegram_username', 'password');
        if (auth()->guard('admin')->attempt($credentials, $remember)) {
            $admin = auth()->guard('admin')->user();
            return redirect()->route('admin.panel');
        }

        // if credentials are not correct
        $this_->addError(
            'telegram_username',
            'Предоставленные вами учетные данные не совпадают с нашими записями.'
        );
    }

    public function authenticateUser($email, $password, $remember, $this_)
    {
        $credentials = compact('email', 'password');
        if (Auth::attempt($credentials, $remember)) {

            // remove session's name, email, password and currentStep, used in registration
            session()->forget(['name', 'email', 'password', 'currentStep']);

            // check if user has verified telegram id
            if (auth()->user()->telegram_id === null) {
                return redirect()->route("telegram.verify");
            }

            // make a new session
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
