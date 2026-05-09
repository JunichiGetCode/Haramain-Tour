<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Paket;

try {
    $paket = Paket::create([
        'nama' => 'Paket Premium Plus 12 Hari',
        'kategori' => 'plus',
        'durasi_hari' => 12,
        'tanggal_keberangkatan' => '2026-10-15',
        'hotel_makkah' => 'Pullman Zamzam Makkah',
        'hotel_madinah' => 'Anwar Al Madinah Mofvenpick',
        'harga' => 35000000,
        'harga_label' => 'Rp 35.000.000',
        'rating' => 5,
        'deskripsi' => 'Paket Umroh Premium dengan fasilitas bintang 5 dan pelayanan terbaik.',
        'fasilitas' => ['Tiket PP Pesawat', 'Hotel Bintang 5', 'Makan 3x Sehari', 'Visa Umroh', 'Ziarah Makkah & Madinah', 'Mutawwif Berpengalaman'],
        'gambar_utama' => 'images/paket-1.jpg',
        'status_populer' => true,
        'status_premium' => true,
    ]);

    echo "SUCCESS: Paket created with ID: " . $paket->id . "\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
