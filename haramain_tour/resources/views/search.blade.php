<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian: {{ $query }} - Haramain Tour</title>
    <meta name="description" content="Hasil pencarian untuk {{ $query }} di Haramain Tour.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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

        .hero {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            padding: 50px 20px 60px; position: relative; overflow: hidden;
        }
        .hero::after {
            content: ''; position: absolute; bottom: -30px; left: 0; width: 100%;
            height: 60px; background: var(--bg-color); transform: skewY(-2deg);
        }
        .hero-inner { max-width: 900px; margin: 0 auto; }
        .hero-back { display: inline-flex; align-items: center; gap: 8px; color: rgba(255,255,255,0.5); text-decoration: none; font-size: 0.85rem; margin-bottom: 25px; transition: 0.2s; }
        .hero-back:hover { color: var(--gold-color); }

        .search-wrapper {
            position: relative;
        }
        .search-box {
            width: 100%; padding: 18px 24px 18px 56px; border: 2px solid rgba(255,255,255,0.2);
            border-radius: 18px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);
            color: white; font-size: 1.1rem; font-family: 'Poppins', sans-serif; outline: none;
            transition: 0.3s;
        }
        .search-box::placeholder { color: rgba(255,255,255,0.5); }
        .search-box:focus { border-color: var(--gold-color); background: rgba(255,255,255,0.15); }
        .search-icon-hero { position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.6); font-size: 1.1rem; pointer-events: none; }
        .search-submit { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: linear-gradient(135deg, var(--gold-color), var(--gold-light)); color: var(--navy-color); border: none; padding: 10px 22px; border-radius: 12px; font-weight: 700; font-size: 0.9rem; cursor: pointer; font-family: 'Poppins', sans-serif; }

        .result-meta { margin-top: 20px; color: rgba(255,255,255,0.7); font-size: 0.9rem; }
        .result-meta strong { color: var(--gold-color); }

        /* Container */
        .container { max-width: 1500px; margin: 0 auto; padding: 50px 20px 80px; }

        /* Section */
        .result-section { margin-bottom: 45px; }
        .result-section-title {
            display: flex; align-items: center; gap: 12px; margin-bottom: 18px;
            font-size: 1rem; font-weight: 800; color: var(--navy-color);
            text-transform: uppercase; letter-spacing: 0.5px;
        }
        .result-section-title .section-badge {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color); padding: 3px 10px; border-radius: 50px;
            font-size: 0.7rem; font-weight: 700;
        }

        /* Paket Card */
        .paket-card {
            display: flex; align-items: center; gap: 18px; background: var(--card-bg);
            border-radius: 16px; padding: 18px 20px; margin-bottom: 12px;
            border: 1px solid rgba(0,0,0,0.05); transition: var(--transition); text-decoration: none; color: inherit;
        }
        .paket-card:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(0,0,0,0.08); border-color: var(--gold-color); }
        .paket-thumb { width: 70px; height: 70px; border-radius: 12px; object-fit: cover; flex-shrink: 0; background: var(--bg-color); }
        .paket-info { flex: 1; min-width: 0; }
        .paket-name { font-weight: 800; font-size: 1rem; color: var(--navy-color); margin-bottom: 4px; }
        .paket-meta { font-size: 0.8rem; color: var(--text-gray); }
        .paket-price { font-weight: 800; color: var(--gold-color); font-size: 0.95rem; white-space: nowrap; }

        /* Berita Card */
        .berita-card {
            display: flex; align-items: center; gap: 18px; background: var(--card-bg);
            border-radius: 16px; padding: 18px 20px; margin-bottom: 12px;
            border: 1px solid rgba(0,0,0,0.05); transition: var(--transition); text-decoration: none; color: inherit;
        }
        .berita-card:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(0,0,0,0.08); border-color: #10b981; }
        .berita-thumb { width: 70px; height: 70px; border-radius: 12px; object-fit: cover; flex-shrink: 0; background: #f0fdf4; display: flex; align-items: center; justify-content: center; }
        .berita-thumb img { width: 100%; height: 100%; object-fit: cover; border-radius: 12px; }
        .berita-thumb .no-img { color: #16a34a; font-size: 1.5rem; }
        .berita-name { font-weight: 800; font-size: 0.95rem; color: var(--navy-color); margin-bottom: 4px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .berita-meta { font-size: 0.78rem; color: var(--text-gray); }

        /* Page Card */
        .page-cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 12px; }
        .page-card {
            background: var(--card-bg); border-radius: 14px; padding: 18px; display: flex; align-items: flex-start;
            gap: 14px; border: 1px solid rgba(0,0,0,0.05); transition: var(--transition); text-decoration: none; color: inherit;
        }
        .page-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.07); border-color: var(--gold-color); }
        .page-icon { width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); display: flex; align-items: center; justify-content: center; color: var(--gold-color); font-size: 1rem; flex-shrink: 0; }
        .page-title { font-weight: 700; font-size: 0.9rem; color: var(--navy-color); margin-bottom: 3px; }
        .page-desc { font-size: 0.78rem; color: var(--text-gray); line-height: 1.5; }

        /* Empty / No query */
        .empty-state { text-align: center; padding: 60px 20px; }
        .empty-state i { font-size: 4rem; color: #d1d5db; display: block; margin-bottom: 20px; }
        .empty-state h2 { font-size: 1.4rem; color: var(--navy-color); margin-bottom: 10px; }
        .empty-state p { color: var(--text-gray); }

        /* Suggestions */
        .suggestions { margin-top: 25px; }
        .suggestions-title { font-size: 0.85rem; color: rgba(255,255,255,0.5); font-weight: 600; margin-bottom: 10px; }
        .suggestion-chips { display: flex; flex-wrap: wrap; gap: 8px; }
        .suggestion-chip {
            padding: 6px 14px; border: 1px solid rgba(255,255,255,0.2); border-radius: 50px;
            color: rgba(255,255,255,0.7); font-size: 0.8rem; text-decoration: none; transition: 0.2s;
        }
        .suggestion-chip:hover { background: var(--gold-color); color: var(--navy-color); border-color: var(--gold-color); }

        @media (max-width: 768px) {
            .hero { padding: 35px 20px 50px; }
            .paket-thumb, .berita-thumb { width: 55px; height: 55px; }
            .page-cards { grid-template-columns: 1fr; }
        }
    @include('partials.footer-css')
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">
    @include('partials.navbar-css')
    @include('partials.navbar')

    <div class="hero">
        <div class="hero-inner">
            <a href="{{ route('dashboard') }}" class="hero-back"><i class="fa-solid fa-arrow-left"></i> {{ __('Dashboard') }}</a>
            <form action="{{ route('search') }}" method="GET" style="position: relative;">
                <i class="fa-solid fa-search search-icon-hero"></i>
                <input type="text" name="q" class="search-box" placeholder="{{ __('Cari paket, berita, panduan, doa...') }}" value="{{ $query }}" autofocus>
                <button type="submit" class="search-submit">{{ __('Cari') }}</button>
            </form>
            @if($query)
                <p class="result-meta">
                    {{ __('Menampilkan') }} <strong>{{ $totalResults }} {{ __('hasil') }}</strong> {{ __('untuk') }} "<strong>{{ $query }}</strong>"
                </p>
            @endif

            <div class="suggestions">
                <p class="suggestions-title">{{ __('Pencarian populer:') }}</p>
                <div class="suggestion-chips">
                    @foreach(['umroh reguler', 'doa tawaf', 'kamus arab', 'hotel makkah', 'panduan ihram'] as $sug)
                        <a href="{{ route('search') }}?q={{ $sug }}" class="suggestion-chip">{{ $sug }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        @if(!$query)
            <div class="empty-state">
                <i class="fa-solid fa-magnifying-glass"></i>
                <h2>{{ __('Apa yang ingin Anda cari?') }}</h2>
                <p>{{ __('Ketik kata kunci di atas untuk mencari paket umroh, berita, panduan, doa, dan kosakata Arab.') }}</p>
            </div>

        @elseif($totalResults === 0)
            <div class="empty-state">
                <i class="fa-solid fa-face-frown-open"></i>
                <h2>{{ __('Tidak ada hasil untuk') }} "{{ $query }}"</h2>
                <p>{{ __('Coba kata kunci yang berbeda, atau pilih salah satu dari navigasi di bawah.') }}</p>
                <div style="display:flex;flex-wrap:wrap;gap:12px;justify-content:center;margin-top:30px;">
                    <a href="{{ route('paket') }}" style="display:flex;align-items:center;gap:8px;padding:12px 20px;background:white;border-radius:12px;text-decoration:none;color:var(--navy-color);font-weight:700;box-shadow:0 4px 15px rgba(0,0,0,0.06);">📦 {{ __('Paket Umroh') }}</a>
                    <a href="{{ route('berita.index') }}" style="display:flex;align-items:center;gap:8px;padding:12px 20px;background:white;border-radius:12px;text-decoration:none;color:var(--navy-color);font-weight:700;box-shadow:0 4px 15px rgba(0,0,0,0.06);">📰 {{ __('Berita') }}</a>
                    <a href="{{ route('doa') }}" style="display:flex;align-items:center;gap:8px;padding:12px 20px;background:white;border-radius:12px;text-decoration:none;color:var(--navy-color);font-weight:700;box-shadow:0 4px 15px rgba(0,0,0,0.06);">🤲 {{ __('Doa Penting') }}</a>
                    <a href="{{ route('kamus') }}" style="display:flex;align-items:center;gap:8px;padding:12px 20px;background:white;border-radius:12px;text-decoration:none;color:var(--navy-color);font-weight:700;box-shadow:0 4px 15px rgba(0,0,0,0.06);">📖 {{ __('Kamus Arab') }}</a>
                </div>
            </div>

        @else

            @if($pakets->count())
            <div class="result-section">
                <div class="result-section-title">
                    <i class="fa-solid fa-file-lines" style="color:var(--gold-color);"></i>
                    {{ __('Paket Umroh') }}
                    <span class="section-badge">{{ $pakets->count() }}</span>
                </div>
                @foreach($pakets as $paket)
                <div style="position:relative;">
                    <a href="{{ route('paket') }}" class="paket-card">
                        @if($paket->gambar_utama)
                            <img loading="lazy" src="{{ str_starts_with($paket->gambar_utama, 'http') ? $paket->gambar_utama : (str_starts_with($paket->gambar_utama, 'storage/') ? asset($paket->gambar_utama) : asset('storage/' . $paket->gambar_utama)) }}" alt="{{ $paket->nama }}" class="paket-thumb">
                        @else
                            <div class="paket-thumb" style="display:flex;align-items:center;justify-content:center;"><i class="fa-solid fa-kaaba" style="color:var(--gold-color);font-size:1.5rem;"></i></div>
                        @endif
                        <div class="paket-info">
                            <div class="paket-name">{{ $paket->nama }}</div>
                            <div class="paket-meta">{{ $paket->kategori }} · {{ $paket->durasi_hari }} hari</div>
                        </div>
                        <div class="paket-price">{{ $paket->harga_rupiah }}</div>
                    </a>
                    <i class="{{ in_array($paket->id, Auth::user()->settings['wishlist'] ?? []) ? 'fa-solid' : 'fa-regular' }} fa-bookmark wishlist-toggle" 
                       data-package-id="{{ $paket->id }}" 
                       onclick="toggleWishlist(event, this)" 
                       style="position:absolute; right:20px; top:50%; transform:translateY(-50%); cursor:pointer; color:var(--gold-color); font-size:1.1rem; z-index:10; background:white; padding:10px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.05);"></i>
                </div>
                @endforeach
            </div>
            @endif

            @if($beritas->count())
            <div class="result-section">
                <div class="result-section-title">
                    <i class="fa-solid fa-newspaper" style="color:#16a34a;"></i>
                    {{ __('Berita & Informasi') }}
                    <span class="section-badge" style="background:linear-gradient(135deg,#10b981,#059669);">{{ $beritas->count() }}</span>
                </div>
                @foreach($beritas as $berita)
                <a href="{{ route('berita.show', $berita->slug) }}" class="berita-card">
                    <div class="berita-thumb">
                        @if($berita->thumbnail)
                            <img loading="lazy" src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->judul }}">
                        @else
                            <i class="fa-solid fa-newspaper no-img"></i>
                        @endif
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div class="berita-name">{{ $berita->judul }}</div>
                        <div class="berita-meta">
                            {{ $berita->user->name ?? 'Redaksi' }} · {{ $berita->created_at->format('d M Y') }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @endif

            @if($pages->count())
            <div class="result-section">
                <div class="result-section-title">
                    <i class="fa-solid fa-link" style="color:#4f46e5;"></i>
                    {{ __('Halaman') }}
                    <span class="section-badge" style="background:linear-gradient(135deg,#6366f1,#4f46e5);">{{ $pages->count() }}</span>
                </div>
                <div class="page-cards">
                    @foreach($pages as $page)
                    <a href="{{ route($page['route']) }}" class="page-card">
                        <div class="page-icon"><i class="fa-solid {{ $page['icon'] }}"></i></div>
                        <div>
                            <div class="page-title">{{ $page['title'] }}</div>
                            <div class="page-desc">{{ $page['desc'] }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        @endif
    </div>

    @include('partials.footer')
    @include('partials.chatbot')
    @include('partials.wishlist-js')
</body>
</html>


