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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // User yang menerima notifikasi
            $table->string('type')->default('general'); // Jenis notifikasi, seperti 'referral', 'rank_update'
            $table->string('image')->default('assets/img/profpic.svg');
            $table->string('link')->nullable();
            $table->string('title'); // Pesan notifikasi
            $table->text('message'); // Pesan notifikasi
            $table->boolean('is_read')->default(false); // Status apakah notifikasi sudah dibaca
            $table->timestamp('read_at')->nullable(); // Waktu notifikasi dibaca
            $table->timestamps();

            // Foreign key untuk menghubungkan ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
