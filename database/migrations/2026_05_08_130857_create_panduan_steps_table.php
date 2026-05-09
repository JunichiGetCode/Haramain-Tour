<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('panduan_steps', function (Blueprint $table) {
            $table->id();
            $table->string('step_id')->unique();  // persiapan, niat-ihram, tawaf, sai, tahallul, ziarah
            $table->string('step_label');           // Persiapan, Langkah 1, dst
            $table->string('title');
            $table->text('description');
            $table->string('icon')->default('clipboard-list');
            $table->integer('order')->default(0);
            $table->json('sections');               // Array of sections with items
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('panduan_steps');
    }
};
