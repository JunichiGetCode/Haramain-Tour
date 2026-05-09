<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} - Haramain Tour</title>
    <meta name="description" content="{{ Str::limit(strip_tags($berita->konten), 150) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-color: #f5f3ee; --navy-color: #0d1130; --navy-light: #283375;
            --gold-color: #c9a84c; --gold-light: #d6b881; --text-dark: #2c2c2c;
            --text-gray: #4b5563; --card-bg: #ffffff; --transition: all 0.3s ease;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); overflow-x: hidden; }

        .article-hero { background: var(--navy-color); position: relative; height: 60vh; min-height: 400px; display: flex; align-items: flex-end; justify-content: center; overflow: hidden; }
        @if($berita->thumbnail)
        .article-hero::before { content: ''; position: absolute; top:0; left:0; width:100%; height:100%; background: url('{{ asset('storage/'.$berita->thumbnail) }}') center/cover no-repeat; opacity: 0.4; }
        @endif
        .article-hero::after { content: ''; position: absolute; bottom:0; left:0; width:100%; height:80%; background: linear-gradient(to top, var(--navy-color) 0%, transparent 100%); }
        
        .hero-content { position: relative; z-index: 2; text-align: center; color: white; padding: 40px 20px; max-width: 900px; }
        .hero-category { display: inline-block; background: var(--gold-color); color: white; padding: 6px 16px; border-radius: 50px; font-size: 0.85rem; font-weight: 700; margin-bottom: 20px; }
        .hero-title { font-size: 2.8rem; font-weight: 800; line-height: 1.3; margin-bottom: 20px; }
        
        .hero-meta { display: flex; align-items: center; justify-content: center; gap: 25px; flex-wrap: wrap; font-size: 0.95rem; color: rgba(255,255,255,0.8); }
        .hero-meta i { color: var(--gold-color); margin-right: 6px; }

        .container { max-width: 1500px; margin: 50px auto; padding: 0 20px; display: grid; grid-template-columns: 2fr 1fr; gap: 40px; }

        /* Main Content */
        .article-content { background: var(--card-bg); border-radius: 20px; padding: 40px; box-shadow: 0 5px 25px rgba(0,0,0,0.03); }
        .article-body { font-size: 1.05rem; line-height: 1.8; color: #374151; }
        .article-body p { margin-bottom: 20px; }
        .article-body img { max-width: 100%; height: auto; border-radius: 12px; margin: 20px 0; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .article-body h2, .article-body h3, .article-body h4 { color: var(--navy-color); margin: 30px 0 15px; font-weight: 700; }
        .article-body ul, .article-body ol { margin-bottom: 20px; padding-left: 20px; }
        .article-body li { margin-bottom: 10px; }
        
        .share-box { margin-top: 40px; padding-top: 30px; border-top: 1px solid #e5e7eb; display: flex; align-items: center; gap: 15px; }
        .share-title { font-weight: 700; color: var(--navy-color); }
        .share-links { display: flex; gap: 10px; }
        .share-links a { width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: #f3f4f6; color: var(--text-gray); text-decoration: none; transition: 0.3s; }
        .share-links a:hover { background: var(--gold-color); color: white; transform: translateY(-3px); }

        /* Sidebar */
        .sidebar { display: flex; flex-direction: column; gap: 30px; }
        .sidebar-widget { background: var(--card-bg); border-radius: 20px; padding: 25px; box-shadow: 0 5px 25px rgba(0,0,0,0.03); }
        .widget-title { font-size: 1.2rem; font-weight: 800; color: var(--navy-color); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .widget-title i { color: var(--gold-color); }
        
        .recent-news { display: flex; flex-direction: column; gap: 15px; }
        .small-news-item { display: flex; gap: 15px; text-decoration: none; color: var(--text-dark); transition: 0.3s; }
        .small-news-item:hover { transform: translateX(5px); }
        .sn-img { width: 80px; height: 80px; border-radius: 12px; object-fit: cover; }
        .sn-info h4 { font-size: 0.95rem; line-height: 1.4; margin-bottom: 5px; color: var(--navy-color); font-weight: 700; }
        .sn-info span { font-size: 0.8rem; color: var(--text-gray); }
        .sn-info h4:hover { color: var(--gold-color); }
        
        .contact-widget { background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); color: white; text-align: center; padding: 20px !important; }
        .contact-widget h3 { color: var(--gold-color); margin-bottom: 10px; font-size: 1.05rem; }
        .contact-widget p { font-size: 0.82rem; color: rgba(255,255,255,0.8); margin-bottom: 14px; line-height: 1.5; }
        .btn-wa { display: inline-block; background: #25D366; color: white; padding: 10px 20px; border-radius: 50px; text-decoration: none; font-weight: 700; transition: 0.3s; font-size: 0.85rem; }
        .btn-wa:hover { background: #128C7E; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(37,211,102,0.3); }

        @media (max-width: 900px) {
            .container { grid-template-columns: 1fr; }
            .hero-title { font-size: 2rem; }
        }
        @media (max-width: 768px) {
            .article-hero { height: auto; min-height: 50vh; }
            .article-content { padding: 20px 15px; }
            .hero-content { padding: 80px 20px 40px; }
            .footer-content { text-align: center; }
            .share-box { flex-direction: column; align-items: flex-start; gap: 10px; }
        }
    </style>
    @include('partials.footer-css')
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">
    
    @include('partials.navbar-css')
    @include('partials.navbar')

    <section class="article-hero">
        <div class="hero-content">
            <span class="hero-category">{{ __('Informasi') }}</span>
            <h1 class="hero-title">{{ $berita->judul }}</h1>
            <div class="hero-meta">
                <span><i class="fa-solid fa-calendar-days"></i> {{ $berita->created_at->format('d F Y') }}</span>
                <span><i class="fa-solid fa-user-pen"></i> {{ __('Ditulis oleh') }} {{ $berita->user->name ?? 'Admin' }}</span>
                <span><a href="{{ route('berita.index') }}" style="color:var(--gold-color); text-decoration:none;"><i class="fa-solid fa-arrow-left"></i> {{ __('Indeks Berita') }}</a></span>
            </div>
        </div>
    </section>

    <main class="container">
        <!-- Konten Berita -->
        <div>
            <article class="article-content">
                <div class="article-body">
                    {!! $berita->konten !!}
                </div>
                
                <div class="share-box">
                    <span class="share-title">{{ __('Bagikan:') }}</span>
                    <div class="share-links">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($berita->judul) }}" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . url()->current()) }}" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>
            </article>
        </div>

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-widget">
                <h3 class="widget-title"><i class="fa-solid fa-fire"></i> {{ __('Berita Terkait') }}</h3>
                <div class="recent-news">
                    @forelse($recentBeritas as $recent)
                        <a href="{{ route('berita.show', $recent->slug) }}" class="small-news-item">
                            @if($recent->thumbnail)
                                <img loading="lazy" src="{{ asset('storage/'.$recent->thumbnail) }}" class="sn-img" alt="">
                            @else
                                <div class="sn-img" style="background:#e5e7eb; display:flex; align-items:center; justify-content:center; color:#9ca3af;">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            @endif
                            <div class="sn-info">
                                <h4>{{ $recent->judul }}</h4>
                                <span>{{ $recent->created_at->format('d M Y') }}</span>
                            </div>
                        </a>
                    @empty
                        <p style="color:var(--text-gray); font-size:0.9rem;">{{ __('Belum ada berita lainnya.') }}</p>
                    @endforelse
                </div>
            </div>

            <div class="sidebar-widget contact-widget">
                <h3>{{ __('Ada Pertanyaan?') }}</h3>
                <p>{{ __('Konsultasikan rencana ibadah Anda ke Tanah Suci bersama tim kami yang siap melayani.') }}</p>
                <a href="https://wa.me/6287775482764" target="_blank" class="btn-wa"><i class="fa-brands fa-whatsapp"></i> {{ __('Hubungi Customer Service') }}</a>
            </div>
        </aside>
    </main>

    @include('partials.footer')


    @include('partials.chatbot')
</body>
</html>

