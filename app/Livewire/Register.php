<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public $password_confirmation = "";
    #[Validate("required|string|min:2|max:25")]
    public $name = "";
    #[Validate("required|min:4|max:50|email|unique:users")]
    public $email = "";
    #[Validate("required|min:1|max:50|unique:users")]
    public $telegram_username = "";
    #[Validate("required|min:8|confirmed")]
    public $password = "";

    public function store()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'telegram_username' => $this->telegram_username,
            'uuid' => Str::uuid()->toString(),
            'referral_id' => Str::uuid()->toString(),
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        $credentials = $this->only('email', 'password');
        Auth::attempt($credentials);
        session()->regenerate();

        return redirect()->route("confirmation");
    }

    public function mount()
    {
        if (Auth::check() && Auth::user()->is_telegram_id_verified === 1) {
            return redirect()->route("dashboard");
        }
    }

    public function render()
    {
        return view('livewire.register');
    }
}
