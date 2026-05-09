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
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->enum('kategori', ['reguler', 'plus', 'furoda']);
            $table->integer('durasi_hari');
            $table->date('tanggal_keberangkatan')->nullable(); // nullable as some packages might be generic
            $table->string('hotel_makkah', 150)->nullable();
            $table->string('hotel_madinah', 150)->nullable();
            $table->bigInteger('harga');
            $table->string('harga_label', 50)->default('/Orang');
            $table->decimal('rating', 3, 1)->default(5.0);
            $table->text('deskripsi')->nullable();
            $table->json('fasilitas')->nullable();
            $table->string('gambar_utama')->nullable();
            $table->json('gambar_rincian')->nullable(); // array of image paths for slider
            $table->boolean('status_populer')->default(false);
            $table->boolean('status_premium')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
