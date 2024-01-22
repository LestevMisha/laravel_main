<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Models\UsersTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Telegram\Bot\Laravel\Facades\Telegram;

class Dashboard extends Component
{
    private $authService = null;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
        // return redirect()->route('login')->withErrors(["email" => 'Вы успешно вышли из аккаунта.'])->onlyInput("email");
    }

    // in case (isn't used)
    public function delete()
    {
        $user = User::where("uuid", Auth::user()->uuid);
        $user->delete();
        session()->flush();
        return redirect()->route('register');
        // return redirect()->route('register')->withErrors(["email" => 'Вы удалили свою учетную запись.'])->onlyInput("email");
    }

    public function access3(Request $request)
    {
        $amount = 3000;
        $descriprtion = "Monthly payment 3K";

        $transaction = UsersTransactions::create([
            "uuid" => Auth::user()->uuid,
            "amount" => $amount,
            "description" => $descriprtion,
            "ip" => $request->ip(),
        ]);

        if ($transaction) {
            $payment = $this->authService->createPayment($amount, $descriprtion, [
                "transaction_id" => $transaction->id,
                "table" => "UsersTransactions",
            ]);
            $transaction->yookassa_transaction_id = $payment->id;
            $transaction->status = $payment->status;
            $transaction->save();

            return redirect()->away($payment->getConfirmation()->getConfirmationUrl());
        }
    }

    public function mount()
    {
        // open refferal payment link if user was reffered
        if ($this->authService->isReferred()) {
            return redirect()->route("referral_payment");
        }

        if (!Auth::check()) {
            return redirect()->route("login");
        }
        if (Auth::user()->is_telegram_id_verified === 0) {
            return redirect()->route("confirmation");
        }
    }

    public function render()
    {
        return view("livewire.dashboard");
    }
}
