<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doa;
use App\Models\KamusEntry;
use App\Models\PanduanStep;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // ── DOA ──────────────────────────────────────────────────────────────
        $doas = [
            ['category' => 'masjid', 'title' => 'Doa Masuk Masjidil Haram', 'arabic' => 'بِسْمِ اللَّهِ وَالصَّلاَةُ وَالسَّلاَمُ عَلَى رَسُولِ اللَّهِ، اللَّهُمَّ افْتَحْ لِي أَبْوَابَ رَحْمَتِكَ', 'latin' => "Bismillahi wash-shalaatu was-salaamu 'ala Rasulillah, Allahummaf-tah li abwaaba rahmatik", 'translation' => 'Dengan nama Allah, shalawat dan salam atas Rasulullah. Ya Allah bukakanlah untukku pintu-pintu rahmat-Mu.', 'order' => 1],
            ['category' => 'masjid', 'title' => "Doa Melihat Ka'bah Pertama Kali", 'arabic' => 'اللَّهُمَّ أَنْتَ السَّلاَمُ وَمِنْكَ السَّلاَمُ فَحَيِّنَا رَبَّنَا بِالسَّلاَمِ', 'latin' => 'Allahumma antas-salaam, wa minkas-salaam, fa hayyinaa rabbanaa bis-salaam', 'translation' => 'Ya Allah, Engkaulah As-Salaam, dari-Mu segala kesejahteraan.', 'order' => 2],
            ['category' => 'masjid', 'title' => 'Doa Keluar Masjid', 'arabic' => 'بِسْمِ اللَّهِ وَالصَّلاَةُ وَالسَّلاَمُ عَلَى رَسُولِ اللَّهِ، اللَّهُمَّ إِنِّي أَسْأَلُكَ مِنْ فَضْلِكَ', 'latin' => "Bismillahi wash-shalaatu was-salaamu 'ala Rasulillah, Allahumma inni as'aluka min fadlik", 'translation' => 'Ya Allah, aku memohon keutamaan dari-Mu.', 'order' => 3],
            ['category' => 'tawaf', 'title' => 'Doa Memulai Tawaf', 'arabic' => 'بِسْمِ اللَّهِ وَاللَّهُ أَكْبَرُ', 'latin' => 'Bismillahi wallahu akbar', 'translation' => 'Dengan nama Allah dan Allah Maha Besar.', 'order' => 4],
            ['category' => 'tawaf', 'title' => 'Doa Antara Rukun Yamani & Hajar Aswad', 'arabic' => 'رَبَّنَا آتِنَا فِي الدُّنْيَا حَسَنَةً وَفِي الآخِرَةِ حَسَنَةً وَقِنَا عَذَابَ النَّارِ', 'latin' => "Rabbanaa aatinaa fid-dunyaa hasanah, wa fil-aakhirati hasanah, wa qinaa 'adzaaban-naar", 'translation' => 'Ya Tuhan kami, berilah kami kebaikan di dunia dan akhirat.', 'order' => 5],
            ['category' => 'tawaf', 'title' => 'Doa di Maqam Ibrahim', 'arabic' => 'وَاتَّخِذُوا مِنْ مَقَامِ إِبْرَاهِيمَ مُصَلًّى', 'latin' => 'Wattakhidzuu min maqaami Ibraahiima mushalla', 'translation' => 'Jadikanlah maqam Ibrahim tempat shalat. (QS Al-Baqarah: 125)', 'order' => 6],
            ['category' => 'sai', 'title' => 'Doa di Bukit Shafa & Marwah', 'arabic' => 'إِنَّ الصَّفَا وَالْمَرْوَةَ مِنْ شَعَائِرِ اللَّهِ', 'latin' => "Innash-shafaa wal-marwata min sya'aa'irillah", 'translation' => "Sesungguhnya Shafa dan Marwah adalah syi'ar Allah.", 'order' => 7],
            ['category' => 'sai', 'title' => 'Doa Minum Air Zamzam', 'arabic' => 'اللَّهُمَّ إِنِّي أَسْأَلُكَ عِلْمًا نَافِعًا وَرِزْقًا وَاسِعًا وَشِفَاءً مِنْ كُلِّ دَاءٍ', 'latin' => "Allahumma inni as'aluka 'ilman naafi'an, wa rizqan waasi'an, wa syifaa'an min kulli daa'", 'translation' => 'Ya Allah, aku memohon ilmu bermanfaat, rezeki luas, dan kesembuhan.', 'order' => 8],
            ['category' => 'arafah', 'title' => 'Bacaan Talbiyah', 'arabic' => 'لَبَّيْكَ اللَّهُمَّ لَبَّيْكَ، لَبَّيْكَ لاَ شَرِيكَ لَكَ لَبَّيْكَ', 'latin' => 'Labbaikallahumma labbaik, labbaika laa syariika laka labbaik', 'translation' => 'Aku penuhi panggilan-Mu ya Allah.', 'order' => 9],
            ['category' => 'arafah', 'title' => 'Doa Terbaik di Hari Arafah', 'arabic' => 'لاَ إِلَهَ إِلاَّ اللَّهُ وَحْدَهُ لاَ شَرِيكَ لَهُ', 'latin' => 'Laa ilaaha illallahu wahdahu laa syariika lah', 'translation' => 'Tiada Tuhan selain Allah semata, tiada sekutu bagi-Nya.', 'order' => 10],
        ];
        foreach ($doas as $d) { Doa::create($d); }

        // ── KAMUS ────────────────────────────────────────────────────────────
        $kamus = [
            ['category' => 'sapaan', 'arabic' => 'السَّلاَمُ عَلَيْكُمْ', 'latin' => "Assalamu'alaikum", 'indonesian' => 'Semoga keselamatan atas kamu', 'order' => 1],
            ['category' => 'sapaan', 'arabic' => 'شُكْرًا', 'latin' => 'Syukran', 'indonesian' => 'Terima kasih', 'order' => 2],
            ['category' => 'sapaan', 'arabic' => 'عَفْوًا', 'latin' => "'Afwan", 'indonesian' => 'Maaf / Permisi', 'order' => 3],
            ['category' => 'sapaan', 'arabic' => 'نَعَمْ / لاَ', 'latin' => "Na'am / Laa", 'indonesian' => 'Ya / Tidak', 'order' => 4],
            ['category' => 'sapaan', 'arabic' => 'مِنْ فَضْلِكَ', 'latin' => 'Min Fadhlika', 'indonesian' => 'Tolong / Mohon', 'order' => 5],
            ['category' => 'sapaan', 'arabic' => 'إِنْ شَاءَ اللَّهُ', 'latin' => 'Insya Allah', 'indonesian' => 'Jika Allah menghendaki', 'order' => 6],
            ['category' => 'sapaan', 'arabic' => 'الْحَمْدُ لِلَّهِ', 'latin' => 'Alhamdulillah', 'indonesian' => 'Segala puji bagi Allah', 'order' => 7],
            ['category' => 'sapaan', 'arabic' => 'سُبْحَانَ اللَّهِ', 'latin' => 'Subhanallah', 'indonesian' => 'Maha suci Allah', 'order' => 8],
            ['category' => 'tempat', 'arabic' => 'اَلْمَسْجِد', 'latin' => 'Al-Masjid', 'indonesian' => 'Masjid', 'order' => 1],
            ['category' => 'tempat', 'arabic' => 'اَلْفُنْدُق', 'latin' => 'Al-Funduq', 'indonesian' => 'Hotel', 'order' => 2],
            ['category' => 'tempat', 'arabic' => 'يَمِين / يَسَار', 'latin' => 'Yamiin / Yasaar', 'indonesian' => 'Kanan / Kiri', 'order' => 3],
            ['category' => 'tempat', 'arabic' => 'أَيْنَ؟', 'latin' => 'Aina?', 'indonesian' => 'Di mana?', 'order' => 4],
            ['category' => 'tempat', 'arabic' => 'اَلْحَمَّام', 'latin' => 'Al-Hammaam', 'indonesian' => 'Kamar mandi / Toilet', 'order' => 5],
            ['category' => 'tempat', 'arabic' => 'اَلسُّوق', 'latin' => 'As-Suuq', 'indonesian' => 'Pasar', 'order' => 6],
            ['category' => 'tempat', 'arabic' => 'اَلْمُسْتَشْفَى', 'latin' => 'Al-Mustasyfa', 'indonesian' => 'Rumah Sakit', 'order' => 7],
            ['category' => 'tempat', 'arabic' => 'اَلْمَطَار', 'latin' => 'Al-Mataar', 'indonesian' => 'Bandara', 'order' => 8],
            ['category' => 'sehari', 'arabic' => 'مَاء', 'latin' => "Maa'", 'indonesian' => 'Air', 'order' => 1],
            ['category' => 'sehari', 'arabic' => 'طَعَام', 'latin' => "Tha'aam", 'indonesian' => 'Makanan', 'order' => 2],
            ['category' => 'sehari', 'arabic' => 'بِكَمْ؟', 'latin' => 'Bikam?', 'indonesian' => 'Berapa harganya?', 'order' => 3],
            ['category' => 'sehari', 'arabic' => 'غَالِي', 'latin' => 'Ghaalii', 'indonesian' => 'Mahal', 'order' => 4],
            ['category' => 'sehari', 'arabic' => 'رَخِيص', 'latin' => 'Rakhiish', 'indonesian' => 'Murah', 'order' => 5],
            ['category' => 'sehari', 'arabic' => 'سَيَّارَة', 'latin' => 'Sayyaarah', 'indonesian' => 'Mobil / Taksi', 'order' => 6],
            ['category' => 'sehari', 'arabic' => 'طَبِيب', 'latin' => 'Thabiib', 'indonesian' => 'Dokter', 'order' => 7],
            ['category' => 'sehari', 'arabic' => 'دَوَاء', 'latin' => "Dawaa'", 'indonesian' => 'Obat', 'order' => 8],
            ['category' => 'angka', 'arabic' => 'وَاحِد', 'latin' => 'Waahid', 'indonesian' => '1 (Satu)', 'order' => 1],
            ['category' => 'angka', 'arabic' => 'اِثْنَان', 'latin' => 'Itsnaan', 'indonesian' => '2 (Dua)', 'order' => 2],
            ['category' => 'angka', 'arabic' => 'ثَلاَثَة', 'latin' => 'Tsalaatsah', 'indonesian' => '3 (Tiga)', 'order' => 3],
            ['category' => 'angka', 'arabic' => 'أَرْبَعَة', 'latin' => "Arba'ah", 'indonesian' => '4 (Empat)', 'order' => 4],
            ['category' => 'angka', 'arabic' => 'خَمْسَة', 'latin' => 'Khamsah', 'indonesian' => '5 (Lima)', 'order' => 5],
            ['category' => 'angka', 'arabic' => 'سِتَّة', 'latin' => 'Sittah', 'indonesian' => '6 (Enam)', 'order' => 6],
            ['category' => 'angka', 'arabic' => 'سَبْعَة', 'latin' => "Sab'ah", 'indonesian' => '7 (Tujuh)', 'order' => 7],
            ['category' => 'angka', 'arabic' => 'ثَمَانِيَة', 'latin' => 'Tsamaaniyah', 'indonesian' => '8 (Delapan)', 'order' => 8],
            ['category' => 'angka', 'arabic' => 'تِسْعَة', 'latin' => "Tis'ah", 'indonesian' => '9 (Sembilan)', 'order' => 9],
            ['category' => 'angka', 'arabic' => 'عَشَرَة', 'latin' => "'Asyarah", 'indonesian' => '10 (Sepuluh)', 'order' => 10],
            ['category' => 'angka', 'arabic' => 'عِشْرُون', 'latin' => "'Isyruun", 'indonesian' => '20 (Dua Puluh)', 'order' => 11],
            ['category' => 'angka', 'arabic' => 'مِائَة', 'latin' => "Mi'ah", 'indonesian' => '100 (Seratus)', 'order' => 12],
            ['category' => 'darurat', 'arabic' => 'سَاعِدْنِي!', 'latin' => "Saa'idnii!", 'indonesian' => 'Tolong saya!', 'order' => 1],
            ['category' => 'darurat', 'arabic' => 'أَنَا مَرِيض', 'latin' => 'Ana mariidh', 'indonesian' => 'Saya sakit', 'order' => 2],
            ['category' => 'darurat', 'arabic' => 'أَنَا ضَائِع', 'latin' => "Ana dhaa'i'", 'indonesian' => 'Saya tersesat', 'order' => 3],
            ['category' => 'darurat', 'arabic' => 'اِتَّصِلْ بِالشُّرْطَة!', 'latin' => 'Ittashil bisy-syurthah!', 'indonesian' => 'Hubungi polisi!', 'order' => 4],
            ['category' => 'darurat', 'arabic' => 'أَيْنَ الْمُسْتَشْفَى؟', 'latin' => 'Aina al-mustasyfa?', 'indonesian' => 'Di mana rumah sakit?', 'order' => 5],
        ];
        foreach ($kamus as $k) { KamusEntry::create($k); }

        // ── PANDUAN ──────────────────────────────────────────────────────────
        $panduan = json_decode(file_get_contents(storage_path('app/mobile_content/panduan.json')), true);
        if (!empty($panduan['steps'])) {
            foreach ($panduan['steps'] as $i => $step) {
                PanduanStep::create([
                    'step_id'     => $step['id'],
                    'step_label'  => $step['step_label'],
                    'title'       => $step['title'],
                    'description' => $step['description'],
                    'icon'        => $step['icon'] ?? 'clipboard-list',
                    'order'       => $i + 1,
                    'sections'    => $step['sections'],
                ]);
            }
        }
    }
}
