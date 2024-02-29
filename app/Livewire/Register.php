<?php

namespace App\Livewire;

use Throwable;

use Livewire\Component;
use App\Services\AuthService;
use App\Services\ModelService;
use Livewire\Attributes\Layout;
use Illuminate\Auth\Events\Registered;

class Register extends Component
{
    public $remember = false;
    public $currentStep;

    // validate attributes for validation
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => "required|string|min:2|max:25",
        'email' => "required|min:4|max:50|email|unique:users",
        'password' => "required|min:8|confirmed",
    ];

    private $authService;
    public function __construct() {
        $this->authService = new AuthService();
    }


    /* +++++++++++++++++++ PUBLIC SECTION +++++++++++++++++++ */
    public function nextStep()
    {
        // Validation rules for each step
        if ($this->currentStep === 0) {
            $this->valid("name");
        } elseif ($this->currentStep === 1) {
            $this->valid("email");
        } elseif ($this->currentStep === 2) {
            $this->submit();
        }
    }

    public function previousStep()
    {
        $this->currentStep--;
        session()->put("currentStep", $this->currentStep);
    }

    public function submit()
    {
        // validate the fields
        $this->validate();

        // save password
        session(["password" => $this->password]);

        $this->authService->handleError(function () {
            // create a new user
            $modelService = new ModelService();
            $user = $modelService->createUser(
                $this->name,
                $this->email,
                $this->password,
            );

            // send verification letter
            event(new Registered($user));


            // authentificate user
            return $this->authService->authenticateUser(
                $this->email,
                $this->password,
                $this->remember,
                $this,
            );
        }, $this);
    }


    /* +++++++++++++++++++ PRIVATE SECTION +++++++++++++++++++ */
    private function valid($key)
    {
        $this->authService->handleError(function () use ($key) {
            $this->resetValidation();
            $this->validateOnly($key);
            session([$key => $this->{$key}]);
            // Move to the next step
            $this->currentStep++;
            session()->put("currentStep", $this->currentStep);
        }, $this, $key);
    }


    /* +++++++++++++++++++ LIVEWIRE'S LIFECYCLE SECTION +++++++++++++++++++ */
    public function mount()
    {
        // keep entered user's data
        $this->currentStep = session()->get("currentStep", 0);
        $this->name = session()->get("name", "");
        $this->email = session()->get("email", "");
        $this->password = session()->get("password", "");

        // general checks
        return $this->authService->check();
    }

    // change default layout
    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.register');
    }
}
