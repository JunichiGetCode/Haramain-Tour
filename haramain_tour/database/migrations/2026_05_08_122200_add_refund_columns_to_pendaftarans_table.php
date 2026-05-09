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
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->enum('refund_status', ['none', 'requested', 'processed', 'completed'])->default('none')->after('payment_status');
            $table->text('catatan_refund')->nullable()->after('refund_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn(['refund_status', 'catatan_refund']);
        });
    }

};
