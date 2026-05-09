<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Pengaturan') }} - Haramain Tour</title>
    <meta name="description" content="Pengaturan akun Haramain Tour.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-color: #f5f3ee; --navy-color: #0d1130; --navy-light: #283375;
            --gold-color: #c9a84c; --gold-light: #d6b881; --gold-glow: rgba(201, 168, 76, 0.3);
            --text-dark: #2c2c2c; --text-gray: #6b7280; --error-color: #e3342f;
            --card-bg: #ffffff; --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', 'Segoe UI', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); overflow-x: hidden; }

        /* --- NAVBAR --- */
        .navbar { background-color: white; padding: 14px 5%; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 20px rgba(0,0,0,0.04); position: sticky; top: 0; z-index: 100; border-bottom: 1px solid rgba(0,0,0,0.04); }
        .brand-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .brand-logo img { width: 40px; height: 40px; object-fit: contain; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1)); }
        .brand-logo h1 { font-size: 1.3rem; font-weight: 800; color: var(--navy-color); letter-spacing: 1px; }
        .nav-icons { display: flex; align-items: center; gap: 8px; }
        .nav-icon-btn { width: 42px; height: 42px; display: flex; justify-content: center; align-items: center; border-radius: 12px; color: var(--text-gray); text-decoration: none; transition: var(--transition); font-size: 1.15rem; }
        .nav-icon-btn:hover { background: var(--bg-color); color: var(--navy-color); }
        .profile-dropdown { position: relative; display: inline-block; }
        .profile-trigger { background: var(--bg-color); border: 2px solid transparent; width: 42px; height: 42px; border-radius: 12px; font-size: 1.1rem; color: var(--navy-color); cursor: pointer; transition: var(--transition); display: flex; align-items: center; justify-content: center; }
        .profile-trigger:hover { border-color: var(--gold-color); color: var(--gold-color); }
        .dropdown-menu { display: none; position: absolute; right: 0; top: calc(100% + 10px); background-color: white; min-width: 220px; box-shadow: 0 15px 40px rgba(0,0,0,0.12); border-radius: 16px; overflow: hidden; z-index: 1000; flex-direction: column; border: 1px solid rgba(0,0,0,0.05); animation: dropIn 0.2s ease-out; }
        @keyframes dropIn { from { opacity: 0; transform: translateY(-8px); } to { opacity: 1; transform: translateY(0); } }
        .dropdown-menu.show { display: flex; }
        .dropdown-header { padding: 18px 20px; font-weight: 700; color: var(--navy-color); border-bottom: 1px solid #f0f0f0; background: linear-gradient(135deg, #fafafa, #f5f5f5); font-size: 0.95rem; }
        .dropdown-header small { display: block; font-weight: 400; color: var(--text-gray); font-size: 0.8rem; margin-top: 2px; }
        .dropdown-menu a, .dropdown-menu button { padding: 14px 20px; text-decoration: none; color: var(--text-dark); font-size: 0.9rem; font-weight: 500; display: flex; align-items: center; gap: 12px; transition: var(--transition); border: none; background: none; width: 100%; text-align: left; cursor: pointer; font-family: 'Poppins', sans-serif; }
        .dropdown-menu a:hover, .dropdown-menu button:hover { background-color: #f8f9fa; color: var(--gold-color); }
        .dropdown-divider { height: 1px; background-color: #f0f0f0; margin: 4px 0; }
        .logout-btn { color: var(--error-color) !important; }
        .logout-btn:hover { background-color: #fef2f2 !important; color: var(--error-color) !important; }

        /* --- LAYOUT --- */
        .main-container { max-width: 1500px; margin: 30px auto; padding: 0 20px; }
        .page-title-bar { display: flex; align-items: center; gap: 14px; margin-bottom: 30px; }
        .back-btn { width: 44px; height: 44px; border-radius: 14px; border: 2px solid #e5e7eb; background: white; display: flex; justify-content: center; align-items: center; color: var(--text-dark); text-decoration: none; transition: var(--transition); font-size: 1rem; }
        .back-btn:hover { border-color: var(--gold-color); color: var(--gold-color); }
        .page-title-bar h2 { font-size: 1.4rem; font-weight: 800; color: var(--navy-color); }

        /* Alerts */
        .alert-success { background: linear-gradient(135deg, #d4edda, #c3e6cb); color: #155724; padding: 16px 22px; border-radius: 14px; margin-bottom: 25px; border-left: 4px solid #28a745; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 10px; }
        .alert-error { background: linear-gradient(135deg, #f8d7da, #f1aeb5); color: #842029; padding: 16px 22px; border-radius: 14px; margin-bottom: 25px; border-left: 4px solid var(--error-color); font-weight: 600; font-size: 0.85rem; display: flex; align-items: center; gap: 10px; }

        /* --- SIDEBAR NAV --- */
        .settings-layout { display: flex; gap: 28px; align-items: flex-start; }
        .settings-sidebar { flex: 0 0 240px; background: white; border-radius: 20px; padding: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); position: sticky; top: 90px; }
        .sidebar-item { display: flex; align-items: center; gap: 12px; padding: 14px 18px; border-radius: 14px; cursor: pointer; transition: var(--transition); font-size: 0.88rem; font-weight: 600; color: var(--text-gray); border: none; background: none; width: 100%; text-align: left; font-family: 'Poppins', sans-serif; }
        .sidebar-item:hover { background: var(--bg-color); color: var(--navy-color); }
        .sidebar-item.active { background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); color: white; box-shadow: 0 4px 15px rgba(13,17,48,0.25); }
        .sidebar-item i { width: 20px; text-align: center; font-size: 1rem; }
        .sidebar-item.active i { color: var(--gold-color); }
        .sidebar-item.danger { color: var(--error-color); }
        .sidebar-item.danger:hover { background: #fef2f2; }

        .settings-content { flex: 1; }

        /* --- SECTION CARD --- */
        .section-card { background: white; border-radius: 22px; padding: 36px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 24px; display: none; }
        .section-card.active { display: block; animation: fadeUp 0.3s ease; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }

        .section-title { font-size: 1.1rem; font-weight: 800; color: var(--navy-color); margin-bottom: 6px; display: flex; align-items: center; gap: 10px; }
        .section-title i { color: var(--gold-color); }
        .section-subtitle { color: var(--text-gray); font-size: 0.85rem; margin-bottom: 28px; }

        /* --- TOGGLE --- */
        .setting-row { display: flex; align-items: center; justify-content: space-between; padding: 18px 0; border-bottom: 1px solid #f3f4f6; }
        .setting-row:last-child { border-bottom: none; }
        .setting-info { flex: 1; }
        .setting-info h4 { font-size: 0.92rem; font-weight: 700; color: var(--navy-color); margin-bottom: 3px; }
        .setting-info p { font-size: 0.8rem; color: var(--text-gray); }

        .toggle-switch { position: relative; width: 52px; height: 28px; flex-shrink: 0; }
        .toggle-switch input { opacity: 0; width: 0; height: 0; }
        .toggle-slider {
            position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0;
            background-color: #e5e7eb; border-radius: 50px; transition: var(--transition);
        }
        .toggle-slider::before {
            content: ''; position: absolute; height: 22px; width: 22px; left: 3px; bottom: 3px;
            background-color: white; border-radius: 50%; transition: var(--transition);
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        .toggle-switch input:checked + .toggle-slider { background: linear-gradient(135deg, var(--gold-color), var(--gold-light)); }
        .toggle-switch input:checked + .toggle-slider::before { transform: translateX(24px); }

        /* --- SELECT --- */
        .setting-select {
            padding: 10px 38px 10px 14px; border: 2px solid #eef0f3; border-radius: 12px;
            font-family: 'Poppins', sans-serif; font-size: 0.85rem; color: var(--text-dark);
            transition: var(--transition); background: #fafbfc; outline: none;
            appearance: none; cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 14px center;
        }
        .setting-select:focus { border-color: var(--gold-color); box-shadow: 0 0 0 3px var(--gold-glow); }

        /* --- CONNECTED ACCOUNTS --- */
        .account-row { display: flex; align-items: center; justify-content: space-between; padding: 18px 0; border-bottom: 1px solid #f3f4f6; }
        .account-row:last-child { border-bottom: none; }
        .account-left { display: flex; align-items: center; gap: 14px; }
        .account-icon { width: 46px; height: 46px; border-radius: 14px; display: flex; justify-content: center; align-items: center; font-size: 1.3rem; }
        .account-icon.google { background: #fef2f2; color: #ea4335; }
        .account-icon.facebook { background: #eff6ff; color: #1877f2; }
        .account-info h4 { font-size: 0.9rem; font-weight: 700; color: var(--navy-color); }
        .account-info p { font-size: 0.78rem; color: var(--text-gray); }

        .btn-connect { padding: 9px 20px; border-radius: 12px; font-family: 'Poppins', sans-serif; font-size: 0.82rem; font-weight: 600; cursor: pointer; transition: var(--transition); border: 2px solid #e5e7eb; background: white; color: var(--text-dark); }
        .btn-connect:hover { border-color: var(--gold-color); color: var(--gold-color); }
        .btn-connected { padding: 9px 20px; border-radius: 12px; font-family: 'Poppins', sans-serif; font-size: 0.82rem; font-weight: 600; border: none; background: linear-gradient(135deg, #d4edda, #c3e6cb); color: #155724; display: flex; align-items: center; gap: 6px; }

        /* --- DANGER ZONE --- */
        .danger-zone { border: 2px solid #fecaca; border-radius: 18px; padding: 28px; background: #fef2f2; }
        .danger-title { color: var(--error-color); font-size: 1rem; font-weight: 800; margin-bottom: 6px; display: flex; align-items: center; gap: 8px; }
        .danger-title i { font-size: 1.1rem; }
        .danger-desc { font-size: 0.85rem; color: #991b1b; margin-bottom: 20px; line-height: 1.6; }

        .input-delete { width: 100%; padding: 14px 16px; border: 2px solid #fecaca; border-radius: 14px; font-size: 0.9rem; font-family: 'Poppins', sans-serif; color: var(--text-dark); transition: var(--transition); background: white; outline: none; margin-bottom: 16px; }
        .input-delete:focus { border-color: var(--error-color); box-shadow: 0 0 0 3px rgba(227,52,47,0.15); }
        .input-delete::placeholder { color: #d4a0a0; }

        .btn-delete { background: linear-gradient(135deg, #dc2626, #b91c1c); color: white; border: none; padding: 14px 28px; border-radius: 14px; font-weight: 700; font-size: 0.88rem; cursor: pointer; transition: var(--transition); font-family: 'Poppins', sans-serif; display: inline-flex; align-items: center; gap: 8px; }
        .btn-delete:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(220,38,38,0.3); }

        .btn-save { background: linear-gradient(135deg, var(--gold-color), var(--gold-light)); color: var(--navy-color); border: none; padding: 15px 35px; border-radius: 14px; font-weight: 700; font-size: 0.92rem; cursor: pointer; transition: var(--transition); font-family: 'Poppins', sans-serif; box-shadow: 0 4px 15px var(--gold-glow); display: inline-flex; align-items: center; gap: 8px; }
        .btn-save:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(201,168,76,0.4); }

        .form-actions { display: flex; justify-content: flex-end; margin-top: 28px; }

        /* Responsive */
        @media (max-width: 768px) {
            .settings-layout { flex-direction: column; }
            .settings-sidebar { width: 100%; position: static; flex-direction: row; display: flex; overflow-x: auto; gap: 6px; padding: 8px; }
            .sidebar-item { white-space: nowrap; padding: 10px 16px; font-size: 0.82rem; }
            .section-card { padding: 24px; }
        }
    </style>
    @include('partials.footer-css')
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">

    @include('partials.navbar-css')
    @include('partials.navbar')

    <main class="main-container">
        <div class="page-title-bar">
            <a href="{{ request('from') === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="back-btn"><i class="fa-solid fa-chevron-left"></i></a>
            <h2>{{ __('Pengaturan') }}</h2>
        </div>

        @if(session('success'))
            <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}</div>
        @endif

        <div class="settings-layout">
            {{-- Sidebar --}}
            <div class="settings-sidebar">
                <button class="sidebar-item active" onclick="showSection('notifikasi', this)"><i class="fa-solid fa-bell"></i> {{ __('Notifikasi') }}</button>
                <button class="sidebar-item" onclick="showSection('bahasa', this)"><i class="fa-solid fa-globe"></i> {{ __('Bahasa') }}</button>
                <button class="sidebar-item" onclick="showSection('tampilan', this)"><i class="fa-solid fa-palette"></i> {{ __('Tampilan') }}</button>
                <button class="sidebar-item" onclick="showSection('privasi', this)"><i class="fa-solid fa-shield-halved"></i> {{ __('Privasi') }}</button>
                <button class="sidebar-item" onclick="showSection('akun', this)"><i class="fa-solid fa-link"></i> {{ __('Akun Terhubung') }}</button>
                <button class="sidebar-item danger" onclick="showSection('hapus', this)"><i class="fa-solid fa-trash-can"></i> {{ __('Hapus Akun') }}</button>
            </div>

            <div class="settings-content">

                {{-- ========== 1. NOTIFIKASI ========== --}}
                <form action="{{ route('settings.update', ['from' => request('from')]) }}" method="POST">
                    @csrf @method('PUT')

                    <div id="section-notifikasi" class="section-card active">
                        <h3 class="section-title"><i class="fa-solid fa-bell"></i> {{ __('Notifikasi') }}</h3>
                        <p class="section-subtitle">{{ __('Atur notifikasi email yang ingin Anda terima.') }}</p>

                        <div class="setting-row">
                            <div class="setting-info">
                                <h4>{{ __('Promo & Penawaran') }}</h4>
                                <p>{{ __('Dapatkan info promo paket umroh dan haji terbaru.') }}</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="notif_promo" value="1" {{ $settings['notif_promo'] ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="setting-row">
                            <div class="setting-info">
                                <h4>{{ __('Update Paket') }}</h4>
                                <p>{{ __('Notifikasi saat ada paket baru atau perubahan jadwal.') }}</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="notif_update_paket" value="1" {{ $settings['notif_update_paket'] ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="setting-row">
                            <div class="setting-info">
                                <h4>{{ __('Pengingat Keberangkatan') }}</h4>
                                <p>{{ __('Reminder sebelum tanggal keberangkatan Anda.') }}</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="notif_keberangkatan" value="1" {{ $settings['notif_keberangkatan'] ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>

                    {{-- ========== 2. BAHASA ========== --}}
                    <div id="section-bahasa" class="section-card">
                        <h3 class="section-title"><i class="fa-solid fa-globe"></i> {{ __('Bahasa') }}</h3>
                        <p class="section-subtitle">{{ __('Pilih bahasa tampilan aplikasi.') }}</p>

                        <div class="setting-row">
                            <div class="setting-info">
                                <h4>{{ __('Bahasa Tampilan') }}</h4>
                                <p>{{ __('Pilih bahasa yang digunakan pada halaman.') }}</p>
                            </div>
                            <select name="bahasa" class="setting-select">
                                <option value="id" {{ $settings['bahasa'] == 'id' ? 'selected' : '' }}>🇮🇩 Bahasa Indonesia</option>
                                <option value="en" {{ $settings['bahasa'] == 'en' ? 'selected' : '' }}>🇬🇧 English</option>
                            </select>
                        </div>
                    </div>

                    {{-- ========== 3. TAMPILAN ========== --}}
                    <div id="section-tampilan" class="section-card">
                        <h3 class="section-title"><i class="fa-solid fa-palette"></i> {{ __('Tampilan') }}</h3>
                        <p class="section-subtitle">{{ __('Sesuaikan tampilan aplikasi.') }}</p>

                        <div class="setting-row">
                            <div class="setting-info">
                                <h4>{{ __('Mode Gelap') }}</h4>
                                <p>{{ __('Aktifkan tampilan gelap untuk kenyamanan mata di malam hari.') }}</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="dark_mode" value="1" id="darkModeToggle" {{ $settings['dark_mode'] ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>

                    {{-- ========== 4. PRIVASI ========== --}}
                    <div id="section-privasi" class="section-card">
                        <h3 class="section-title"><i class="fa-solid fa-shield-halved"></i> {{ __('Privasi & Keamanan') }}</h3>
                        <p class="section-subtitle">{{ __('Kontrol visibilitas informasi pribadi Anda.') }}</p>

                        <div class="setting-row">
                            <div class="setting-info">
                                <h4>{{ __('Tampilkan Email') }}</h4>
                                <p>{{ __('Izinkan orang lain melihat alamat email Anda.') }}</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="show_email" value="1" {{ $settings['show_email'] ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="setting-row">
                            <div class="setting-info">
                                <h4>{{ __('Tampilkan Nomor Telepon') }}</h4>
                                <p>{{ __('Izinkan orang lain melihat nomor telepon Anda.') }}</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="show_phone" value="1" {{ $settings['show_phone'] ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>

                    {{-- Save Button (shared by all settings tabs above) --}}
                    <div id="save-btn-container" class="form-actions" style="display: block;">
                        <button type="submit" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> {{ __('Simpan Pengaturan') }}</button>
                    </div>
                    </div>
                </form>

                {{-- ========== 5. AKUN TERHUBUNG ========== --}}
                <div id="section-akun" class="section-card">
                    <h3 class="section-title"><i class="fa-solid fa-link"></i> {{ __('Akun Terhubung') }}</h3>
                    <p class="section-subtitle">{{ __('Hubungkan akun pihak ketiga untuk login lebih mudah.') }}</p>

                    <div class="account-row">
                        <div class="account-left">
                            <div class="account-icon google"><i class="fa-brands fa-google"></i></div>
                            <div class="account-info">
                                <h4>Google</h4>
                                <p>{{ __('Login cepat dengan akun Google Anda.') }}</p>
                            </div>
                        </div>
                        <button class="btn-connect" onclick="alert('{{ __('Fitur ini akan segera tersedia.') }}')"><i class="fa-solid fa-plug"></i> {{ __('Hubungkan') }}</button>
                    </div>

                </div>

                {{-- ========== 7. HAPUS AKUN ========== --}}
                <div id="section-hapus" class="section-card">
                    <div class="danger-zone">
                        <h3 class="danger-title"><i class="fa-solid fa-triangle-exclamation"></i> {{ __('Zona Berbahaya') }}</h3>
                        <p class="danger-desc">
                            {{ __('Menghapus akun bersifat <strong>permanen</strong> dan tidak dapat dibatalkan.') }}
                            {{ __('Semua data pribadi, riwayat pemesanan, dan pengaturan Anda akan hilang selamanya.') }}
                            {{ __('Pastikan Anda yakin sebelum melanjutkan.') }}
                        </p>

                        <form action="{{ route('settings.delete-account') }}" method="POST" onsubmit="return confirm('PERINGATAN: Akun Anda akan dihapus secara permanen. Lanjutkan?')">
                            @csrf @method('DELETE')
                            <input type="password" name="password" class="input-delete" placeholder="{{ __('Masukkan password Anda untuk konfirmasi') }}" required>
                            <button type="submit" class="btn-delete"><i class="fa-solid fa-trash-can"></i> {{ __('Hapus Akun Saya') }}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>

    @include('partials.footer')

    <script>
        function toggleProfileDropdown() {
            document.getElementById("profileMenu").classList.toggle("show");
        }
        window.onclick = function(event) {
            if (!event.target.closest('.profile-dropdown')) {
                document.querySelectorAll('.dropdown-menu').forEach(d => d.classList.remove('show'));
            }
        }

        function showSection(name, btn) {
            document.querySelectorAll('.section-card').forEach(s => s.classList.remove('active'));
            document.getElementById('section-' + name).classList.add('active');
            document.querySelectorAll('.sidebar-item').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const saveBtnContainer = document.getElementById('save-btn-container');
            const hideSaveFor = ['akun', 'tentang', 'hapus'];
            saveBtnContainer.style.display = hideSaveFor.includes(name) ? 'none' : 'block';
        }

        // Live dark mode preview toggle
        const darkToggle = document.getElementById('darkModeToggle');
        if (darkToggle) {
            darkToggle.addEventListener('change', function() {
                document.body.classList.toggle('dark-mode', this.checked);
            });
        }
    </script>
    @include('partials.chatbot')
</body>
</html>


