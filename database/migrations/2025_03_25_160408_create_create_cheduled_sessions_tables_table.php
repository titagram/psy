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
        Schema::create('scheduled_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('therapist')->constrained('users');
            $table->foreignId('session_type_id')->constrained();
            $table->dateTime('date_time')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduled_sessions');
    }
};
