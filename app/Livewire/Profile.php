<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Profile extends Component
{

    #[Layout("components.layouts.dashboard")]
    public function render()
    {
        return view('livewire.profile');
    }
}
