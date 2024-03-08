<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ModelService;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class TelegramVerification extends Component
{

    public function generateQRCode($arg)
    {
        return QrCode::generate(
            $arg,
        );
    }

    public function getLink()
    {
        $tgService = new TelegramService();
        return $tgService->getLink(Auth::user()->uuid, "telegram-verification");
    }

    public function deleteUser()
    {
        $modelService = new ModelService();
        $modelService->deleteUser(Auth::user()->email);
        return redirect()->route("register");
    }

    public function mount()
    {
        if (Auth::check() && Auth::user()->telegram_id !== null) {

            // make user pay 10K for enterance
            if (Auth::user()->is_paid_10K === 0) {
                $yoo = new ModelService();
                $link = $yoo->createTransaction(
                    Auth::user(),
                    10000,
                    "New registered user - 10K",
                    ["is_paid_10K" => 1],
                    session()->get("referral_id", "")
                );
                return redirect()->away($link);
            }

            return redirect()->route("dashboard");
        }

        if (!Auth::check()) {
            return redirect()->route("register");
        }
    }

    public function render()
    {
        return view('livewire.telegram-verification');
    }
}
