<?php

namespace App\Livewire;

use Livewire\Component;
use LVR\CreditCard\CardCvc;
use App\Services\AuthService;
use LVR\CreditCard\CardNumber;
use App\Models\UsersTransactions;
use App\Services\ModelService;
use Illuminate\Support\Facades\Auth;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;

class Dashboard extends Component
{
    public $card_name = '';
    public $card_number = '';
    public $expiration = '';
    public $expiration_year = 0;
    public $expiration_month = 0;
    public $cvc = '';

    protected $listeners = [
        'loadMoreUTs',
        'loadMoreURTs'
    ];

    static function hasCardVerification()
    {
        $modelService = new ModelService();
        if ($modelService->getCardCredentials(Auth::user()->uuid)) {
            return true;
        }
        return false;
    }

    protected $rules = [];
    public function saveCC()
    {
        if ($this->expiration) {
            $monthYearArr = explode('/', $this->expiration);
            $this->expiration_year = $monthYearArr[1];
            $this->expiration_month = $monthYearArr[0];
        }

        $this->rules = [
            'card_name' => ['required', "min:3"],
            'card_number' => ['required', 'unique:card_credentials,card_number', "min:16", "max:16", new CardNumber],
            'expiration_year' => ['required', new CardExpirationYear($this->expiration_month)],
            'expiration_month' => ['required', new CardExpirationMonth($this->expiration_year)],
            'cvc' => ['required', new CardCvc($this->card_number)]
        ];

        $this->validate();

        $modelService = new ModelService();
        $modelService->insertCardCredentials(
            $this->card_name,
            $this->card_number,
            $this->cvc,
            $this->expiration,
        );
        return redirect(request()->header('Referer'));
    }

    // getting & keeping modal open/closed
    public int $isModalOpened = 0;
    public function setModal($index)
    {
        $this->isModalOpened = $index;
    }

    // getting & keeping current tab
    public int $currentTab = 0;
    public function setCurrentTab($index)
    {
        $this->currentTab = $index;
    }

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route("login");
        }
        if (Auth::user()->telegram_id === null) {
            return redirect()->route("telegram.verify");
        }

        // !IMPORTANT It must be after user is logged in
        // open referral payment link if user was reffered
        $authService = new AuthService();
        if ($authService->isReferred()) {
            return redirect()->route("payment.referral");
        }
    }


    public function render()
    {
        return view("livewire.dashboard");
    }


    // for tables optimization to load more
    public int $countUTs = 0;
    public int $countURTs = 0;
    public array $users_transactions = [];
    public array $users_referral_transactions = [];

    public function getUsersTransactionsCount(bool $isReferral = false)
    {
        if ($isReferral) {
            return UsersTransactions::where('referral_id', Auth::user()->referral_id)->count();
        }
        return UsersTransactions::where('uuid', Auth::user()->uuid)->count();
    }

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
}
