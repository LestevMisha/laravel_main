<?php

namespace App\Livewire;

use Livewire\Component;

class MainIndex extends Component
{
    public $referralId;

    public function mount()
    {
        // Retrieve the value of the query parameter
        $this->referralId = request()->query('referral_id');
        // Optionally, you can remove the query parameter from the URL
        if ($this->referralId) {
            session()->put("referral_id", $this->referralId);
        }
    }

    public function render()
    {
        return view('livewire.main-index');
    }
}
