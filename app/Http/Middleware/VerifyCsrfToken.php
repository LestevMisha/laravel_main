<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [];
    public function __construct(Application $app, Encrypter $encrypter)
    {
        $this->except = [
            "/" . config("services.telegram.bot_token") . "/tgwebhook",
            "/yoocallback",
        ];
        parent::__construct($app, $encrypter);
    }
}
