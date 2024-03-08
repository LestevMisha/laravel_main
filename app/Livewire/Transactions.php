<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UsersTransactions;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

class Transactions extends Component
{
    protected $listeners = [
        'loadMoreUTs',
    ];

    // for tables optimization to load more
    public int $countUTs = 0;
    public array $users_transactions = [];

    public function loadUTs(): void
    {
        $this->countUTs += 1;
        $transactions = UsersTransactions::where('uuid', Auth::user()->uuid)
            ->orderBy("created_at", "desc")
            ->paginate(5, ['*'], 'page');
        array_push($this->users_transactions, ...$transactions->items());
    }

    public function loadMoreUTs(): void
    {
        $this->countUTs += 1;
        $transactions = UsersTransactions::where('uuid', Auth::user()->uuid)
            ->orderBy("created_at", "desc")
            ->paginate(5, ['*'], 'page', $this->countUTs);
        array_push($this->users_transactions, ...$transactions->items());
    }

    public function getUTCount() {
        return UsersTransactions::where('uuid', Auth::user()->uuid)->count();
    }

    #[Layout("components.layouts.dashboard")]
    public function render()
    {
        return view('livewire.transactions');
    }
}
