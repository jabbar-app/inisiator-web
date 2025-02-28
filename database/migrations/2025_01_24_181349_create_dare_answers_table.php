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
        Schema::create('dare_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dare_response_id')->constrained()->onDelete('cascade');
            $table->foreignId('dare_question_id')->constrained()->onDelete('cascade');
            $table->string('selected_answer');
            $table->integer('time')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dare_answers');
    }
};
