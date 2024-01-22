<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Confirmation extends Component
{

    public function mount()
    {
        if (Auth::check() && Auth::user()->is_telegram_id_verified === 1) {
            return redirect()->route("dashboard");
        }
        if (!Auth::check()) {
            return redirect()->route("register");
        }
    }

    public function render()
    {
        return view('livewire.confirmation');
    }
}
