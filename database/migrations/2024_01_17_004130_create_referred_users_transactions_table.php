<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('referred_users_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('email')->default("");
            $table->string('telegram_id')->default("");
            $table->string('uuid')->default("");
            $table->string('yookassa_transaction_id')->default("");
            $table->string('payment_method_id')->default("");
            $table->enum('status', ['created', 'pending', 'waiting_for_capture', 'canceled', 'succeeded'])->default('created');
            $table->string('referral_id')->default("");
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('description', 255)->nullable();
            $table->string('ip', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referred_users_transactions');
    }
};
