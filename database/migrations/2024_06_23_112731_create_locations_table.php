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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('address')->unique();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('facebook')->unique();
            $table->string('instagram')->unique();
            $table->string('twitter')->unique();
            $table->string('snap_chat')->unique();
            $table->string('tiktok')->unique();

            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
