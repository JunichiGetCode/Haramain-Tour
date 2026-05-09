<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Buat akun admin default.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@haramaintour.com'],
            [
                'name' => 'Admin Haramain',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        $this->command->info('✅ Akun admin berhasil dibuat!');
        $this->command->info('   Email: admin@haramaintour.com');
        $this->command->info('   Password: admin123');
    }
}
