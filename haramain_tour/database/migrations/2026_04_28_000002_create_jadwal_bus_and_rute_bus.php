<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel jadwal bus
        Schema::create('jadwal_bus', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_bus', 20);                    // Contoh: "Bus 01"
            $table->string('nama_sopir', 100)->nullable();
            $table->string('no_plat', 20)->nullable();
            $table->foreignId('rombongan_id')
                  ->nullable()
                  ->constrained('rombongans')
                  ->onDelete('set null');

            $table->string('dari', 150);                        // Titik keberangkatan
            $table->string('ke', 150);                          // Tujuan
            $table->date('tanggal');
            $table->time('jam_berangkat');
            $table->time('jam_tiba_estimasi')->nullable();

            $table->integer('kapasitas')->default(40);
            $table->integer('penumpang_terisi')->default(0);

            $table->enum('status', [
                'terjadwal',
                'boarding',
                'dalam_perjalanan',
                'tiba',
                'dibatalkan'
            ])->default('terjadwal');

            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        // Tabel rute bus (polyline per rute)
        Schema::create('rute_bus', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);                        // Contoh: "Hotel → Masjidil Haram"
            $table->string('kode', 30)->unique();               // Contoh: "HTL-HRM"
            $table->json('stops');                              // Array titik pemberhentian [{nama, lat, lng}]
            $table->json('polyline')->nullable();               // Array koordinat polyline [{lat, lng}]
            $table->integer('estimasi_menit')->nullable();
            $table->string('warna', 10)->default('#C9A84C');    // Warna polyline di peta
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rute_bus');
        Schema::dropIfExists('jadwal_bus');
    }
};
