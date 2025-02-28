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
        Schema::create('dare_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dare_quiz_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('content');
            $table->boolean('is_visible')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dare_messages');
    }
};
