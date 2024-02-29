<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ModelService;
use Livewire\Attributes\Layout;
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
        return "https://t.me/start_marathon_bot?start=" . Auth::user()->uuid;
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
            return redirect()->route("dashboard");
        }
        if (!Auth::check()) {
            return redirect()->route("register");
        }
    }

    // change default layout
    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.telegram-verification');
    }
}
