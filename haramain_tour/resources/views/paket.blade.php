<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Paket - Haramain Tour</title>
    <meta name="description" content="Daftar paket umroh dan haji terbaik dari Haramain Tour.">
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
            --text-light: #e0e0e0;
            --error-color: #e3342f;
            --card-bg: #ffffff;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', 'Segoe UI', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); overflow-x: hidden; }

        /* --- NAVBAR --- */
        .navbar {
            background-color: white; padding: 14px 5%; display: flex; align-items: center;
            justify-content: space-between; box-shadow: 0 2px 20px rgba(0, 0, 0, 0.04);
            position: sticky; top: 0; z-index: 100; border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .brand-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .brand-logo img { width: 40px; height: 40px; object-fit: contain; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1)); }
        .brand-logo h1 { font-size: 1.3rem; font-weight: 800; color: var(--navy-color); letter-spacing: 1px; }

        .search-bar {
            flex: 1; max-width: 380px;
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            border-radius: 14px; display: flex; align-items: center; padding: 12px 20px;
            color: white; margin: 0 25px;
            box-shadow: 0 4px 15px var(--gold-glow);
            transition: var(--transition);
        }
        .search-bar:focus-within { box-shadow: 0 6px 25px rgba(201, 168, 76, 0.4); transform: translateY(-1px); }
        .search-bar i { font-size: 1rem; opacity: 0.9; }
        .search-bar input {
            border: none; background: transparent; color: white; font-size: 0.9rem;
            outline: none; width: 100%; margin-left: 12px; font-weight: 500; font-family: 'Poppins', sans-serif;
        }
        .search-bar input::placeholder { color: rgba(255,255,255,0.75); }

        .nav-icons { display: flex; align-items: center; gap: 8px; }
        .nav-icon-btn {
            width: 42px; height: 42px; display: flex; justify-content: center; align-items: center;
            border-radius: 12px; color: var(--text-gray); text-decoration: none;
            transition: var(--transition); font-size: 1.15rem;
        }
        .nav-icon-btn:hover { background: var(--bg-color); color: var(--navy-color); }
        .nav-icon-btn.active {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: white; box-shadow: 0 4px 12px var(--gold-glow);
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
            display: none; position: absolute; right: 0; top: calc(100% + 10px);
            background-color: white; min-width: 220px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12); border-radius: 16px;
            overflow: hidden; z-index: 1000; flex-direction: column;
            border: 1px solid rgba(0, 0, 0, 0.05); animation: dropIn 0.2s ease-out;
        }
        @keyframes dropIn { from { opacity: 0; transform: translateY(-8px); } to { opacity: 1; transform: translateY(0); } }
        .dropdown-menu.show { display: flex; }

        .dropdown-header {
            padding: 18px 20px; font-weight: 700; color: var(--navy-color);
            border-bottom: 1px solid #f0f0f0; background: linear-gradient(135deg, #fafafa, #f5f5f5); font-size: 0.95rem;
        }
        .dropdown-header small { display: block; font-weight: 400; color: var(--text-gray); font-size: 0.8rem; margin-top: 2px; }

        .dropdown-menu a, .dropdown-menu button {
            padding: 14px 20px; text-decoration: none; color: var(--text-dark);
            font-size: 0.9rem; font-weight: 500; display: flex; align-items: center; gap: 12px;
            transition: var(--transition); border: none; background: none; width: 100%;
            text-align: left; cursor: pointer; font-family: 'Poppins', sans-serif;
        }
        .dropdown-menu a:hover, .dropdown-menu button:hover { background-color: #f8f9fa; color: var(--gold-color); }
        .dropdown-divider { height: 1px; background-color: #f0f0f0; margin: 4px 0; }
        .logout-btn { color: var(--error-color) !important; }
        .logout-btn:hover { background-color: #fef2f2 !important; color: var(--error-color) !important; }

        /* --- LAYOUT UTAMA --- */
        .main-container { max-width: 1500px; margin: 30px auto; padding: 0 30px;
            display: flex; gap: 30px; align-items: flex-start;
        }

        /* --- SIDEBAR FILTER --- */
        .filter-sidebar {
            flex: 0 0 250px; background-color: var(--card-bg); border-radius: 20px; padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); position: sticky; top: 90px;
        }

        .filter-title {
            font-size: 1.1rem; font-weight: 800; color: var(--navy-color); margin-bottom: 22px;
            padding-bottom: 14px; border-bottom: 2px solid #f0f0f0;
            display: flex; align-items: center; gap: 10px;
        }

        .filter-title i { color: var(--gold-color); }

        .filter-group { margin-bottom: 22px; }
        .filter-group > label:first-child {
            display: block; font-weight: 700; margin-bottom: 12px; color: var(--navy-color); font-size: 0.88rem;
            text-transform: uppercase; letter-spacing: 0.5px;
        }

        .checkbox-group {
            display: flex; align-items: center; gap: 10px; margin-bottom: 10px; font-size: 0.88rem;
            color: var(--text-dark); cursor: pointer; padding: 6px 8px; border-radius: 8px;
            transition: var(--transition);
        }
        .checkbox-group:hover { background: var(--bg-color); }
        .checkbox-group input { accent-color: var(--gold-color); width: 17px; height: 17px; cursor: pointer; }

        .filter-select {
            width: 100%; padding: 11px 14px; border: 2px solid #f0f0f0; border-radius: 12px;
            outline: none; font-family: 'Poppins', sans-serif; font-size: 0.88rem;
            color: var(--text-dark); transition: var(--transition); background: white;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
        }
        .filter-select:focus { border-color: var(--gold-color); box-shadow: 0 0 0 3px var(--gold-glow); }

        .btn-filter {
            width: 100%;
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color); border: none; padding: 13px;
            border-radius: 12px; font-weight: 700; cursor: pointer;
            transition: var(--transition); font-family: 'Poppins', sans-serif; font-size: 0.9rem;
            box-shadow: 0 4px 15px var(--gold-glow);
        }
        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(201, 168, 76, 0.4);
        }

        /* --- GRID PAKET --- */
        .package-content { flex: 1; }

        .page-header {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;
        }
        .page-header h2 { color: var(--navy-color); font-weight: 800; font-size: 1.4rem; }
        .page-header span { color: var(--text-gray); font-weight: 500; font-size: 0.88rem; }

        .package-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; }

        /* --- KARTU PAKET --- */
        .package-card {
            background-color: var(--navy-color); border-radius: 18px; overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12); transition: var(--transition);
            display: flex; flex-direction: column; position: relative;
        }
        .package-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.2);
        }

        .card-img-container { position: relative; width: 100%; height: 200px; overflow: hidden; }
        .card-img-container img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.5s ease;
        }
        .package-card:hover .card-img-container img { transform: scale(1.08); }

        .rating-badge {
            position: absolute; top: 15px; right: 15px;
            background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);
            color: var(--navy-color); padding: 5px 12px; border-radius: 50px;
            font-size: 0.82rem; font-weight: 700; display: flex; align-items: center; gap: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .rating-badge i { color: #f39c12; }

        .category-badge {
            position: absolute; top: 15px; left: 15px;
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color); padding: 5px 14px; border-radius: 50px;
            font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
        }

        .sold-out-badge {
            position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(-15deg);
            background: linear-gradient(135deg, #e3342f, #cc1f1a);
            color: white; padding: 10px 28px; font-size: 1.3rem; font-weight: 900;
            border: 3px solid white; border-radius: 12px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3); z-index: 2;
            box-shadow: 0 8px 20px rgba(227,52,47,0.3);
        }

        .card-body { padding: 22px; display: flex; flex-direction: column; flex: 1; color: var(--text-light); }

        .card-title {
            font-size: 1.15rem; font-weight: 700; color: white; margin-bottom: 14px;
            display: flex; justify-content: space-between; align-items: flex-start;
        }
        .card-title i { color: var(--gold-color); cursor: pointer; transition: var(--transition); font-size: 1.1rem; }
        .card-title i:hover { transform: scale(1.2); }

        .card-info {
            font-size: 0.85rem; margin-bottom: 8px; display: flex; align-items: center; gap: 10px;
            color: rgba(255, 255, 255, 0.7);
        }
        .card-info i { color: var(--gold-color); width: 16px; text-align: center; font-size: 0.9rem; }

        .card-footer {
            margin-top: auto; padding-top: 18px; display: flex;
            justify-content: space-between; align-items: center;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .price-wrapper { display: flex; flex-direction: column; }
        .price-label { font-size: 0.72rem; color: rgba(255,255,255,0.5); font-weight: 500; }
        .price-value {
            font-size: 1.15rem; font-weight: 800; color: var(--gold-color);
            letter-spacing: 0.3px;
        }

        .btn-detail {
            background: transparent; border: 2px solid var(--gold-color); color: var(--gold-color);
            padding: 9px 20px; border-radius: 12px; font-weight: 600; cursor: pointer;
            transition: var(--transition); font-family: 'Poppins', sans-serif; font-size: 0.85rem;
        }
        .btn-detail:hover {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color); border-color: transparent;
            box-shadow: 0 4px 15px var(--gold-glow);
        }

        /* --- MODAL --- */
        .modal {
            display: none; position: fixed; z-index: 1000; left: 0; top: 0;
            width: 100%; height: 100%; overflow: auto;
            background-color: rgba(0,0,0,0.6);
            align-items: center; justify-content: center;
            backdrop-filter: blur(8px);
        }
        .modal.show { display: flex; }

        .modal-content {
            background-color: var(--navy-color); margin: auto; padding: 0;
            border-radius: 24px; width: 90%; max-width: 500px; color: white;
            position: relative; overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4);
            animation: modalSlideUp 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            max-height: 90vh; display: flex; flex-direction: column;
        }

        @keyframes modalSlideUp {
            from { transform: translateY(40px) scale(0.95); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }

        .close-modal {
            position: absolute; top: 15px; left: 15px;
            background: rgba(0,0,0,0.4); backdrop-filter: blur(10px);
            color: white; width: 38px; height: 38px; border-radius: 12px;
            display: flex; justify-content: center; align-items: center; cursor: pointer;
            z-index: 20; transition: var(--transition); border: none; font-size: 1rem;
        }
        .close-modal:hover { background: var(--error-color); }

        /* --- CAROUSEL MODAL --- */
        .modal-image-carousel {
            position: relative; width: 100%; height: 260px; flex-shrink: 0;
        }

        .carousel-slide { display: none; width: 100%; height: 100%; }
        .carousel-slide.active { display: block; animation: fadeSlide 0.4s ease; }
        @keyframes fadeSlide { from { opacity: 0.4; } to { opacity: 1; } }
        .carousel-slide img { width: 100%; height: 100%; object-fit: cover; }

        .btn-carousel {
            position: absolute; top: 50%; transform: translateY(-50%);
            background-color: rgba(0,0,0,0.3); backdrop-filter: blur(10px);
            color: white; border: none;
            width: 40px; height: 40px; border-radius: 12px; cursor: pointer;
            display: flex; justify-content: center; align-items: center;
            font-size: 1rem; transition: var(--transition); z-index: 10;
        }
        .btn-carousel:hover { background-color: var(--gold-color); color: var(--navy-color); }
        .btn-prev { left: 15px; }
        .btn-next { right: 15px; }

        .carousel-dots {
            position: absolute; bottom: 15px; left: 0; right: 0;
            display: flex; justify-content: center; gap: 8px; z-index: 10;
        }
        .dot {
            width: 8px; height: 8px; border-radius: 50%;
            background-color: rgba(255,255,255,0.4); cursor: pointer; transition: var(--transition);
        }
        .dot.active { background-color: var(--gold-color); width: 24px; border-radius: 4px; }

        .modal-body { padding: 28px; overflow-y: auto; flex: 1; }
        .modal-title { font-size: 1.3rem; font-weight: 800; margin-bottom: 12px; }

        .modal-info-row {
            display: flex; flex-direction: column; gap: 6px; margin-bottom: 18px;
        }

        .modal-info-item {
            font-size: 0.85rem; color: rgba(255, 255, 255, 0.7);
            display: flex; align-items: center; gap: 10px;
        }
        .modal-info-item i { color: var(--gold-color); width: 16px; text-align: center; }

        .modal-desc { font-size: 0.88rem; color: rgba(255,255,255,0.65); line-height: 1.7; margin-bottom: 22px; }

        .modal-price-box {
            background: linear-gradient(135deg, var(--navy-light), rgba(26, 31, 78, 0.8));
            padding: 18px; border-radius: 14px; margin-bottom: 22px;
            border: 1px solid rgba(255, 255, 255, 0.06);
        }
        .modal-price-box span { font-size: 0.78rem; color: rgba(255,255,255,0.5); }
        .modal-price-box h3 { color: var(--gold-color); font-size: 1.3rem; margin-top: 4px; }
        .modal-price-box h3 small { font-size: 0.78rem; color: rgba(255,255,255,0.4); font-weight: 400; }

        .modal-facilities h4 {
            font-size: 0.95rem; margin-bottom: 14px; color: white;
            display: flex; align-items: center; gap: 8px;
        }
        .modal-facilities h4 i { color: var(--gold-color); }

        .facility-list { list-style: none; display: grid; gap: 10px; }
        .facility-list li {
            font-size: 0.85rem; color: rgba(255,255,255,0.7);
            display: flex; align-items: center; gap: 10px;
            padding: 6px 0;
        }
        .facility-list li i { color: var(--gold-color); font-size: 0.85rem; }

        .modal-footer {
            padding: 20px 28px;
            background: linear-gradient(to top, var(--navy-color), rgba(13, 17, 48, 0.95));
            border-top: 1px solid rgba(255,255,255,0.06);
            display: flex; align-items: center; gap: 12px; flex-shrink: 0;
        }

        .btn-buy-now {
            flex: 1;
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color); border: none; padding: 14px;
            border-radius: 14px; font-size: 0.95rem; font-weight: 700;
            cursor: pointer; transition: var(--transition);
            text-transform: uppercase; letter-spacing: 0.5px;
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 4px 15px var(--gold-glow);
        }
        .btn-buy-now:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(201, 168, 76, 0.4); }

        .btn-save-modal {
            background: transparent; color: var(--gold-color);
            border: 2px solid var(--gold-color); width: 50px; height: 50px;
            border-radius: 14px; display: flex; justify-content: center; align-items: center;
            font-size: 1.2rem; cursor: pointer; transition: var(--transition);
        }
        .btn-save-modal:hover { background: var(--gold-color); color: var(--navy-color); }

        /* Responsive */
        @media (max-width: 1200px) {
            .package-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 900px) {
            .navbar { flex-wrap: wrap; gap: 12px; justify-content: center; padding: 12px 15px; }
            .search-bar { order: 3; max-width: 100%; margin: 0; }
            .nav-icons { order: 2; }
            .main-container { flex-direction: column; }
            .filter-sidebar { width: 100%; position: static; }
            .dropdown-menu { right: -50px; }
        }
        @media (max-width: 768px) {
            .package-grid { grid-template-columns: 1fr; }
        }
    </style>
    @include('partials.footer-css')
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">

    @include('partials.navbar-css')
    @include('partials.navbar')

    <x-hero 
        badgeIcon="fa-solid fa-kaaba" 
        :badgeText="__('Paket Perjalanan')" 
        :title="__('Paket Umroh & Haji')" 
        arabic="حِزَمُ الْعُمْرَةِ وَالْحَجِّ" 
        :description="__('Pilih paket perjalanan ibadah yang sesuai dengan kebutuhan Anda. Tersedia berbagai pilihan kategori dan fasilitas terbaik untuk kenyamanan ibadah Anda.')"
        bgIcon="\f5b0" 
    />

    <div class="main-container" style="margin-top: 0;">

        <aside class="filter-sidebar">
            <h3 class="filter-title"><i class="fa-solid fa-sliders"></i> {{ __('Filter Paket') }}</h3>

            <div class="filter-group">
                <label>{{ __('Kategori Ibadah') }}</label>
                <label class="checkbox-group"><input type="checkbox" class="kategori-filter" value="reguler"> {{ __('Umroh Reguler') }}</label>
                <label class="checkbox-group"><input type="checkbox" class="kategori-filter" value="plus"> {{ __('Umroh Plus') }}</label>
                <label class="checkbox-group"><input type="checkbox" class="kategori-filter" value="furoda"> {{ __('Haji Furoda / VIP') }}</label>
                <label class="checkbox-group"><input type="checkbox" class="kategori-filter" value="haji_basic"> {{ __('Haji Basic') }}</label>
                <label class="checkbox-group"><input type="checkbox" class="kategori-filter" value="haji_plus"> {{ __('Haji Plus') }}</label>
            </div>

            <div class="filter-group">
                <label>{{ __('Bulan Keberangkatan') }}</label>
                <select class="filter-select" id="bulan-filter">
                    <option value="all">{{ __('Semua Bulan') }}</option>
                    <option value="jan">{{ __('Januari') }}</option>
                    <option value="feb">{{ __('Februari') }}</option>
                    <option value="mar">{{ __('Maret') }}</option>
                    <option value="apr">{{ __('April') }}</option>
                    <option value="mei">{{ __('Mei') }}</option>
                    <option value="jun">{{ __('Juni') }}</option>
                    <option value="jul">{{ __('Juli') }}</option>
                    <option value="agu">{{ __('Agustus') }}</option>
                    <option value="sep">{{ __('September') }}</option>
                    <option value="okt">{{ __('Oktober') }}</option>
                    <option value="nov">{{ __('November') }}</option>
                    <option value="des">{{ __('Desember') }}</option>
                </select>
            </div>

            <div class="filter-group">
                <label>{{ __('Rentang Harga') }}</label>
                <select class="filter-select" id="harga-filter">
                    <option value="all">{{ __('Semua Harga') }}</option>
                    <option value="1">< Rp 30 Juta</option>
                    <option value="2">Rp 30 - 40 Juta</option>
                    <option value="3">> Rp 40 Juta</option>
                </select>
            </div>

            <button class="btn-filter">
                <i class="fa-solid fa-search" style="margin-right: 6px;"></i> {{ __('Terapkan Filter') }}
            </button>
        </aside>

        <main class="package-content">
            <div class="page-header">
                <h2>{{ __('Daftar Paket Tersedia') }}</h2>
                <span id="package-count">{{ __('Menampilkan') }} {{ $pakets->count() }} {{ __('Paket') }}</span>
            </div>

            <div class="package-grid" id="packageGrid">

                @forelse($pakets as $paket)
                <div class="package-card" data-kategori="{{ $paket->kategori }}" data-bulan="{{ $paket->tanggal_keberangkatan ? strtolower(substr($paket->tanggal_keberangkatan->format('F'), 0, 3)) : 'all' }}" data-harga="{{ $paket->harga }}" @if($paket->status_premium) style="border: 2px solid var(--gold-color); box-shadow: 0 8px 30px rgba(201,168,76,0.15);" @endif>
                    <div class="card-img-container">
                        <img loading="lazy" src="{{ str_starts_with($paket->gambar_utama, 'http') ? $paket->gambar_utama : (str_starts_with($paket->gambar_utama, 'storage/') ? asset($paket->gambar_utama) : asset('storage/' . $paket->gambar_utama)) }}" alt="{{ $paket->nama }}">
                        @if($paket->status_premium)
                            <span class="category-badge" style="background: linear-gradient(135deg, #f39c12, #e67e22); color: white;"><i class="fa-solid fa-crown" style="margin-right: 4px;"></i> {{ __('PREMIUM') }}</span>
                        @elseif($paket->status_populer)
                            <span class="category-badge">{{ __('Populer') }}</span>
                        @else
                            <span class="category-badge" style="text-transform: capitalize;">{{ __(ucwords(str_replace('_', ' ', $paket->kategori))) }}</span>
                        @endif
                        <div class="rating-badge"><i class="fa-solid fa-star"></i> {{ number_format($paket->rating, 1) }}</div>
                    </div>

                    <div class="card-body">
                        <div class="card-title">
                            {{ $paket->nama }}
                            <i class="{{ in_array($paket->id, Auth::user()->settings['wishlist'] ?? []) ? 'fa-solid' : 'fa-regular' }} fa-bookmark wishlist-toggle" data-package-id="{{ $paket->id }}" onclick="toggleWishlist(event, this)" style="cursor:pointer; {{ $paket->status_premium ? 'color: var(--gold-color);' : '' }}"></i>
                        </div>
                        <div class="card-info"><i class="fa-regular fa-calendar"></i> {{ $paket->durasi_hari }} Hari - {{ $paket->tanggal_keberangkatan ? $paket->tanggal_keberangkatan->format('d F Y') : 'TBA' }}</div>
                        <div class="card-info"><i class="fa-solid fa-location-dot"></i> {{ $paket->hotel_makkah ?? 'TBA' }} & {{ $paket->hotel_madinah ?? 'TBA' }}</div>
                        @if($paket->status_premium)
                            <div class="card-info"><i class="fa-solid fa-star" style="color: #f39c12;"></i> Hotel Bintang 5 Premium</div>
                        @endif

                        <div class="card-footer">
                            <div class="price-wrapper">
                                <span class="price-label">{{ __('Mulai dari') }}</span>
                                <span class="price-value">{{ $paket->harga_rupiah }}</span>
                            </div>
                            <button class="btn-detail" onclick="openModal('modal_paket_{{ $paket->id }}')">{{ __('Lihat Detail') }}</button>
                        </div>
                    </div>
                </div>
                @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--text-gray);">
                    <i class="fa-solid fa-box-open" style="font-size: 3rem; color: var(--gold-color); margin-bottom: 15px; display:block;"></i>
                    <p>{{ __('Belum ada paket yang tersedia saat ini.') }}</p>
                </div>
                @endforelse

            </div>
        </main>
    </div>

    <!-- Modal Detail -->
    @foreach($pakets as $paket)
    <div id="modal_paket_{{ $paket->id }}" class="modal">
        <div class="modal-content">

            <button class="close-modal" onclick="closeModal('modal_paket_{{ $paket->id }}')"><i class="fa-solid fa-xmark"></i></button>

            <div class="modal-image-carousel">
                @if($paket->gambar_rincian && is_array($paket->gambar_rincian))
                    @foreach($paket->gambar_rincian as $index => $gambar)
                        <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}" style="{{ $index === 0 ? 'display: block;' : 'display: none;' }}">
                            <img loading="lazy" src="{{ str_starts_with($gambar, 'http') ? $gambar : (str_starts_with($gambar, 'storage/') ? asset($gambar) : asset('storage/' . $gambar)) }}" alt="{{ $paket->nama }}">
                        </div>
                    @endforeach
                    <button class="btn-carousel btn-prev" onclick="ubahSlide(-1, 'modal_paket_{{ $paket->id }}')">&#10094;</button>
                    <button class="btn-carousel btn-next" onclick="ubahSlide(1, 'modal_paket_{{ $paket->id }}')">&#10095;</button>

                    <div class="carousel-dots">
                        @foreach($paket->gambar_rincian as $index => $gambar)
                            <span class="dot {{ $index === 0 ? 'active' : '' }}" onclick="lompatSlide({{ $index }}, 'modal_paket_{{ $paket->id }}')"></span>
                        @endforeach
                    </div>
                @elseif($paket->gambar_utama)
                    <div class="carousel-slide active" style="display: block;">
                        <img loading="lazy" src="{{ str_starts_with($paket->gambar_utama, 'http') ? $paket->gambar_utama : (str_starts_with($paket->gambar_utama, 'storage/') ? asset($paket->gambar_utama) : asset('storage/' . $paket->gambar_utama)) }}" alt="{{ $paket->nama }}">
                    </div>
                @endif
            </div>

            <div class="modal-body">
                <h2 class="modal-title">
                    @if($paket->status_premium) <i class="fa-solid fa-crown" style="color: var(--gold-color); margin-right: 8px;"></i> @endif
                    {{ $paket->nama }}
                </h2>

                <div class="modal-info-row">
                    <div class="modal-info-item"><i class="fa-regular fa-calendar"></i> {{ $paket->durasi_hari }} Hari - {{ $paket->tanggal_keberangkatan ? $paket->tanggal_keberangkatan->format('d F Y') : 'TBA' }}</div>
                    @if($paket->hotel_makkah || $paket->hotel_madinah)
                    <div class="modal-info-item"><i class="fa-solid fa-location-dot"></i> {{ $paket->hotel_makkah ?? '' }} & {{ $paket->hotel_madinah ?? '' }}</div>
                    @endif
                </div>

                <p class="modal-desc">{{ $paket->deskripsi }}</p>

                <div class="modal-price-box" @if($paket->status_premium) style="border: 1px solid rgba(201,168,76,0.3); background: linear-gradient(135deg, rgba(201,168,76,0.1), rgba(26, 31, 78, 0.8));" @endif>
                    <span>{{ __('Harga Paket') }} {{ $paket->status_premium ? __('Premium') : '' }}</span>
                    <h3>{{ $paket->harga_rupiah }} <small>{{ $paket->harga_label }}</small></h3>
                </div>

                <div class="modal-facilities">
                    <h4><i class="fa-solid {{ $paket->status_premium ? 'fa-crown' : 'fa-circle-check' }}"></i> {{ __('Fasilitas') }} {{ $paket->status_premium ? __('Premium') : __('Termasuk') }}</h4>
                    <ul class="facility-list">
                        @if($paket->fasilitas && is_array($paket->fasilitas))
                            @foreach($paket->fasilitas as $fasilitas)
                                <li><i class="fa-solid {{ $fasilitas['icon'] ?? 'fa-check' }}"></i> {{ $fasilitas['text'] ?? '' }}</li>
                            @endforeach
                        @else
                            <li>{{ __('Tidak ada data fasilitas.') }}</li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn-save-modal" onclick="toggleWishlist(event, this.querySelector('i'))" title="{{ __('Simpan ke Wishlist') }}">
                    <i class="{{ in_array($paket->id, Auth::user()->settings['wishlist'] ?? []) ? 'fa-solid' : 'fa-regular' }} fa-bookmark wishlist-toggle" data-package-id="{{ $paket->id }}"></i>
                </button>
                <button class="btn-buy-now" @if($paket->status_premium) style="background: linear-gradient(135deg, #f39c12, var(--gold-color));" @endif onclick="openPendaftaran({{ $paket->id }}, '{{ addslashes($paket->nama) }}', '{{ $paket->harga_rupiah }}')">
                    @if($paket->status_premium) <i class="fa-solid fa-crown" style="margin-right: 6px;"></i> @endif {{ __('Pesan Sekarang') }}
                </button>
            </div>

        </div>
    </div>
    @endforeach

    <!-- ============================================== -->
    <!-- MODAL FORM PENDAFTARAN MULTI-STEP (5 STEP) -->
    <!-- ============================================== -->
    <div id="modalPendaftaran" class="modal">
        <div class="modal-content" style="max-width: 620px; max-height: 92vh; overflow: hidden;">
            <button class="close-modal" onclick="closePendaftaran()" style="position: absolute !important; top: 20px !important; right: 20px !important; left: auto !important; color: white !important; background: rgba(255,255,255,0.15) !important; border: none !important; width: 36px !important; height: 36px !important; border-radius: 12px !important; display: flex !important; align-items: center !important; justify-content: center !important; cursor: pointer !important; z-index: 100 !important; backdrop-filter: blur(10px) !important;"><i class="fa-solid fa-xmark"></i></button>


            <!-- Progress Steps (5 Steps) -->
            <div style="background: linear-gradient(135deg, var(--navy-light), var(--navy-color)); padding: 28px 28px 20px; flex-shrink: 0;">
                <h2 style="font-size: 1.15rem; font-weight: 800; color: white; margin-bottom: 4px;">{{ __('Form Pendaftaran') }}</h2>
                <p id="pendaftaranPaketNama" style="font-size: 0.82rem; color: var(--gold-color); font-weight: 600; margin-bottom: 20px;"></p>
                <div style="display: flex; align-items: center; gap: 0;">
                    <div class="step-indicator active" id="stepInd1">
                        <div class="step-circle">1</div>
                        <span>{{ __('Syarat') }}</span>
                    </div>
                    <div class="step-line" id="stepLine1"></div>
                    <div class="step-indicator" id="stepInd2">
                        <div class="step-circle">2</div>
                        <span>{{ __('Perjanjian') }}</span>
                    </div>
                    <div class="step-line" id="stepLine2"></div>
                    <div class="step-indicator" id="stepInd3">
                        <div class="step-circle">3</div>
                        <span>{{ __('Identitas') }}</span>
                    </div>
                    <div class="step-line" id="stepLine3"></div>
                    <div class="step-indicator" id="stepInd4">
                        <div class="step-circle">4</div>
                        <span>{{ __('Dokumen') }}</span>
                    </div>
                    <div class="step-line" id="stepLine4"></div>
                    <div class="step-indicator" id="stepInd5">
                        <div class="step-circle">5</div>
                        <span>{{ __('Bayar') }}</span>
                    </div>
                </div>
            </div>

            <form id="formPendaftaran" action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; flex: 1; min-height: 0; overflow: hidden;">
                @csrf
                <input type="hidden" name="paket_id" id="inputPaketId">
                <input type="hidden" name="tanda_tangan_digital" id="inputTandaTangan">

                <div class="modal-body" id="formStepsContainer" style="padding: 28px; overflow-y: auto; flex: 1; min-height: 0;">

                    <!-- ===== STEP 1: PERSYARATAN ===== -->
                    <div class="form-step active" id="formStep1">
                        <h3 style="font-size: 1rem; font-weight: 700; color: white; margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-clipboard-check" style="color: var(--gold-color);"></i> {{ __('Persyaratan Umroh') }}
                        </h3>
                        <p style="font-size: 0.8rem; color: rgba(255,255,255,0.5); margin-bottom: 20px; line-height: 1.6;">
                            {{ __('Silakan baca dan centang semua persyaratan berikut sebelum melanjutkan pendaftaran.') }}
                        </p>

                        <div style="background: rgba(255,255,255,0.04); border-radius: 14px; padding: 18px; border: 1px solid rgba(255,255,255,0.08);">
                            <div class="syarat-item">
                                <label class="checkbox-syarat">
                                    <input type="checkbox" class="persyaratan-check" id="syarat1">
                                    <span class="checkmark-syarat"></span>
                                    <span class="syarat-text"><i class="fa-solid fa-passport" style="color: var(--gold-color); margin-right: 8px;"></i> {{ __('Paspor masih berlaku minimal 6 bulan sebelum tanggal keberangkatan') }}</span>
                                </label>
                            </div>
                            <div class="syarat-item">
                                <label class="checkbox-syarat">
                                    <input type="checkbox" class="persyaratan-check" id="syarat2">
                                    <span class="checkmark-syarat"></span>
                                    <span class="syarat-text"><i class="fa-solid fa-syringe" style="color: var(--gold-color); margin-right: 8px;"></i> {{ __('Memiliki Sertifikat Vaksin Meningitis yang masih berlaku') }}</span>
                                </label>
                            </div>
                            <div class="syarat-item">
                                <label class="checkbox-syarat">
                                    <input type="checkbox" class="persyaratan-check" id="syarat3">
                                    <span class="checkmark-syarat"></span>
                                    <span class="syarat-text"><i class="fa-solid fa-id-card" style="color: var(--gold-color); margin-right: 8px;"></i> {{ __('KTP asli yang masih berlaku') }}</span>
                                </label>
                            </div>
                            <div class="syarat-item">
                                <label class="checkbox-syarat">
                                    <input type="checkbox" class="persyaratan-check" id="syarat4">
                                    <span class="checkmark-syarat"></span>
                                    <span class="syarat-text"><i class="fa-solid fa-camera" style="color: var(--gold-color); margin-right: 8px;"></i> {{ __('Pas foto terbaru ukuran 4x6 dengan latar belakang putih') }}</span>
                                </label>
                            </div>
                            <div class="syarat-item">
                                <label class="checkbox-syarat">
                                    <input type="checkbox" class="persyaratan-check" id="syarat5">
                                    <span class="checkmark-syarat"></span>
                                    <span class="syarat-text"><i class="fa-solid fa-list-check" style="color: var(--gold-color); margin-right: 8px;"></i> {{ __('Bersedia mengikuti seluruh ketentuan dan jadwal yang ditetapkan oleh pihak travel') }}</span>
                                </label>
                            </div>
                            <div class="syarat-item">
                                <label class="checkbox-syarat">
                                    <input type="checkbox" class="persyaratan-check" id="syarat6">
                                    <span class="checkmark-syarat"></span>
                                    <span class="syarat-text"><i class="fa-solid fa-file-contract" style="color: var(--gold-color); margin-right: 8px;"></i> {{ __('Memahami syarat & ketentuan pembatalan serta konsekuensinya') }}</span>
                                </label>
                            </div>
                        </div>

                        <div id="syaratWarning" style="margin-top: 14px; background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2); border-radius: 12px; padding: 12px; display: none; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-triangle-exclamation" style="color: #ef4444;"></i>
                            <p style="font-size: 0.78rem; color: #ef4444; font-weight: 600;">{{ __('Centang semua persyaratan untuk melanjutkan.') }}</p>
                        </div>
                    </div>

                    <!-- ===== STEP 2: SURAT PERJANJIAN + TANDA TANGAN ===== -->
                    <div class="form-step" id="formStep2">
                        <h3 style="font-size: 1rem; font-weight: 700; color: white; margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-file-signature" style="color: var(--gold-color);"></i> {{ __('Surat Perjanjian') }}
                        </h3>
                        <p style="font-size: 0.8rem; color: rgba(255,255,255,0.5); margin-bottom: 16px; line-height: 1.6;">
                            {{ __('Baca surat perjanjian dengan seksama, lalu bubuhkan tanda tangan digital Anda di bawah.') }}
                        </p>

                        <!-- Surat Perjanjian Scrollable -->
                        <div class="agreement-scroll-box">
                            <h4 style="text-align: center; color: var(--gold-color); margin-bottom: 12px; font-size: 0.95rem;">{{ __('PERJANJIAN PERJALANAN IBADAH UMROH') }}</h4>
                            <p style="margin-bottom: 10px; font-size: 0.82rem; color: rgba(255,255,255,0.7); line-height: 1.7;">
                                {{ __('Yang bertanda tangan di bawah ini, menyatakan bahwa calon Jamaah telah membaca, memahami, dan menyetujui seluruh ketentuan berikut:') }}
                            </p>
                            <ol style="padding-left: 16px; font-size: 0.82rem; color: rgba(255,255,255,0.65); line-height: 1.8;">
                                <li style="margin-bottom: 8px;">Jamaah wajib memenuhi seluruh persyaratan dokumen perjalanan <strong style="color: rgba(255,255,255,0.85);">(Paspor, Visa, Vaksin Meningitis)</strong> dan dokumen lain yang diperlukan sebelum tanggal keberangkatan.</li>
                                <li style="margin-bottom: 8px;">Jamaah wajib mengikuti seluruh jadwal dan peraturan yang telah ditentukan oleh pihak <strong style="color: rgba(255,255,255,0.85);">Haramain Tour</strong> selama perjalanan ibadah.</li>
                                <li style="margin-bottom: 8px;">Pihak Travel bertanggung jawab atas akomodasi, transportasi, dan pelayanan sesuai dengan paket yang dipilih.</li>
                                <li style="margin-bottom: 8px;">Pembatalan oleh Jamaah dikenakan <strong style="color: rgba(255,255,255,0.85);">biaya administrasi</strong> sesuai dengan ketentuan yang berlaku:
                                    <ul style="padding-left: 14px; margin-top: 4px;">
                                        <li>H-30: Potongan 25% dari harga paket</li>
                                        <li>H-14: Potongan 50% dari harga paket</li>
                                        <li>H-7: Potongan 75% dari harga paket</li>
                                    </ul>
                                </li>
                                <li style="margin-bottom: 8px;">Pihak Travel tidak bertanggung jawab atas kejadian <strong style="color: rgba(255,255,255,0.85);">force majeure</strong> (bencana alam, kebijakan pemerintah, pandemi, dll).</li>
                                <li style="margin-bottom: 8px;">Jamaah wajib menjaga kesehatan dan <strong style="color: rgba(255,255,255,0.85);">melaporkan riwayat penyakit</strong> yang dimiliki sebelum keberangkatan.</li>
                                <li style="margin-bottom: 8px;">Segala bentuk perselisihan akan diselesaikan secara <strong style="color: rgba(255,255,255,0.85);">musyawarah mufakat</strong>.</li>
                            </ol>
                        </div>

                        <!-- Tanda Tangan Digital -->
                        <div style="margin-top: 18px;">
                            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: white; margin-bottom: 10px;">
                                <i class="fa-solid fa-pen-nib" style="color: var(--gold-color); margin-right: 6px;"></i> {{ __('Tanda Tangan Digital') }} <span class="req">*</span>
                            </label>
                            <div class="signature-pad-wrapper">
                                <canvas id="signatureCanvas"></canvas>
                                <div class="signature-placeholder" id="signaturePlaceholder">
                                    <i class="fa-solid fa-pen-fancy"></i>
                                    <span>{{ __('Gambar tanda tangan Anda di sini') }}</span>
                                </div>
                            </div>
                            <div style="display: flex; gap: 10px; margin-top: 10px;">
                                <button type="button" class="btn-clear-sig" onclick="clearSignature()">
                                    <i class="fa-solid fa-eraser"></i> {{ __('Hapus Tanda Tangan') }}
                                </button>
                            </div>
                        </div>

                        <div id="signatureWarning" style="margin-top: 14px; background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2); border-radius: 12px; padding: 12px; display: none; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-triangle-exclamation" style="color: #ef4444;"></i>
                            <p style="font-size: 0.78rem; color: #ef4444; font-weight: 600;">{{ __('Silakan bubuhkan tanda tangan digital Anda.') }}</p>
                        </div>
                    </div>

                    <!-- ===== STEP 3: IDENTITAS ===== -->
                    <div class="form-step" id="formStep3">
                        <h3 style="font-size: 1rem; font-weight: 700; color: white; margin-bottom: 18px; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-user" style="color: var(--gold-color);"></i> {{ __('Data Identitas Jamaah') }}
                        </h3>

                        <div class="reg-field">
                            <label>{{ __('Nama Lengkap (sesuai Paspor)') }} <span class="req">*</span></label>
                            <input type="text" name="nama_lengkap" required placeholder="{{ __('Masukkan nama lengkap') }}">
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                            <div class="reg-field">
                                <label>{{ __('NIK (16 digit)') }} <span class="req">*</span></label>
                                <input type="text" name="nik" required maxlength="16" minlength="16" pattern="[0-9]{16}" placeholder="3201XXXXXXXXXXXX">
                            </div>
                            <div class="reg-field">
                                <label>{{ __('Jenis Kelamin') }} <span class="req">*</span></label>
                                <select name="jenis_kelamin" required>
                                    <option value="">{{ __('-- Pilih --') }}</option>
                                    <option value="L">{{ __('Laki-laki') }}</option>
                                    <option value="P">{{ __('Perempuan') }}</option>
                                </select>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                            <div class="reg-field">
                                <label>{{ __('Tempat Lahir') }} <span class="req">*</span></label>
                                <input type="text" name="tempat_lahir" required placeholder="{{ __('Kota kelahiran') }}">
                            </div>
                            <div class="reg-field">
                                <label>{{ __('Tanggal Lahir') }} <span class="req">*</span></label>
                                <input type="date" name="tanggal_lahir" required>
                            </div>
                        </div>

                        <div class="reg-field">
                            <label>{{ __('No. HP / WhatsApp') }} <span class="req">*</span></label>
                            <input type="text" name="no_hp" required placeholder="08XXXXXXXXXX">
                        </div>

                        <div class="reg-field">
                            <label>{{ __('Alamat Lengkap') }} <span class="req">*</span></label>
                            <textarea name="alamat_lengkap" required rows="3" placeholder="{{ __('Alamat domisili saat ini') }}"></textarea>
                        </div>

                        <div class="reg-field">
                            <label>{{ __('Nama Mahram') }} <small style="color: rgba(255,255,255,0.4);">{{ __('(Opsional, untuk jamaah wanita)') }}</small></label>
                            <input type="text" name="nama_mahram" placeholder="{{ __('Nama mahram pendamping') }}">
                        </div>
                    </div>

                    <!-- ===== STEP 4: DOKUMEN ===== -->
                    <div class="form-step" id="formStep4">
                        <h3 style="font-size: 1rem; font-weight: 700; color: white; margin-bottom: 18px; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-file-medical" style="color: var(--gold-color);"></i> {{ __('Dokumen & Kesehatan') }}
                        </h3>

                        <div class="reg-field">
                            <label>{{ __('Foto KTP') }} <span class="req">*</span></label>
                            <div class="file-upload-box" id="boxKtp" onclick="document.getElementById('inputKtp').click()">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <span>{{ __('Klik untuk upload foto KTP') }}</span>
                                <small>JPG, JPEG, PNG (Maks. 2MB)</small>
                            </div>
                            <input type="file" name="foto_ktp" id="inputKtp" accept="image/*" required style="display:none;" onchange="previewFile(this, 'boxKtp')">
                        </div>

                        <div class="reg-field">
                            <label>{{ __('Foto Paspor') }} <span class="req">*</span></label>
                            <div class="file-upload-box" id="boxPaspor" onclick="document.getElementById('inputPaspor').click()">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <span>{{ __('Klik untuk upload foto Paspor') }}</span>
                                <small>JPG, JPEG, PNG (Maks. 2MB)</small>
                            </div>
                            <input type="file" name="foto_paspor" id="inputPaspor" accept="image/*" required style="display:none;" onchange="previewFile(this, 'boxPaspor')">
                        </div>

                        <div class="reg-field">
                            <label>{{ __('Foto Visa') }} <small style="color: rgba(255,255,255,0.4);">{{ __('(Opsional)') }}</small></label>
                            <div class="file-upload-box" id="boxVisa" onclick="document.getElementById('inputVisa').click()">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <span>{{ __('Klik untuk upload foto Visa') }}</span>
                                <small>JPG, JPEG, PNG (Maks. 2MB)</small>
                            </div>
                            <input type="file" name="foto_visa" id="inputVisa" accept="image/*" style="display:none;" onchange="previewFile(this, 'boxVisa')">
                        </div>

                        <div class="reg-field">
                            <label>{{ __('Pas Foto Terbaru (4x6 Latar Putih)') }} <span class="req">*</span></label>
                            <div class="file-upload-box" id="boxPasFoto" onclick="document.getElementById('inputPasFoto').click()">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <span>{{ __('Klik untuk upload pas foto') }}</span>
                                <small>JPG, JPEG, PNG (Maks. 2MB)</small>
                            </div>
                            <input type="file" name="pas_foto" id="inputPasFoto" accept="image/*" required style="display:none;" onchange="previewFile(this, 'boxPasFoto')">
                        </div>

                        <div class="reg-field">
                            <label>{{ __('Sertifikat Vaksin / Buku Vaksin Meningitis') }} <span class="req">*</span></label>
                            <div class="file-upload-box" id="boxVaksin" onclick="document.getElementById('inputVaksin').click()">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <span>{{ __('Klik untuk upload') }}</span>
                                <small>JPG, JPEG, PNG (Maks. 2MB)</small>
                            </div>
                            <input type="file" name="foto_buku_vaksin" id="inputVaksin" accept="image/*" required style="display:none;" onchange="previewFile(this, 'boxVaksin')">
                        </div>

                        <div class="reg-field">
                            <label>{{ __('Golongan Darah') }} <span class="req">*</span></label>
                            <select name="golongan_darah" required>
                                <option value="">{{ __('-- Pilih --') }}</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>

                        <div class="reg-field">
                            <label>{{ __('Riwayat Penyakit') }} <small style="color: rgba(255,255,255,0.4);">{{ __('(Opsional)') }}</small></label>
                            <textarea name="riwayat_penyakit" rows="3" placeholder="{{ __('Tuliskan riwayat penyakit jika ada (diabetes, asma, jantung, dll)') }}"></textarea>
                        </div>
                    </div>

                    <!-- ===== STEP 5: PEMBAYARAN via MIDTRANS ===== -->
                    <div class="form-step" id="formStep5">
                        <h3 style="font-size: 1rem; font-weight: 700; color: white; margin-bottom: 18px; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-credit-card" style="color: var(--gold-color);"></i> {{ __('Review & Pembayaran') }}
                        </h3>

                        <!-- Preview Tanda Tangan -->
                        <div style="background: rgba(255,255,255,0.04); border-radius: 14px; padding: 16px; margin-bottom: 16px; border: 1px solid rgba(255,255,255,0.08);">
                            <p style="font-size: 0.78rem; color: rgba(255,255,255,0.5); margin-bottom: 8px; font-weight: 600;">
                                <i class="fa-solid fa-file-signature" style="color: var(--gold-color); margin-right: 6px;"></i> {{ __('Tanda Tangan Digital Anda') }}
                            </p>
                            <div style="background: white; border-radius: 10px; padding: 8px; text-align: center;">
                                <img loading="lazy" id="signaturePreview" src="" alt="Tanda Tangan" style="max-width: 100%; max-height: 80px; display: none;">
                                <p id="noSignatureText" style="color: #9ca3af; font-size: 0.8rem; padding: 10px 0;">{{ __('Belum ada tanda tangan') }}</p>
                            </div>
                        </div>

                        <div style="background: linear-gradient(135deg, rgba(201,168,76,0.12), rgba(26,31,78,0.6)); border: 1px solid rgba(201,168,76,0.25); border-radius: 14px; padding: 18px; margin-bottom: 20px;">
                            <p style="font-size: 0.82rem; color: rgba(255,255,255,0.6); margin-bottom: 4px;">{{ __('Total Harga Paket') }}</p>
                            <h3 id="pendaftaranHarga" style="color: var(--gold-color); font-size: 1.3rem; font-weight: 800;"></h3>
                        </div>

                        <!-- Skema Pembayaran -->
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: white; margin-bottom: 10px;">{{ __('Pilih Skema Pembayaran') }}</label>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                <label class="skema-option" style="background: rgba(255,255,255,0.04); border: 2px solid var(--gold-color); border-radius: 12px; padding: 15px; cursor: pointer; display: flex; flex-direction: column; gap: 5px; transition: all 0.3s ease;">
                                    <input type="radio" name="skema_pembayaran" value="full" checked style="display: none;" onchange="updateSkema(this)">
                                    <span style="font-weight: 700; font-size: 0.9rem; color: white;">{{ __('Bayar Lunas') }}</span>
                                    <span style="font-size: 0.75rem; color: rgba(255,255,255,0.5);">{{ __('Bayar lunas seluruh biaya paket') }}</span>
                                </label>
                                <label class="skema-option" style="background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 15px; cursor: pointer; display: flex; flex-direction: column; gap: 5px; transition: all 0.3s ease;">
                                    <input type="radio" name="skema_pembayaran" value="cicilan" style="display: none;" onchange="updateSkema(this)">
                                    <span style="font-weight: 700; font-size: 0.9rem; color: white;">{{ __('Cicilan / DP') }}</span>
                                    <span style="font-size: 0.75rem; color: rgba(255,255,255,0.5);">{{ __('Bayar DP minimal Rp 5 Juta') }}</span>
                                </label>
                            </div>
                        </div>

                        <!-- Nominal DP Input (Hidden by default) -->
                        <div id="dpInputSection" style="display: none; margin-bottom: 20px;">
                            <div class="reg-field">
                                <label>{{ __('Nominal DP (Minimal Rp 5.000.000)') }} <span class="req">*</span></label>
                                <input type="number" name="nominal_dp" value="5000000" min="5000000" step="500000" placeholder="Masukkan nominal DP" style="width: 100%; padding: 11px 14px; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; background: rgba(255,255,255,0.06); color: white;">
                            </div>
                        </div>

                        <!-- Midtrans Payment Info -->

                        <div style="background: rgba(255,255,255,0.04); border-radius: 14px; padding: 20px; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.08);">
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                                <div style="width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, var(--gold-color), var(--gold-light)); display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-shield-halved" style="color: var(--navy-color); font-size: 1.1rem;"></i>
                                </div>
                                <div>
                                    <p style="font-size: 0.9rem; font-weight: 700; color: white; margin-bottom: 2px;">{{ __('Pembayaran Aman via Midtrans') }}</p>
                                    <p style="font-size: 0.75rem; color: rgba(255,255,255,0.5);">{{ __('Diproses oleh payment gateway terpercaya') }}</p>
                                </div>
                            </div>

                            <p style="font-size: 0.82rem; color: rgba(255,255,255,0.6); line-height: 1.7; margin-bottom: 16px;">
                                {!! __('Setelah menekan tombol <strong style="color: var(--gold-color);">"Bayar Sekarang"</strong>, Anda akan diarahkan ke halaman pembayaran Midtrans untuk memilih metode pembayaran.') !!}
                            </p>

                            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                                <span class="payment-method-badge"><i class="fa-solid fa-qrcode"></i> QRIS</span>
                                <span class="payment-method-badge"><i class="fa-solid fa-wallet"></i> GoPay</span>
                                <span class="payment-method-badge"><i class="fa-solid fa-wallet"></i> ShopeePay</span>
                                <span class="payment-method-badge"><i class="fa-solid fa-building-columns"></i> Bank Transfer</span>
                                <span class="payment-method-badge"><i class="fa-solid fa-credit-card"></i> Kartu Kredit</span>
                                <span class="payment-method-badge"><i class="fa-solid fa-store"></i> Alfamart</span>
                                <span class="payment-method-badge"><i class="fa-solid fa-store"></i> Indomaret</span>
                            </div>
                        </div>

                        <div style="background: rgba(16,185,129,0.08); border: 1px solid rgba(16,185,129,0.2); border-radius: 12px; padding: 14px; display: flex; align-items: flex-start; gap: 10px;">
                            <i class="fa-solid fa-circle-info" style="color: #10b981; margin-top: 2px;"></i>
                            <p style="font-size: 0.78rem; color: rgba(255,255,255,0.6); line-height: 1.6;">
                                {{ __('Data pendaftaran Anda akan disimpan terlebih dahulu. Setelah pembayaran berhasil, pendaftaran Anda akan langsung masuk ke antrian review admin.') }}
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Navigation Buttons -->
                <div class="modal-footer" style="justify-content: space-between;">
                    <button type="button" class="btn-step-prev" id="btnPrev" onclick="prevStep()" style="display:none;">
                        <i class="fa-solid fa-arrow-left"></i> {{ __('Kembali') }}
                    </button>
                    <div style="flex:1;"></div>
                    <button type="button" class="btn-step-next" id="btnNext" onclick="nextStep()">
                        {{ __('Lanjut') }} <i class="fa-solid fa-arrow-right"></i>
                    </button>
                    <button type="button" class="btn-step-submit" id="btnSubmit" style="display:none;" onclick="submitPendaftaran()">
                        <i class="fa-solid fa-credit-card"></i> {{ __('Bayar Sekarang') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Step Indicator */
        .step-indicator { display: flex; flex-direction: column; align-items: center; gap: 6px; flex-shrink: 0; }
        .step-circle {
            width: 34px; height: 34px; border-radius: 50%;
            background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.4);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.82rem; font-weight: 800;
            transition: all 0.3s ease; border: 2px solid transparent;
        }
        .step-indicator span { font-size: 0.7rem; color: rgba(255,255,255,0.4); font-weight: 600; transition: all 0.3s ease; }
        .step-indicator.active .step-circle { background: var(--gold-color); color: var(--navy-color); border-color: var(--gold-color); box-shadow: 0 0 15px rgba(201,168,76,0.4); }
        .step-indicator.active span { color: var(--gold-color); }
        .step-indicator.done .step-circle { background: #10b981; color: white; border-color: #10b981; }
        .step-indicator.done span { color: #10b981; }
        .step-line { flex: 1; height: 2px; background: rgba(255,255,255,0.1); margin: 0 8px; margin-bottom: 20px; transition: background 0.3s ease; }
        .step-line.done { background: #10b981; }

        /* Form Steps */
        .form-step { display: none; animation: fadeStepIn 0.35s ease; }
        .form-step.active { display: block; }
        @keyframes fadeStepIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }

        /* Registration fields */
        .reg-field { margin-bottom: 16px; }
        .reg-field label { display: block; font-size: 0.82rem; font-weight: 600; color: rgba(255,255,255,0.8); margin-bottom: 6px; }
        .reg-field .req { color: #ef4444; }
        .reg-field input[type="text"],
        .reg-field input[type="number"],
        .reg-field input[type="date"],
        .reg-field select,
        .reg-field textarea {
            width: 100%; padding: 11px 14px; border: 2px solid rgba(255,255,255,0.1);
            border-radius: 12px; background: rgba(255,255,255,0.06); color: white;
            font-size: 0.88rem; font-family: 'Poppins', sans-serif; outline: none;
            transition: all 0.3s ease;
        }
        .reg-field input:focus, .reg-field select:focus, .reg-field textarea:focus {
            border-color: var(--gold-color); background: rgba(255,255,255,0.08);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.15);
        }
        .reg-field select option { background: var(--navy-color); color: white; }
        .reg-field textarea { resize: vertical; min-height: 60px; }

        /* File upload */
        .file-upload-box {
            border: 2px dashed rgba(255,255,255,0.15); border-radius: 14px;
            padding: 22px; text-align: center; cursor: pointer;
            transition: all 0.3s ease; background: rgba(255,255,255,0.03);
        }
        .file-upload-box:hover { border-color: var(--gold-color); background: rgba(201,168,76,0.05); }
        .file-upload-box i { font-size: 1.5rem; color: var(--gold-color); display: block; margin-bottom: 8px; }
        .file-upload-box span { display: block; font-size: 0.85rem; color: rgba(255,255,255,0.6); font-weight: 500; }
        .file-upload-box small { display: block; font-size: 0.72rem; color: rgba(255,255,255,0.3); margin-top: 4px; }
        .file-upload-box.has-file { border-color: #10b981; background: rgba(16,185,129,0.08); }
        .file-upload-box.has-file i { color: #10b981; }
        .file-upload-box.has-file span { color: #10b981; }

        /* Navigation Buttons */
        .btn-step-prev {
            background: transparent; border: 2px solid rgba(255,255,255,0.2); color: rgba(255,255,255,0.7);
            padding: 12px 24px; border-radius: 12px; font-size: 0.88rem; font-weight: 600;
            cursor: pointer; font-family: 'Poppins', sans-serif; transition: all 0.3s ease;
            display: flex; align-items: center; gap: 8px;
        }
        .btn-step-prev:hover { border-color: var(--gold-color); color: var(--gold-color); }
        .btn-step-next {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color); border: none; padding: 12px 28px;
            border-radius: 12px; font-size: 0.88rem; font-weight: 700;
            cursor: pointer; font-family: 'Poppins', sans-serif; transition: all 0.3s ease;
            display: flex; align-items: center; gap: 8px;
            box-shadow: 0 4px 15px rgba(201,168,76,0.3);
        }
        .btn-step-next:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(201,168,76,0.4); }
        .btn-step-submit {
            background: linear-gradient(135deg, #10b981, #34d399);
            color: white; border: none; padding: 12px 28px;
            border-radius: 12px; font-size: 0.88rem; font-weight: 700;
            cursor: pointer; font-family: 'Poppins', sans-serif; transition: all 0.3s ease;
            display: flex; align-items: center; gap: 8px;
            box-shadow: 0 4px 15px rgba(16,185,129,0.3);
        }
        .btn-step-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(16,185,129,0.4); }

        /* Validation error shake */
        @keyframes shake { 0%,100%{transform:translateX(0);} 25%{transform:translateX(-5px);} 75%{transform:translateX(5px);} }
        .reg-field.error input, .reg-field.error select, .reg-field.error textarea { border-color: #ef4444 !important; animation: shake 0.3s ease; }
        .reg-field.error .file-upload-box { border-color: #ef4444 !important; animation: shake 0.3s ease; }
        /* Payment method badges */
        .payment-method-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);
            padding: 6px 12px; border-radius: 8px;
            font-size: 0.72rem; color: rgba(255,255,255,0.6); font-weight: 500;
        }
        .payment-method-badge i { font-size: 0.7rem; }

        /* Loading overlay for payment */
        .payment-loading-overlay {
            position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(13,17,48,0.92); z-index: 100;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 16px; border-radius: 24px;
        }
        .payment-spinner {
            width: 48px; height: 48px; border: 4px solid rgba(201,168,76,0.2);
            border-top: 4px solid var(--gold-color); border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ===== STEP 1: Persyaratan Checkbox ===== */
        .syarat-item { margin-bottom: 12px; }
        .checkbox-syarat {
            display: flex; align-items: flex-start; gap: 12px; cursor: pointer;
            padding: 10px 12px; border-radius: 10px; transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        .checkbox-syarat:hover { background: rgba(201,168,76,0.06); border-color: rgba(201,168,76,0.15); }
        .checkbox-syarat input[type="checkbox"] { display: none; }
        .checkmark-syarat {
            width: 22px; height: 22px; min-width: 22px; border-radius: 6px;
            border: 2px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.05);
            display: flex; align-items: center; justify-content: center;
            transition: all 0.3s ease; margin-top: 1px;
        }
        .checkmark-syarat::after {
            content: '\f00c'; font-family: 'Font Awesome 6 Free'; font-weight: 900;
            font-size: 0.65rem; color: transparent; transition: all 0.3s ease;
        }
        .checkbox-syarat input:checked ~ .checkmark-syarat {
            background: var(--gold-color); border-color: var(--gold-color);
            box-shadow: 0 0 10px rgba(201,168,76,0.3);
        }
        .checkbox-syarat input:checked ~ .checkmark-syarat::after { color: var(--navy-color); }
        .checkbox-syarat input:checked ~ .syarat-text { color: rgba(255,255,255,0.9); }
        .syarat-text {
            font-size: 0.82rem; color: rgba(255,255,255,0.6); line-height: 1.5;
            transition: all 0.3s ease; flex: 1;
        }

        /* ===== STEP 2: Agreement Box ===== */
        .agreement-scroll-box {
            max-height: 220px; overflow-y: auto; padding: 18px;
            background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1);
            border-radius: 14px; scrollbar-width: thin;
            scrollbar-color: var(--gold-color) rgba(255,255,255,0.05);
        }
        .agreement-scroll-box::-webkit-scrollbar { width: 6px; }
        .agreement-scroll-box::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); border-radius: 3px; }
        .agreement-scroll-box::-webkit-scrollbar-thumb { background: var(--gold-color); border-radius: 3px; }

        /* ===== Signature Pad ===== */
        .signature-pad-wrapper {
            position: relative; border: 2px solid rgba(255,255,255,0.15);
            border-radius: 14px; overflow: hidden; background: white;
            cursor: crosshair;
        }
        .signature-pad-wrapper canvas {
            display: block; width: 100%; height: 160px;
            touch-action: none;
        }
        .signature-placeholder {
            position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 8px; pointer-events: none; transition: opacity 0.3s ease;
        }
        .signature-placeholder i { font-size: 1.5rem; color: #d1d5db; }
        .signature-placeholder span { font-size: 0.8rem; color: #9ca3af; font-weight: 500; }
        .signature-placeholder.hidden { opacity: 0; }

        .btn-clear-sig {
            background: transparent; border: 2px solid rgba(239,68,68,0.3);
            color: #ef4444; padding: 8px 16px; border-radius: 10px;
            font-size: 0.78rem; font-weight: 600; cursor: pointer;
            font-family: 'Poppins', sans-serif; transition: all 0.3s ease;
            display: flex; align-items: center; gap: 6px;
        }
        .btn-clear-sig:hover { background: rgba(239,68,68,0.1); border-color: #ef4444; }

        /* Step circle size for 5 steps */
        .step-circle {
            width: 30px; height: 30px; font-size: 0.75rem;
        }
        .step-indicator span { font-size: 0.62rem; }
        .step-line { margin: 0 4px; margin-bottom: 20px; }
    </style>

    <script>
        // Dropdown Profil
        function toggleProfileDropdown() {
            document.getElementById("profileMenu").classList.toggle("show");
        }

        // Buka/Tutup Modal Detail
        function openModal(modalId) {
            document.getElementById(modalId).classList.add("show");
            document.body.style.overflow = "hidden";
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove("show");
            document.body.style.overflow = "auto";
        }

        // ======= PENDAFTARAN MULTI-STEP (5 STEP) =======
        let currentStep = 1;
        const totalSteps = 5;

        // ===== SIGNATURE CANVAS SETUP =====
        let signatureCanvas, signatureCtx, isDrawing = false, hasSignature = false;

        function initSignatureCanvas() {
            signatureCanvas = document.getElementById('signatureCanvas');
            if (!signatureCanvas) return;
            signatureCtx = signatureCanvas.getContext('2d');

            // Fixed internal resolution for high DPI (2x multiplier over typical 500x160 canvas)
            signatureCanvas.width = 1040;
            signatureCanvas.height = 320;
            signatureCtx.lineCap = 'round';
            signatureCtx.lineJoin = 'round';
            signatureCtx.strokeStyle = '#1a1a2e';
            signatureCtx.lineWidth = 4.5;
            
            // Fill white background for correct saving
            signatureCtx.fillStyle = 'white';
            signatureCtx.fillRect(0, 0, signatureCanvas.width, signatureCanvas.height);

            // Mouse events
            signatureCanvas.addEventListener('mousedown', startDrawing);
            signatureCanvas.addEventListener('mousemove', draw);
            signatureCanvas.addEventListener('mouseup', stopDrawing);
            signatureCanvas.addEventListener('mouseleave', stopDrawing);

            // Touch events
            signatureCanvas.addEventListener('touchstart', (e) => {
                e.preventDefault();
                const touch = e.touches[0];
                startDrawing(touch);
            });
            signatureCanvas.addEventListener('touchmove', (e) => {
                e.preventDefault();
                const touch = e.touches[0];
                draw(touch);
            });
            signatureCanvas.addEventListener('touchend', (e) => {
                e.preventDefault();
                stopDrawing();
            });
        }

        function getCanvasCoords(e) {
            const rect = signatureCanvas.getBoundingClientRect();
            // Scale points based on actual rendering size vs internal resolution
            const scaleX = signatureCanvas.width / rect.width;
            const scaleY = signatureCanvas.height / rect.height;
            
            return {
                x: (e.clientX - rect.left) * scaleX,
                y: (e.clientY - rect.top) * scaleY
            };
        }

        function startDrawing(e) {
            isDrawing = true;
            hasSignature = true;
            const coords = getCanvasCoords(e);
            signatureCtx.beginPath();
            signatureCtx.moveTo(coords.x, coords.y);

            // Hide placeholder
            const ph = document.getElementById('signaturePlaceholder');
            if (ph) ph.classList.add('hidden');

            // Hide warning
            document.getElementById('signatureWarning').style.display = 'none';
        }

        function draw(e) {
            if (!isDrawing) return;
            const coords = getCanvasCoords(e);
            signatureCtx.lineTo(coords.x, coords.y);
            signatureCtx.stroke();
        }

        function stopDrawing() {
            isDrawing = false;
        }

        function clearSignature() {
            if (!signatureCanvas) return;
            signatureCtx.fillStyle = 'white';
            signatureCtx.fillRect(0, 0, signatureCanvas.width, signatureCanvas.height);
            hasSignature = false;
            const ph = document.getElementById('signaturePlaceholder');
            if (ph) ph.classList.remove('hidden');
        }

        function getSignatureDataURL() {
            if (!signatureCanvas || !hasSignature) return null;
            // Create a temporary canvas to get the actual image without scaling
            const tmpCanvas = document.createElement('canvas');
            tmpCanvas.width = signatureCanvas.width;
            tmpCanvas.height = signatureCanvas.height;
            const tmpCtx = tmpCanvas.getContext('2d');
            tmpCtx.drawImage(signatureCanvas, 0, 0);
            return tmpCanvas.toDataURL('image/png');
        }

        // Initialize when modal opens
        document.addEventListener('DOMContentLoaded', initSignatureCanvas);

        function openPendaftaran(paketId, paketNama, paketHarga) {
            // Close any existing detail modal
            document.querySelectorAll('.modal.show').forEach(m => {
                m.classList.remove('show');
            });

            // Set data
            document.getElementById('inputPaketId').value = paketId;
            document.getElementById('pendaftaranPaketNama').textContent = paketNama;
            document.getElementById('pendaftaranHarga').textContent = paketHarga;

            // Reset all checkboxes
            document.querySelectorAll('.persyaratan-check').forEach(cb => cb.checked = false);

            // Clear signature
            clearSignature();

            // Reset form fields
            document.getElementById('formPendaftaran').reset();
            document.getElementById('inputPaketId').value = paketId;

            // Reset file upload boxes
            document.querySelectorAll('.file-upload-box').forEach(box => {
                box.classList.remove('has-file');
                const icon = box.querySelector('i');
                if (icon) icon.className = 'fa-solid fa-cloud-arrow-up';
            });

            // Reset to step 1
            currentStep = 1;
            updateStepUI();

            // Open modal
            document.getElementById('modalPendaftaran').classList.add('show');
            document.body.style.overflow = 'hidden';
            
            // Re-init signature canvas strictly once modal is shown
            setTimeout(initSignatureCanvas, 100);
        }

        function closePendaftaran() {
            document.getElementById('modalPendaftaran').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        function nextStep() {
            // Validate current step
            if (!validateStep(currentStep)) return;

            if (currentStep < totalSteps) {
                currentStep++;
                updateStepUI();
                // Scroll to top of form
                document.getElementById('formStepsContainer').scrollTop = 0;

                // If going to step 5, show signature preview
                if (currentStep === 5) {
                    updateSignaturePreview();
                }
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                currentStep--;
                updateStepUI();
                document.getElementById('formStepsContainer').scrollTop = 0;
            }
        }

        function updateStepUI() {
            // Update steps visibility
            for (let i = 1; i <= totalSteps; i++) {
                const step = document.getElementById('formStep' + i);
                const ind = document.getElementById('stepInd' + i);

                step.classList.remove('active');
                ind.classList.remove('active', 'done');

                if (i === currentStep) {
                    step.classList.add('active');
                    ind.classList.add('active');
                } else if (i < currentStep) {
                    ind.classList.add('done');
                }
            }

            // Update step lines
            for (let i = 1; i < totalSteps; i++) {
                const line = document.getElementById('stepLine' + i);
                line.classList.toggle('done', i < currentStep);
            }

            // Update buttons
            document.getElementById('btnPrev').style.display = currentStep > 1 ? 'flex' : 'none';
            document.getElementById('btnNext').style.display = currentStep < totalSteps ? 'flex' : 'none';
            document.getElementById('btnSubmit').style.display = currentStep === totalSteps ? 'flex' : 'none';
        }

        function updateSignaturePreview() {
            const preview = document.getElementById('signaturePreview');
            const noText = document.getElementById('noSignatureText');
            const dataUrl = getSignatureDataURL();

            if (dataUrl) {
                preview.src = dataUrl;
                preview.style.display = 'block';
                if (noText) noText.style.display = 'none';
            } else {
                preview.style.display = 'none';
                if (noText) noText.style.display = 'block';
            }
        }

        function validateStep(step) {
            // Step 1: Persyaratan - check all checkboxes
            if (step === 1) {
                const allChecks = document.querySelectorAll('.persyaratan-check');
                const allChecked = Array.from(allChecks).every(cb => cb.checked);
                const warning = document.getElementById('syaratWarning');

                if (!allChecked) {
                    warning.style.display = 'flex';
                    return false;
                }
                warning.style.display = 'none';
                return true;
            }

            // Step 2: Signature
            if (step === 2) {
                const warning = document.getElementById('signatureWarning');
                if (!hasSignature) {
                    warning.style.display = 'flex';
                    return false;
                }
                warning.style.display = 'none';
                return true;
            }

            // Step 3, 4: Standard form validation
            if (step === 3 || step === 4) {
                const stepEl = document.getElementById('formStep' + step);
                const requiredFields = stepEl.querySelectorAll('[required]');
                let isValid = true;

                // Clear previous errors
                stepEl.querySelectorAll('.reg-field.error').forEach(f => f.classList.remove('error'));

                requiredFields.forEach(field => {
                    if (!field.value || field.value.trim() === '') {
                        field.closest('.reg-field').classList.add('error');
                        isValid = false;
                    }

                    // Specific: NIK must be 16 digits
                    if (field.name === 'nik' && field.value.length !== 16) {
                        field.closest('.reg-field').classList.add('error');
                        isValid = false;
                    }
                });

                if (!isValid) {
                    showToast("{{ __('Mohon lengkapi semua field yang wajib diisi.') }}");
                }

                return isValid;
            }

            return true;
        }

        // File preview
        function previewFile(input, boxId) {
            const box = document.getElementById(boxId);
            if (input.files && input.files[0]) {
                const file = input.files[0];
                // Check file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    showToast("{{ __('Ukuran file melebihi batas 2MB!') }}");
                    input.value = '';
                    return;
                }
                box.classList.add('has-file');
                box.querySelector('span').textContent = file.name;
                box.querySelector('i').className = 'fa-solid fa-circle-check';
            }
        }

        // Update Skema Pembayaran (Full vs Cicilan)
        function updateSkema(input) {
            const dpSection = document.getElementById('dpInputSection');
            const options = document.querySelectorAll('.skema-option');
            
            options.forEach(opt => {
                opt.style.borderColor = 'rgba(255,255,255,0.1)';
            });
            
            input.closest('.skema-option').style.borderColor = 'var(--gold-color)';
            
            if (input.value === 'cicilan') {
                dpSection.style.display = 'block';
            } else {
                dpSection.style.display = 'none';
            }
        }

        // ======= MIDTRANS PAYMENT =======

        function submitPendaftaran() {
            // Set signature data to hidden input
            const sigData = getSignatureDataURL();
            if (sigData) {
                document.getElementById('inputTandaTangan').value = sigData;
            }

            const form = document.getElementById('formPendaftaran');
            const formData = new FormData(form);
            const submitBtn = document.getElementById('btnSubmit');
            const modalContent = document.querySelector('#modalPendaftaran .modal-content');

            // Show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> {{ __('Memproses...') }}';

            // Add loading overlay
            let overlay = document.createElement('div');
            overlay.className = 'payment-loading-overlay';
            overlay.id = 'paymentLoading';
            overlay.innerHTML = '<div class="payment-spinner"></div><p style="color: var(--gold-color); font-weight: 600; font-size: 0.9rem;">{{ __('Menyimpan data & memproses pembayaran...') }}</p>';
            modalContent.style.position = 'relative';
            modalContent.appendChild(overlay);

            fetch('{{ route("pendaftaran.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Remove loading
                const loadingEl = document.getElementById('paymentLoading');
                if (loadingEl) loadingEl.remove();

                if (data.success && data.snap_token) {
                    // Close modal
                    closePendaftaran();

                    // Open Midtrans Snap popup
                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            showToast("{{ __('Pembayaran berhasil! 🎉') }}");
                            
                            // Hit backend to force status update since local webhooks might fail
                            if (data.pendaftaran_id) {
                                fetch(`/pendaftaran/${data.pendaftaran_id}/check-payment`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                        'Accept': 'application/json'
                                    }
                                }).finally(() => {
                                    setTimeout(() => {
                                        window.location.href = '{{ route("notifikasi") }}';
                                    }, 1000);
                                });
                            } else {
                                setTimeout(() => {
                                    window.location.href = '{{ route("notifikasi") }}';
                                }, 1500);
                            }
                        },
                        onPending: function(result) {
                            showToast("{{ __('Menunggu pembayaran... Cek riwayat pendaftaran Anda.') }}");
                            setTimeout(() => {
                                window.location.href = '{{ route("notifikasi") }}';
                            }, 1500);
                        },
                        onError: function(result) {
                            showToast("{{ __('Pembayaran gagal. Silakan coba lagi dengan pendaftaran baru.') }}");
                        },
                        onClose: function() {
                            showToast("{{ __('Popup pembayaran ditutup. Jika belum bayar, silakan daftar ulang.') }}");
                        }
                    });
                } else {
                    showToast(data.error || "{{ __('Terjadi kesalahan. Silakan coba lagi.') }}");
                }
            })
            .catch(error => {
                const loadingEl = document.getElementById('paymentLoading');
                if (loadingEl) loadingEl.remove();

                console.error('Error:', error);
                showToast("{{ __('Terjadi kesalahan jaringan. Silakan coba lagi.') }}");
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fa-solid fa-credit-card"></i> {{ __('Bayar Sekarang') }}';
            });
        }

        // Global click handlers
        window.onclick = function(event) {
            if (!event.target.closest('.profile-dropdown')) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    if (dropdowns[i].classList.contains('show')) {
                        dropdowns[i].classList.remove('show');
                    }
                }
            }
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove("show");
                document.body.style.overflow = "auto";
            }
        }

        // Image Carousel Multi-Modal
        function ubahSlide(n, modalId) {
            let container = document.getElementById(modalId);
            if (!container) return;
            
            if (typeof container.slideIndex === 'undefined') { container.slideIndex = 0; }
            container.slideIndex += n;
            tampilkanSlide(container.slideIndex, container);
        }

        function lompatSlide(n, modalId) {
            let container = document.getElementById(modalId);
            if (!container) return;
            container.slideIndex = n;
            tampilkanSlide(container.slideIndex, container);
        }

        function tampilkanSlide(n, container) {
            let slides = container.getElementsByClassName("carousel-slide");
            let dots = container.getElementsByClassName("dot");

            if (!slides || slides.length === 0) return;

            if (typeof container.slideIndex === 'undefined') { container.slideIndex = 0; }

            if (n >= slides.length) { container.slideIndex = 0; }
            if (n < 0) { container.slideIndex = slides.length - 1; }

            for (let i = 0; i < slides.length; i++) {
                slides[i].classList.remove("active");
                slides[i].style.display = "none";
            }
            for (let i = 0; i < dots.length; i++) {
                dots[i].classList.remove("active");
            }

            slides[container.slideIndex].classList.add("active");
            slides[container.slideIndex].style.display = "block";
            if (dots.length > container.slideIndex) {
                dots[container.slideIndex].classList.add("active");
            }
        }

    </script>
    @include('partials.wishlist-js')
    <script>

        // --- SISTEM FILTERING JAVASCRIPT ---
        document.addEventListener('DOMContentLoaded', () => {
            const kategoriCheckboxes = document.querySelectorAll('.kategori-filter');
            const bulanSelect = document.getElementById('bulan-filter');
            const hargaSelect = document.getElementById('harga-filter');
            const btnFilter = document.querySelector('.btn-filter');
            const packageCards = document.querySelectorAll('.package-card');
            const countDisplay = document.getElementById('package-count');
            
            const searchInput = document.querySelector('.search-bar input');

            function performFilter() {
                const activeKategoris = Array.from(kategoriCheckboxes)
                                            .filter(cb => cb.checked)
                                            .map(cb => cb.value);
                
                const selectedBulan = bulanSelect.value;
                const selectedHarga = hargaSelect.value;
                const searchQuery = searchInput ? searchInput.value.toLowerCase() : '';

                let showingCount = 0;

                packageCards.forEach(card => {
                    const cardKategori = card.getAttribute('data-kategori');
                    const cardBulan = card.getAttribute('data-bulan');
                    const cardHarga = parseInt(card.getAttribute('data-harga'));
                    const cardTitle = card.querySelector('.card-title').textContent.toLowerCase();

                    let isMatch = true;

                    if (activeKategoris.length > 0 && !activeKategoris.includes(cardKategori)) {
                        isMatch = false;
                    }

                    if (selectedBulan !== 'all' && cardBulan !== selectedBulan) {
                        isMatch = false;
                    }

                    if (selectedHarga !== 'all') {
                        if (selectedHarga === '1' && cardHarga >= 30000000) isMatch = false;
                        if (selectedHarga === '2' && (cardHarga < 30000000 || cardHarga > 40000000)) isMatch = false;
                        if (selectedHarga === '3' && cardHarga <= 40000000) isMatch = false;
                    }

                    if (searchQuery && !cardTitle.includes(searchQuery)) {
                        isMatch = false;
                    }

                    if (isMatch) {
                        card.style.display = 'flex';
                        showingCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                countDisplay.textContent = `Menampilkan ${showingCount} Paket`;
            }

            if(btnFilter) {
                btnFilter.addEventListener('click', performFilter);
            }

            kategoriCheckboxes.forEach(cb => cb.addEventListener('change', performFilter));
            bulanSelect.addEventListener('change', performFilter);
            hargaSelect.addEventListener('change', performFilter);
            if(searchInput) {
                searchInput.addEventListener('input', performFilter);
            }
        });
    </script>
    @include('partials.footer')
    @include('partials.chatbot')

    <!-- Midtrans Snap.js -->
    <script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
</body>
</html>

