<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Informasi - Haramain Tour</title>
    <meta name="description" content="Baca berita terbaru, artikel islami, dan pengumuman seputar perjalanan ibadah Haji dan Umrah di Haramain Tour.">
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
            --text-dark: #2c2c2c;
            --text-gray: #6b7280;
            --card-bg: #ffffff;
            --transition: all 0.3s ease;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); overflow-x: hidden; }



        .container { max-width: 1500px; margin: 60px auto; padding: 0 20px; }

        /* Grid Berita */
        .berita-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .berita-card {
            background: var(--card-bg);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: var(--text-dark);
            border: 1px solid rgba(0,0,0,0.03);
            position: relative;
            top: 0;
        }

        .berita-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .berita-img-wrapper {
            width: 100%;
            height: 220px;
            overflow: hidden;
            position: relative;
        }
        .berita-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        .berita-card:hover .berita-img { transform: scale(1.05); }

        .berita-date-badge {
            position: absolute; top: 15px; right: 15px;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(5px);
            color: var(--navy-color);
            padding: 8px 12px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 700;
            display: flex; flex-direction: column; align-items: center; line-height: 1.2;
        }
        .berita-date-badge span { color: var(--gold-color); font-size: 1.3rem; }

        .berita-content {
            padding: 25px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .berita-category { font-size: 0.8rem; color: var(--gold-color); font-weight: 700; text-transform: uppercase; margin-bottom: 10px; }
        .berita-title { font-size: 1.2rem; font-weight: 700; margin-bottom: 12px; line-height: 1.4; color: var(--navy-color); }
        .berita-excerpt { font-size: 0.9rem; color: var(--text-gray); line-height: 1.6; margin-bottom: 20px; flex: 1; }
        
        .berita-footer {
            display: flex; justify-content: space-between; align-items: center;
            border-top: 1px solid rgba(0,0,0,0.05);
            padding-top: 15px;
            margin-top: auto;
        }

        .berita-author { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; font-weight: 600; color: var(--text-gray); }
        .berita-author img { width: 30px; height: 30px; border-radius: 50%; object-fit: cover; }
        .read-more { color: var(--gold-color); font-size: 0.9rem; font-weight: 700; display: flex; align-items: center; gap: 5px; }
        .berita-card:hover .read-more { gap: 8px; }

        /* Pagination */
        .pagination-container { margin-top: 50px; display: flex; justify-content: center; }

        @media (max-width: 1024px) {
            .berita-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .berita-grid { grid-template-columns: 1fr; }
        }
    </style>
    @include('partials.footer-css')
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">
    
    @include('partials.navbar-css')
    @include('partials.navbar')

    <x-hero 
        badgeIcon="fa-solid fa-newspaper" 
        :badgeText="__('Informasi & Artikel')" 
        :title="__('Berita Terkini')" 
        arabic="أَخْبَارٌ حَدِيثَةٌ" 
        :description="__('Temukan kabar terbaru, promo paket ibadah, panduan perjalanan, hingga cerita inspiratif dari Tanah Suci.')"
        bgIcon="\f1ea" 
    />

    <main class="container">
        @if($beritas->count() > 0)
            <div class="berita-grid">
                @foreach($beritas as $berita)
                    <a href="{{ route('berita.show', $berita->slug) }}" class="berita-card">
                        <div class="berita-img-wrapper">
                            @if($berita->thumbnail)
                                <img loading="lazy" src="{{ asset('storage/'.$berita->thumbnail) }}" class="berita-img" alt="{{ $berita->judul }}">
                            @else
                                <div style="width: 100%; height: 100%; background: #e5e7eb; display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 3rem;">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            @endif
                            <div class="berita-date-badge">
                                <span>{{ $berita->created_at->format('d') }}</span>
                                {{ $berita->created_at->format('M Y') }}
                            </div>
                        </div>
                        <div class="berita-content">
                            <span class="berita-category">{{ __('Kabar Terbaru') }}</span>
                            <h3 class="berita-title">{{ $berita->judul }}</h3>
                            <div class="berita-excerpt">
                                {{ Str::limit(strip_tags($berita->konten), 120) }}
                            </div>
                            <div class="berita-footer">
                                <div class="berita-author">
                                    <i class="fa-solid fa-user-pen"></i> {{ $berita->user->name ?? 'Admin' }}
                                </div>
                                <div class="read-more">{{ __('Baca') }} <i class="fa-solid fa-arrow-right"></i></div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="pagination-container">
                {{ $beritas->links() }}
            </div>
        @else
            <div style="text-align: center; padding: 100px 20px; color: var(--text-gray);">
                <i class="fa-regular fa-newspaper" style="font-size: 5rem; color: #d1d5db; margin-bottom: 20px;"></i>
                <h2 style="font-size: 1.5rem; color: var(--navy-color); margin-bottom: 10px;">{{ __('Belum Ada Berita') }}</h2>
                <p>{{ __('Saat ini belum ada artikel terbaru yang dipublikasikan. Silakan cek kembali nanti.') }}</p>
            </div>
        @endif
    </main>

    @include('partials.footer')


    @include('partials.chatbot')
</body>
</html>


