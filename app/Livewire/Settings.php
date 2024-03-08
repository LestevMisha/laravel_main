<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Auth;

class Settings extends Component
{
    public function getLink()
    {
        $tgService = new TelegramService();
        return $tgService->getLink("changeEmail", Auth::user()->uuid);
    }

    #[Layout("components.layouts.dashboard")]
    public function render()
    {
        return view('livewire.settings');
    }
}
