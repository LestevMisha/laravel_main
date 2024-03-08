<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users_images', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->timestamps();
        });
        if (!Schema::hasColumn("users_images", "image_data")) {
            DB::statement("ALTER TABLE users_images ADD image_data LONGBLOB");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_images');
    }
};
