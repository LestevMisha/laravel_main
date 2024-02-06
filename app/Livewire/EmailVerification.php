<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;

class EmailVerification extends Component
{

    // User's email verificaiton.
    public function verify(Request $request)
    {
        $userId = $request->route('id');
        $user = User::findOrFail($userId);

        if ($user->hasVerifiedEmail()) {
            return redirect()->route("dashboard");
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->route("dashboard");;
    }

    // Resend verificaiton email to user.
    public function resend(Request $request)
    {
        $request->user()?->sendEmailVerificationNotification();
        return back()
            ->withSuccess('На ваш адрес электронной почты была отправлена новая ссылка для подтверждения.');
    }

    public function mount(Request $request)
    {
        // in case if admin
        if (Auth::guard('admin')->check()) {
            return redirect()->route("admin.panel");
        }
        
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }
    }

    public function render()
    {
        return view('livewire.email-verification');
    }
}
