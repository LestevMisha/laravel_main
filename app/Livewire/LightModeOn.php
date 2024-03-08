<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UsersImages;
use Illuminate\Support\Facades\Auth;

class LightModeOn extends Component
{
    public $image;
    public $checked;
    public $menu_type;

    public function toggle()
    {
        session()->put("checked", !session()->get("checked", false));
        $this->checked = session()->get("checked");
    }
    
    public function mount()
    {
        $this->image = UsersImages::where("uuid", Auth::user()?->uuid)->first();
        $this->checked = session()->get('checked', false);
    }

    public function render()
    {
        return view('livewire.light-mode-on');
    }
}
