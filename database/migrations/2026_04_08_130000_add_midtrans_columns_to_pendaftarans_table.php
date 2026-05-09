<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->string('snap_token')->nullable()->after('bukti_pembayaran');
            $table->string('midtrans_order_id')->nullable()->unique()->after('snap_token');
            $table->string('midtrans_transaction_id')->nullable()->after('midtrans_order_id');
            $table->enum('payment_status', ['unpaid', 'paid', 'expired', 'failed'])->default('unpaid')->after('midtrans_transaction_id');
        });

        // Make metode_pembayaran and bukti_pembayaran nullable using raw SQL
        // (enum columns can't use ->change() easily)
        DB::statement("ALTER TABLE pendaftarans MODIFY metode_pembayaran VARCHAR(50) NULL");
        DB::statement("ALTER TABLE pendaftarans MODIFY bukti_pembayaran VARCHAR(255) NULL");

        // Update existing records: set payment_status to 'paid' for existing pendaftarans that already have bukti_pembayaran
        DB::statement("UPDATE pendaftarans SET payment_status = 'paid' WHERE bukti_pembayaran IS NOT NULL AND bukti_pembayaran != ''");
    }

    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn(['snap_token', 'midtrans_order_id', 'midtrans_transaction_id', 'payment_status']);
        });

        DB::statement("ALTER TABLE pendaftarans MODIFY metode_pembayaran ENUM('transfer_bca','transfer_mandiri','transfer_bni') NOT NULL");
        DB::statement("ALTER TABLE pendaftarans MODIFY bukti_pembayaran VARCHAR(255) NOT NULL");
    }
};
