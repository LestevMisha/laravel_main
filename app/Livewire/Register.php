<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;
use App\Services\AuthService;

use App\Services\ModelService;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class Register extends Component
{
    public $password;
    public $password_confirmation;
    public $remember = false;

    // validate attributes for validation
    #[Validate("required|string|min:2|max:25")]
    public $name = "";

    #[Validate("required|min:4|max:50|email|unique:users")]
    public $email = "";

    #[Validate("required|min:1|max:50|unique:users")]
    public $telegram_username = "";


    public function store()
    {
        // validate the fields
        $this->validate();

        // confirm password
        $this->validate([
            'password' => "required|min:8|confirmed"
        ]);

        try {
            // create a new user
            $modelService = new ModelService();
            $user = $modelService->createUser(
                $this->name,
                $this->email,
                $this->telegram_username,
                $this->password,
            );

            // send verification letter
            event(new Registered($user));


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
        /*
        In case is user want to insert changes
        1. Telegram must be unverified
        2. Must be logged in
        */
        if (Auth::check() && Auth::user()->telegram_id === null) {
            $modelService = new ModelService();
            $modelService->deleteUser(Auth::user()->email);
        }

        if (Auth::check() && Auth::user()->telegram_id !== null) {
            return redirect()->route("dashboard");
        }
    }


    public function render()
    {
        return view('livewire.register');
    }
}
