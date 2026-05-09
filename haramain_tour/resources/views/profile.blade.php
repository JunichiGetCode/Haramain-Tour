<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Haramain Tour</title>
    <meta name="description" content="Kelola profil akun Haramain Tour Anda.">
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

        .nav-icons { display: flex; align-items: center; gap: 8px; }
        .nav-icon-btn {
            width: 42px; height: 42px; display: flex; justify-content: center; align-items: center;
            border-radius: 12px; color: var(--text-gray); text-decoration: none;
            transition: var(--transition); font-size: 1.15rem;
        }
        .nav-icon-btn:hover { background: var(--bg-color); color: var(--navy-color); }
        .nav-icon-btn.active { background: linear-gradient(135deg, var(--gold-color), var(--gold-light)); color: white; box-shadow: 0 4px 12px var(--gold-glow); }

        .profile-dropdown { position: relative; display: inline-block; }
        .profile-trigger {
            background: var(--bg-color); border: 2px solid var(--gold-color); width: 42px; height: 42px; border-radius: 12px;
            font-size: 1.1rem; color: var(--gold-color); cursor: pointer; transition: var(--transition);
            display: flex; align-items: center; justify-content: center;
        }
        .dropdown-menu {
            display: none; position: absolute; right: 0; top: calc(100% + 10px);
            background-color: white; min-width: 220px; box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
            border-radius: 16px; overflow: hidden; z-index: 1000; flex-direction: column;
            border: 1px solid rgba(0, 0, 0, 0.05); animation: dropIn 0.2s ease-out;
        }
        @keyframes dropIn { from { opacity: 0; transform: translateY(-8px); } to { opacity: 1; transform: translateY(0); } }
        .dropdown-menu.show { display: flex; }
        .dropdown-header { padding: 18px 20px; font-weight: 700; color: var(--navy-color); border-bottom: 1px solid #f0f0f0; background: linear-gradient(135deg, #fafafa, #f5f5f5); font-size: 0.95rem; }
        .dropdown-header small { display: block; font-weight: 400; color: var(--text-gray); font-size: 0.8rem; margin-top: 2px; }
        .dropdown-menu a, .dropdown-menu button {
            padding: 14px 20px; text-decoration: none; color: var(--text-dark); font-size: 0.9rem; font-weight: 500;
            display: flex; align-items: center; gap: 12px; transition: var(--transition);
            border: none; background: none; width: 100%; text-align: left; cursor: pointer; font-family: 'Poppins', sans-serif;
        }
        .dropdown-menu a:hover, .dropdown-menu button:hover { background-color: #f8f9fa; color: var(--gold-color); }
        .dropdown-divider { height: 1px; background-color: #f0f0f0; margin: 4px 0; }
        .logout-btn { color: var(--error-color) !important; }
        .logout-btn:hover { background-color: #fef2f2 !important; color: var(--error-color) !important; }

        /* --- PROFILE PAGE --- */
        .main-container { max-width: 1500px; margin: 30px auto; padding: 0 20px; }

        .page-title-bar {
            display: flex; align-items: center; gap: 14px; margin-bottom: 30px;
        }
        .back-btn {
            width: 44px; height: 44px; border-radius: 14px; border: 2px solid #e5e7eb;
            background: white; display: flex; justify-content: center; align-items: center;
            color: var(--text-dark); text-decoration: none; transition: var(--transition); font-size: 1rem;
        }
        .back-btn:hover { border-color: var(--gold-color); color: var(--gold-color); }
        .page-title-bar h2 { font-size: 1.4rem; font-weight: 800; color: var(--navy-color); }

        /* Alert */
        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb); color: #155724;
            padding: 16px 22px; border-radius: 14px; margin-bottom: 25px;
            border-left: 4px solid #28a745; font-weight: 600; font-size: 0.9rem;
            display: flex; align-items: center; gap: 10px;
        }
        .alert-error {
            background: linear-gradient(135deg, #f8d7da, #f1aeb5); color: #842029;
            padding: 16px 22px; border-radius: 14px; margin-bottom: 25px;
            border-left: 4px solid var(--error-color); font-weight: 600; font-size: 0.85rem;
            display: flex; align-items: center; gap: 10px;
        }

        /* Profile Header Card */
        .profile-header {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            border-radius: 24px; padding: 40px; color: white; margin-bottom: 28px;
            display: flex; align-items: center; gap: 30px; position: relative; overflow: hidden;
        }
        .profile-header::after {
            content: ''; position: absolute; right: -80px; top: -80px; width: 280px; height: 280px;
            background: radial-gradient(circle, var(--gold-glow) 0%, transparent 70%); border-radius: 50%;
        }

        .avatar-container { position: relative; flex-shrink: 0; z-index: 2; }
        .avatar-img {
            width: 110px; height: 110px; border-radius: 24px; object-fit: cover;
            border: 4px solid var(--gold-color); box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }
        .avatar-placeholder {
            width: 110px; height: 110px; border-radius: 24px; border: 4px solid var(--gold-color);
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            display: flex; justify-content: center; align-items: center;
            font-size: 2.8rem; font-weight: 800; color: var(--navy-color);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }
        .avatar-edit-btn {
            position: absolute; bottom: -4px; right: -4px; width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            border: 3px solid var(--navy-color); border-radius: 12px;
            display: flex; justify-content: center; align-items: center;
            color: var(--navy-color); font-size: 0.85rem; cursor: pointer;
            transition: var(--transition); z-index: 3;
        }
        .avatar-edit-btn:hover { transform: scale(1.1); }

        .profile-info { z-index: 2; }
        .profile-info h2 { font-size: 1.5rem; font-weight: 800; margin-bottom: 4px; }
        .profile-info p { color: rgba(255,255,255,0.6); font-size: 0.88rem; }
        .profile-info .member-badge {
            display: inline-flex; align-items: center; gap: 6px; margin-top: 10px;
            background: rgba(201, 168, 76, 0.15); border: 1px solid rgba(201, 168, 76, 0.3);
            padding: 5px 14px; border-radius: 50px; font-size: 0.78rem; font-weight: 600;
            color: var(--gold-color);
        }
        .profile-info .member-badge i { font-size: 0.72rem; }

        /* Tabs */
        .profile-tabs {
            display: flex; gap: 6px; margin-bottom: 28px; background: white;
            padding: 6px; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        }
        .tab-btn {
            flex: 1; padding: 14px; border: none; background: transparent; border-radius: 12px;
            font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 0.88rem;
            color: var(--text-gray); cursor: pointer; transition: var(--transition);
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .tab-btn.active {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            color: white; box-shadow: 0 4px 15px rgba(13, 17, 48, 0.3);
        }
        .tab-btn:not(.active):hover { background: var(--bg-color); color: var(--navy-color); }

        /* Form Card */
        .form-card {
            background: white; border-radius: 22px; padding: 36px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); margin-bottom: 28px;
        }
        .form-card.hidden { display: none; }

        .form-card-title {
            font-size: 1.1rem; font-weight: 800; color: var(--navy-color); margin-bottom: 8px;
            display: flex; align-items: center; gap: 10px;
        }
        .form-card-title i { color: var(--gold-color); }
        .form-card-subtitle { color: var(--text-gray); font-size: 0.85rem; margin-bottom: 28px; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }

        .form-group { margin-bottom: 0; }
        .form-group label {
            display: block; font-weight: 600; font-size: 0.82rem; color: var(--navy-color);
            margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative; display: flex; align-items: center;
        }
        .input-wrapper i {
            position: absolute; left: 16px; color: var(--text-gray); font-size: 0.95rem;
            transition: var(--transition); z-index: 2;
        }
        .input-wrapper input, .input-wrapper select, .input-wrapper textarea {
            width: 100%; padding: 14px 16px 14px 48px;
            border: 2px solid #eef0f3; border-radius: 14px; font-size: 0.9rem;
            font-family: 'Poppins', sans-serif; color: var(--text-dark);
            transition: var(--transition); background: #fafbfc; outline: none;
        }
        .input-wrapper textarea { resize: vertical; min-height: 90px; }
        .input-wrapper input:focus, .input-wrapper select:focus, .input-wrapper textarea:focus {
            border-color: var(--gold-color); background: white;
            box-shadow: 0 0 0 4px var(--gold-glow);
        }
        .input-wrapper input:focus + i, .input-wrapper select:focus + i,
        .input-wrapper textarea:focus + i,
        .input-wrapper input:focus ~ i, .input-wrapper select:focus ~ i,
        .input-wrapper textarea:focus ~ i { color: var(--gold-color); }

        .input-wrapper select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 16px center;
        }

        .field-error { color: var(--error-color); font-size: 0.78rem; margin-top: 6px; font-weight: 500; }

        .btn-save {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color); border: none; padding: 15px 35px;
            border-radius: 14px; font-weight: 700; font-size: 0.92rem;
            cursor: pointer; transition: var(--transition); font-family: 'Poppins', sans-serif;
            box-shadow: 0 4px 15px var(--gold-glow); display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-save:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(201, 168, 76, 0.4); }

        .form-actions { display: flex; justify-content: flex-end; margin-top: 10px; }

        /* Avatar Upload */
        .avatar-upload-area {
            display: flex; align-items: center; gap: 20px; padding: 20px;
            border: 2px dashed #e5e7eb; border-radius: 16px; margin-bottom: 25px;
            transition: var(--transition);
        }
        .avatar-upload-area:hover { border-color: var(--gold-color); background: rgba(201, 168, 76, 0.03); }

        .avatar-upload-preview {
            width: 80px; height: 80px; border-radius: 18px; object-fit: cover;
            border: 3px solid #e5e7eb; flex-shrink: 0;
        }
        .avatar-upload-placeholder {
            width: 80px; height: 80px; border-radius: 18px; background: var(--bg-color);
            display: flex; justify-content: center; align-items: center; flex-shrink: 0;
            color: var(--text-gray); font-size: 2rem;
        }

        .avatar-upload-text h4 { font-size: 0.9rem; font-weight: 700; color: var(--navy-color); margin-bottom: 4px; }
        .avatar-upload-text p { font-size: 0.78rem; color: var(--text-gray); }
        .avatar-upload-text label {
            display: inline-flex; align-items: center; gap: 6px;
            margin-top: 8px; padding: 8px 16px; border-radius: 10px;
            background: var(--bg-color); color: var(--navy-color);
            font-size: 0.82rem; font-weight: 600; cursor: pointer;
            transition: var(--transition);
        }
        .avatar-upload-text label:hover { background: var(--gold-color); color: var(--navy-color); }
        .avatar-upload-text input[type="file"] { display: none; }

        /* Info Cards */
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 20px; }
        .info-item {
            background: var(--bg-color); padding: 16px 20px; border-radius: 14px;
            display: flex; align-items: center; gap: 14px;
        }
        .info-item-icon {
            width: 42px; height: 42px; border-radius: 12px;
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            display: flex; justify-content: center; align-items: center; flex-shrink: 0;
        }
        .info-item-icon i { color: var(--gold-color); font-size: 1rem; }
        .info-item-text span { display: block; font-size: 0.72rem; color: var(--text-gray); font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }
        .info-item-text strong { font-size: 0.9rem; color: var(--navy-color); }

        /* Password Strength */
        .password-hint {
            font-size: 0.78rem; color: var(--text-gray); margin-top: 8px;
            display: flex; align-items: center; gap: 6px;
        }
        .password-hint i { color: var(--gold-color); }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar { flex-wrap: wrap; gap: 12px; justify-content: center; padding: 12px 15px; }
            .profile-header { flex-direction: column; text-align: center; padding: 30px; }
            .profile-info { text-align: center; }
            .form-row { grid-template-columns: 1fr; }
            .info-grid { grid-template-columns: 1fr; }
            .form-card { padding: 24px; }
            .profile-tabs { flex-direction: column; }
            .avatar-upload-area { flex-direction: column; text-align: center; }
        }
    </style>
    @include('partials.footer-css')
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">

    @include('partials.navbar-css')
    @include('partials.navbar')

    <main class="main-container">

        {{-- Title Bar --}}
        <div class="page-title-bar">
            <a href="{{ route('dashboard') }}" class="back-btn"><i class="fa-solid fa-chevron-left"></i></a>
            <h2>{{ __('Profil Saya') }}</h2>
        </div>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Profile Header --}}
        <div class="profile-header">
            <div class="avatar-container">
                @if($user->avatar)
                    <img loading="lazy" src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="avatar-img">
                @else
                    <div class="avatar-placeholder">
                        {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $user->name)[1] ?? '', 0, 1)) }}
                    </div>
                @endif
            </div>
            <div class="profile-info">
                <h2>{{ $user->name }}</h2>
                <p>{{ $user->email }}</p>
                <div class="member-badge">
                    <i class="fa-solid fa-gem"></i>
                    {{ __('Anggota sejak') }} {{ $user->created_at->translatedFormat('F Y') }}
                </div>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="profile-tabs">
            <button class="tab-btn active" onclick="switchTab('info')">
                <i class="fa-solid fa-user"></i> {{ __('Informasi Pribadi') }}
            </button>
            <button class="tab-btn" onclick="switchTab('security')">
                <i class="fa-solid fa-shield-halved"></i> {{ __('Keamanan') }}
            </button>
        </div>

        {{-- Tab: Personal Info --}}
        <div id="tab-info" class="form-card">
            <h3 class="form-card-title"><i class="fa-solid fa-pen-to-square"></i> {{ __('Edit Informasi Pribadi') }}</h3>
            <p class="form-card-subtitle">{{ __('Perbarui data diri Anda agar informasi selalu terkini.') }}</p>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Avatar Upload --}}
                <div class="avatar-upload-area">
                    @if($user->avatar)
                        <img loading="lazy" src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="avatar-upload-preview" id="avatarPreview">
                    @else
                        <div class="avatar-upload-placeholder" id="avatarPlaceholder">
                            <i class="fa-solid fa-camera"></i>
                        </div>
                    @endif
                    <div class="avatar-upload-text">
                        <h4>{{ __('Foto Profil') }}</h4>
                        <p>{{ __('Format: JPG, PNG. Maksimal 2MB.') }}</p>
                        <label for="avatarInput">
                            <i class="fa-solid fa-cloud-arrow-up"></i> {{ __('Pilih Foto') }}
                            <input type="file" name="avatar" id="avatarInput" accept="image/*">
                        </label>
                    </div>
                </div>

                {{-- Name & Email --}}
                <div class="form-row">
                    <div class="form-group">
                        <label>{{ __('Nama Lengkap') }}</label>
                        <div class="input-wrapper">
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                            <i class="fa-solid fa-user"></i>
                        </div>
                        @error('name') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Alamat Email') }}</label>
                        <div class="input-wrapper">
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        @error('email') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Phone & Gender --}}
                <div class="form-row">
                    <div class="form-group">
                        <label>{{ __('Nomor Telepon') }}</label>
                        <div class="input-wrapper">
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        @error('phone') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Jenis Kelamin') }}</label>
                        <div class="input-wrapper">
                            <select name="gender">
                                <option value="">{{ __('Pilih jenis kelamin') }}</option>
                                <option value="Laki-laki" {{ old('gender', $user->gender) == 'Laki-laki' ? 'selected' : '' }}>{{ __('Laki-laki') }}</option>
                                <option value="Perempuan" {{ old('gender', $user->gender) == 'Perempuan' ? 'selected' : '' }}>{{ __('Perempuan') }}</option>
                            </select>
                            <i class="fa-solid fa-venus-mars"></i>
                        </div>
                    </div>
                </div>

                {{-- Birth Date & Address --}}
                <div class="form-row">
                    <div class="form-group">
                        <label>{{ __('Tanggal Lahir') }}</label>
                        <div class="input-wrapper">
                            <input type="date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}">
                            <i class="fa-solid fa-cake-candles"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Alamat') }}</label>
                        <div class="input-wrapper">
                            <textarea name="address" placeholder="{{ __('Masukkan alamat lengkap...') }}">{{ old('address', $user->address) }}</textarea>
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        @error('address') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-floppy-disk"></i> {{ __('Simpan Perubahan') }}
                    </button>
                </div>
            </form>

            {{-- Quick Info --}}
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-item-icon"><i class="fa-solid fa-calendar-check"></i></div>
                    <div class="info-item-text">
                        <span>{{ __('Bergabung') }}</span>
                        <strong>{{ $user->created_at->translatedFormat('d F Y') }}</strong>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-item-icon"><i class="fa-solid fa-clock"></i></div>
                    <div class="info-item-text">
                        <span>{{ __('Terakhir diperbarui') }}</span>
                        <strong>{{ $user->updated_at->translatedFormat('d F Y') }}</strong>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab: Security --}}
        <div id="tab-security" class="form-card hidden">
            <h3 class="form-card-title"><i class="fa-solid fa-lock"></i> {{ __('Ubah Password') }}</h3>
            <p class="form-card-subtitle">{{ __('Pastikan akun Anda menggunakan password yang kuat dan unik.') }}</p>

            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group" style="margin-bottom: 20px;">
                    <label>{{ __('Password Saat Ini') }}</label>
                    <div class="input-wrapper">
                        <input type="password" name="current_password" placeholder="{{ __('Masukkan password saat ini') }}" required>
                        <i class="fa-solid fa-key"></i>
                    </div>
                    @error('current_password') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>{{ __('Password Baru') }}</label>
                        <div class="input-wrapper">
                            <input type="password" name="password" placeholder="{{ __('Minimal 8 karakter') }}" required>
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div class="password-hint"><i class="fa-solid fa-info-circle"></i> {{ __('Gunakan kombinasi huruf, angka, dan simbol') }}</div>
                        @error('password') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Konfirmasi Password Baru') }}</label>
                        <div class="input-wrapper">
                            <input type="password" name="password_confirmation" placeholder="{{ __('Ulangi password baru') }}" required>
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-shield-halved"></i> {{ __('Perbarui Password') }}
                    </button>
                </div>
            </form>
        </div>

    </main>

    @include('partials.footer')

    <script>
        // Dropdown profile
        function toggleProfileDropdown() {
            document.getElementById("profileMenu").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.closest('.profile-dropdown')) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    if (dropdowns[i].classList.contains('show')) {
                        dropdowns[i].classList.remove('show');
                    }
                }
            }
        }

        // Tab Switching
        function switchTab(tabName) {
            // Hide all tabs
            document.getElementById('tab-info').classList.add('hidden');
            document.getElementById('tab-security').classList.add('hidden');

            // Show selected tab
            document.getElementById('tab-' + tabName).classList.remove('hidden');

            // Update btn active state
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            event.target.closest('.tab-btn').classList.add('active');
        }

        // Avatar preview
        document.getElementById('avatarInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    // Remove placeholder if exists
                    const placeholder = document.getElementById('avatarPlaceholder');
                    if (placeholder) {
                        const img = document.createElement('img');
                        img.src = ev.target.result;
                        img.className = 'avatar-upload-preview';
                        img.id = 'avatarPreview';
                        placeholder.replaceWith(img);
                    } else {
                        document.getElementById('avatarPreview').src = ev.target.result;
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    @include('partials.chatbot')
</body>
</html>


