<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paket;
use Carbon\Carbon;

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pakets = [
            [
                'id' => 1,
                'nama' => 'Paket Umroh Ekonomis',
                'kategori' => 'reguler',
                'durasi_hari' => 9,
                'tanggal_keberangkatan' => Carbon::create(2026, 1, 20),
                'hotel_makkah' => 'Makareem Umm Al Quro Makkah',
                'hotel_madinah' => 'Madinah Aram Hotel',
                'harga' => 25000000,
                'rating' => 4.5,
                'deskripsi' => 'Paket spesial Ramadhan untuk merasakan suasana ibadah di bulan penuh berkah. Lengkap dengan sahur dan berbuka di tanah suci dengan pembimbing tersertifikasi.',
                'fasilitas' => [
                    ['icon' => 'fa-plane', 'text' => 'Tiket Pesawat Pulang Pergi'],
                    ['icon' => 'fa-suitcase', 'text' => 'Perlengkapan Umroh Standar'],
                    ['icon' => 'fa-hotel', 'text' => 'Hotel Bintang 3 (Mekkah & Madinah)'],
                    ['icon' => 'fa-passport', 'text' => 'Visa Umroh & Asuransi'],
                    ['icon' => 'fa-utensils', 'text' => 'Makan 3x Sehari (Menu Indonesia)']
                ],
                'gambar_utama' => 'storage/image/paket1.jpeg',
                'gambar_rincian' => [
                    'storage/image/paket1.jpeg',
                    'storage/image/hotel1.png',
                    'storage/image/hotel2.png'
                ],
                'status_populer' => true,
                'status_premium' => false,
            ],
            [
                'id' => 2,
                'nama' => 'Paket Umroh Bintang 4',
                'kategori' => 'plus',
                'durasi_hari' => 10,
                'tanggal_keberangkatan' => Carbon::create(2026, 2, 15),
                'hotel_makkah' => 'Makareem Umm Al Qura',
                'hotel_madinah' => 'Saja Al Madinah',
                'harga' => 35000000,
                'rating' => 4.0,
                'deskripsi' => 'Nikmati pengalaman ibadah Umroh yang khusyuk dan nyaman dengan fasilitas hotel bintang 4. Menginap di Makareem Umm Al Qura (Makkah) dan Saja Al Madinah (Madinah) yang strategis dan memberikan pelayanan berkualitas internasional.',
                'fasilitas' => [
                    ['icon' => 'fa-plane', 'text' => 'Tiket Pesawat Pulang Pergi'],
                    ['icon' => 'fa-suitcase', 'text' => 'Perlengkapan Umroh Standar'],
                    ['icon' => 'fa-hotel', 'text' => 'Hotel Makareem Umm Al Qura Bintang 4 (Makkah)'],
                    ['icon' => 'fa-hotel', 'text' => 'Hotel Saja Al Madinah Bintang 4 (Madinah)'],
                    ['icon' => 'fa-passport', 'text' => 'Visa Umroh & Asuransi'],
                    ['icon' => 'fa-utensils', 'text' => 'Makan 3x Sehari (Menu Indonesia)']
                ],
                'gambar_utama' => 'storage/image/cover2.jpeg',
                'gambar_rincian' => [
                    'storage/image/cover2.jpeg',
                    'storage/image/hotel3.jpeg',
                    'storage/image/hotel2.jpeg'
                ],
                'status_populer' => false,
                'status_premium' => false,
            ],
            [
                'id' => 3,
                'nama' => 'Paket Umroh Bintang 5 Premium',
                'kategori' => 'furoda',
                'durasi_hari' => 12,
                'tanggal_keberangkatan' => Carbon::create(2026, 3, 10),
                'hotel_makkah' => 'Makkah Al Aziziah',
                'hotel_madinah' => 'Crowne Plaza Madinah',
                'harga' => 45000000,
                'rating' => 5.0,
                'deskripsi' => 'Rasakan pengalaman ibadah umroh terbaik dengan akomodasi hotel bintang 5 premium. Menginap di Crowne Plaza Madinah yang berada hanya beberapa langkah dari Masjid Nabawi, dan Makkah Al Aziziah dengan akses mudah ke Masjidil Haram. Dilengkapi pembimbing berpengalaman, city tour eksklusif, dan pelayanan VIP sepanjang perjalanan.',
                'fasilitas' => [
                    ['icon' => 'fa-plane', 'text' => 'Tiket Pesawat PP (Direct Flight)'],
                    ['icon' => 'fa-hotel', 'text' => 'Crowne Plaza Madinah ★★★★★ (5 Malam)'],
                    ['icon' => 'fa-hotel', 'text' => 'Makkah Al Aziziah ★★★★★ (5 Malam)'],
                    ['icon' => 'fa-utensils', 'text' => 'Makan 3x Sehari (Buffet Internasional & Indonesia)'],
                    ['icon' => 'fa-bus', 'text' => 'Transportasi Bus VIP Full AC'],
                    ['icon' => 'fa-passport', 'text' => 'Visa Umroh & Asuransi Premium'],
                    ['icon' => 'fa-suitcase', 'text' => 'Perlengkapan Umroh Eksklusif (Koper, Kain Ihram Premium, dll)'],
                    ['icon' => 'fa-user-tie', 'text' => 'Pembimbing Ibadah Bersertifikat'],
                    ['icon' => 'fa-camera', 'text' => 'Dokumentasi Foto & Video Perjalanan'],
                    ['icon' => 'fa-map-location-dot', 'text' => 'City Tour Makkah & Madinah (Jabal Rahmah, Gua Hira, dll)'],
                    ['icon' => 'fa-droplet', 'text' => 'Air Zamzam 10 Liter (dibawa pulang)'],
                    ['icon' => 'fa-shirt', 'text' => 'Laundry Service Selama di Hotel']
                ],
                'gambar_utama' => 'storage/image/cover3.jpeg',
                'gambar_rincian' => [
                    'storage/image/cover3.jpeg',
                    'storage/image/Crowne Plaza Madinah.jpeg',
                    'storage/image/Makkah Al Aziziah.jpeg'
                ],
                'status_populer' => false,
                'status_premium' => true,
            ]
        ];

        foreach ($pakets as $paket) {
            Paket::updateOrCreate(['id' => $paket['id']], $paket);
        }
    }
}
