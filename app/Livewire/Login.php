<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;
use App\Services\AuthService;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $remember = false;

    // validate attributes for validation
    #[Validate('required|min:4|email')]
    public $email = "";

    #[Validate('required|min:8')]
    public $password = "";


    public function auth()
    {
        // validate the fields
        $this->validate();

        try {

            // authentificate user
            $authService = new AuthService();
            return $authService->authenticateUser(
                $this->email,
                $this->password,
                $this->remember,
                $this,
            );
        } catch (Exception $e) {
            $error = "Пожалуйста проверьте интернет соединение. Попробуйте позже. Если ничего не помогло напишите нам в поддержку." . " Ошибка сервера: " . $e->getMessage();
            $this->addError("server", $error);
        }
    }


    public function mount()
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


    public function render()
    {
        return view('livewire.login');
    }
}
