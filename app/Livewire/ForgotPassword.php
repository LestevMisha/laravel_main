<?php

namespace App\Livewire;

use Exception;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component
{
    public $disabled = false;
    protected $listeners = ['resetDisabled'];

    public function resetDisabled()
    {
        $this->disabled = false;
    }


    // validate attributes for validation
    #[Validate('required|min:4|email')]
    public $email = "";

    public function sendResetLink()
    {
        // validate the fields
        $this->validate();

        if (User::where('email', $this->email)->first() === null) {
            return $this->addError(
                'email',
                'Предоставленный вами адрес электронной почты не существует.',
            );
        }

        try {
            if ($this->disabled === false) {
                $this->disabled = true;
                $email = $this->email;
                $status = Password::sendResetLink(compact('email'));
                if ($status === Password::RESET_LINK_SENT) {
                    session()->flash('success', __($status));
                } else {
                    session()->flash('failure', __($status));
                }
            }
        } catch (Exception $e) {
            $error = "Пожалуйста проверьте интернет соединение. Попробуйте позже. Если ничего не помогло напишите нам в поддержку." . " Ошибка сервера: " . $e->getMessage();
            $this->addError("server", $error);
        }
    }

    // change default layout
    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.forgot-password');
    }
}
