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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->bigInteger('phone_number')->unique();
            $table->string('password');
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->boolean('accept_privacy');
            $table->boolean('isactive')->default(1);
            $table->string('profile_img')->nullable();

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
