<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kamus_entries', function (Blueprint $table) {
            $table->id();
            $table->string('category');      // sapaan, tempat, sehari, angka, darurat
            $table->text('arabic');
            $table->string('latin');
            $table->string('indonesian');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamus_entries');
    }
};
