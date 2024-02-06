<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Admin extends Component
{

    public $remember = false;

    // validate attributes for validation
    #[Validate('required|min:4')]
    public $telegram_profile = "";

    #[Validate('required|min:8')]
    public $password = "";


    public function auth_admin(Request $request)
    {
        // validate the fields
        $this->validate();

        try {
            // authentificate user
            $authService = new AuthService();
            return $authService->authenticateAdmin(
                $this->telegram_profile,
                $this->password,
                $this->remember,
                $request->ip(),
                $this,
            );
        } catch (Exception $e) {
            $error = "Пожалуйста проверьте интернет соединение. Попробуйте позже. Если ничего не помогло напишите нам в поддержку." . " Ошибка сервера: " . $e->getMessage();
            $this->addError("server", $error);
        }
    }

    public function mount()
    {
        // check if logged user tries to access admin panel
        if (Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::guard('admin')->check()) {
            return redirect()->route("admin.panel");
        }
    }

    public function render()
    {
        return view('livewire.admin');
    }
}
