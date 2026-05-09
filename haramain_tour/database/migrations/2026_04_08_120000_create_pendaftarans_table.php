<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('paket_id')->constrained()->onDelete('cascade');

            // Identitas Jamaah
            $table->string('nama_lengkap', 200);
            $table->string('nik', 16);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('no_hp', 20);
            $table->text('alamat_lengkap');
            $table->string('nama_mahram', 200)->nullable();

            // Dokumen
            $table->string('foto_ktp');
            $table->string('foto_paspor');
            $table->string('foto_visa')->nullable();
            $table->string('foto_buku_vaksin');
            $table->text('riwayat_penyakit')->nullable();
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O']);

            // Pembayaran
            $table->enum('metode_pembayaran', ['transfer_bca', 'transfer_mandiri', 'transfer_bni']);
            $table->bigInteger('jumlah_bayar');
            $table->string('bukti_pembayaran');

            // Status & Admin
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan_admin')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
