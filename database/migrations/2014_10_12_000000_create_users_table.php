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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();

            $table->integer('days_left')->default(0);

            $table->string('name');
            $table->string('email')->unique();
            $table->string('telegram_username')->nullable();

            /* if empty (null) - user is not either verified/referred,
            if not empty (<value>) - user is either verified/referred  */
            $table->string('telegram_id')->nullable();
            $table->string('referral_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
