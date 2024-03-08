<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;
use App\Services\AuthService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $remember = false;

    // validate attributes for validation
    public $email;
    public $password;

    protected $rules = [
        'email' => "required|min:4|email",
        'password' => "required|min:8",
    ];

    private $authService;
    public function __construct()
    {
        $this->authService = new AuthService();
    }


    /* +++++++++++++++++++ PUBLIC SECTION +++++++++++++++++++ */

    public function submit()
    {
        // validate the fields
        $this->validate();

        // save password
        session(["password" => $this->password]);

        $this->authService->handleError(function () {
            // authentificate user
            return $this->authService->authenticateUser(
                $this->email,
                $this->password,
                $this->remember,
                $this,
            );
        }, $this);
    }


    /* +++++++++++++++++++ LIVEWIRE'S LIFECYCLE SECTION +++++++++++++++++++ */
    public function mount()
    {
        // keep entered user's data
        $this->email = session()->get("email", "");
        $this->password = session()->get("password", "");

        // general checks
        return $this->authService->check();
    }

    public function render()
    {
        return view('livewire.login');
    }
}
