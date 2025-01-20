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
        Schema::create('invitation_requests', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Nama lengkap
            $table->string('phone')->unique(); // Nomor WhatsApp (unik)
            $table->string('email')->unique(); // Email (unik)
            $table->string('sample_article'); // Path file sampel tulisan
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status permintaan
            $table->text('admin_notes')->nullable(); // Catatan admin
            $table->timestamps(); // Timestamps: created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitation_requests');
    }
};
