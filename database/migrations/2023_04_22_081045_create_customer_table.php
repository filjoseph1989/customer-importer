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
        // From the task, this the only data needed for display
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first');
            $table->string('last');
            $table->string('username');
            $table->string('password')->unique();
            $table->string('email')->unique();
            $table->string('country')->nullable();
            $table->string('gender')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
