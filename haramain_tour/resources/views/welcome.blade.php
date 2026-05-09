<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haramain Tour - Selamat Datang</title>
    <meta name="description" content="Haramain Tour - Jelajahi perjalanan ibadah umroh dan haji Anda dengan mudah dan nyaman.">
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
            --card-bg: #ffffff;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', 'Segoe UI', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-color);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* --- Navbar --- */
        .top-nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 18px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            transition: var(--transition);
        }

        .top-nav.scrolled {
            background: rgba(13, 17, 48, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 12px 50px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15);
        }

        .nav-brand {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--gold-color);
            text-decoration: none;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-brand img {
            width: 38px;
            height: 38px;
            object-fit: contain;
        }

        .nav-links {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-nav {
            padding: 10px 28px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
            cursor: pointer;
            text-align: center;
            display: inline-block;
            letter-spacing: 0.3px;
        }

        .btn-nav-login {
            background-color: transparent;
            color: var(--gold-color);
            border: 2px solid var(--gold-color);
        }

        .btn-nav-login:hover {
            background-color: var(--gold-color);
            color: var(--navy-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px var(--gold-glow);
        }

        .btn-nav-admin {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color);
            border: 2px solid var(--gold-color);
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 700;
        }
        .btn-nav-admin:hover {
            background: var(--navy-color);
            color: var(--gold-color);
            border-color: var(--gold-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 20px var(--gold-glow);
        }

        .btn-cta-admin {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light)) !important;
            color: var(--navy-color) !important;
            border: 2px solid var(--gold-color) !important;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
        }
        .btn-cta-admin:hover {
            background: transparent !important;
            color: var(--gold-color) !important;
            box-shadow: 0 4px 20px var(--gold-glow);
        }

        /* Language Switcher */
        .lang-switcher {
            position: relative;
            display: flex;
            align-items: center;
        }
        .lang-btn {
            display: flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,0.1); border: 1px solid rgba(201,168,76,0.4);
            color: var(--gold-color); padding: 8px 14px; border-radius: 50px;
            font-size: 0.82rem; font-weight: 600; cursor: pointer;
            transition: var(--transition); text-decoration: none;
        }
        .lang-btn:hover { background: rgba(201,168,76,0.15); border-color: var(--gold-color); }
        .lang-btn i { font-size: 0.9rem; }
        .lang-dropdown {
            position: absolute; top: calc(100% + 4px); right: 0;
            background: var(--navy-color); border: 1px solid rgba(201,168,76,0.3);
            border-radius: 12px; overflow: hidden; display: none;
            min-width: 160px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            z-index: 200;
        }
        .lang-dropdown.show { display: block; }
        .lang-option {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 16px; color: rgba(255,255,255,0.8);
            text-decoration: none; font-size: 0.85rem; transition: var(--transition);
        }
        .lang-option:hover { background: rgba(201,168,76,0.15); color: var(--gold-color); }
        .lang-option.active { color: var(--gold-color); font-weight: 700; background: rgba(201,168,76,0.08); }
        .lang-option img { width: 20px; height: 14px; border-radius: 2px; object-fit: cover; }

        /* --- Hero Section --- */
        .hero-section {
            width: 100%;
            min-height: 100vh;
            background-image: url("{{ asset('storage/image/background1.jpeg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            text-align: center;
            padding: 0 20px;
        }

        /* Overlay gelap */
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(
                180deg,
                rgba(13, 17, 48, 0.92) 0%,
                rgba(13, 17, 48, 0.5) 40%,
                rgba(13, 17, 48, 0.4) 60%,
                rgba(13, 17, 48, 0.95) 100%
            );
            z-index: 1;
        }


        .hero-content {
            position: relative;
            z-index: 3;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hero-logo {
            width: 180px;
            height: 180px;
            margin-bottom: 10px;
            animation: fadeInDown 1s ease-out;
        }

        .hero-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 8px 25px rgba(0,0,0,0.3));
        }

        .hero-content h1 {
            font-size: 4.5rem;
            font-weight: 700;
            letter-spacing: 4px;
            color: var(--gold-color);
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            margin-bottom: 8px;
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        .hero-content .tagline {
            font-size: 1.15rem;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 40px;
            letter-spacing: 1px;
            animation: fadeInUp 1s ease-out 0.5s both;
        }

        .hero-cta {
            display: flex;
            gap: 16px;
            animation: fadeInUp 1s ease-out 0.7s both;
        }

        .btn-cta-primary, .btn-cta-secondary {
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
            background-color: transparent;
            color: var(--gold-color);
            border: 2px solid var(--gold-color);
            letter-spacing: 0.5px;
        }

        .btn-cta-primary:hover, .btn-cta-secondary:hover {
            background-color: var(--gold-color);
            color: var(--navy-color);
            transform: translateY(-3px);
            box-shadow: 0 4px 15px var(--gold-glow);
        }

        /* --- Features Strip --- */
        .features-strip {
            background: var(--navy-color);
            padding: 50px 20px;
            position: relative;
            z-index: 5;
            margin-top: -2px;
        }

        .features-grid {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .feature-item {
            text-align: center;
            color: white;
            padding: 25px 15px;
            border-radius: 16px;
            transition: var(--transition);
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: translateY(-5px);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 18px;
            font-size: 1.5rem;
            color: var(--navy-color);
        }

        .feature-item h4 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .feature-item p {
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.5;
        }

        /* --- Content Section --- */
        .main-content {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 70px 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            flex-grow: 1;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
        }

        .section-title {
            color: var(--navy-color);
            font-size: 1.6rem;
            font-weight: 800;
            position: relative;
        }

        .section-badge {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color);
            padding: 4px 14px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Testimoni */
        .testimonials-col {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .testimonial-card {
            background-color: var(--card-bg);
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border-left: 4px solid var(--gold-color);
            transition: var(--transition);
            position: relative;
        }

        .testimonial-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
        }

        .testimonial-card .quote-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 2rem;
            color: var(--gold-color);
            opacity: 0.15;
        }

        .testimonial-stars {
            display: flex;
            gap: 3px;
            margin-bottom: 12px;
        }

        .testimonial-stars i {
            color: #f39c12;
            font-size: 0.85rem;
        }

        .testimonial-text {
            font-style: italic;
            color: var(--text-dark);
            margin-bottom: 18px;
            line-height: 1.7;
            font-size: 0.92rem;
        }

        .testimonial-author {
            font-weight: 600;
            color: var(--navy-color);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .author-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--navy-color);
            font-weight: 800;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .author-info span {
            display: block;
            font-size: 0.95rem;
            font-weight: 700;
        }

        .author-info small {
            font-size: 0.78rem;
            color: var(--text-gray);
            font-weight: 400;
        }

        /* Dokumentasi */
        .documentation-col {
            display: flex;
            flex-direction: column;
        }

        .doc-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .doc-frame {
            background-color: #e8e6e1;
            border-radius: 16px;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            transition: var(--transition);
        }

        .doc-frame:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        .doc-frame::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50%;
            background: linear-gradient(to top, rgba(13, 17, 48, 0.7), transparent);
            opacity: 0;
            transition: var(--transition);
        }

        .doc-frame:hover::after {
            opacity: 1;
        }

        .doc-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .doc-frame:hover .doc-image {
            transform: scale(1.08);
        }

        /* --- Animations --- */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-15px); }
            60% { transform: translateY(-8px); }
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .top-nav {
                padding: 15px 20px;
            }

            .top-nav.scrolled {
                padding: 10px 20px;
            }

            .nav-brand {
                font-size: 1.1rem;
            }

            .nav-brand img {
                width: 30px;
                height: 30px;
            }

            .btn-nav {
                padding: 8px 18px;
                font-size: 0.82rem;
            }

            .hero-logo {
                width: 120px;
                height: 120px;
            }

            .hero-content h1 {
                font-size: 2.5rem;
                letter-spacing: 2px;
            }

            .hero-content .tagline {
                font-size: 0.95rem;
            }

            .hero-cta {
                flex-direction: column;
                width: 80%;
            }

            .btn-cta-primary,
            .btn-cta-secondary {
                text-align: center;
            }

            .features-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .feature-item {
                padding: 15px 10px;
            }

            .feature-icon {
                width: 50px; height: 50px;
                font-size: 1.2rem;
            }

            .feature-item h4 { font-size: 0.9rem; }
            .feature-item p { font-size: 0.75rem; }

            .main-content {
                grid-template-columns: 1fr;
                padding: 40px 20px;
                gap: 40px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
                text-align: center;
            }

            .footer-brand p {
                max-width: 100%;
                margin: 0 auto;
            }

            .footer-social {
                justify-content: center;
            }

            .doc-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .hero-content h1 { font-size: 2rem; letter-spacing: 1px; }
            .hero-logo { width: 100px; height: 100px; }
            .features-grid { grid-template-columns: 1fr; }
            .nav-brand { font-size: 1rem; }
            .lang-switcher { display: none; }
        }
    </style>
    @include('partials.footer-css')
