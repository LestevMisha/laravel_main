<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TelegramVerification extends Component
{

    public function mount()
    {
        if (Auth::check() && Auth::user()->telegram_id !== null) {
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
