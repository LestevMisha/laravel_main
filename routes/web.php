<?php

use App\Http\Controllers\TelegramController;
use App\Http\Controllers\YooKassaController;
use App\Livewire\Confirmation;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\Dashboard;
use App\Livewire\Error;
use App\Livewire\Index;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::match(["POST", "GET"], '/', Index::class);

Route::controller(TelegramController::class)->group(function () {
    $token = config("services.telegram.bot_token");
    Route::post("/$token/tgwebhook", "webhook");
    // test ++++++++++++
    Route::get("/setwebhook", "setWebhook");
    Route::get("/removewebhook", "removeWebhook");
    // test ------------
});

Route::get("/login", Login::class)->name("login");
Route::get("/register", Register::class)->name("register");
Route::get("/dashboard", Dashboard::class)->name("dashboard");
Route::get("/confirmation", Confirmation::class)->name("confirmation");

Route::controller(YooKassaController::class)->group(function () {
    Route::post("/yoocallback", "callback");
    Route::match(["POST", "GET"], "/referral_payment", "referral_payment")->name("referral_payment");
});

Route::get("/error", Error::class)->name("error");
