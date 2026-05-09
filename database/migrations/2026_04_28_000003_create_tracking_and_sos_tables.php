<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel lokasi jamaah (GPS tracking real-time)
        Schema::create('lokasi_jamaah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pendaftaran_id')
                  ->nullable()
                  ->constrained('pendaftarans')
                  ->onDelete('set null');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->decimal('akurasi', 8, 2)->nullable();       // Akurasi GPS dalam meter
            $table->boolean('di_luar_zona')->default(false);    // Flag OOZ (out of zone)
            $table->timestamp('waktu')->useCurrent();
            $table->timestamps();

            // Index untuk query cepat
            $table->index(['user_id', 'waktu']);
        });

        // Tabel lokasi bus (GPS bus real-time)
        Schema::create('lokasi_bus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id')
                  ->constrained('jadwal_bus')
                  ->onDelete('cascade');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->decimal('kecepatan_kmh', 6, 2)->nullable();
            $table->decimal('arah_derajat', 6, 2)->nullable();  // Bearing 0-360
            $table->timestamp('waktu')->useCurrent();
            $table->timestamps();

            $table->index(['jadwal_id', 'waktu']);
        });

        // Tabel SOS / alert darurat
        Schema::create('sos_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pendaftaran_id')
                  ->nullable()
                  ->constrained('pendaftarans')
                  ->onDelete('set null');
            $table->enum('tipe', [
                'sos',          // Darurat umum
                'out_of_zone',  // Keluar zona
                'saya_tersesat' // Minta navigasi
            ])->default('sos');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->text('pesan')->nullable();
            $table->enum('status', ['aktif', 'ditangani', 'selesai'])->default('aktif');
            $table->foreignId('ditangani_oleh')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');
            $table->timestamp('ditangani_pada')->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sos_alerts');
        Schema::dropIfExists('lokasi_bus');
        Schema::dropIfExists('lokasi_jamaah');
    }
};
