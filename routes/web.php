<?php

use App\Livewire\Admin;
use App\Livewire\Error;
use App\Livewire\Index;
use App\Livewire\Login;
use App\Livewire\Support;
use App\Livewire\Register;
use App\Livewire\Dashboard;
use App\Livewire\Documents;
use App\Livewire\AdminPanel;
use App\Services\ModelService;
use App\Livewire\EmailVerification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Livewire\TelegramVerification;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\YooKassaController;
// make all redirections using https !IMPORTANT
URL::forceScheme("https");


// Pages
Route::get('/', Index::class)->name("main");
Route::get("/login", Login::class)->name("login");
Route::get("/error", Error::class)->name("error");
Route::get("/support", Support::class)->name("support");
Route::get("/register", Register::class)->name("register");
Route::get("/documents", Documents::class)->name("documents");
Route::get("/dashboard", Dashboard::class)->name("dashboard");
Route::get("/telegram/verify", TelegramVerification::class)->name("telegram.verify");
Route::get("/email/verify", EmailVerification::class)->name("email.verify");
Route::get("/admin/login", Admin::class)->name("admin.login");
Route::get("/admin/panel", AdminPanel::class)->name("admin.panel");

// methods
Route::post("/logout", [ModelService::class, "logout"])->name("logout");


// Telegram Verification
Route::controller(TelegramController::class)->group(function () {
    Route::post("/" . config("services.telegram.bot_token") . "/webhook", "webhook");
    Route::get("/setwebhook", "setWebhook");
    Route::get("/removewebhook", "removeWebhook");
});

// E-mail Verification
Route::controller(EmailVerification::class)->group(function () {
    Route::get("/email/verify/{id}/{hash}", "verify")->name("verification.verify");
    Route::post("/email/resend", "resend")->name("verification.resend");
});

// Payment Routes
Route::controller(YooKassaController::class)->group(function () {
    Route::post("/yoocallback", "callback");
    Route::post("/payment/monthly", "monthlyPayment")->name("payment.monthly");
    Route::get("/payment/referral", "referralPayment")->name("payment.referral");
});
