<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE pakets MODIFY COLUMN kategori ENUM('reguler', 'plus', 'furoda', 'haji_basic', 'haji_plus') NOT NULL DEFAULT 'reguler'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE pakets MODIFY COLUMN kategori ENUM('reguler', 'plus', 'furoda') NOT NULL DEFAULT 'reguler'");
    }
};
