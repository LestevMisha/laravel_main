<?php

namespace App\Livewire;

use DateTime;
use DateTimeZone;
use App\Models\User;
use IntlDateFormatter;
use Livewire\Component;
use App\Models\UsersTransactions;
use Illuminate\Support\Facades\Auth;

class AdminPanel extends Component
{
    public $users_transactions = null;
    public $users = null;

    public function getTimeMsc($date)
    {
        $formatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::LONG, IntlDateFormatter::SHORT);
        return $formatter->format(new DateTime($date));
    }

    public function mount()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login');
        }

        // get all transactions
        $this->users_transactions = UsersTransactions::get();
        $this->users = User::get();
    }

    public function render()
    {
        return view('livewire.admin-panel');
    }
}
