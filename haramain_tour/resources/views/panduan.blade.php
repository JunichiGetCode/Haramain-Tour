<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Ibadah Umroh - Haramain Tour</title>
    <meta name="description" content="Panduan Ibadah Umroh Lengkap - Haramain Tour">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Base styles matching dashboard */
        :root {
            --bg-color: #f5f3ee;
            --navy-color: #0d1130;
            --navy-light: #283375;
            --gold-color: #c9a84c;
            --gold-light: #d6b881;
            --gold-glow: rgba(201, 168, 76, 0.3);
            --text-dark: #2c2c2c;
            --text-gray: #6b7280;
            --error-color: #e3342f;
            --card-bg: #ffffff;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', 'Segoe UI', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); overflow-x: hidden; }

        /* --- NAVBAR --- */
        .navbar {
            background-color: white;
            padding: 14px 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.04);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .brand-logo {
            display: flex; align-items: center; gap: 12px; text-decoration: none;
        }

        .brand-logo img {
            width: 40px; height: 40px; object-fit: contain;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }

        .brand-logo h1 {
            font-size: 1.3rem; font-weight: 800; color: var(--navy-color);
            letter-spacing: 1px;
        }

        .search-bar {
            flex: 1; max-width: 380px;
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            border-radius: 14px;
            display: flex; align-items: center; padding: 12px 20px;
            color: white; margin: 0 25px;
            box-shadow: 0 4px 15px var(--gold-glow);
            transition: var(--transition);
        }

        .search-bar:focus-within {
            box-shadow: 0 6px 25px rgba(201, 168, 76, 0.4);
            transform: translateY(-1px);
        }

        .search-bar i { font-size: 1rem; opacity: 0.9; }
        .search-bar input {
            border: none; background: transparent; color: white; font-size: 0.9rem;
            outline: none; width: 100%; margin-left: 12px; font-weight: 500;
            font-family: 'Poppins', sans-serif;
        }
        .search-bar input::placeholder { color: rgba(255,255,255,0.75); }

        .nav-icons { display: flex; align-items: center; gap: 8px; }

        .nav-icon-btn {
            width: 42px; height: 42px;
            display: flex; justify-content: center; align-items: center;
            border-radius: 12px;
            color: var(--text-gray);
            text-decoration: none;
            transition: var(--transition);
            font-size: 1.15rem;
            position: relative;
        }

        .nav-icon-btn:hover {
            background: var(--bg-color);
            color: var(--navy-color);
        }

        .nav-icon-btn.active {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: white;
            box-shadow: 0 4px 12px var(--gold-glow);
        }

        /* --- DROPDOWN PROFILE --- */
        .profile-dropdown { position: relative; display: inline-block; }

        .profile-trigger {
            background: var(--bg-color); border: 2px solid transparent;
            width: 42px; height: 42px; border-radius: 12px;
            font-size: 1.1rem; color: var(--navy-color);
            cursor: pointer; transition: var(--transition);
            display: flex; align-items: center; justify-content: center;
        }
        .profile-trigger:hover { border-color: var(--gold-color); color: var(--gold-color); }

        .dropdown-menu {
            display: none;
            position: absolute; right: 0; top: calc(100% + 10px);
            background-color: white; min-width: 220px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
            border-radius: 16px; overflow: hidden; z-index: 1000;
            flex-direction: column;
            border: 1px solid rgba(0, 0, 0, 0.05);
            animation: dropIn 0.2s ease-out;
        }

        @keyframes dropIn {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dropdown-menu.show { display: flex; }

        .dropdown-header {
            padding: 18px 20px;
            font-weight: 700;
            color: var(--navy-color);
            border-bottom: 1px solid #f0f0f0;
            background: linear-gradient(135deg, #fafafa, #f5f5f5);
            font-size: 0.95rem;
        }

        .dropdown-header small {
            display: block;
            font-weight: 400;
            color: var(--text-gray);
            font-size: 0.8rem;
            margin-top: 2px;
        }

        .dropdown-menu a, .dropdown-menu button {
            padding: 14px 20px; text-decoration: none; color: var(--text-dark);
            font-size: 0.9rem; font-weight: 500; display: flex; align-items: center; gap: 12px;
            transition: var(--transition); border: none; background: none; width: 100%;
            text-align: left; cursor: pointer; font-family: 'Poppins', sans-serif;
        }

        .dropdown-menu a:hover, .dropdown-menu button:hover {
            background-color: #f8f9fa; color: var(--gold-color);
        }

        .dropdown-divider { height: 1px; background-color: #f0f0f0; margin: 4px 0; }

        .logout-btn { color: var(--error-color) !important; }
        .logout-btn:hover { background-color: #fef2f2 !important; color: var(--error-color) !important; }

        /* --- PANDUAN STYLES --- */
        .main-container { max-width: 1500px; margin: 30px auto; padding: 0 20px; }
        


        .panduan-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px; margin-bottom: 50px;
        }

        .panduan-card {
            background: var(--card-bg); border-radius: 20px; padding: 35px 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); transition: var(--transition);
            position: relative; overflow: hidden; display: flex; flex-direction: column;
            border: 2px solid transparent; text-decoration: none;
        }
        .panduan-card:hover {
            transform: translateY(-8px); border-color: var(--gold-color);
            box-shadow: 0 15px 35px rgba(201, 168, 76, 0.15);
        }
        .panduan-card::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(201, 168, 76, 0.05), transparent);
            opacity: 0; transition: var(--transition); z-index: 0;
        }
        .panduan-card:hover::before { opacity: 1; }

        .panduan-step {
            display: inline-flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            color: var(--gold-color); padding: 6px 16px; border-radius: 50px;
            font-size: 0.78rem; font-weight: 700; margin-bottom: 20px; align-self: flex-start;
            position: relative; z-index: 1; letter-spacing: 0.5px; text-transform: uppercase;
        }

        .panduan-icon {
            font-size: 2.5rem; color: var(--gold-color); margin-bottom: 20px;
            position: relative; z-index: 1; transition: var(--transition);
            background: var(--bg-color); width: 70px; height: 70px;
            display: flex; justify-content: center; align-items: center; border-radius: 18px;
        }
        .panduan-card:hover .panduan-icon {
            background: var(--gold-color); color: white; transform: scale(1.05) rotate(5deg);
        }

        .panduan-title {
            font-size: 1.3rem; font-weight: 800; color: var(--navy-color);
            margin-bottom: 12px; position: relative; z-index: 1;
        }

        .panduan-desc {
            font-size: 0.9rem; color: var(--text-gray); line-height: 1.6;
            margin-bottom: 25px; flex-grow: 1; position: relative; z-index: 1;
        }

        .panduan-btn {
            background: transparent; color: var(--navy-color);
            border: 1px solid rgba(13, 17, 48, 0.15); padding: 12px 0; border-radius: 14px;
            font-weight: 700; text-align: center; transition: var(--transition);
            position: relative; z-index: 1; width: 100%; font-size: 0.9rem;
            display: flex; justify-content: center; align-items: center; gap: 8px;
        }
        .panduan-card:hover .panduan-btn {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: white; border-color: transparent; box-shadow: 0 4px 15px var(--gold-glow);
        }

        .panduan-tips {
            background: linear-gradient(135deg, #ffffff, #fffaf0);
            border: 1px solid rgba(201, 168, 76, 0.3); border-radius: 20px; padding: 35px;
            display: flex; align-items: center; gap: 25px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            position: relative; overflow: hidden; margin-bottom: 20px;
        }
        .panduan-tips::before {
            content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 6px;
            background: linear-gradient(to bottom, var(--gold-color), var(--gold-light));
        }
        .panduan-tips-icon {
            background: rgba(201, 168, 76, 0.15); color: var(--gold-color);
            width: 70px; height: 70px; border-radius: 50%;
            display: flex; justify-content: center; align-items: center;
            font-size: 2rem; flex-shrink: 0;
        }
        .panduan-tips-content h3 { font-size: 1.25rem; font-weight: 800; color: var(--navy-color); margin-bottom: 8px; }
        .panduan-tips-content p { font-size: 0.95rem; color: var(--text-gray); line-height: 1.7; margin: 0; }

        /* --- MODAL PANDUAN --- */
        .modal {
            display: none; position: fixed; z-index: 1000; left: 0; top: 0;
            width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.6);
            align-items: center; justify-content: center; backdrop-filter: blur(8px);
        }
        .modal.show { display: flex; }

        .modal-content {
            background-color: var(--navy-color); margin: auto; padding: 0;
            border-radius: 24px; width: 90%; max-width: 600px; color: white;
            position: relative; overflow: hidden; box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4);
            animation: modalSlideUp 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            max-height: 90vh; display: flex; flex-direction: column;
        }

        @keyframes modalSlideUp {
            from { transform: translateY(40px) scale(0.95); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }

        .close-modal {
            position: absolute; top: 20px; right: 20px;
            background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);
            color: white; width: 38px; height: 38px; border-radius: 12px;
            display: flex; justify-content: center; align-items: center; cursor: pointer;
            z-index: 20; transition: var(--transition); border: none; font-size: 1.1rem;
        }
        .close-modal:hover { background: var(--error-color); }
        .modal-body { padding: 35px; overflow-y: auto; flex: 1; }
        .modal-title { font-size: 1.4rem; font-weight: 800; margin-bottom: 25px; display: flex; align-items: center; gap: 10px; }
        
        .prep-section {
            background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px; padding: 25px; margin-bottom: 20px;
        }
        .prep-header { display: flex; align-items: center; gap: 15px; margin-bottom: 15px; }
        .prep-num {
            width: 32px; height: 32px; border-radius: 8px;
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color); display: flex; justify-content: center; align-items: center;
            font-weight: 800; font-size: 1.1rem; flex-shrink: 0;
        }
        .prep-header h3 { font-size: 1.15rem; color: white; font-weight: 700; margin: 0; }
        
        .prep-list { list-style: none; display: grid; gap: 12px; }
        .prep-list li {
            font-size: 0.92rem; color: rgba(255,255,255,0.75); line-height: 1.5;
            display: flex; align-items: flex-start; gap: 12px;
        }
        .prep-list li i { color: var(--gold-color); margin-top: 4px; font-size: 0.85rem; }

        /* Kamus specific */
        .kamus-list { gap: 0 !important; }
        .kamus-list .kamus-entry {
            display: flex !important; flex-direction: column !important;
            gap: 0 !important; align-items: stretch !important;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding: 14px 0;
        }
        .kamus-list .kamus-entry:last-child { border-bottom: none; }
        .kamus-entry .kamus-row {
            display: flex; justify-content: space-between; align-items: center; gap: 20px; width: 100%;
        }
        .kamus-entry .kamus-arab {
            color: var(--gold-color); font-family: 'Amiri', serif;
            font-size: 1.15rem; font-weight: bold;
        }
        .kamus-entry .kamus-arti {
            color: #ccc; text-align: right; flex-shrink: 0; margin-left: auto;
            font-size: 0.92rem;
        }
        .kamus-entry .kamus-latin {
            font-style: italic; color: #888; font-size: 0.8rem; margin-top: 5px;
        }
        .kamus-angka {
            display: grid !important; grid-template-columns: repeat(5, 1fr) !important;
            gap: 10px !important; text-align: center;
        }
        .kamus-angka .angka-item {
            display: flex !important; flex-direction: column !important;
            align-items: center !important; gap: 0 !important;
            background: rgba(255,255,255,0.04); border-radius: 12px;
            padding: 14px 8px; border: 1px solid rgba(255,255,255,0.06);
            transition: all 0.2s ease;
        }
        .kamus-angka .angka-item:hover { background: rgba(201,168,76,0.1); border-color: rgba(201,168,76,0.3); }
        .kamus-angka .angka-num {
            font-size: 1.3rem; font-weight: 800; color: var(--gold-color); line-height: 1;
        }
        .kamus-angka .angka-arab {
            font-family: 'Amiri', serif; color: rgba(255,255,255,0.8);
            font-size: 1rem; margin-top: 6px;
        }
        .kamus-angka .angka-latin {
            font-style: italic; color: #888; font-size: 0.7rem; margin-top: 4px;
        }

        @media (max-width: 768px) {
            .navbar { flex-wrap: wrap; gap: 12px; justify-content: center; padding: 12px 15px; }
            .search-bar { order: 3; max-width: 100%; margin: 0; }
            .nav-icons { order: 2; }
            .dropdown-menu { right: -50px; }

            .panduan-grid { grid-template-columns: 1fr; }
            .panduan-tips { flex-direction: column; text-align: center; gap: 15px; }
            .footer-content { grid-template-columns: 1fr; gap: 30px; text-align: center; }
            .footer-social { justify-content: center; }
        }
    </style>
    @include('partials.footer-css')
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">

    <!-- Navbar -->
    @include('partials.navbar-css')
    @include('partials.navbar')

    <x-hero 
        badgeIcon="fa-solid fa-book-quran" 
        :badgeText="__('Panduan Lengkap')" 
        :title="__('Panduan Ibadah')" 
        arabic="إِرْشَادَاتُ الْعِبَادَةِ" 
        :description="__('Pelajari tata cara, doa, dan tips lengkap untuk kesempurnaan ibadah umroh Anda dari awal hingga akhir, sesuai dengan sunnah.')"
        bgIcon="\f02d" 
    />

    <!-- Main Content -->
    <main class="main-container" style="margin-top: 0;">

        <div class="panduan-grid">
            <!-- Card 1 -->
            <a href="javascript:void(0)" onclick="openModal('modal-persiapan')" class="panduan-card">
                <span class="panduan-step">{{ __('Persiapan') }}</span>
                <div class="panduan-icon">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>
                <h3 class="panduan-title">{{ __('Sebelum Berangkat') }}</h3>
                <p class="panduan-desc">{{ __('Hal yang wajib dicek sebelum keberangkatan, mencakup dokumen, kesehatan, dan perlengkapan jamaah.') }}</p>
                <div class="panduan-btn">{{ __('Lihat Detail') }} <i class="fa-solid fa-arrow-right"></i></div>
            </a>

            <!-- Card 2 -->
            <a href="javascript:void(0)" onclick="openModal('modal-niat-ihram')" class="panduan-card">
                <span class="panduan-step">{{ __('Langkah 1') }}</span>
                <div class="panduan-icon">
                    <i class="fa-solid fa-hands-praying"></i>
                </div>
                <h3 class="panduan-title">{{ __('Niat Ihram') }}</h3>
                <p class="panduan-desc">{{ __('Awal memulai ibadah umroh dari Miqat. Ketahui syarat wajib, sunnah ihram, dan pantangannya.') }}</p>
                <div class="panduan-btn">{{ __('Lihat Detail') }} <i class="fa-solid fa-arrow-right"></i></div>
            </a>

            <!-- Card 3 -->
            <a href="javascript:void(0)" onclick="openModal('modal-tawaf')" class="panduan-card">
                <span class="panduan-step">{{ __('Langkah 2') }}</span>
                <div class="panduan-icon">
                    <i class="fa-solid fa-kaaba"></i>
                </div>
                <h3 class="panduan-title">{{ __('Tawaf') }}</h3>
                <p class="panduan-desc">{{ __('Mengelilingi Ka\'bah 7 kali putaran. Pahami titik mulai, doa setiap putaran, hingga shalat sunnah Tawaf.') }}</p>
                <div class="panduan-btn">{{ __('Lihat Detail') }} <i class="fa-solid fa-arrow-right"></i></div>
            </a>

            <!-- Card 4 -->
            <a href="javascript:void(0)" onclick="openModal('modal-sai')" class="panduan-card">
                <span class="panduan-step">{{ __('Langkah 3') }}</span>
                <div class="panduan-icon">
                    <i class="fa-solid fa-person-walking"></i>
                </div>
                <h3 class="panduan-title">{{ __('Sa\'i') }}</h3>
                <p class="panduan-desc">{{ __('Lari kecil antara bukit Shafa dan Marwah. Sejarah ringkas, doa mendaki bukit, dan tata cara lengkap.') }}</p>
                <div class="panduan-btn">{{ __('Lihat Detail') }} <i class="fa-solid fa-arrow-right"></i></div>
            </a>

            <!-- Card 5 -->
            <a href="javascript:void(0)" onclick="openModal('modal-tahallul')" class="panduan-card">
                <span class="panduan-step">{{ __('Langkah 4') }}</span>
                <div class="panduan-icon">
                    <i class="fa-solid fa-scissors"></i>
                </div>
                <h3 class="panduan-title">{{ __('Tahallul') }}</h3>
                <p class="panduan-desc">{{ __('Mengakhiri ihram dengan memotong/mencukur rambut. Simbol suci terlepasnya dari larangan ihram.') }}</p>
                <div class="panduan-btn">{{ __('Lihat Detail') }} <i class="fa-solid fa-arrow-right"></i></div>
            </a>

            <!-- Card 6 -->
            <a href="javascript:void(0)" onclick="openModal('modal-ziarah')" class="panduan-card">
                <span class="panduan-step">{{ __('Pelengkap') }}</span>
                <div class="panduan-icon">
                    <i class="fa-solid fa-mosque"></i>
                </div>
                <h3 class="panduan-title">{{ __('Ziarah & Tips') }}</h3>
                <p class="panduan-desc">{{ __('Tempat bersejarah penting dan tips berharga selama tinggal di tanah suci Makkah dan Madinah.') }}</p>
                <div class="panduan-btn">{{ __('Lihat Detail') }} <i class="fa-solid fa-arrow-right"></i></div>
            </a>
        </div>

        <div class="panduan-tips">
            <div class="panduan-tips-icon">
                <i class="fa-regular fa-lightbulb"></i>
            </div>
            <div class="panduan-tips-content">
                <h3>Tips Menggunakan Panduan</h3>
                <p>Klik setiap kartu panduan untuk melihat detail lengkap. Pelajari dengan seksama sebelum berangkat dan simpan aplikasi ini sebagai referensi praktis selama perjalanan umroh Anda. Semoga Allah mudahkan ibadah Anda dan menjadikan umroh mabrur.</p>
            </div>
        </div>

    </main>

    <!-- Modal Persiapan -->
    <div id="modal-persiapan" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeModal('modal-persiapan')"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-body" style="padding-top: 40px;">
                <h2 class="modal-title" style="color: var(--gold-color);"><i class="fa-solid fa-clipboard-list"></i> Persiapan & Perlengkapan</h2>
                
                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">1</div>
                        <h3>Dokumen Penting</h3>
                    </div>
                    <ul class="prep-list">
                        <li><i class="fa-solid fa-check"></i> Paspor (berlaku minimal 6 bulan)</li>
                        <li><i class="fa-solid fa-check"></i> Visa umroh</li>
                        <li><i class="fa-solid fa-check"></i> Tiket pesawat PP</li>
                        <li><i class="fa-solid fa-check"></i> Voucher hotel</li>
                        <li><i class="fa-solid fa-check"></i> Kartu vaksin (meningitis & COVID-19)</li>
                        <li><i class="fa-solid fa-check"></i> Fotokopi semua dokumen</li>
                        <li><i class="fa-solid fa-check"></i> Travel document dari biro</li>
                    </ul>
                </div>

                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">2</div>
                        <h3>Barang Penting</h3>
                    </div>
                    <ul class="prep-list">
                        <li><i class="fa-solid fa-check"></i> Kain ihram 2 set (pria) / Mukena & jilbab (wanita)</li>
                        <li><i class="fa-solid fa-check"></i> Sandal yang nyaman (tidak menutupi punggung kaki untuk pria)</li>
                        <li><i class="fa-solid fa-check"></i> Obat-obatan pribadi & vitamin</li>
                        <li><i class="fa-solid fa-check"></i> Tas pinggang untuk dokumen & uang</li>
                        <li><i class="fa-solid fa-check"></i> Power bank & charger</li>
                        <li><i class="fa-solid fa-check"></i> Pakaian ganti secukupnya</li>
                        <li><i class="fa-solid fa-check"></i> Uang riyal & rupiah secukupnya</li>
                    </ul>
                </div>

                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">3</div>
                        <h3>Mental & Fisik</h3>
                    </div>
                    <ul class="prep-list">
                        <li><i class="fa-solid fa-check"></i> Niat karena Allah semata</li>
                        <li><i class="fa-solid fa-check"></i> Istirahat yang cukup sebelum berangkat</li>
                        <li><i class="fa-solid fa-check"></i> Selesaikan hutang & minta maaf pada keluarga</li>
                        <li><i class="fa-solid fa-check"></i> Pelajari manasik umroh</li>
                        <li><i class="fa-solid fa-check"></i> Kondisi kesehatan fit (medical check up jika perlu)</li>
                        <li><i class="fa-solid fa-check"></i> Perbanyak doa & istighfar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Niat Ihram -->
    <div id="modal-niat-ihram" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeModal('modal-niat-ihram')"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-body" style="padding-top: 40px;">
                <h2 class="modal-title" style="color: var(--gold-color);"><i class="fa-solid fa-hands-praying"></i> Niat & Ihram</h2>
                
                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">1</div>
                        <h3>Cara Berihram</h3>
                    </div>
                    <ul class="prep-list">
                        <li><i class="fa-solid fa-check"></i> Mandi sunnah (sangat dianjurkan)</li>
                        <li><i class="fa-solid fa-check"></i> Pakai wewangian di badan (sebelum pakai ihram)</li>
                        <li><i class="fa-solid fa-check"></i> Pakai kain ihram (pria: 2 kain putih tanpa jahitan, wanita: pakaian sopan menutup aurat)</li>
                        <li><i class="fa-solid fa-check"></i> Shalat sunnah 2 rakaat (opsional tapi dianjurkan)</li>
                        <li><i class="fa-solid fa-check"></i> Niat ihram dan bacakan talbiyah</li>
                    </ul>
                </div>

                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">2</div>
                        <h3>Niat & Doa</h3>
                    </div>
                    <ul class="prep-list">
                        <li><i class="fa-solid fa-check"></i> Bacakan niat di dalam hati</li>
                        <li><i class="fa-solid fa-check"></i> Ucapkan talbiyah dengan lantang (pria) / lirih (wanita)</li>
                        <li><i class="fa-solid fa-check"></i> Terus ucapkan talbiyah sampai tiba di Masjidil Haram</li>
                    </ul>
                    <div style="background: rgba(0,0,0,0.2); padding: 15px; border-radius: 12px; margin-top: 15px; text-align: center;">
                        <p style="font-size: 1.6rem; color: var(--gold-color); font-weight: bold; font-family: 'Amiri', serif; margin-bottom: 15px;" dir="rtl">لَبَّيْكَ اللَّهُمَّ عُمْرَةً</p>
                        <p style="font-style: italic; color: #ccc; margin-bottom: 5px;">Latin: Labbaikallahumma umratan</p>
                        <p style="font-size: 0.9rem; color: #aaa;">Artinya: Aku penuhi panggilan-Mu ya Allah untuk melaksanakan umroh</p>
                    </div>
                </div>

                <div class="prep-section" style="border-color: rgba(255, 85, 85, 0.3); background: rgba(255, 85, 85, 0.05);">
                    <div class="prep-header">
                        <div class="prep-num" style="background: linear-gradient(135deg, #ff5555, #aa0000); color: white;"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        <h3 style="color: #ffaaaa;">Larangan Saat Ihram</h3>
                    </div>
                    <ul class="prep-list">
                        <li style="color: #ffaaaa;"><i class="fa-solid fa-xmark" style="color: #ff5555;"></i> Tidak boleh memakai wewangian (parfum, minyak wangi)</li>
                        <li style="color: #ffaaaa;"><i class="fa-solid fa-xmark" style="color: #ff5555;"></i> Tidak boleh potong rambut atau kuku</li>
                        <li style="color: #ffaaaa;"><i class="fa-solid fa-xmark" style="color: #ff5555;"></i> Tidak boleh berburu atau membunuh hewan</li>
                        <li style="color: #ffaaaa;"><i class="fa-solid fa-xmark" style="color: #ff5555;"></i> Tidak boleh akad nikah atau menikahkan</li>
                        <li style="color: #ffaaaa;"><i class="fa-solid fa-xmark" style="color: #ff5555;"></i> Khusus pria: tidak boleh pakai pakaian berjahit & tutup kepala</li>
                        <li style="color: #ffaaaa;"><i class="fa-solid fa-xmark" style="color: #ff5555;"></i> Khusus wanita: tidak boleh tutup muka dengan cadar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tawaf -->
    <div id="modal-tawaf" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeModal('modal-tawaf')"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-body" style="padding-top: 40px;">
                <h2 class="modal-title" style="color: var(--gold-color);"><i class="fa-solid fa-kaaba"></i> Panduan Tawaf</h2>
                
                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">1</div>
                        <h3>Persiapan Tawaf</h3>
                    </div>
                    <ul class="prep-list">
                        <li><i class="fa-solid fa-check"></i> Pastikan dalam keadaan suci (wudhu)</li>
                        <li><i class="fa-solid fa-check"></i> Pria mengatur kain ihram: idhtiba' (buka bahu kanan)</li>
                        <li><i class="fa-solid fa-check"></i> Masuk Masjidil Haram dari pintu Bani Syaibah (dianjurkan)</li>
                        <li><i class="fa-solid fa-check"></i> Saat pertama lihat Ka'bah, angkat tangan & berdoa</li>
                        <li><i class="fa-solid fa-check"></i> Menuju Hajar Aswad untuk memulai tawaf</li>
                    </ul>
                </div>

                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">2</div>
                        <h3>Cara Tawaf</h3>
                    </div>
                    <ul class="prep-list">
                        <li><i class="fa-solid fa-check"></i> Mulai dari Hajar Aswad (pojok timur Ka'bah)</li>
                        <li><i class="fa-solid fa-check"></i> Istilam (cium) Hajar Aswad jika memungkinkan, atau cukup isyarat tangan</li>
                        <li><i class="fa-solid fa-check"></i> Ucapkan: Bismillahi wallahu akbar</li>
                        <li><i class="fa-solid fa-check"></i> Keliling Ka'bah berlawanan arah jarum jam</li>
                        <li><i class="fa-solid fa-check"></i> Lakukan ramal (jalan cepat) untuk pria di 3 putaran pertama</li>
                        <li><i class="fa-solid fa-check"></i> Baca doa & dzikir sepanjang tawaf</li>
                        <li><i class="fa-solid fa-check"></i> Istilam setiap melewati Hajar Aswad</li>
                        <li><i class="fa-solid fa-check"></i> Ulangi hingga 7 putaran</li>
                    </ul>
                </div>

                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">3</div>
                        <h3>Setelah Tawaf</h3>
                    </div>
                    <ul class="prep-list">
                        <li><i class="fa-solid fa-check"></i> Shalat sunnah 2 rakaat di belakang Maqam Ibrahim</li>
                        <li><i class="fa-solid fa-check"></i> Minum air zamzam sambil berdoa</li>
                        <li><i class="fa-solid fa-check"></i> Kembali ke Hajar Aswad untuk istilam (jika memungkinkan)</li>
                        <li><i class="fa-solid fa-check"></i> Siap untuk melanjutkan ke Sa'i</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sa'i -->
    <div id="modal-sai" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeModal('modal-sai')"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-body" style="padding-top: 40px;">
                <h2 class="modal-title" style="color: var(--gold-color);"><i class="fa-solid fa-person-walking"></i> Panduan Sa'i</h2>
                
                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">1</div>
                        <h3>Cara Sa'i</h3>
                    </div>
                    <ul class="prep-list">
                        <li><i class="fa-solid fa-check"></i> Mulai dari bukit Shafa</li>
                        <li><i class="fa-solid fa-check"></i> Menghadap Ka'bah dan bertakbir 3x serta berdoa</li>
                        <li><i class="fa-solid fa-check"></i> Berjalan menuju Marwah</li>
                        <li><i class="fa-solid fa-check"></i> Pria berlari kecil di antara 2 lampu hijau</li>
                        <li><i class="fa-solid fa-check"></i> Wanita berjalan biasa saja (tidak perlu berlari)</li>
                        <li><i class="fa-solid fa-check"></i> Sampai di Marwah, menghadap Ka'bah, takbir & berdoa</li>
                        <li><i class="fa-solid fa-check"></i> Kembali ke Shafa (ini hitungan putaran ke-2)</li>
                        <li><i class="fa-solid fa-check"></i> Ulangi hingga 7 putaran (berakhir di Marwah)</li>
                    </ul>
                </div>

                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">2</div>
                        <h3>Doa di Shafa & Marwah</h3>
                    </div>
                    <ul class="prep-list">
                        <li><i class="fa-solid fa-check"></i> Bacakan ayat di bawah saat naik Shafa</li>
                        <li><i class="fa-solid fa-check"></i> Ucapkan takbir 3x: Allahu Akbar, Allahu Akbar, Allahu Akbar</li>
                        <li><i class="fa-solid fa-check"></i> Berdoa dengan khusyu' menghadap Ka'bah</li>
                    </ul>
                    <div style="background: rgba(0,0,0,0.2); padding: 15px; border-radius: 12px; margin-top: 15px; text-align: center;">
                        <p style="font-size: 1.6rem; color: var(--gold-color); font-weight: bold; font-family: 'Amiri', serif; margin-bottom: 15px;" dir="rtl">إِنَّ الصَّفَا وَالْمَرْوَةَ مِنْ شَعَائِرِ اللَّهِ</p>
                        <p style="font-style: italic; color: #ccc; margin-bottom: 5px;">Latin: Innash-shafaa wal-marwata min sya'aa'irillah</p>
                        <p style="font-size: 0.9rem; color: #aaa;">Artinya: Sesungguhnya Shafa dan Marwah adalah sebagian dari syi'ar Allah</p>
                    </div>
                </div>

                <div class="prep-section" style="border-color: rgba(201, 168, 76, 0.3); background: rgba(201, 168, 76, 0.05);">
                    <div class="prep-header">
                        <div class="prep-num" style="background: linear-gradient(135deg, var(--gold-color), var(--gold-light)); color: var(--navy-color);"><i class="fa-solid fa-lightbulb"></i></div>
                        <h3 style="color: var(--gold-light);">Tips Sa'i</h3>
                    </div>
                    <ul class="prep-list">
                        <li style="color: #e2e8f0;"><i class="fa-solid fa-check" style="color: var(--gold-color);"></i> Gunakan lantai atas jika bawah penuh</li>
                        <li style="color: #e2e8f0;"><i class="fa-solid fa-check" style="color: var(--gold-color);"></i> Boleh istirahat sejenak jika lelah</li>
                        <li style="color: #e2e8f0;"><i class="fa-solid fa-check" style="color: var(--gold-color);"></i> Minum air zamzam untuk stamina</li>
                        <li style="color: #e2e8f0;"><i class="fa-solid fa-check" style="color: var(--gold-color);"></i> Jaga konsentrasi & perbanyak doa</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tahallul -->
    <div id="modal-tahallul" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeModal('modal-tahallul')"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-body" style="padding-top: 40px;">
                <h2 class="modal-title" style="color: var(--gold-color);"><i class="fa-solid fa-scissors"></i> Panduan Tahallul</h2>
                
                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">1</div>
                        <h3>Cara Tahallul</h3>
                    </div>
                    <ul class="prep-list">
                        <li><i class="fa-solid fa-check"></i> Potong atau cukur rambut minimal 3 helai</li>
                        <li><i class="fa-solid fa-check"></i> Pria: dianjurkan cukur gundul (lebih afdhal)</li>
                        <li><i class="fa-solid fa-check"></i> Wanita: potong ujung rambut sepanjang ujung jari (sekitar 3 cm)</li>
                        <li><i class="fa-solid fa-check"></i> Lakukan setelah selesai Sa'i</li>
                        <li><i class="fa-solid fa-check"></i> Bisa dilakukan di Masjidil Haram atau hotel</li>
                    </ul>
                </div>

                <div class="prep-section" style="border-color: rgba(16, 185, 129, 0.3); background: rgba(16, 185, 129, 0.05);">
                    <div class="prep-header">
                        <div class="prep-num" style="background: linear-gradient(135deg, #10b981, #059669); color: white;"><i class="fa-solid fa-check-double"></i></div>
                        <h3 style="color: #10b981;">Setelah Tahallul</h3>
                    </div>
                    <ul class="prep-list">
                        <li style="color: #e2e8f0;"><i class="fa-solid fa-check-circle" style="color: #10b981;"></i> Umroh selesai, semua larangan ihram sudah halal</li>
                        <li style="color: #e2e8f0;"><i class="fa-solid fa-check-circle" style="color: #10b981;"></i> Boleh pakai pakaian biasa</li>
                        <li style="color: #e2e8f0;"><i class="fa-solid fa-check-circle" style="color: #10b981;"></i> Boleh pakai wewangian</li>
                        <li style="color: #e2e8f0;"><i class="fa-solid fa-check-circle" style="color: #10b981;"></i> Sudah boleh melakukan aktivitas normal</li>
                        <li style="color: #e2e8f0;"><i class="fa-solid fa-check-circle" style="color: #10b981;"></i> Dianjurkan perbanyak ibadah di Masjidil Haram</li>
                    </ul>
                </div>

                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">3</div>
                        <h3>Ibadah Setelah Umroh</h3>
                    </div>
                    <ul class="prep-list">
                        <li><i class="fa-solid fa-check"></i> Perbanyak tawaf sunnah</li>
                        <li><i class="fa-solid fa-check"></i> Shalat tahajud di Masjidil Haram</li>
                        <li><i class="fa-solid fa-check"></i> Baca Al-Qur'an</li>
                        <li><i class="fa-solid fa-check"></i> Doa di tempat-tempat mustajab</li>
                        <li><i class="fa-solid fa-check"></i> Bersedekah kepada yang membutuhkan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ziarah -->
    <div id="modal-ziarah" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeModal('modal-ziarah')"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-body" style="padding-top: 40px;">
                <h2 class="modal-title" style="color: var(--gold-color);"><i class="fa-solid fa-mosque"></i> Ziarah & Tips</h2>
                
                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">1</div>
                        <h3>Tempat Ziarah di Makkah</h3>
                    </div>
                    <ul class="prep-list">
                        <li><i class="fa-solid fa-map-location-dot" style="color: var(--gold-color);"></i> Jabal Nur (Gua Hira) - tempat turunnya wahyu pertama</li>
                        <li><i class="fa-solid fa-map-location-dot" style="color: var(--gold-color);"></i> Jabal Tsur - tempat Nabi bersembunyi saat hijrah</li>
                        <li><i class="fa-solid fa-map-location-dot" style="color: var(--gold-color);"></i> Jabal Rahmah di Arafah - tempat Nabi Adam & Hawa bertemu</li>
                        <li><i class="fa-solid fa-map-location-dot" style="color: var(--gold-color);"></i> Masjid Jin - tempat Nabi berdakwah kepada jin</li>
                        <li><i class="fa-solid fa-map-location-dot" style="color: var(--gold-color);"></i> Gua Tsur - sejarah hijrah Nabi</li>
                    </ul>
                </div>

                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">2</div>
                        <h3>Tempat Ziarah di Madinah</h3>
                    </div>
                    <ul class="prep-list">
                        <li><i class="fa-solid fa-map-location-dot" style="color: var(--gold-color);"></i> Raudhah - taman surga di Masjid Nabawi (shalat sangat berkah)</li>
                        <li><i class="fa-solid fa-map-location-dot" style="color: var(--gold-color);"></i> Makam Rasulullah, Abu Bakar, & Umar</li>
                        <li><i class="fa-solid fa-map-location-dot" style="color: var(--gold-color);"></i> Masjid Quba - shalat 2 rakaat = pahala umroh</li>
                        <li><i class="fa-solid fa-map-location-dot" style="color: var(--gold-color);"></i> Makam Baqi' - pemakaman para sahabat</li>
                        <li><i class="fa-solid fa-map-location-dot" style="color: var(--gold-color);"></i> Gunung Uhud - tempat perang Uhud</li>
                        <li><i class="fa-solid fa-map-location-dot" style="color: var(--gold-color);"></i> Masjid Qiblatain - tempat perubahan arah kiblat</li>
                    </ul>
                </div>

                <div class="prep-section" style="border-color: rgba(201, 168, 76, 0.3); background: rgba(201, 168, 76, 0.05);">
                    <div class="prep-header">
                        <div class="prep-num" style="background: linear-gradient(135deg, var(--gold-color), var(--gold-light)); color: var(--navy-color);"><i class="fa-solid fa-lightbulb"></i></div>
                        <h3 style="color: var(--gold-light);">Tips Penting</h3>
                    </div>
                    <ul class="prep-list">
                        <li style="color: #e2e8f0;"><i class="fa-solid fa-clock" style="color: var(--gold-color);"></i> Pilih waktu tawaf saat tidak ramai (dini hari 02:00-05:00)</li>
                        <li style="color: #e2e8f0;"><i class="fa-solid fa-droplet" style="color: var(--gold-color);"></i> Selalu bawa air zamzam & minum yang cukup</li>
                        <li style="color: #e2e8f0;"><i class="fa-solid fa-umbrella" style="color: var(--gold-color);"></i> Pakai payung/topi saat keluar masjid (cuaca panas)</li>
                        <li style="color: #e2e8f0;"><i class="fa-solid fa-users" style="color: var(--gold-color);"></i> Simpan nomor pembimbing & selalu dalam kelompok</li>
                        <li style="color: #e2e8f0;"><i class="fa-solid fa-kit-medical" style="color: var(--gold-color);"></i> Bawa obat-obatan pribadi</li>
                        <li style="color: #e2e8f0;"><i class="fa-solid fa-hands-praying" style="color: var(--gold-color);"></i> Manfaatkan waktu untuk doa & ibadah maksimal</li>
                        <li style="color: #e2e8f0;"><i class="fa-solid fa-heart-pulse" style="color: var(--gold-color);"></i> Jaga kesehatan & istirahat cukup</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Doa-Doa Penting -->
    <div id="modal-doa" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeModal('modal-doa')"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-body" style="padding-top: 40px;">
                <h2 class="modal-title" style="color: var(--gold-color);"><i class="fa-solid fa-book-quran"></i> Doa-Doa Penting Umroh</h2>
                
                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">1</div>
                        <h3>Doa Masuk Masjidil Haram</h3>
                    </div>
                    <div style="background: rgba(0,0,0,0.2); padding: 15px; border-radius: 12px; text-align: center;">
                        <p style="font-size: 1.4rem; color: var(--gold-color); font-weight: bold; font-family: 'Amiri', serif; margin-bottom: 12px;" dir="rtl">بِسْمِ اللَّهِ وَالصَّلاَةُ وَالسَّلاَمُ عَلَى رَسُولِ اللَّهِ، اللَّهُمَّ افْتَحْ لِي أَبْوَابَ رَحْمَتِكَ</p>
                        <p style="font-style: italic; color: #ccc; margin-bottom: 5px;">Bismillahi wash-shalaatu was-salaamu 'ala Rasulillah, Allahummaf-tah li abwaaba rahmatik</p>
                        <p style="font-size: 0.85rem; color: #aaa;">Artinya: Dengan nama Allah, shalawat dan salam atas Rasulullah. Ya Allah bukakanlah untukku pintu-pintu rahmat-Mu</p>
                    </div>
                </div>

                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">2</div>
                        <h3>Doa Tawaf (Antara Rukun Yamani & Hajar Aswad)</h3>
                    </div>
                    <div style="background: rgba(0,0,0,0.2); padding: 15px; border-radius: 12px; text-align: center;">
                        <p style="font-size: 1.4rem; color: var(--gold-color); font-weight: bold; font-family: 'Amiri', serif; margin-bottom: 12px;" dir="rtl">رَبَّنَا آتِنَا فِي الدُّنْيَا حَسَنَةً وَفِي الآخِرَةِ حَسَنَةً وَقِنَا عَذَابَ النَّارِ</p>
                        <p style="font-style: italic; color: #ccc; margin-bottom: 5px;">Rabbanaa aatinaa fid-dunyaa hasanah, wa fil-aakhirati hasanah, wa qinaa 'adzaaban-naar</p>
                        <p style="font-size: 0.85rem; color: #aaa;">Artinya: Ya Tuhan kami, berilah kami kebaikan di dunia dan kebaikan di akhirat, dan lindungilah kami dari azab neraka</p>
                    </div>
                </div>

                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">3</div>
                        <h3>Doa Setelah Shalat di Maqam Ibrahim</h3>
                    </div>
                    <div style="background: rgba(0,0,0,0.2); padding: 15px; border-radius: 12px; text-align: center;">
                        <p style="font-size: 1.4rem; color: var(--gold-color); font-weight: bold; font-family: 'Amiri', serif; margin-bottom: 12px;" dir="rtl">وَاتَّخِذُوا مِنْ مَقَامِ إِبْرَاهِيمَ مُصَلًّى</p>
                        <p style="font-style: italic; color: #ccc; margin-bottom: 5px;">Wattakhidzuu min maqaami Ibraahiima mushalla</p>
                        <p style="font-size: 0.85rem; color: #aaa;">Artinya: Dan jadikanlah sebagian maqam Ibrahim tempat shalat</p>
                    </div>
                </div>

                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">4</div>
                        <h3>Doa Minum Air Zamzam</h3>
                    </div>
                    <div style="background: rgba(0,0,0,0.2); padding: 15px; border-radius: 12px; text-align: center;">
                        <p style="font-size: 1.4rem; color: var(--gold-color); font-weight: bold; font-family: 'Amiri', serif; margin-bottom: 12px;" dir="rtl">اللَّهُمَّ إِنِّي أَسْأَلُكَ عِلْمًا نَافِعًا وَرِزْقًا وَاسِعًا وَشِفَاءً مِنْ كُلِّ دَاءٍ</p>
                        <p style="font-style: italic; color: #ccc; margin-bottom: 5px;">Allahumma inni as'aluka 'ilman naafi'an, wa rizqan waasi'an, wa syifaa'an min kulli daa'</p>
                        <p style="font-size: 0.85rem; color: #aaa;">Artinya: Ya Allah, aku memohon kepada-Mu ilmu yang bermanfaat, rezeki yang luas, dan kesembuhan dari segala penyakit</p>
                    </div>
                </div>

                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">5</div>
                        <h3>Doa Keluar Masjid</h3>
                    </div>
                    <div style="background: rgba(0,0,0,0.2); padding: 15px; border-radius: 12px; text-align: center;">
                        <p style="font-size: 1.4rem; color: var(--gold-color); font-weight: bold; font-family: 'Amiri', serif; margin-bottom: 12px;" dir="rtl">بِسْمِ اللَّهِ وَالصَّلاَةُ وَالسَّلاَمُ عَلَى رَسُولِ اللَّهِ، اللَّهُمَّ إِنِّي أَسْأَلُكَ مِنْ فَضْلِكَ</p>
                        <p style="font-style: italic; color: #ccc; margin-bottom: 5px;">Bismillahi wash-shalaatu was-salaamu 'ala Rasulillah, Allahumma inni as'aluka min fadlik</p>
                        <p style="font-size: 0.85rem; color: #aaa;">Artinya: Dengan nama Allah, shalawat dan salam atas Rasulullah. Ya Allah, aku memohon keutamaan dari-Mu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Kamus Bahasa Arab -->
    <div id="modal-kamus" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeModal('modal-kamus')"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-body" style="padding-top: 40px;">
                <h2 class="modal-title" style="color: var(--gold-color);"><i class="fa-solid fa-language"></i> Kamus Bahasa Arab</h2>
                <p style="color: rgba(255,255,255,0.6); font-size: 0.85rem; margin-bottom: 20px;">Kosa kata penting yang sering digunakan jamaah saat di tanah suci.</p>
                
                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">1</div>
                        <h3>Sapaan &amp; Umum</h3>
                    </div>
                    <ul class="prep-list kamus-list">
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">السَّلاَمُ عَلَيْكُمْ</span><span class="kamus-arti">Semoga keselamatan atas kamu</span></div><span class="kamus-latin">Assalamu'alaikum</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">شُكْرًا</span><span class="kamus-arti">Terima kasih</span></div><span class="kamus-latin">Syukran</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">عَفْوًا</span><span class="kamus-arti">Maaf / Permisi</span></div><span class="kamus-latin">'Afwan</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">نَعَمْ / لاَ</span><span class="kamus-arti">Ya / Tidak</span></div><span class="kamus-latin">Na'am / Laa</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">مِنْ فَضْلِكَ</span><span class="kamus-arti">Tolong / Mohon</span></div><span class="kamus-latin">Min Fadhlika</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">إِنْ شَاءَ اللَّهُ</span><span class="kamus-arti">Jika Allah menghendaki</span></div><span class="kamus-latin">Insya Allah</span></li>
                    </ul>
                </div>

                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">2</div>
                        <h3>Tempat &amp; Arah</h3>
                    </div>
                    <ul class="prep-list kamus-list">
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">اَلْمَسْجِد</span><span class="kamus-arti">Masjid</span></div><span class="kamus-latin">Al-Masjid</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">اَلْفُنْدُق</span><span class="kamus-arti">Hotel</span></div><span class="kamus-latin">Al-Funduq</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">يَمِين / يَسَار</span><span class="kamus-arti">Kanan / Kiri</span></div><span class="kamus-latin">Yamiin / Yasaar</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">أَيْنَ</span><span class="kamus-arti">Di mana?</span></div><span class="kamus-latin">Aina?</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">اَلْحَمَّام</span><span class="kamus-arti">Kamar mandi</span></div><span class="kamus-latin">Al-Hammaam</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">اَلسُّوق</span><span class="kamus-arti">Pasar</span></div><span class="kamus-latin">As-Suuq</span></li>
                    </ul>
                </div>

                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">3</div>
                        <h3>Kebutuhan Sehari-hari</h3>
                    </div>
                    <ul class="prep-list kamus-list">
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">مَاء</span><span class="kamus-arti">Air</span></div><span class="kamus-latin">Maa'</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">طَعَام</span><span class="kamus-arti">Makanan</span></div><span class="kamus-latin">Tha'aam</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">بِكَمْ؟</span><span class="kamus-arti">Berapa harganya?</span></div><span class="kamus-latin">Bikam?</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">غَالِي</span><span class="kamus-arti">Mahal</span></div><span class="kamus-latin">Ghaalii</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">رَخِيص</span><span class="kamus-arti">Murah</span></div><span class="kamus-latin">Rakhiish</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">سَيَّارَة</span><span class="kamus-arti">Mobil / Taksi</span></div><span class="kamus-latin">Sayyaarah</span></li>
                    </ul>
                </div>

                <div class="prep-section">
                    <div class="prep-header">
                        <div class="prep-num">4</div>
                        <h3>Angka Dasar</h3>
                    </div>
                    <div class="kamus-angka">
                        <div class="angka-item"><span class="angka-num">1</span><span class="angka-arab">وَاحِد</span><span class="angka-latin">Waahid</span></div>
                        <div class="angka-item"><span class="angka-num">2</span><span class="angka-arab">اِثْنَان</span><span class="angka-latin">Itsnaan</span></div>
                        <div class="angka-item"><span class="angka-num">3</span><span class="angka-arab">ثَلاَثَة</span><span class="angka-latin">Tsalaatsah</span></div>
                        <div class="angka-item"><span class="angka-num">4</span><span class="angka-arab">أَرْبَعَة</span><span class="angka-latin">Arba'ah</span></div>
                        <div class="angka-item"><span class="angka-num">5</span><span class="angka-arab">خَمْسَة</span><span class="angka-latin">Khamsah</span></div>
                        <div class="angka-item"><span class="angka-num">6</span><span class="angka-arab">سِتَّة</span><span class="angka-latin">Sittah</span></div>
                        <div class="angka-item"><span class="angka-num">7</span><span class="angka-arab">سَبْعَة</span><span class="angka-latin">Sab'ah</span></div>
                        <div class="angka-item"><span class="angka-num">8</span><span class="angka-arab">ثَمَانِيَة</span><span class="angka-latin">Tsamaaniyah</span></div>
                        <div class="angka-item"><span class="angka-num">9</span><span class="angka-arab">تِسْعَة</span><span class="angka-latin">Tis'ah</span></div>
                        <div class="angka-item"><span class="angka-num">10</span><span class="angka-arab">عَشَرَة</span><span class="angka-latin">'Asyarah</span></div>
                    </div>
                </div>

                <div class="prep-section" style="border-color: rgba(201, 168, 76, 0.3); background: rgba(201, 168, 76, 0.05);">
                    <div class="prep-header">
                        <div class="prep-num" style="background: linear-gradient(135deg, var(--gold-color), var(--gold-light)); color: var(--navy-color);"><i class="fa-solid fa-lightbulb"></i></div>
                        <h3 style="color: var(--gold-light);">Frasa Darurat</h3>
                    </div>
                    <ul class="prep-list kamus-list">
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">سَاعِدْنِي</span><span class="kamus-arti">Tolong saya!</span></div><span class="kamus-latin">Saa'idnii!</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">أَنَا مَرِيض</span><span class="kamus-arti">Saya sakit</span></div><span class="kamus-latin">Ana mariidh</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">أَنَا ضَائِع</span><span class="kamus-arti">Saya tersesat</span></div><span class="kamus-latin">Ana dhaa'i'</span></li>
                        <li class="kamus-entry"><div class="kamus-row"><span class="kamus-arab">اِتَّصِلْ بِالشُّرْطَة</span><span class="kamus-arti">Hubungi polisi</span></div><span class="kamus-latin">Ittashil bisy-syurthah</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('partials.footer')


    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.add("show");
            document.body.style.overflow = "hidden";
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove("show");
            document.body.style.overflow = "auto";
        }

        function toggleProfileDropdown() {
            document.getElementById("profileMenu").classList.toggle("show");
        }

        window.onclick = function(event) {
            // Modal outside click
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove("show");
                document.body.style.overflow = "auto";
            }
            
            // Dropdown outside click
            if (!event.target.closest('.profile-trigger') && !event.target.closest('.profile-dropdown')) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
    @include('partials.chatbot')
</body>
</html>


