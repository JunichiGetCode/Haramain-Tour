<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Haramain Tour</title>
    <meta name="description" content="Dashboard Haramain Tour - Kelola perjalanan umroh dan haji Anda.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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

        /* --- KONTEN UTAMA --- */
        .main-container { max-width: 1500px; margin: 30px auto; padding: 0 20px; }

        /* Welcome Card */
        .welcome-card {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            border-radius: 20px;
            padding: 35px 40px;
            color: white;
            margin-bottom: 35px;
            position: relative;
            overflow: hidden;
        }

        .welcome-card::after {
            content: '';
            position: absolute;
            right: -50px; top: -50px;
            width: 200px; height: 200px;
            background: radial-gradient(circle, var(--gold-glow) 0%, transparent 70%);
            border-radius: 50%;
        }

        .welcome-card h2 {
            font-size: 1.5rem; font-weight: 700; margin-bottom: 6px;
            position: relative; z-index: 2;
        }

        .welcome-card h2 span {
            color: var(--gold-color);
        }

        .welcome-card p {
            font-size: 0.9rem; color: rgba(255, 255, 255, 0.6);
            position: relative; z-index: 2;
        }

        /* Notifikasi Sukses */
        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724; padding: 16px 22px;
            border-radius: 14px; margin-bottom: 25px;
            border-left: 4px solid #28a745;
            font-weight: 600; font-size: 0.9rem;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.1);
            display: flex; align-items: center; gap: 10px;
        }

        /* Banner */
        .banner {
            width: 100%; height: 260px; border-radius: 20px;
            overflow: hidden; margin-bottom: 40px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
            position: relative;
            background: linear-gradient(135deg, #eef1f5 0%, #dcd9cf 100%);
        }
        .banner img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.5s ease;
        }
        .banner:hover img { transform: scale(1.03); }

        /* Menu Grid */
        .menu-grid {
            display: flex; justify-content: center; gap: 25px; margin-bottom: 50px; flex-wrap: wrap;
        }

        .menu-card {
            background-color: var(--card-bg);
            width: 160px; height: 160px; border-radius: 20px;
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            text-decoration: none; color: var(--navy-color);
            transition: var(--transition);
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .menu-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, var(--gold-glow), transparent);
            opacity: 0;
            transition: var(--transition);
        }

        .menu-card:hover {
            transform: translateY(-8px);
            border-color: var(--gold-color);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
        }

        .menu-card:hover::before { opacity: 1; }

        .menu-card .menu-icon {
            width: 56px; height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            display: flex; justify-content: center; align-items: center;
            margin-bottom: 14px;
            position: relative;
            z-index: 2;
            transition: var(--transition);
        }

        .menu-card:hover .menu-icon {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
        }

        .menu-card .menu-icon i {
            font-size: 1.4rem; color: var(--gold-color);
            transition: var(--transition);
        }

        .menu-card:hover .menu-icon i { color: var(--navy-color); }

        .menu-card span {
            font-size: 0.88rem; font-weight: 700; text-align: center;
            position: relative; z-index: 2;
        }

        /* Section Title */
        .section-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.4rem; color: var(--navy-color); font-weight: 800;
        }

        .section-badge {
            background: var(--bg-color);
            color: var(--text-gray);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 600;
        }

        /* Dokumentasi */
        .doc-wrapper {
            background-color: var(--card-bg); border-radius: 20px; padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            margin-bottom: 40px;
        }

        .doc-header {
            display: flex; align-items: center; gap: 12px; margin-bottom: 25px;
            font-weight: 700; font-size: 1.1rem; color: var(--navy-color);
        }

        .doc-header i {
            color: var(--gold-color);
        }

        .carousel-container {
            display: flex; align-items: center; justify-content: space-between; gap: 20px;
        }

        .carousel-btn {
            background: var(--card-bg); border: 2px solid #eee;
            width: 48px; height: 48px; border-radius: 14px;
            font-size: 1rem; color: var(--text-dark);
            cursor: pointer; transition: var(--transition); flex-shrink: 0;
            display: flex; justify-content: center; align-items: center;
        }
        .carousel-btn:hover {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: white; border-color: var(--gold-color);
            box-shadow: 0 4px 15px var(--gold-glow);
        }

        .doc-image-card {
            flex: 1; height: 380px; border-radius: 18px; overflow: hidden;
            position: relative; background-color: #f8f9fa;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            display: flex; justify-content: center; align-items: center;
        }
        .doc-image-card img { width: 100%; height: 100%; object-fit: cover; object-position: center; }

        /* Mengapa Memilih Kami */
        .features-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; margin-bottom: 50px;
        }
        .feature-card {
            background-color: white; border-radius: 18px; padding: 30px 25px;
            text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.04); transition: var(--transition);
        }
        .feature-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.08); border-color: var(--gold-color); }
        .feature-icon {
            width: 70px; height: 70px; border-radius: 50%;
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            color: var(--gold-color); display: flex; justify-content: center; align-items: center;
            font-size: 1.8rem; margin: 0 auto 20px;
        }
        .feature-card h4 { font-size: 1.1rem; color: var(--navy-color); font-weight: 700; margin-bottom: 12px; }
        .feature-card p { font-size: 0.85rem; color: var(--text-gray); line-height: 1.6; }

        /* Testimonial */
        .testimonial-grid {
            display: flex; overflow-x: auto; scroll-snap-type: x mandatory; 
            gap: 20px; margin-bottom: 50px; padding-bottom: 20px;
            scrollbar-width: thin; scrollbar-color: var(--gold-color) #eee;
        }
        .testimonial-grid::-webkit-scrollbar { height: 8px; }
        .testimonial-grid::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .testimonial-grid::-webkit-scrollbar-thumb { background: var(--gold-color); border-radius: 10px; }
        
        .testi-card {
            flex: 0 0 calc(50% - 10px); min-width: 320px; scroll-snap-align: start;
            background-color: var(--card-bg); border-radius: 18px; padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04); border-left: 4px solid var(--gold-color);
            position: relative; overflow: hidden;
        }
        .testi-card::before {
            content: '\f10d'; font-family: 'Font Awesome 6 Free'; font-weight: 900;
            position: absolute; right: 20px; top: 20px; font-size: 3rem; color: rgba(201,168,76,0.1);
        }
        .testi-text { font-size: 0.9rem; font-style: italic; color: #4a5568; line-height: 1.7; margin-bottom: 20px; position: relative; z-index: 2; }
        .testi-user { display: flex; align-items: center; gap: 15px; position: relative; z-index: 2; }
        .testi-avatar { width: 50px; height: 50px; border-radius: 50%; background-color: var(--navy-color); color: white; display: flex; justify-content: center; align-items: center; font-weight: 700; font-size: 1.2rem; }
        .testi-info h5 { font-size: 0.95rem; color: var(--navy-color); font-weight: 700; }
        .testi-info span { font-size: 0.75rem; color: var(--text-gray); }
        .testi-rating { color: #f59e0b; font-size: 0.8rem; margin-top: 3px; }

        /* --- TENTANG KAMI --- */
        .values-strip { display: flex; gap: 0; background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); border-radius: 16px; padding: 20px; margin-bottom: 30px; box-shadow: 0 8px 25px rgba(13, 17, 48, 0.15); }
        .value-item { flex: 1; text-align: center; color: white; padding: 10px; }
        .value-item:not(:last-child) { border-right: 1px solid rgba(255,255,255,0.1); }
        .value-item i { font-size: 1.6rem; color: var(--gold-color); margin-bottom: 10px; display: block; }
        .value-item span { font-size: 0.78rem; font-weight: 600; }

        .visi-misi-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px; }
        .visi-card, .misi-card { background: white; border-radius: 18px; padding: 28px; border: 1px solid rgba(0,0,0,0.04); box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
        .visi-card h4, .misi-card h4 { font-size: 1.1rem; font-weight: 800; color: var(--navy-color); margin-bottom: 14px; display: flex; align-items: center; gap: 8px; }
        .visi-card h4 i, .misi-card h4 i { color: var(--gold-color); }
        .visi-card p, .misi-card p { font-size: 0.85rem; color: var(--text-gray); line-height: 1.7; }
        .misi-card ol { list-style: none; counter-reset: misi; padding: 0; }
        .misi-card ol li { counter-increment: misi; font-size: 0.85rem; color: var(--text-gray); line-height: 1.7; padding: 10px 0; border-bottom: 1px solid rgba(0,0,0,0.04); position: relative; padding-left: 32px; }
        .misi-card ol li:last-child { border-bottom: none; }
        .misi-card ol li::before { content: counter(misi); position: absolute; left: 0; top: 12px; width: 22px; height: 22px; background: linear-gradient(135deg, var(--gold-color), var(--gold-light)); color: var(--navy-color); border-radius: 8px; font-size: 0.72rem; font-weight: 800; display: flex; justify-content: center; align-items: center; }

        /* --- FOOTER --- */
        .footer {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            padding: 50px 20px 30px;
            color: white;
            margin-top: 50px;
        }
        .footer-content { max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 40px; margin-bottom: 35px; }
        .footer-brand h3 { font-size: 1.4rem; font-weight: 800; color: var(--gold-color); margin-bottom: 12px; letter-spacing: 1px; }
        .footer-brand p { font-size: 0.85rem; color: rgba(255, 255, 255, 0.6); line-height: 1.6; max-width: 300px; }
        .footer-links h4 { font-size: 0.95rem; font-weight: 700; margin-bottom: 15px; color: var(--gold-color); }
        .footer-links ul { list-style: none; }
        .footer-links li { margin-bottom: 8px; }
        .footer-links a { color: rgba(255, 255, 255, 0.6); text-decoration: none; font-size: 0.85rem; transition: var(--transition); }
        .footer-links a:hover { color: var(--gold-color); padding-left: 5px; }
        .footer-social { display: flex; gap: 12px; margin-top: 20px; }
        .footer-social a { width: 40px; height: 40px; border-radius: 50%; border: 1px solid rgba(255, 255, 255, 0.2); display: flex; justify-content: center; align-items: center; color: rgba(255, 255, 255, 0.6); text-decoration: none; transition: var(--transition); }
        .footer-social a:hover { background: var(--gold-color); color: var(--navy-color); border-color: var(--gold-color); transform: translateY(-3px); }
        .footer-bottom { text-align: center; padding-top: 25px; border-top: 1px solid rgba(255, 255, 255, 0.1); font-size: 0.82rem; color: rgba(255, 255, 255, 0.4); }

        /* Responsive */
        @media (max-width: 768px) {
            .menu-grid { gap: 15px; }
            .menu-card { width: calc(50% - 15px); height: 150px; min-width: 130px; }
            .doc-image-card { height: 220px; }
            .welcome-card { padding: 25px; }
            .welcome-card h2 { font-size: 1.2rem; }
            .visi-misi-grid { grid-template-columns: 1fr; }
            .features-grid { grid-template-columns: 1fr; }
            .testi-card { flex: 0 0 90%; }
            .values-strip { flex-direction: column; gap: 0; }
            .value-item:not(:last-child) { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.1); }
            
            .footer-content { grid-template-columns: 1fr; gap: 30px; text-align: center; }
            .footer-brand p { max-width: 100%; margin: 0 auto; }
            .footer-social { justify-content: center; }
        }

        @media (max-width: 480px) {
            .menu-card { width: 100%; height: 120px; flex-direction: row; padding: 20px; justify-content: flex-start; gap: 20px; }
            .menu-card .menu-icon { margin-bottom: 0; width: 45px; height: 45px; flex-shrink: 0; }
            .menu-card .menu-icon i { font-size: 1.1rem; }
            .menu-card span { text-align: left; font-size: 0.85rem; }
        }
    </style>
    @include('partials.footer-css')
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">

    @include('partials.navbar-css')
    @include('partials.navbar')

    <main class="main-container">

        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <div class="welcome-card">
            <h2>{{ __('Assalamualaikum,') }} <span>{{ Auth::user()->name ?? __('Pengguna') }}</span> 👋</h2>
            <p>{{ __('Siap merencanakan perjalanan ibadah Anda hari ini?') }}</p>
        </div>

        <div class="banner">
            <img loading="lazy" src="{{ asset('storage/image/banner1.png') }}" alt="{{ __('Banner Promosi Haramain Tour') }}">
        </div>

        <div class="menu-grid">
            <a href="{{ route('panduan') }}" class="menu-card">
                <div class="menu-icon">
                    <i class="fa-solid fa-book"></i>
                </div>
                <span>{{ __('Panduan') }}<br>{{ __('Ibadah') }}</span>
            </a>
            <a href="{{ route('doa') }}" class="menu-card">
                <div class="menu-icon">
                    <i class="fa-solid fa-hands-praying"></i>
                </div>
                <span>{{ __('Doa') }}<br>{{ __('Penting') }}</span>
            </a>
            <a href="{{ route('kamus') }}" class="menu-card">
                <div class="menu-icon">
                    <i class="fa-solid fa-language"></i>
                </div>
                <span>{{ __('Kamus') }}<br>{{ __('Arab') }}</span>
            </a>
            <a href="{{ route('berita.index') }}" class="menu-card">
                <div class="menu-icon">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
                <span>{{ __('Berita') }}</span>
            </a>
            <a href="{{ route('paket') }}" class="menu-card">
                <div class="menu-icon">
                    <i class="fa-solid fa-file-lines"></i>
                </div>
                <span>{{ __('Paket') }}</span>
            </a>
        </div>

        <div class="section-header">
            <h2 class="section-title">{{ __('Dokumentasi') }}</h2>
            <span class="section-badge">{{ __('Terbaru') }}</span>
        </div>

        <div class="doc-wrapper">
            <div class="doc-header">
                <i class="fa-solid fa-camera"></i> {{ __('Dokumentasi Perjalanan') }}
            </div>

            <div class="carousel-container" style="justify-content: center;">
                <div class="doc-image-card" style="max-width: 100%; flex: 1;">
                    <img loading="lazy" id="docImage" src="{{ asset('storage/image/dokumentasi1.jpeg') }}" alt="{{ __('Dokumentasi') }}" style="transition: opacity 0.5s ease; border-radius: 18px;">
                </div>
            </div>
        </div>

        {{-- Mengapa Memilih Kami Section --}}
        <div class="section-header">
            <h2 class="section-title">{{ __('Mengapa Memilih Kami?') }}</h2>
            <span class="section-badge">{{ __('Keunggulan Utama') }}</span>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-plane-departure"></i></div>
                <h4>{{ __('Keberangkatan Pasti') }}</h4>
                <p>{{ __('Kami menjamin ketepatan waktu dengan maskapai terbaik, memberikan kepastian jadwal ibadah tanpa penundaan berlebih.') }}</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-hands-holding-circle"></i></div>
                <h4>{{ __('Layanan Sepenuh Hati') }}</h4>
                <p>{{ __('Tim profesional dan pembimbing (Muthawif) tersertifikasi siap mendampingi seluruh rangkaian ibadah Anda 24/7 di tanah suci.') }}</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-hotel"></i></div>
                <h4>{{ __('Fasilitas Premium') }}</h4>
                <p>{{ __('Mendapatkan akomodasi di hotel-hotel strategis bertaraf Internasional dengan akses yang sangat dekat dari pelataran Masjid.') }}</p>
            </div>
        </div>

        {{-- Testimonial Section --}}
        <div class="section-header">
            <h2 class="section-title">{{ __('Apa Kata Jamaah Kami') }}</h2>
            <span class="section-badge">{{ __('Testimonial') }}</span>
        </div>

        <div class="testimonial-grid">
            <div class="testi-card">
                <p class="testi-text">"{{ __('Alhamdulillah perjalanan ibadah Umroh bersama Haramain Tour sungguh luar biasa nyaman. Muthawif sangat membimbing, hotel dekat, dan makanannya pun sangat menyesuaikan lidah Indonesia. Terimakasih telah memfasilitasi ibadah kami sekeluarga.') }}"</p>
                <div class="testi-user">
                    <div class="testi-avatar">H</div>
                    <div class="testi-info">
                        <h5>H. Budi Santoso</h5>
                        <span>{{ __('Jamaah Umroh Plus Turki (Des 2025)') }}</span>
                        <div class="testi-rating">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testi-card">
                <p class="testi-text">"{{ __('Pendaftaran sangat mudah, transparan, dan tidak ada biaya tersembunyi. Dari persiapan manasik, keberangkatan, hingga kembali ke tanah air pelayanannya tetap konsisten. InsyaAllah tabungan haji saya percayakan ke sini juga.') }}"</p>
                <div class="testi-user">
                    <div class="testi-avatar">A</div>
                    <div class="testi-info">
                        <h5>Hj. Aisyah Rahmawati</h5>
                        <span>{{ __('Jamaah Haji Furoda (Jun 2025)') }}</span>
                        <div class="testi-rating">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testi-card">
                <p class="testi-text">"{{ __('Sangat bersyukur memilih Haramain Tour. Bimbingan dari awal manasik sampai tawaf wada begitu khidmat. Tour leader responsif saat jamaah punya kebingungan, dan kulinernya selalu terjaga selera nusantara.') }}"</p>
                <div class="testi-user">
                    <div class="testi-avatar" style="background:#059669;">I</div>
                    <div class="testi-info">
                        <h5>Iqbal Rinaldi</h5>
                        <span>{{ __('Jamaah Umroh Reguler Lanjutan (Sep 2025)') }}</span>
                        <div class="testi-rating">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testi-card">
                <p class="testi-text">"{{ __('Fasilitas kereta cepat Haramain ke Madinah itu life saver banget! Apalagi bawa orang tua. Secara keseluruhan perjalanan ibadah ini sangat efisien tenaganya, recommended banget!') }}"</p>
                <div class="testi-user">
                    <div class="testi-avatar" style="background:#7c3aed;">D</div>
                    <div class="testi-info">
                        <h5>Dr. Desy Ratnasari</h5>
                        <span>{{ __('Jamaah VIP Plus (Okt 2025)') }}</span>
                        <div class="testi-rating">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tentang Kami Section --}}
        <div id="about" class="section-header" style="margin-top: 40px;">
            <h2 class="section-title">{{ __('Tentang Kami') }}</h2>
            <span class="section-badge">{{ __('Profil') }}</span>
        </div>

        <div class="about-section" style="margin-bottom: 50px;">
            <div class="values-strip">
                <div class="value-item">
                    <i class="fa-solid fa-shield-check"></i>
                    <span>{{ __('Kepercayaan dan') }}<br>{{ __('Transparansi') }}</span>
                </div>
                <div class="value-item">
                    <i class="fa-solid fa-people-group"></i>
                    <span>{{ __('Pelayanan') }}<br>{{ __('Jamaah') }}</span>
                </div>
                <div class="value-item">
                    <i class="fa-solid fa-mosque"></i>
                    <span>{{ __('Pengalaman') }}<br>{{ __('Ibadah') }}</span>
                </div>
            </div>

            <div class="visi-misi-grid">
                <div class="visi-card">
                    <h4><i class="fa-solid fa-eye"></i> {{ __('Visi') }}</h4>
                    <p>{{ __('Mewujudkan biro perjalanan wisata dan penyelenggara umroh yang berkualitas, professional dan amanah dengan pondasi syariat Islam serta menjadi manfaat bagi umat.') }}</p>
                </div>
                <div class="misi-card">
                    <h4><i class="fa-solid fa-bullseye"></i> {{ __('Misi') }}</h4>
                    <ol>
                        <li>{{ __('Menyajikan pelayanan terbaik untuk setiap program perjalanan wisata halal maupun penyelenggara ibadah umrah dengan mengutamakan prinsip-prinsip syariat islam dan sunnah rasulullah shallallahu \'alaihi wasallam.') }}</li>
                        <li>{{ __('Senantiasa memprioritaskan kemudahan dengan memberikan alternatif yang solutif khususnya bagi para jama\'ah dengan mengedepankan ukhuwah islamiyyah yang professional setiap lini operasional.') }}</li>
                    </ol>
                </div>
            </div>
        </div>


    </main>

    @include('partials.footer')


    <script>
        // Data Dokumentasi
        const docs = [
            '{!! asset("storage/image/dokumentasi1.jpeg") !!}',
            '{!! asset("storage/image/dokumentasi2.png") !!}',
            '{!! asset("storage/image/dokumentasi3.png") !!}',
            '{!! asset("storage/image/dokumentasi4.png") !!}',
            '{!! asset("storage/image/dokumentasi5.jpg") !!}',
            '{!! asset("storage/image/dokumentasi6.jpg") !!}',
            '{!! asset("storage/image/dokumentasi7.jpg") !!}',
            '{!! asset("storage/image/dokumentasi8.jpg") !!}'
        ];
        
        let currentDocIndex = 0;
        const docImage = document.getElementById('docImage');
        
        function updateCarousel(index) {
            if (!docImage) return;
            docImage.style.opacity = 0;
            setTimeout(() => {
                const img = new Image();
                img.onload = function() {
                    docImage.src = docs[index];
                    docImage.style.opacity = 1;
                };
                img.onerror = function() {
                    // Fallback to next image if fail to load
                    docImage.style.opacity = 1;
                };
                img.src = docs[index];
            }, 600);
        }

        // Auto slide functionality
        setInterval(() => {
            currentDocIndex = (currentDocIndex === docs.length - 1) ? 0 : currentDocIndex + 1;
            updateCarousel(currentDocIndex);
        }, 3500);

        function toggleProfileDropdown() {
            document.getElementById("profileMenu").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.closest('.profile-dropdown')) {
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

