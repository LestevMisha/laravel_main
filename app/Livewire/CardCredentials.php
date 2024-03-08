<?php

namespace App\Livewire;

use Livewire\Component;
use LVR\CreditCard\CardCvc;
use App\Services\ModelService;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;

class CardCredentials extends Component
{
    public $card_name = '';
    public $card_number = '';
    public $expiration = '';
    public $expiration_year = 0;
    public $expiration_month = 0;
    public $cvc = '';

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
        return redirect()->route("dashboard");
    }

    public function render()
    {
        return view('livewire.card-credentials');
    }
}
