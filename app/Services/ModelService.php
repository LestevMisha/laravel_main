<?php

namespace App\Services;

use App\Models\User;
use App\Models\UsersImages;
use Illuminate\Support\Str;
use App\Models\CardCredentials;
use App\Models\UsersTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ModelService
{

    public function createUser($name, $email, $password)
    {
        return User::create([
            'uuid' => Str::uuid()->toString(),
            'referral_id' => Str::uuid()->toString(),
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),

        ]);
    }

    public function insertCardCredentials($full_name, $card_number, $security_code, $expires_at)
    {
        return CardCredentials::create([
            'uuid' => Auth::user()->uuid,
            'full_name' => $full_name,
            'card_number' => $card_number,
            'security_code' => $security_code,
            'expires_at' => $expires_at,
        ]);
    }

    public function getCardCredentials($uuid)
    {
        return CardCredentials::where('uuid', $uuid)->first();
    }

    public function deleteUser($email)
    {
        $user = User::where("email", $email);
        $user->delete();
        session()->flush();
    }

    public function createTransaction($user, $amount, $description, $options = [], $referral_id = "", $getConfirmation = true)
    {

        $transaction = UsersTransactions::create([
            "uuid" => $user->uuid,

            "email" => $user->email,
            "telegram_id" => $user->telegram_id,
            "referral_id" => $referral_id,

            "ip" => $user->ip,

            "amount" => $amount,
            "description" => $description,
        ]);

        // return url for yookassa redirect
        if ($getConfirmation) {
            $authService = new AuthService();
            if ($transaction) {
                $options["transaction_id"] = $transaction->id;
                $payment = $authService->createPayment($amount, $description, $options);
                // set yookassa_transaction_id & status columns
                $transaction->yookassa_transaction_id = $payment->id;
                $transaction->status = $payment->status;
                $transaction->save();
                return $payment->getConfirmation()->getConfirmationUrl();
            }
        } else {
            return $transaction;
        }
    }

    public function observeUsersTransactions($user)
    {
        return UsersTransactions::where('uuid', $user->uuid)
            ->orderBy('created_at', "desc")
            ->get();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
        // return redirect()->route('login')->withErrors(["email" => 'Вы успешно вышли из аккаунта.'])->onlyInput("email");
    }

    public function logout_admin()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
        // return redirect()->route('login')->withErrors(["email" => 'Вы успешно вышли из аккаунта.'])->onlyInput("email");
    }

    public function hasImage()
    {
        return UsersImages::where("uuid", Auth::user()->uuid)->exists();
    }

    public function createImage($uuid, $image_data)
    {
        return UsersImages::create([
            'uuid' => $uuid,
            'image_data' => $image_data,
        ]);
    }
}
