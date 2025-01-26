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
        Schema::create('dare_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dare_quiz_id')->constrained('dare_quizzes')->onDelete('cascade');
            $table->text('question');
            $table->json('options'); // Menyimpan opsi dalam format JSON
            $table->string('correct_answer'); // Simpan index atau value dari jawaban yang benar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dare_questions');
    }
};