</head>
<body>

    <nav class="top-nav" id="mainNav">
        <a href="{{ route('home') }}" class="nav-brand">
            <img loading="lazy" src="{{ asset('storage/image/LOGO.png') }}" alt="Haramain Tour Logo">
            HARAMAIN TOUR
        </a>
        <div class="nav-links">
            <div class="lang-switcher">
                <div class="lang-btn" id="langToggle" onclick="toggleLangDropdown(event)">
                    <i class="fa-solid fa-globe"></i>
                    {{ app()->getLocale() == 'en' ? 'EN' : 'ID' }}
                    <i class="fa-solid fa-chevron-down" style="font-size: 0.65rem;"></i>
                </div>
                <div class="lang-dropdown" id="langDropdown">
                    <a href="{{ route('lang.switch', 'id') }}" class="lang-option {{ app()->getLocale() == 'id' ? 'active' : '' }}">
                        🇮🇩 Bahasa Indonesia
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}" class="lang-option {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                        🇬🇧 English
                    </a>
                </div>
            </div>
            <a href="{{ route('login') }}" class="btn-nav btn-nav-login">{{ __('Masuk') }}</a>
            <a href="{{ route('register') }}" class="btn-nav btn-nav-login">{{ __('Daftar') }}</a>

        </div>
    </nav>

    <div class="hero-section">
        <div class="hero-content">
            <div class="hero-logo">
                <img loading="lazy" src="{{ asset('storage/image/LOGO.png') }}" alt="Haramain Tour">
            </div>
            <h1>HARAMAIN TOUR</h1>
            <p class="tagline">{{ __('Wujudkan perjalanan ibadah Anda dengan mudah dan nyaman') }}</p>
            <div class="hero-cta">
                <a href="{{ route('login') }}" class="btn-cta-primary">{{ __('Mulai Sekarang') }}</a>
                <a href="#explore" class="btn-cta-secondary">{{ __('Jelajahi') }}</a>
            </div>
        </div>
    </div>

    <div class="features-strip">
        <div class="features-grid">
            <div class="feature-item reveal">
                <div class="feature-icon"><i class="fa-solid fa-kaaba"></i></div>
                <h4>{{ __('Paket Lengkap') }}</h4>
                <p>{{ __('Umroh & Haji dengan fasilitas terbaik') }}</p>
            </div>
            <div class="feature-item reveal">
                <div class="feature-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <h4>{{ __('Terjamin Aman') }}</h4>
                <p>{{ __('Bersertifikat resmi & terpercaya') }}</p>
            </div>
            <div class="feature-item reveal">
                <div class="feature-icon"><i class="fa-solid fa-hotel"></i></div>
                <h4>{{ __('Hotel Bintang') }}</h4>
                <p>{{ __('Akomodasi premium dekat Masjidil Haram') }}</p>
            </div>
            <div class="feature-item reveal">
                <div class="feature-icon"><i class="fa-solid fa-headset"></i></div>
                <h4>{{ __('Layanan 24/7') }}</h4>
                <p>{{ __('Pendampingan penuh selama perjalanan') }}</p>
            </div>
        </div>
    </div>

    <section class="main-content" id="explore">
        
        <div class="testimonials-col reveal">
            <div class="section-header">
                <h2 class="section-title">{{ __('Testimoni') }}</h2>
                <span class="section-badge">{{ __('Terpercaya') }}</span>
            </div>
            
            <div class="testimonial-card">
                <i class="fa-solid fa-quote-right quote-icon"></i>
                <div class="testimonial-stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="testimonial-text">"{{ __('Perjalanan umroh saya jadi lebih teratur dan nyaman karena jadwal perjalanan bisa diatur dengan jelas. Semua rencana perjalanan terasa lebih rapi sehingga ibadah bisa dijalankan dengan lebih tenang!') }}"</p>
                <div class="testimonial-author">
                    <div class="author-avatar">AS</div>
                    <div class="author-info">
                        <span>Ahmad Subarjo</span>
                        <small>{{ __('Jamaah Umroh 2025') }}</small>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <i class="fa-solid fa-quote-right quote-icon"></i>
                <div class="testimonial-stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="testimonial-text">"{{ __('Fiturnya lengkap dan gampang banget dipakai. Saya sangat merekomendasikan Haramain Tour buat yang ingin merencanakan perjalanan umroh dengan lebih mudah.') }}"</p>
                <div class="testimonial-author">
                    <div class="author-avatar">SA</div>
                    <div class="author-info">
                        <span>Siti Aminah</span>
                        <small>{{ __('Jamaah Umroh 2025') }}</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="documentation-col reveal">
            <div class="section-header">
                <h2 class="section-title">{{ __('Dokumentasi') }}</h2>
                <span class="section-badge">{{ __('Gallery') }}</span>
            </div>
            
            <div class="doc-grid">
                <div class="doc-frame">
                     <img loading="lazy" src="{{ asset('storage/image/dokumentasi2.png') }}" class="doc-image" alt="Dokumentasi 1">
                </div>
                <div class="doc-frame">
                    <img loading="lazy" src="{{ asset('storage/image/dokumentasi3.png') }}" class="doc-image" alt="Dokumentasi 2">
                </div>
                <div class="doc-frame">
                    <img loading="lazy" src="{{ asset('storage/image/dokumentasi4.png') }}" class="doc-image" alt="Dokumentasi 3">
                </div>
                <div class="doc-frame">
                    <img loading="lazy" src="{{ asset('storage/image/dokumentasi5.jpg') }}" class="doc-image" alt="Dokumentasi 4">
                </div>
            </div>
        </div>

    </section>

    @include('partials.footer')


    <script>
        // Language switcher toggle
        function toggleLangDropdown(e) {
            e.stopPropagation();
            document.getElementById('langDropdown').classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('langDropdown');
            const toggle = document.getElementById('langToggle');
            if (dropdown && !dropdown.contains(e.target) && !toggle.contains(e.target)) {
                dropdown.classList.remove('show');
            }
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('mainNav');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        // Scroll reveal animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>

    @include('partials.chatbot')
</body>
</html>