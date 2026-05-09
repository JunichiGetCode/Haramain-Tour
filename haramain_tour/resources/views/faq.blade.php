<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bantuan & FAQ - Haramain Tour</title>
    <meta name="description" content="Temukan jawaban atas pertanyaan yang sering diajukan seputar umroh, haji, pendaftaran, dan layanan Haramain Tour.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-color: #f5f3ee; --navy-color: #0d1130; --navy-light: #283375;
            --gold-color: #c9a84c; --gold-light: #d6b881; --gold-glow: rgba(201,168,76,0.3);
            --text-dark: #2c2c2c; --text-gray: #6b7280; --card-bg: #ffffff;
            --transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); overflow-x: hidden; }

        /* Category Tabs */
        .cat-tabs-section {
            background: var(--card-bg); padding: 18px 20px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            position: sticky; top: 60px; z-index: 50;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            margin-bottom: 40px;
        }
        .cat-tabs-inner { max-width: 900px; margin: 0 auto; display: flex; gap: 10px; flex-wrap: wrap; justify-content: center; }
        .cat-tab {
            padding: 9px 22px; border-radius: 50px; font-size: 0.82rem; font-weight: 700;
            border: 1.5px solid rgba(0,0,0,0.1); background: transparent; cursor: pointer;
            transition: var(--transition); color: var(--text-gray); font-family: 'Poppins', sans-serif;
            display: flex; align-items: center; gap: 7px;
        }
        .cat-tab:hover { border-color: var(--gold-color); color: var(--gold-color); }
        .cat-tab.active { background: var(--navy-color); color: var(--gold-color); border-color: var(--navy-color); }

        /* Container */
        .container { max-width: 1500px; margin: 0 auto; padding: 0 20px 60px; }

        /* Section Headers */
        .section-header {
            display: flex; align-items: center; gap: 15px; margin-bottom: 25px; padding-top: 10px;
        }
        .section-icon {
            width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.15rem; flex-shrink: 0; color: white;
        }
        .section-icon.umum { background: linear-gradient(135deg, #3b82f6, #2563eb); }
        .section-icon.pendaftaran { background: linear-gradient(135deg, #10b981, #059669); }
        .section-icon.perjalanan { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .section-icon.pembayaran { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
        .section-icon.dokumen { background: linear-gradient(135deg, #ef4444, #dc2626); }
        .section-icon.kesehatan { background: linear-gradient(135deg, #ec4899, #db2777); }
        .section-header h2 { font-size: 1.3rem; font-weight: 800; color: var(--navy-color); }
        .section-header p { font-size: 0.82rem; color: var(--text-gray); }

        /* FAQ Cards */
        .faq-section { margin-bottom: 45px; }
        .faq-section.hidden { display: none; }

        .faq-card {
            background: var(--card-bg); border-radius: 16px; margin-bottom: 12px;
            overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.04); transition: var(--transition);
        }
        .faq-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.06); }
        .faq-card.open { border-color: rgba(201,168,76,0.3); box-shadow: 0 8px 28px rgba(201,168,76,0.08); }

        .faq-question {
            padding: 20px 24px; display: flex; align-items: center; justify-content: space-between;
            cursor: pointer; gap: 15px; transition: 0.2s;
        }
        .faq-question:hover { background: rgba(201,168,76,0.04); }
        .faq-q-text { font-size: 0.95rem; font-weight: 700; color: var(--navy-color); flex: 1; line-height: 1.5; }
        .faq-card.open .faq-q-text { color: var(--gold-color); }
        .faq-chevron {
            width: 32px; height: 32px; border-radius: 8px;
            background: var(--bg-color); display: flex; align-items: center; justify-content: center;
            color: var(--text-gray); font-size: 0.8rem; flex-shrink: 0; transition: 0.3s;
        }
        .faq-card.open .faq-chevron { background: var(--navy-color); color: var(--gold-color); transform: rotate(180deg); }

        .faq-answer {
            max-height: 0; overflow: hidden; transition: max-height 0.4s ease, padding 0.3s ease;
            padding: 0 24px;
        }
        .faq-card.open .faq-answer {
            max-height: 600px; padding: 0 24px 24px;
        }
        .faq-answer-inner {
            padding-top: 16px; border-top: 1px solid rgba(0,0,0,0.06);
            font-size: 0.9rem; color: var(--text-gray); line-height: 1.8;
        }
        .faq-answer-inner strong { color: var(--text-dark); }
        .faq-answer-inner ul { margin: 10px 0 10px 20px; }
        .faq-answer-inner ul li { margin-bottom: 6px; }

        /* Search */
        .faq-search-box {
            max-width: 900px; margin: 0 auto 30px; padding: 0 20px;
        }
        .faq-search {
            width: 100%; padding: 16px 20px 16px 50px; border: 2px solid rgba(0,0,0,0.08);
            border-radius: 16px; font-size: 0.95rem; font-family: 'Poppins', sans-serif;
            outline: none; transition: 0.3s; background: var(--card-bg);
        }
        .faq-search:focus { border-color: var(--gold-color); box-shadow: 0 0 0 4px var(--gold-glow); }
        .faq-search-wrapper { position: relative; }
        .faq-search-icon { position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--text-gray); font-size: 1rem; pointer-events: none; }

        /* No Results */
        .no-results { text-align: center; padding: 50px 20px; color: var(--text-gray); display: none; }
        .no-results i { font-size: 3rem; margin-bottom: 15px; color: #d1d5db; display: block; }

        /* Contact Section */
        .contact-section {
            max-width: 900px; margin: 0 auto; padding: 0 20px 80px;
        }
        .contact-card {
            background: linear-gradient(135deg, var(--navy-color) 0%, var(--navy-light) 100%);
            border-radius: 24px; padding: 50px 40px; text-align: center;
            position: relative; overflow: hidden;
        }
        .contact-card::before {
            content: '\f059'; font-family: 'Font Awesome 6 Free'; font-weight: 900;
            position: absolute; font-size: 18rem; color: rgba(255,255,255,0.02);
            top: -60px; right: -80px; line-height: 1; pointer-events: none;
        }
        .contact-card h3 {
            font-size: 1.6rem; font-weight: 800; color: var(--gold-color);
            margin-bottom: 12px; position: relative; z-index: 2;
        }
        .contact-card > p {
            color: rgba(255,255,255,0.7); font-size: 0.95rem; max-width: 500px;
            margin: 0 auto 35px; line-height: 1.7; position: relative; z-index: 2;
        }
        .contact-channels {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;
            position: relative; z-index: 2;
        }
        .contact-item {
            background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 18px; padding: 28px 20px; transition: var(--transition);
            text-decoration: none; color: white; display: flex; flex-direction: column;
            align-items: center; gap: 12px;
        }
        .contact-item:hover { background: rgba(255,255,255,0.12); transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,0.2); }
        .contact-item-icon {
            width: 54px; height: 54px; border-radius: 16px; display: flex;
            align-items: center; justify-content: center; font-size: 1.4rem;
        }
        .contact-item-icon.wa { background: linear-gradient(135deg, #25D366, #128C7E); color: white; }
        .contact-item-icon.email { background: linear-gradient(135deg, var(--gold-color), var(--gold-light)); color: var(--navy-color); }
        .contact-item-icon.ig { background: linear-gradient(135deg, #E1306C, #C13584); color: white; }
        .contact-item h4 { font-size: 0.95rem; font-weight: 700; color: white; }
        .contact-item p { font-size: 0.82rem; color: rgba(255,255,255,0.6); line-height: 1.5; }

        @media (max-width: 768px) {
            .contact-channels { grid-template-columns: 1fr; }
            .contact-card { padding: 35px 20px; }
            .cat-tabs-inner { gap: 8px; }
            .cat-tab { padding: 7px 14px; font-size: 0.78rem; }
        }
    </style>
    @include('partials.footer-css')
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">
    @include('partials.navbar-css')
    @include('partials.navbar')

    <x-hero
        badgeIcon="fa-solid fa-circle-question"
        :badgeText="__('Pusat Bantuan')"
        :title="__('Bantuan & FAQ')"
        arabic="أَسْئِلَةٌ شَائِعَةٌ"
        :description="__('Temukan jawaban atas pertanyaan yang sering diajukan seputar layanan umroh, haji, pendaftaran, dan perjalanan ibadah bersama Haramain Tour.')"
        bgIcon="\f059"
    />

    <!-- Search -->
    <div class="faq-search-box">
        <div class="faq-search-wrapper">
            <i class="fa-solid fa-search faq-search-icon"></i>
            <input type="text" id="faqSearch" class="faq-search" placeholder="{{ __('Cari pertanyaan...') }} (contoh: paspor, pembayaran, vaksin)" oninput="filterFAQ()">
        </div>
    </div>

    <!-- Category Tabs -->
    <div class="cat-tabs-section">
        <div class="cat-tabs-inner">
            <button class="cat-tab active" onclick="showCat('semua', this)"><i class="fa-solid fa-layer-group"></i> {{ __('Semua') }}</button>
            <button class="cat-tab" onclick="showCat('umum', this)"><i class="fa-solid fa-circle-info"></i> {{ __('Umum') }}</button>
            <button class="cat-tab" onclick="showCat('pendaftaran', this)"><i class="fa-solid fa-clipboard-list"></i> {{ __('Pendaftaran') }}</button>
            <button class="cat-tab" onclick="showCat('perjalanan', this)"><i class="fa-solid fa-plane"></i> {{ __('Perjalanan') }}</button>
            <button class="cat-tab" onclick="showCat('pembayaran', this)"><i class="fa-solid fa-credit-card"></i> {{ __('Pembayaran') }}</button>
            <button class="cat-tab" onclick="showCat('dokumen', this)"><i class="fa-solid fa-file-lines"></i> {{ __('Dokumen') }}</button>
            <button class="cat-tab" onclick="showCat('kesehatan', this)"><i class="fa-solid fa-heart-pulse"></i> {{ __('Kesehatan') }}</button>
        </div>
    </div>

    <div class="container">

        <div class="no-results" id="noResults">
            <i class="fa-solid fa-search"></i>
            {{ __('Tidak ditemukan pertanyaan dengan kata kunci') }} "<span id="searchTerm"></span>"
        </div>

        <!-- ==================== UMUM ==================== -->
        <div class="faq-section" id="sec-umum" data-cat="umum">
            <div class="section-header">
                <div class="section-icon umum"><i class="fa-solid fa-circle-info"></i></div>
                <div><h2>{{ __('Pertanyaan Umum') }}</h2><p>{{ __('Informasi dasar seputar Haramain Tour dan layanan kami') }}</p></div>
            </div>

            <div class="faq-card" data-search="apa itu haramain tour siapa perusahaan">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Apa itu Haramain Tour dan siapa yang mengelolanya?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    <strong>Haramain Tour</strong> adalah biro perjalanan ibadah umroh dan haji yang telah berpengalaman melayani jamaah Indonesia menuju Tanah Suci Makkah dan Madinah. Kami dikelola oleh tim profesional yang berdedikasi tinggi dan memiliki izin resmi sebagai Penyelenggara Perjalanan Ibadah Umroh (PPIU) dari Kementerian Agama Republik Indonesia.
                    <ul>
                        <li><strong>Siapa:</strong> Tim profesional bersertifikat dengan pengalaman bertahun-tahun di bidang perjalanan ibadah</li>
                        <li><strong>Apa:</strong> Layanan paket umroh reguler, plus, furoda, serta haji khusus</li>
                        <li><strong>Mengapa:</strong> Mengutamakan kenyamanan, keamanan, dan kekhusyukan ibadah jamaah</li>
                    </ul>
                </div></div>
            </div>

            <div class="faq-card" data-search="kapan waktu terbaik umroh musim bulan">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Kapan waktu terbaik untuk melaksanakan ibadah umroh?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Ibadah umroh dapat dilaksanakan sepanjang tahun, kecuali pada musim haji (bulan Dzulhijjah). Berikut rekomendasi waktu terbaik:
                    <ul>
                        <li><strong>Bulan Ramadhan:</strong> Umroh di bulan Ramadhan pahalanya setara dengan haji bersama Rasulullah ﷺ. Namun sangat ramai.</li>
                        <li><strong>Bulan Rajab & Sya'ban:</strong> Bulan istimewa menjelang Ramadhan, suasana lebih tenang.</li>
                        <li><strong>Musim Dingin (November–Februari):</strong> Cuaca sejuk dan nyaman untuk beribadah, cocok bagi jamaah lansia.</li>
                        <li><strong>Musim Panas (Juni–Agustus):</strong> Suhu bisa mencapai 45°C, perlu persiapan khusus.</li>
                    </ul>
                </div></div>
            </div>

            <div class="faq-card" data-search="bagaimana cara daftar mendaftar umroh langkah">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Bagaimana cara mendaftar umroh melalui Haramain Tour?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Proses pendaftaran sangat mudah dan dapat dilakukan secara online melalui website kami:
                    <ul>
                        <li><strong>Langkah 1:</strong> Login ke akun Anda, lalu pilih paket umroh yang diinginkan dari halaman <em>Paket</em>.</li>
                        <li><strong>Langkah 2:</strong> Klik tombol <em>"Daftar Sekarang"</em> dan isi formulir identitas diri lengkap (KTP, foto, data keluarga).</li>
                        <li><strong>Langkah 3:</strong> Upload dokumen persyaratan (paspor, pas foto, kartu vaksin).</li>
                        <li><strong>Langkah 4:</strong> Lakukan pembayaran melalui metode yang tersedia dan tanda tangan digital.</li>
                        <li><strong>Langkah 5:</strong> Tim kami akan memverifikasi data Anda dan mengirimkan notifikasi persetujuan.</li>
                    </ul>
                </div></div>
            </div>

            <div class="faq-card" data-search="berapa lama umroh durasi hari">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Berapa lama durasi perjalanan umroh pada umumnya?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Durasi perjalanan umroh bervariasi tergantung paket yang dipilih:
                    <ul>
                        <li><strong>Paket Reguler:</strong> 9–12 hari, mencakup ibadah utama di Makkah dan Madinah.</li>
                        <li><strong>Paket Plus:</strong> 12–15 hari, dengan tambahan ziarah ke tempat-tempat bersejarah Islam.</li>
                        <li><strong>Paket Furoda/VIP:</strong> Fleksibel, bisa disesuaikan dengan keinginan jamaah, biasanya 10–14 hari.</li>
                    </ul>
                    Setiap paket sudah termasuk waktu perjalanan (penerbangan), masa tinggal di hotel, dan pelaksanaan ibadah umroh.
                </div></div>
            </div>
        </div>

        <!-- ==================== PENDAFTARAN ==================== -->
        <div class="faq-section" id="sec-pendaftaran" data-cat="pendaftaran">
            <div class="section-header">
                <div class="section-icon pendaftaran"><i class="fa-solid fa-clipboard-list"></i></div>
                <div><h2>{{ __('Pendaftaran & Persyaratan') }}</h2><p>{{ __('Syarat, ketentuan, dan proses pendaftaran jamaah') }}</p></div>
            </div>

            <div class="faq-card" data-search="apa saja syarat persyaratan umroh dokumen">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Apa saja persyaratan utama untuk mendaftar umroh?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Berikut persyaratan utama yang wajib dipenuhi oleh calon jamaah:
                    <ul>
                        <li><strong>Paspor:</strong> Masih berlaku minimal 7 bulan sebelum tanggal keberangkatan, dengan nama sesuai KTP/Akta.</li>
                        <li><strong>Pas Foto:</strong> Berukuran 4x6 cm, berlatar belakang putih, mengenakan pakaian sopan (wanita berjilbab).</li>
                        <li><strong>KTP/Identitas:</strong> Fotokopi KTP yang masih berlaku.</li>
                        <li><strong>Kartu Keluarga:</strong> Fotokopi kartu keluarga terbaru.</li>
                        <li><strong>Surat Vaksin:</strong> Bukti vaksinasi meningitis dan COVID-19 (sesuai ketentuan terbaru).</li>
                        <li><strong>Surat Mahram:</strong> Wanita di bawah 45 tahun wajib didampingi mahram (suami/ayah/saudara laki-laki).</li>
                    </ul>
                </div></div>
            </div>

            <div class="faq-card" data-search="siapa boleh ikut umroh anak lansia usia">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Siapa saja yang boleh mengikuti perjalanan umroh?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Umroh dapat diikuti oleh setiap Muslim yang mampu secara fisik dan finansial:
                    <ul>
                        <li><strong>Dewasa:</strong> Usia 18 tahun ke atas, dapat mendaftar secara mandiri.</li>
                        <li><strong>Anak-anak:</strong> Di bawah 18 tahun harus didampingi orang tua/wali dan memiliki paspor sendiri.</li>
                        <li><strong>Lansia:</strong> Kami menyediakan layanan pendamping khusus untuk jamaah lansia yang membutuhkan bantuan.</li>
                        <li><strong>Wanita:</strong> Di bawah 45 tahun wajib didampingi mahram. Di atas 45 tahun boleh dalam rombongan tanpa mahram (sesuai ketentuan Saudi).</li>
                        <li><strong>Disabilitas:</strong> Kami menyediakan kursi roda dan pendamping atas permintaan, harap informasikan saat pendaftaran.</li>
                    </ul>
                </div></div>
            </div>

            <div class="faq-card" data-search="dimana mendaftar kantor cabang lokasi">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Di mana saja saya bisa mendaftar selain secara online?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Selain pendaftaran online melalui website ini, Anda juga dapat mendaftar melalui:
                    <ul>
                        <li><strong>Kantor Pusat:</strong> Kunjungi langsung kantor kami untuk berkonsultasi dan mendaftar secara tatap muka.</li>
                        <li><strong>WhatsApp:</strong> Hubungi customer service kami di <strong>0812-3456-7890</strong> untuk pendaftaran via chat.</li>
                        <li><strong>Email:</strong> Kirimkan data diri ke <strong>adminharamaintour@gmail.com</strong> dan tim kami akan memproses pendaftaran Anda.</li>
                    </ul>
                </div></div>
            </div>

            <div class="faq-card" data-search="bagaimana batalkan pembatalan refund cancel">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Bagaimana jika saya ingin membatalkan pendaftaran?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Pembatalan pendaftaran dapat dilakukan dengan ketentuan berikut:
                    <ul>
                        <li><strong>Lebih dari 30 hari sebelum keberangkatan:</strong> Pengembalian dana sebesar 80% dari total pembayaran.</li>
                        <li><strong>15–30 hari sebelum keberangkatan:</strong> Pengembalian dana sebesar 50%.</li>
                        <li><strong>Kurang dari 15 hari:</strong> Tidak ada pengembalian dana, kecuali karena alasan medis yang dibuktikan surat dokter.</li>
                    </ul>
                    Hubungi customer service kami segera untuk memproses pembatalan.
                </div></div>
            </div>
        </div>

        <!-- ==================== PERJALANAN ==================== -->
        <div class="faq-section" id="sec-perjalanan" data-cat="perjalanan">
            <div class="section-header">
                <div class="section-icon perjalanan"><i class="fa-solid fa-plane"></i></div>
                <div><h2>{{ __('Perjalanan & Akomodasi') }}</h2><p>{{ __('Informasi penerbangan, hotel, dan fasilitas selama perjalanan') }}</p></div>
            </div>

            <div class="faq-card" data-search="apa saja fasilitas yang didapat hotel pesawat makan">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Apa saja fasilitas yang didapatkan selama perjalanan umroh?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Fasilitas tergantung paket yang dipilih, namun secara umum meliputi:
                    <ul>
                        <li><strong>Tiket Pesawat:</strong> Penerbangan pulang-pergi (PP) dari bandara asal ke Jeddah/Madinah.</li>
                        <li><strong>Hotel:</strong> Akomodasi bintang 3–5 dengan lokasi dekat Masjidil Haram dan Masjid Nabawi.</li>
                        <li><strong>Makan:</strong> Makan 3 kali sehari (menu halal khas Indonesia dan Arab).</li>
                        <li><strong>Transportasi:</strong> Bus ber-AC full selama perjalanan ziarah dan antar-jemput bandara.</li>
                        <li><strong>Muthawwif:</strong> Pembimbing ibadah berpengalaman yang mendampingi selama perjalanan.</li>
                        <li><strong>Visa:</strong> Pengurusan visa umroh oleh tim kami.</li>
                        <li><strong>Air Zamzam:</strong> 5 liter per jamaah untuk dibawa pulang.</li>
                    </ul>
                </div></div>
            </div>

            <div class="faq-card" data-search="dimana hotel lokasi masjidil haram nabawi dekat jauh">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Di mana lokasi hotel yang disediakan? Apakah dekat dengan Masjidil Haram?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Lokasi hotel tergantung pada paket yang dipilih:
                    <ul>
                        <li><strong>Paket Reguler:</strong> Hotel bintang 3–4, berjarak sekitar 300–800 meter dari Masjidil Haram (5–10 menit berjalan kaki).</li>
                        <li><strong>Paket Plus:</strong> Hotel bintang 4–5, berjarak 100–300 meter dari Masjidil Haram.</li>
                        <li><strong>Paket Furoda/VIP:</strong> Hotel bintang 5 premium, sebagian besar berada langsung di Ring 1 (berjarak kurang dari 100 meter) dengan pemandangan langsung ke Ka'bah.</li>
                    </ul>
                    Semua hotel kami pilih berdasarkan kenyamanan dan kemudahan akses ibadah jamaah.
                </div></div>
            </div>

            <div class="faq-card" data-search="bagaimana jadwal ibadah itinerary kegiatan aktivitas">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Bagaimana jadwal kegiatan selama di Tanah Suci?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Jadwal itinerary disusun secara detail oleh tim kami:
                    <ul>
                        <li><strong>Hari 1–2:</strong> Tiba di Madinah, check-in hotel, ziarah Masjid Nabawi, Raudhah, dan makam Baqi'.</li>
                        <li><strong>Hari 3–4:</strong> Ziarah ke Jabal Uhud, Masjid Quba, Masjid Qiblatain, dan kebun kurma.</li>
                        <li><strong>Hari 5:</strong> Perjalanan menuju Makkah, miqat di Bir Ali, dan melaksanakan umroh (Tawaf, Sa'i, Tahallul).</li>
                        <li><strong>Hari 6–8:</strong> Ibadah bebas di Masjidil Haram, ziarah ke Jabal Rahmah, Mina, Muzdalifah, dan Arafah.</li>
                        <li><strong>Hari 9:</strong> Persiapan kepulangan, belanja oleh-oleh, dan penerbangan kembali ke Indonesia.</li>
                    </ul>
                    <em>Jadwal dapat berubah menyesuaikan kondisi di lapangan.</em>
                </div></div>
            </div>
        </div>

        <!-- ==================== PEMBAYARAN ==================== -->
        <div class="faq-section" id="sec-pembayaran" data-cat="pembayaran">
            <div class="section-header">
                <div class="section-icon pembayaran"><i class="fa-solid fa-credit-card"></i></div>
                <div><h2>{{ __('Pembayaran & Biaya') }}</h2><p>{{ __('Metode pembayaran, cicilan, dan rincian biaya paket') }}</p></div>
            </div>

            <div class="faq-card" data-search="berapa harga biaya umroh paket murah mahal">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Berapa kisaran biaya paket umroh di Haramain Tour?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Biaya paket umroh bervariasi tergantung kategori dan fasilitas:
                    <ul>
                        <li><strong>Paket Reguler:</strong> Mulai dari Rp 25.000.000 – Rp 35.000.000 per jamaah.</li>
                        <li><strong>Paket Plus:</strong> Mulai dari Rp 35.000.000 – Rp 50.000.000 per jamaah.</li>
                        <li><strong>Paket Furoda/VIP:</strong> Mulai dari Rp 50.000.000 ke atas, tergantung permintaan khusus.</li>
                    </ul>
                    Harga sudah termasuk tiket pesawat PP, hotel, makan, transportasi, visa, dan pembimbing. Harga dapat berubah sewaktu-waktu mengikuti kebijakan maskapai dan nilai tukar mata uang.
                </div></div>
            </div>

            <div class="faq-card" data-search="bagaimana cara bayar metode pembayaran transfer bank">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Bagaimana metode pembayaran yang tersedia?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Kami menyediakan berbagai metode pembayaran untuk kemudahan jamaah:
                    <ul>
                        <li><strong>Transfer Bank:</strong> BCA, BNI, BRI, Mandiri, dan bank lainnya.</li>
                        <li><strong>E-Wallet:</strong> GoPay, OVO, DANA, dan ShopeePay.</li>
                        <li><strong>Virtual Account:</strong> Pembayaran otomatis melalui kode VA bank.</li>
                        <li><strong>Kartu Kredit:</strong> Visa dan Mastercard (tersedia opsi cicilan 0%).</li>
                        <li><strong>QRIS:</strong> Scan kode QR dari semua aplikasi pembayaran.</li>
                    </ul>
                    Pembayaran diproses secara aman melalui payment gateway Midtrans.
                </div></div>
            </div>

            <div class="faq-card" data-search="kapan batas waktu deadline pembayaran dp lunas">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Kapan batas waktu pelunasan pembayaran?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Ketentuan pembayaran dan pelunasan:
                    <ul>
                        <li><strong>DP (Down Payment):</strong> Minimal 30% dari total biaya paket, dibayarkan saat pendaftaran.</li>
                        <li><strong>Pelunasan:</strong> Paling lambat <strong>30 hari sebelum tanggal keberangkatan</strong>.</li>
                        <li><strong>Konfirmasi:</strong> Setelah pembayaran berhasil, Anda akan menerima notifikasi dan bukti pembayaran digital yang dapat diunduh.</li>
                    </ul>
                    Pastikan melunasi pembayaran tepat waktu agar proses pengurusan visa dan tiket berjalan lancar.
                </div></div>
            </div>
        </div>

        <!-- ==================== DOKUMEN ==================== -->
        <div class="faq-section" id="sec-dokumen" data-cat="dokumen">
            <div class="section-header">
                <div class="section-icon dokumen"><i class="fa-solid fa-file-lines"></i></div>
                <div><h2>{{ __('Dokumen & Visa') }}</h2><p>{{ __('Pengurusan paspor, visa, dan dokumen perjalanan lainnya') }}</p></div>
            </div>

            <div class="faq-card" data-search="apa paspor syarat masa berlaku habis expired pembuatan">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Apa syarat paspor untuk umroh dan bagaimana jika paspor saya sudah habis masa berlakunya?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    <ul>
                        <li><strong>Masa Berlaku:</strong> Paspor harus masih berlaku minimal <strong>7 bulan</strong> sebelum tanggal keberangkatan.</li>
                        <li><strong>Nama di Paspor:</strong> Harus sesuai dengan nama di KTP, Akta Kelahiran, dan Ijazah terakhir (minimal 3 kata).</li>
                        <li><strong>Paspor Habis:</strong> Jika paspor sudah habis masa berlakunya atau belum memiliki paspor, kami dapat membantu pengurusan perpanjangan/pembuatan paspor baru di kantor Imigrasi terdekat.</li>
                        <li><strong>Biaya:</strong> Biaya pembuatan paspor tidak termasuk dalam harga paket umroh.</li>
                    </ul>
                </div></div>
            </div>

            <div class="faq-card" data-search="bagaimana pengurusan visa siapa yang mengurus">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Bagaimana proses pengurusan visa umroh? Siapa yang mengurusnya?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Pengurusan visa umroh <strong>sepenuhnya ditangani oleh Haramain Tour</strong>. Anda cukup menyerahkan dokumen yang diperlukan:
                    <ul>
                        <li>Paspor asli yang masih berlaku</li>
                        <li>Pas foto terbaru 4x6 cm (latar putih)</li>
                        <li>Fotokopi KTP dan Kartu Keluarga</li>
                        <li>Bukti vaksinasi meningitis</li>
                    </ul>
                    <strong>Proses pengurusan visa memakan waktu 5–10 hari kerja.</strong> Pastikan dokumen diserahkan paling lambat 3 minggu sebelum keberangkatan.
                </div></div>
            </div>

            <div class="faq-card" data-search="dimana surat mahram wanita perempuan pendamping">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Di mana saya bisa mendapatkan surat mahram dan apa ketentuannya?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Surat mahram diperlukan bagi <strong>wanita di bawah 45 tahun</strong> yang berangkat umroh:
                    <ul>
                        <li><strong>Mahram:</strong> Suami, ayah, saudara laki-laki kandung, atau kerabat laki-laki yang tidak boleh dinikahi (muhrim).</li>
                        <li><strong>Dokumen:</strong> Melampirkan akta nikah (jika mahram adalah suami), kartu keluarga, dan surat pernyataan mahram.</li>
                        <li><strong>Wanita >45 tahun:</strong> Boleh berangkat tanpa mahram asalkan dalam rombongan dan membuat surat izin dari wali.</li>
                    </ul>
                    Tim kami akan membantu menyiapkan surat pernyataan mahram.
                </div></div>
            </div>
        </div>

        <!-- ==================== KESEHATAN ==================== -->
        <div class="faq-section" id="sec-kesehatan" data-cat="kesehatan">
            <div class="section-header">
                <div class="section-icon kesehatan"><i class="fa-solid fa-heart-pulse"></i></div>
                <div><h2>{{ __('Kesehatan & Vaksinasi') }}</h2><p>{{ __('Persyaratan kesehatan, vaksin, dan tips menjaga kondisi tubuh') }}</p></div>
            </div>

            <div class="faq-card" data-search="apa vaksin wajib meningitis covid suntik">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Apa saja vaksinasi yang wajib dilakukan sebelum berangkat umroh?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Pemerintah Arab Saudi dan Indonesia mewajibkan beberapa vaksinasi bagi jamaah:
                    <ul>
                        <li><strong>Vaksin Meningitis:</strong> <strong>WAJIB</strong> — dilakukan minimal 10 hari sebelum keberangkatan. Berlaku selama 3 tahun.</li>
                        <li><strong>Vaksin Influenza:</strong> Sangat direkomendasikan, terutama untuk jamaah lansia dan memiliki komorbid.</li>
                        <li><strong>Vaksin COVID-19:</strong> Sesuai ketentuan terbaru dari pemerintah Saudi dan Indonesia.</li>
                    </ul>
                    Vaksinasi meningitis bisa dilakukan di Kantor Kesehatan Pelabuhan (KKP) atau rumah sakit yang ditunjuk pemerintah. Bawa paspor asli saat vaksinasi.
                </div></div>
            </div>

            <div class="faq-card" data-search="bagaimana jaga kesehatan tips sakit flu di tanah suci">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Bagaimana tips menjaga kesehatan selama di Tanah Suci?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Berikut tips penting menjaga kesehatan selama ibadah:
                    <ul>
                        <li><strong>Hidrasi:</strong> Minum air putih minimal 2–3 liter per hari, terutama saat cuaca panas.</li>
                        <li><strong>Masker:</strong> Gunakan masker di area ramai untuk menghindari penularan flu dan batuk.</li>
                        <li><strong>Obat Pribadi:</strong> Bawa obat-obatan rutin (darah tinggi, diabetes, asma, dll.) dalam jumlah cukup.</li>
                        <li><strong>Istirahat:</strong> Jangan memaksakan diri, atur waktu ibadah dan istirahat dengan seimbang.</li>
                        <li><strong>Makanan:</strong> Konsumsi makanan bersih dan matang, hindari jajanan pinggir jalan yang tidak higienis.</li>
                        <li><strong>P3K:</strong> Tim kami menyediakan kotak P3K dan memiliki kontak dokter dan rumah sakit terdekat untuk keadaan darurat.</li>
                    </ul>
                </div></div>
            </div>

            <div class="faq-card" data-search="siapa jamaah sakit penyakit komorbid boleh ikut">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="faq-q-text">{{ __('Apakah jamaah dengan riwayat penyakit tertentu boleh ikut umroh?') }}</span>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer"><div class="faq-answer-inner">
                    Jamaah dengan riwayat penyakit kronis tetap boleh berangkat umroh dengan syarat:
                    <ul>
                        <li><strong>Surat Keterangan Sehat:</strong> Dari dokter yang menyatakan layak terbang dan melaksanakan ibadah.</li>
                        <li><strong>Obat rutin:</strong> Membawa stok obat yang cukup selama perjalanan beserta resep dokter berbahasa Inggris.</li>
                        <li><strong>Pendamping:</strong> Disarankan berangkat bersama keluarga atau pendamping yang bisa membantu.</li>
                        <li><strong>Informasikan ke kami:</strong> Harap menginformasikan kondisi kesehatan saat pendaftaran agar kami bisa menyiapkan pendampingan yang optimal.</li>
                    </ul>
                </div></div>
            </div>
        </div>

    </div>

    <!-- Contact Section -->
    <div id="contact" class="contact-section">
        <div class="contact-card">
            <h3><i class="fa-solid fa-headset" style="margin-right: 10px;"></i> {{ __('Butuh Bantuan Lebih Lanjut?') }}</h3>
            <p>{{ __('Jangan ragu untuk menghubungi tim customer service kami. Kami siap membantu Anda kapan saja!') }}</p>
            <div class="contact-channels">
                <a href="https://wa.me/6287775482764" target="_blank" class="contact-item">
                    <div class="contact-item-icon wa"><i class="fa-brands fa-whatsapp"></i></div>
                    <h4>WhatsApp</h4>
                    <p>0877-7548-2764<br>{{ __('Respon cepat 24 jam') }}</p>
                </a>
                <a href="mailto:adminharamaintour@gmail.com" class="contact-item">
                    <div class="contact-item-icon email"><i class="fa-solid fa-envelope"></i></div>
                    <h4>Email</h4>
                    <p>adminharamaintour@gmail.com<br>{{ __('Balasan dalam 1x24 jam') }}</p>
                </a>
                <a href="tel:0217638639" class="contact-item">
                    <div class="contact-item-icon ig" style="background: linear-gradient(135deg, #1d4ed8, #3b82f6);"><i class="fa-solid fa-phone"></i></div>
                    <h4>{{ __('Telepon') }}</h4>
                    <p>021-7638639<br>{{ __('Senin - Jumat, 08:00 - 17:00') }}</p>
                </a>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <script>
        function toggleFaq(el) {
            const card = el.closest('.faq-card');
            const wasOpen = card.classList.contains('open');
            // Close all in same section
            card.closest('.faq-section').querySelectorAll('.faq-card.open').forEach(c => c.classList.remove('open'));
            if (!wasOpen) card.classList.add('open');
        }

        function showCat(cat, btn) {
            document.querySelectorAll('.cat-tab').forEach(t => t.classList.remove('active'));
            btn.classList.add('active');

            document.querySelectorAll('.faq-section').forEach(sec => {
                if (cat === 'semua' || sec.dataset.cat === cat) {
                    sec.classList.remove('hidden');
                } else {
                    sec.classList.add('hidden');
                }
            });
            document.getElementById('noResults').style.display = 'none';
        }

        function filterFAQ() {
            const q = document.getElementById('faqSearch').value.toLowerCase().trim();
            const sections = document.querySelectorAll('.faq-section');
            let totalVisible = 0;

            sections.forEach(sec => {
                let sectionVisible = 0;
                sec.querySelectorAll('.faq-card').forEach(card => {
                    const text = (card.dataset.search || '') + card.textContent.toLowerCase();
                    if (!q || text.includes(q)) {
                        card.style.display = '';
                        sectionVisible++;
                        totalVisible++;
                    } else {
                        card.style.display = 'none';
                    }
                });
                // Hide section header if no cards visible
                if (q && sectionVisible === 0) {
                    sec.style.display = 'none';
                } else {
                    sec.style.display = '';
                    sec.classList.remove('hidden');
                }
            });

            // Reset category tabs to "Semua"
            if (q) {
                document.querySelectorAll('.cat-tab').forEach(t => t.classList.remove('active'));
                document.querySelector('.cat-tab').classList.add('active');
            }

            const noRes = document.getElementById('noResults');
            document.getElementById('searchTerm').textContent = q;
            noRes.style.display = (totalVisible === 0 && q) ? 'block' : 'none';
        }
    </script>

    @include('partials.chatbot')
</body>
</html>


