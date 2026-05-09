<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Haramain Tour')</title>
    <meta name="description" content="Haramain Tour - Login dan registrasi untuk akses layanan perjalanan umroh dan haji terbaik.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-color: #f5f3ee;
            --navy-color: #0d1130;
            --gold-color: #c9a84c;
            --gold-light: #d6b881;
            --gold-glow: rgba(201, 168, 76, 0.3);
            --input-bg: #f0f1f5;
            --text-dark: #2c2c2c;
            --text-gray: #7a7a7a;
            --error-color: #e3342f;
            --card-bg: #ffffff;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Poppins', 'Segoe UI', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            display: flex; justify-content: center; align-items: center; min-height: 100vh;
        }

        .container {
            display: flex; width: 100%; max-width: 1100px; background-color: white;
            border-radius: 24px; overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0, 0, 0, 0.03);
            min-height: 500px;
            animation: slideUpIn 0.6s ease-out;
        }

        @keyframes slideUpIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- Sisi Kiri: Banner --- */
        .landing-section {
            flex: 1;
            background-image: url("{{ asset('storage/image/background1.jpeg') }}");
            background-size: cover;
            background-position: bottom;
            background-repeat: no-repeat;
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            position: relative;
        }

        .landing-section::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(
                180deg,
                rgba(13, 17, 48, 0.88) 0%,
                rgba(13, 17, 48, 0.4) 50%,
                rgba(13, 17, 48, 0.92) 100%
            );
            z-index: 1;
        }

        .hero-logo {
            width: 140px; height: 140px;
            background-image: url("{{ asset('storage/image/LOGO.png') }}");
            background-size: contain; background-repeat: no-repeat; background-position: center;
            margin-bottom: 15px; position: relative; z-index: 2;
            filter: drop-shadow(0 8px 25px rgba(0,0,0,0.3));
            animation: fadeInDown 0.8s ease-out;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .landing-section h1 {
            font-size: 3rem;
            font-weight: 800;
            letter-spacing: 3px;
            z-index: 2;
            margin-top: 5px;
            text-align: center;
            color: var(--gold-color);
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .landing-section .landing-subtitle {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            z-index: 2;
            margin-top: 10px;
            text-align: center;
            font-weight: 400;
            letter-spacing: 0.5px;
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }

        /* --- Sisi Kanan: Area Form --- */
        .login-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            position: relative;
            background-color: white;
            padding: 50px 55px 40px 55px;
        }

        .auth-nav {
            display: flex;
            gap: 8px;
            margin-bottom: 35px;
            background: var(--input-bg);
            padding: 5px;
            border-radius: 14px;
            width: 100%;
            max-width: 350px;
        }

        .auth-nav a {
            text-decoration: none;
            color: var(--text-gray);
            font-size: 0.95rem;
            font-weight: 600;
            padding: 12px 0;
            transition: var(--transition);
            flex: 1;
            text-align: center;
            border-radius: 11px;
        }

        .auth-nav a:hover {
            color: var(--navy-color);
        }

        .auth-nav a.active {
            color: var(--navy-color);
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            font-weight: 700;
        }

        .form-header-container {
            display: flex; flex-direction: column; align-items: center;
            margin-bottom: 28px;
        }

        .small-logo-container {
            width: 72px; height: 72px; background-color: white; border-radius: 50%; display: flex;
            justify-content: center; align-items: center; margin-bottom: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
            border: 2px solid var(--input-bg);
        }

        .small-logo {
            width: 44px; height: 44px;
            background-image: url("{{ asset('storage/image/LOGO.png') }}");
            background-size: contain; background-repeat: no-repeat; background-position: center;
        }

        .login-section h2 {
            color: var(--navy-color);
            font-size: 1.7rem;
            font-weight: 800;
            text-align: center;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .login-section .form-subtitle {
            color: var(--text-gray);
            font-size: 0.85rem;
            margin-top: 6px;
            text-align: center;
        }

        .login-form {
            width: 100%; max-width: 350px;
            display: flex; flex-direction: column; gap: 16px;
            margin: 0 auto;
        }

        .input-group {
            position: relative; width: 100%;
        }

        .input-group .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 0.95rem;
            transition: var(--transition);
            pointer-events: none;
        }

        .input-group input {
            width: 100%; padding: 16px 20px 16px 48px;
            border: 2px solid var(--input-bg);
            border-radius: 14px;
            background-color: var(--input-bg);
            font-size: 0.95rem;
            color: var(--text-dark);
            outline: none;
            transition: var(--transition);
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
        }

        .input-group input:focus {
            border-color: var(--gold-color);
            background-color: white;
            box-shadow: 0 0 0 4px var(--gold-glow);
        }

        .input-group input:focus + .input-icon,
        .input-group input:focus ~ .input-icon {
            color: var(--gold-color);
        }

        .input-group input::placeholder {
            color: #999;
            font-weight: 400;
        }

        .input-group input:-webkit-autofill,
        .input-group input:-webkit-autofill:hover,
        .input-group input:-webkit-autofill:focus,
        .input-group input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px var(--input-bg) inset !important;
            -webkit-text-fill-color: var(--text-dark) !important;
            border-radius: 14px;
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.78rem;
            margin-top: -10px;
            margin-bottom: 2px;
            padding-left: 5px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .error-message::before {
            content: '\f06a';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 0.7rem;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color);
            padding: 16px;
            border: none;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 10px;
            box-shadow: 0 6px 20px var(--gold-glow);
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Poppins', sans-serif;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(201, 168, 76, 0.45);
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .forgot-password {
            text-align: right; margin-top: -5px;
        }

        .forgot-password a {
            color: var(--gold-color);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .forgot-password a:hover {
            color: var(--navy-color);
            text-decoration: underline;
        }

        .social-login {
            text-align: center;
            margin-top: auto;
            padding-top: 25px;
            width: 100%;
            max-width: 350px;
        }

        .social-divider {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 22px;
        }

        .social-divider::before,
        .social-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e8e8e8;
        }

        .social-login p {
            font-size: 0.82rem;
            color: var(--text-gray);
            font-weight: 500;
            white-space: nowrap;
        }

        .social-icons {
            display: flex; justify-content: center; gap: 14px;
        }

        .social-icon-btn {
            width: 48px; height: 48px; border-radius: 14px;
            border: 2px solid #eee;
            display: flex; justify-content: center; align-items: center;
            font-size: 1.2rem; cursor: pointer;
            transition: var(--transition);
            color: var(--text-dark);
            text-decoration: none;
            background: white;
        }

        .social-icon-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .social-icon-btn:hover .fa-google { color: #DB4437; }
        .social-icon-btn:hover .fa-facebook { color: #4267B2; }
        .social-icon-btn:hover .fa-apple { color: #000000; }

        .fa-google { color: #DB4437; }
        .fa-facebook { color: #4267B2; }
        .fa-apple { color: #000000; }

        @media (max-width: 768px) {
            body {
                background-color: white;
            }

            .container {
                flex-direction: column;
                border-radius: 0;
                box-shadow: none;
                min-height: 100vh;
                max-width: 100%;
            }

            .landing-section {
                flex: none;
                padding: 60px 30px;
                min-height: 250px;
            }

            .landing-section h1 { font-size: 2.2rem; }

            .login-section {
                flex: 1;
                padding: 35px 25px;
                border-radius: 0;
            }

            .auth-nav {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="landing-section">
            <div class="hero-logo"></div>
            <h1>HARAMAIN TOUR</h1>
            <p class="landing-subtitle">Wujudkan perjalanan ibadah impian Anda</p>
        </div>

        <div class="login-section">
            <div class="auth-nav">
                <a href="{{ route('login') }}{{ request('admin') ? '?admin=1' : '' }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Masuk</a>
                @if(!request('admin'))
                <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Daftar</a>
                @endif
            </div>

            @if(session('success'))
                <div style="width: 100%; max-width: 350px; background: linear-gradient(135deg, #d4edda, #c3e6cb); color: #155724; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-size: 0.85rem; font-weight: 600; display: flex; align-items: center; gap: 8px; border-left: 4px solid #28a745;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            @yield('content')

        </div>
    </div>

</body>
</html>