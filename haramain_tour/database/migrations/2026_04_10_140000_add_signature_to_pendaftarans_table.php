<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->text('tanda_tangan_digital')->nullable()->after('golongan_darah');
            $table->timestamp('surat_perjanjian_accepted_at')->nullable()->after('tanda_tangan_digital');
            $table->timestamp('persyaratan_accepted_at')->nullable()->after('surat_perjanjian_accepted_at');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn(['tanda_tangan_digital', 'surat_perjanjian_accepted_at', 'persyaratan_accepted_at']);
        });
    }
};
