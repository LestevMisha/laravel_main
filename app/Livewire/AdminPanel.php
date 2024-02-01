<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminPanel extends Component
{

    public function mount() {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('register');
        }
    }

    public function render()
    {
        return view('livewire.admin-panel');
    }
}
