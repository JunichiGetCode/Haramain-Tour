<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doas', function (Blueprint $table) {
            $table->id();
            $table->string('category');      // masjid, tawaf, sai, arafah
            $table->string('title');
            $table->text('arabic');
            $table->text('latin');
            $table->text('translation');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doas');
    }
};
