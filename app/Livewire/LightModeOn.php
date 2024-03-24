<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;
use App\Models\UsersImages;
use Illuminate\Support\Facades\DB;
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
        try {
            $_ = DB::connection()->getPDO();
            $_ = DB::connection()->getDatabaseName();
            $this->image = UsersImages::where("uuid", Auth::user()?->uuid)->first();
        } catch (Exception $e) {
        }
        $this->checked = session()->get('checked', false);
    }

    public function render()
    {
        return view('livewire.light-mode-on');
    }
}
