<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatBotController extends Controller
{
    /**
     * Menangani pesan chat dari pengguna dan membalas sesuai keyword (Rule-Based).
     * Controller ini dirancang agar domain-agnostic:
     * - Semua link menggunakan path relatif, bukan route() yang menghasilkan absolute URL
     * - Semua operasi dibungkus try-catch agar chatbot tidak crash
     */
    public function message(Request $request)
    {
        try {
            $message = strtolower(trim($request->input('message')));

            // Delay buatan 1 detik agar terlihat seolah bot sedang 'mengetik'
            sleep(1);

            // --- Logika Pendeteksian Kata Kunci (Keywords) ---
            
            $response = "";

            // Salam / Sapaan
            if (str_contains($message, 'halo') || str_contains($message, 'hai') || str_contains($message, 'assalamualaikum') || str_contains($message, 'pagi') || str_contains($message, 'siang') || str_contains($message, 'malam')) {
                $response = "Waalaikumsalam! Halo, saya Asisten Virtual Haramain Tour. 😊 Ada yang bisa saya bantu terkait paket perjalanan umroh, haji, atau info lainnya?";
            }
            // Topik: Harga / Biaya (dicek SEBELUM paket, karena pesan bisa mengandung keduanya)
            elseif (str_contains($message, 'harga') || str_contains($message, 'biaya') || str_contains($message, 'berapa')) {
                $response = "Berikut daftar harga paket umroh kami: 💰<br><br>" .
                            "<b>1. Paket Umroh Ekonomis</b> ⭐<br>" .
                            "💵 <b>Rp 25.000.000</b> /Orang<br>" .
                            "📅 9 Hari | 🏨 Hotel Bintang 3<br><br>" .
                            "<b>2. Paket Umroh Bintang 4</b> 🌟<br>" .
                            "💵 <b>Rp 35.000.000</b> /Orang<br>" .
                            "📅 10 Hari | 🏨 Hotel Bintang 4<br><br>" .
                            "Semua harga sudah termasuk tiket pesawat PP, visa, asuransi, dan makan 3x sehari. Ingin tahu info lebih lanjut? Ketik <b>'Paket'</b> atau <b>'Kontak'</b> untuk bicara dengan Admin kami.";
            }
            // Topik: Paket Umroh / Haji
            elseif (str_contains($message, 'paket') || str_contains($message, 'program')) {
                $response = "Berikut paket-paket umroh yang tersedia saat ini: ✈️<br><br>" .

                            "<b>1. Paket Umroh Ekonomis</b> ⭐<br>" .
                            "📅 Durasi: 9 Hari<br>" .
                            "🏨 Hotel: Makareem Umm Al Quro (Makkah) & Madinah Aram Hotel<br>" .
                            "✅ Termasuk: Tiket pesawat PP, perlengkapan umroh, hotel bintang 3, visa & asuransi, makan 3x sehari<br><br>" .

                            "<b>2. Paket Umroh Bintang 4</b> 🌟<br>" .
                            "📅 Durasi: 10 Hari<br>" .
                            "🏨 Hotel: Makareem Umm Al Qura (Makkah) & Saja Al Madinah (Madinah)<br>" .
                            "✅ Termasuk: Tiket pesawat PP, perlengkapan umroh, hotel bintang 4, visa & asuransi, makan 3x sehari<br><br>";
                
                if (Auth::check()) {
                    $response .= "Untuk info lebih lengkap, jadwal keberangkatan, dan pemesanan, silakan kunjungi halaman <a href='/paket' style='color: var(--gold-color); text-decoration: underline;'>Daftar Paket</a> kami.";
                } else {
                    $response .= "Silakan <a href='/login' style='color: var(--gold-color); text-decoration: underline; font-weight:bold;'>Login</a> terlebih dahulu untuk melihat detail lengkap, jadwal keberangkatan, dan melakukan pemesanan.";
                }
            }
            // Topik: Kontak / Bantuan Langsung
            elseif (str_contains($message, 'kontak') || str_contains($message, 'admin') || str_contains($message, 'cs') || str_contains($message, 'bantuan') || str_contains($message, 'telepon')) {
                $response = "Tentu! Untuk bantuan langsung dari Customer Service (Admin) kami, Anda bisa menghubungi kami melalui:<br><br>" .
                            "🟢 WhatsApp: <a href='https://wa.me/6287775482764' target='_blank' style='color: #25D366; font-weight: bold; text-decoration: underline;'>0877-7548-2764</a><br>" .
                            "📞 Telepon: 0812-7551-6335<br>" .
                            "✉️ Email: cs@haramaintour.com<br><br>" .
                            "Admin kami siap membantu Anda di jam kerja (08:00 - 17:00).";
            }
            // Topik: Lokasi / Alamat
            elseif (str_contains($message, 'lokasi') || str_contains($message, 'alamat') || str_contains($message, 'kantor') || str_contains($message, 'dimana')) {
                $response = "Kantor pusat Haramain Tour berlokasi di:<br><b>Graha Haramain, Jl. Sudirman No. 123, Jakarta Selatan</b>.<br><br>Kami buka beroperasi Senin - Sabtu (08:00 - 17:00). Silakan mampir jika ada kesempatan, kami menyediakan kopi arabika gratis untuk para tamu! ☕";
            }
            // Topik: Terima kasih
            elseif (str_contains($message, 'makasih') || str_contains($message, 'terima kasih') || str_contains($message, 'syukron') || str_contains($message, 'baik') || str_contains($message, 'oke')) {
                $response = "Sama-sama! 😊 Semoga niat baik Anda untuk beribadah ke Baitullah dimudahkan jalannya. Jika butuh bantuan lagi, jangan ragu untuk bertanya.";
            }
            // Fallback / Tidak Mengerti
            else {
                $response = "Mohon maaf, saya adalah Asisten Virtual otomatis dan belum mengerti dengan jelas pertanyaan Anda. 🤔<br><br>Coba gunakan kata kunci seperti <b>'Paket'</b>, <b>'Harga'</b>, <b>'Alamat'</b>, atau ketik <b>'Kontak'</b> untuk berbicara dengan tim Admin kami.";
            }

            return response()->json([
                'status' => 'success',
                'reply' => $response
            ]);

        } catch (\Throwable $e) {
            // Jika ada error apapun, kembalikan pesan ramah alih-alih error 500
            return response()->json([
                'status' => 'success',
                'reply' => 'Mohon maaf, terjadi gangguan teknis pada sistem kami. 🔧 Silakan coba lagi dalam beberapa saat atau hubungi Admin kami melalui <a href="https://wa.me/6287775482764" target="_blank" style="color: #25D366; font-weight: bold;">WhatsApp</a>.'
            ]);
        }
    }
}
