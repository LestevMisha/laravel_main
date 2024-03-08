<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\UsersTransactions;
use Illuminate\Support\Facades\Auth;

class ReferralTransactions extends Component
{
    protected $listeners = [
        'loadMoreURTs'
    ];

    // for tables optimization to load more
    public int $countURTs = 0;
    public array $users_referral_transactions = [];


    public function loadURTs(): void
    {
        $this->countURTs += 1;
        $transactions = UsersTransactions::where('referral_id', Auth::user()->referral_id)
            ->orderBy("created_at", "desc")
            ->paginate(5, ['*'], 'page');
        array_push($this->users_referral_transactions, ...$transactions->items());
    }

    public function loadMoreURTs(): void
    {
        $this->countURTs += 1;
        $transactions = UsersTransactions::where('referral_id', Auth::user()->referral_id)
            ->orderBy("created_at", "desc")
            ->paginate(5, ['*'], 'page', $this->countURTs);
        array_push($this->users_referral_transactions, ...$transactions->items());
    }

    public function getURTCount() {
        return UsersTransactions::where("referral_id", Auth::user()->referral_id)->count();
    }

    #[Layout("components.layouts.dashboard")]
    public function render()
    {
        return view('livewire.referral-transactions');
    }
}
