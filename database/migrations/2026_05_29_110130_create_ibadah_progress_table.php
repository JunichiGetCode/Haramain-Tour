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
        Schema::create('ibadah_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('ibadah_id'); // e.g. sholat_subuh, tawaf
            $table->integer('hari_ke')->default(1);
            $table->string('status')->default('belum'); // belum, sedang, selesai
            $table->timestamps();
            
            // A user can only have one status per ibadah_id per hari_ke
            $table->unique(['user_id', 'ibadah_id', 'hari_ke']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ibadah_progress');
    }
};
