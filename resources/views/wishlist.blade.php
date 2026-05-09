<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wishlist - Haramain Tour</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            --card-bg: #ffffff;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); }
        .main-container { max-width: 1500px; margin: 40px auto; padding: 0 20px; min-height: 50vh; }
        
        .page-header {
            margin-bottom: 35px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }
        .page-header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .page-header-icon {
            width: 56px; height: 56px;
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            color: var(--gold-color); font-size: 1.4rem;
            box-shadow: 0 4px 15px rgba(13, 17, 48, 0.2);
        }
        .page-header h1 { font-size: 1.6rem; font-weight: 800; color: var(--navy-color); }
        .page-header p { color: var(--text-gray); font-size: 0.88rem; margin-top: 2px; }
        .wishlist-count {
            background: linear-gradient(135deg, rgba(201,168,76,0.12), rgba(201,168,76,0.06));
            color: var(--gold-color); padding: 8px 18px; border-radius: 50px;
            font-size: 0.85rem; font-weight: 700;
            border: 1px solid rgba(201,168,76,0.2);
            display: flex; align-items: center; gap: 8px;
        }

        .package-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 25px; }

        .package-card {
            background: var(--card-bg); border-radius: 20px; overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04); transition: var(--transition);
            display: flex; flex-direction: column;
            border: 1px solid rgba(0,0,0,0.04);
        }
        .package-card:hover { transform: translateY(-6px); box-shadow: 0 15px 40px rgba(0,0,0,0.1); border-color: rgba(201,168,76,0.2); }
        .package-card.premium { border: 2px solid var(--gold-color); }
        .package-card.premium:hover { box-shadow: 0 15px 40px rgba(201,168,76,0.15); }

        .card-img-wrapper { position: relative; width: 100%; height: 200px; overflow: hidden; }
        .card-img-wrapper img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .package-card:hover .card-img-wrapper img { transform: scale(1.06); }
        .card-badge {
            position: absolute; top: 15px; left: 15px;
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color); padding: 5px 14px; border-radius: 50px;
            font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .card-badge.premium-badge { background: linear-gradient(135deg, #f39c12, #e67e22); color: white; }

        .card-body { padding: 22px; display: flex; flex-direction: column; flex: 1; }
        .card-title {
            font-size: 1.15rem; font-weight: 700; color: var(--navy-color);
            margin-bottom: 14px; line-height: 1.4;
        }
        .card-meta { display: flex; flex-direction: column; gap: 8px; margin-bottom: 18px; }
        .card-meta-item {
            font-size: 0.85rem; color: var(--text-gray);
            display: flex; align-items: center; gap: 10px;
        }
        .card-meta-item i { color: var(--gold-color); width: 16px; text-align: center; font-size: 0.9rem; }

        .card-footer {
            margin-top: auto; padding-top: 18px; display: flex;
            justify-content: space-between; align-items: center;
            border-top: 1px solid rgba(0,0,0,0.06);
        }
        .price-wrapper { display: flex; flex-direction: column; }
        .price-label { font-size: 0.72rem; color: var(--text-gray); font-weight: 500; }
        .price-value { font-size: 1.15rem; font-weight: 800; color: var(--gold-color); }

        .btn-rm {
            background: rgba(239, 68, 68, 0.08); color: #dc2626;
            border: 1.5px solid rgba(239,68,68,0.15); padding: 10px 18px;
            border-radius: 12px; cursor: pointer; transition: var(--transition);
            font-weight: 600; font-size: 0.82rem; font-family: 'Poppins', sans-serif;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-rm:hover { background: #dc2626; color: white; border-color: #dc2626; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(220,38,38,0.2); }

        .empty-state {
            text-align: center; padding: 100px 20px;
            background: var(--card-bg); border-radius: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        }
        .empty-icon {
            width: 100px; height: 100px; border-radius: 50%;
            background: linear-gradient(135deg, rgba(201,168,76,0.1), rgba(201,168,76,0.05));
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 25px; font-size: 2.8rem; color: var(--gold-color);
        }
        .empty-state h3 { font-size: 1.4rem; margin-bottom: 10px; color: var(--navy-color); font-weight: 800; }
        .empty-state p { color: var(--text-gray); font-size: 0.95rem; max-width: 400px; margin: 0 auto; line-height: 1.7; }
        .btn-explore {
            display: inline-flex; align-items: center; gap: 8px;
            margin-top: 25px; padding: 14px 30px;
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color); font-weight: 700; text-decoration: none;
            border-radius: 14px; transition: var(--transition);
            box-shadow: 0 4px 15px var(--gold-glow); font-size: 0.95rem;
        }
        .btn-explore:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(201,168,76,0.4); }

        .alert-success-custom {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724; padding: 16px 22px; border-radius: 14px;
            margin-bottom: 25px; border-left: 4px solid #28a745;
            font-weight: 600; font-size: 0.9rem;
            display: flex; align-items: center; gap: 10px;
        }

        @media (max-width: 768px) {
            .package-grid { grid-template-columns: 1fr; }
            .page-header { flex-direction: column; align-items: flex-start; }
        }
    </style>
    @include('partials.footer-css')
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">

    @include('partials.navbar-css')
    @include('partials.navbar')

    <main class="main-container">
        <div class="page-header">
            <div class="page-header-left">
                <div class="page-header-icon">
                    <i class="fa-solid fa-bookmark"></i>
                </div>
                <div>
                    <h1>{{ __('Wishlist Tersimpan') }}</h1>
                    <p>{{ __('Daftar paket perjalanan yang telah Anda simpan') }}</p>
                </div>
            </div>
            @if(count($wishlistPackages) > 0)
                <div class="wishlist-count">
                    <i class="fa-solid fa-heart"></i> {{ count($wishlistPackages) }} {{ __('Paket') }}
                </div>
            @endif
        </div>

        @if(session('success'))
            <div class="alert-success-custom">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @if(count($wishlistPackages) > 0)
            <div class="package-grid">
                @foreach($wishlistPackages as $paket)
                <div class="package-card @if($paket->status_premium) premium @endif">
                    <div class="card-img-wrapper">
                        <img loading="lazy" src="{{ str_starts_with($paket->gambar_utama, 'http') ? $paket->gambar_utama : (str_starts_with($paket->gambar_utama, 'storage/') ? asset($paket->gambar_utama) : asset('storage/' . $paket->gambar_utama)) }}" alt="{{ $paket->nama }}">
                        @if($paket->status_premium)
                            <span class="card-badge premium-badge"><i class="fa-solid fa-crown" style="margin-right:4px;"></i> PREMIUM</span>
                        @else
                            <span class="card-badge" style="text-transform:capitalize;">{{ ucwords(str_replace('_', ' ', $paket->kategori)) }}</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="card-title">{{ $paket->nama }}</div>
                        <div class="card-meta">
                            <div class="card-meta-item"><i class="fa-regular fa-calendar"></i> {{ $paket->durasi_hari }} {{ __('Hari') }} - {{ $paket->tanggal_keberangkatan ? $paket->tanggal_keberangkatan->format('d F Y') : 'TBA' }}</div>
                            @if($paket->hotel_makkah || $paket->hotel_madinah)
                            <div class="card-meta-item"><i class="fa-solid fa-location-dot"></i> {{ $paket->hotel_makkah ?? 'TBA' }} & {{ $paket->hotel_madinah ?? 'TBA' }}</div>
                            @endif
                        </div>
                        <div class="card-footer">
                            <div class="price-wrapper">
                                <span class="price-label">{{ __('Mulai dari') }}</span>
                                <span class="price-value">{{ $paket->harga_rupiah }}</span>
                            </div>
                            <form action="{{ route('wishlist.remove') }}" method="POST">
                                @csrf @method('DELETE')
                                <input type="hidden" name="package_id" value="{{ $paket->id }}">
                                <button type="submit" class="btn-rm"><i class="fa-solid fa-trash-can"></i> {{ __('Hapus') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fa-regular fa-bookmark"></i>
                </div>
                <h3>{{ __('Wishlist Anda Masih Kosong') }}</h3>
                <p>{{ __('Jelajahi berbagai paket menarik kami dan temukan perjalanan impian Anda.') }}</p>
                <a href="{{ route('paket') }}" class="btn-explore"><i class="fa-solid fa-compass"></i> {{ __('Eksplorasi Paket') }}</a>
            </div>
        @endif
    </main>

    @include('partials.footer')
    @include('partials.chatbot')
</body>
</html>


