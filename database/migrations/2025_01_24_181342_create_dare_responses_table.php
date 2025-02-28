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
        Schema::create('dare_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dare_quiz_id')->constrained()->onDelete('cascade');
            $table->string('responder_name');
            $table->text('responder_message')->nullable();
            $table->integer('score');
            $table->integer('time');
            $table->string('identifier')->nullable();
            $table->string('location')->nullable();
            $table->string('device')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dare_responses');
    }
};
