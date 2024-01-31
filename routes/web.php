<?php

use App\Livewire\Error;
use App\Livewire\Index;
use App\Livewire\Login;
use App\Livewire\Support;
use App\Livewire\Register;
use App\Livewire\Dashboard;
use App\Livewire\Documents;
use App\Livewire\TelegramVerification;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\YooKassaController;
use App\Livewire\EmailVerification;
use App\Services\ModelService;

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

Route::match(["POST", "GET"], '/', Index::class)->name("main");
Route::get("/logout", [ModelService::class, "logout"])->name("logout");
Route::get("/documents", Documents::class)->name("documents");
Route::get("/support", Support::class)->name("support");
Route::get("/error", Error::class)->name("error");
// For email verification

// E-mail Verification Routes + store for registration
Route::controller(EmailVerification::class)->group(function () {
    Route::get("/email/verify", EmailVerification::class)->name("verification.notice");
    Route::get("/email/verify/{id}/{hash}", "verify")->name("verification.verify");
    Route::post("/email/resend", "resend")->name("verification.resend");
});

Route::controller(TelegramController::class)->group(function () {
    $token = config("services.telegram.bot_token");
    Route::post("/$token/tgwebhook", "webhook");
    // test ++++++++++++
    Route::get("/setwebhook", "setWebhook");
    Route::get("/removewebhook", "removeWebhook");
    // test ------------
});

// main logic
Route::get("/login", Login::class)->name("login");
Route::get("/register", Register::class)->name("register");
Route::get("/dashboard", Dashboard::class)->name("dashboard");
Route::get("/telegram-verification", TelegramVerification::class)->name("telegram-verification");

Route::controller(YooKassaController::class)->group(function () {
    Route::get("/pay_3000", "pay_3000")->name("pay_3000");
    Route::post("/yoocallback", "callback");
    Route::match(["POST", "GET"], "/referral_payment", "referral_payment")->name("referral_payment");
});
