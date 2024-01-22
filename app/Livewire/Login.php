<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    #[Validate('required|min:4|email')]
    public $email = "";
    #[Validate('required|min:8')]
    public $password = "";


    public function auth()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return redirect()->route("dashboard");
        }
        $this->addError('email', 'Предоставленные вами учетные данные не совпадают с нашими записями.');
    }

    public function mount()
    {
        if (Auth::check() && Auth::user()->is_telegram_id_verified === 1) {
            return redirect()->route("dashboard");
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
