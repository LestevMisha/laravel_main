<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Client\Request;
use Livewire\Attributes\Layout;

class ResetPassword extends Component
{
    // hidden
    public $token = null;
    // visible
    #[Validate("required|min:4|max:50|email")]
    public $email = null;
    public $password = null;
    public $password_confirmation = null;

    public function resetPassword()
    {
        // validate the fields
        $this->validate();

        // confirm password
        $this->validate([
            'password' => "required|min:8|confirmed"
        ]);


        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );

        // if success redirect with success message in dashboard
        if ($status === Password::PASSWORD_RESET) {
            session()->flash('success', __($status));
            return redirect()->route('login');
        }

        return $this->addError('status', __($status));
    }

    public function mount() {
        $this->email = request()->email;
    }

    public function render()
    {
        return view('livewire.reset-password');
    }
}
