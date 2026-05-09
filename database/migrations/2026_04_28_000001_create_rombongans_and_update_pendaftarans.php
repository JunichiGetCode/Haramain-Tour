<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel rombongan (kelompok jamaah)
        Schema::create('rombongans', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);                        // Contoh: "Grup A - Makkah"
            $table->string('kode', 20)->unique();               // Contoh: "GRP-A-2026"
            $table->foreignId('ketua_id')
                  ->constrained('users')
                  ->onDelete('restrict');                        // Admin/ketua rombongan
            $table->string('kota_asal', 100)->nullable();
            $table->string('hotel_makkah', 150)->nullable();
            $table->string('hotel_madinah', 150)->nullable();

            // Geofencing safe zone
            $table->decimal('safe_zone_lat', 10, 7)->nullable(); // Koordinat pusat zona aman
            $table->decimal('safe_zone_lng', 10, 7)->nullable();
            $table->integer('safe_zone_radius')->default(500);   // Radius dalam meter

            $table->enum('status', ['aktif', 'selesai', 'belum_mulai'])->default('belum_mulai');
            $table->timestamps();
        });

        // Tambah kolom di pendaftarans untuk H-Nav
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->string('kode_booking', 20)->unique()->nullable()->after('id');
            $table->foreignId('rombongan_id')
                  ->nullable()
                  ->constrained('rombongans')
                  ->onDelete('set null')
                  ->after('paket_id');
            $table->string('nomor_paspor', 50)->nullable()->after('nik');
            $table->string('nomor_kamar', 20)->nullable()->after('nomor_paspor');
            $table->string('fcm_token', 255)->nullable()->after('nomor_kamar'); // Untuk push notif
        });
    }

    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropForeign(['rombongan_id']);
            $table->dropColumn(['kode_booking', 'rombongan_id', 'nomor_paspor', 'nomor_kamar', 'fcm_token']);
        });
        Schema::dropIfExists('rombongans');
    }
};
