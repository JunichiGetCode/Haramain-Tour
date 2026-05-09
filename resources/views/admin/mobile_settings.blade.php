<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Mobile App - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('partials.dark-mode')
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
            --border-color: rgba(0,0,0,0.1);
            --transition: all 0.3s ease;
        }
        body { background-color: var(--bg-color); color: var(--text-dark); font-family: 'Poppins', sans-serif; margin: 0; }
        .main-container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        
        .page-header {
            display: flex; align-items: center; gap: 15px; margin-bottom: 30px;
        }
        .back-btn {
            background: white; width: 45px; height: 45px; border-radius: 12px;
            display: flex; justify-content: center; align-items: center;
            color: var(--navy-color); text-decoration: none; font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: var(--transition);
        }
        .back-btn:hover { background: var(--navy-color); color: white; transform: translateX(-5px); }
        .page-title h1 { font-size: 1.5rem; color: var(--navy-color); font-weight: 800; margin: 0; }
        .page-title p { color: var(--text-gray); font-size: 0.9rem; margin: 5px 0 0 0; }
        
        /* Tabs */
        .tabs-container {
            display: flex; gap: 10px; margin-bottom: 25px; overflow-x: auto; padding-bottom: 5px;
        }
        .tab-btn {
            background: white; border: 1px solid var(--border-color); padding: 12px 20px;
            border-radius: 12px; font-family: 'Poppins', sans-serif; font-size: 0.85rem;
            font-weight: 600; color: var(--text-gray); cursor: pointer; transition: var(--transition);
            white-space: nowrap; display: flex; align-items: center; gap: 8px;
        }
        .tab-btn:hover { border-color: var(--gold-color); color: var(--gold-color); }
        .tab-btn.active { background: var(--navy-color); color: var(--gold-color); border-color: var(--navy-color); }
        
        .settings-card {
            background: var(--card-bg); border-radius: 20px; padding: 35px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid var(--border-color);
            margin-bottom: 30px;
        }
        
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        
        .section-title {
            font-size: 1.2rem; color: var(--navy-color); font-weight: 700;
            margin-bottom: 20px; border-bottom: 2px solid var(--bg-color);
            padding-bottom: 10px; display: flex; align-items: center; gap: 10px;
        }
        .section-title i { color: var(--gold-color); }
        
        .form-grid {
            display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;
        }
        .form-group { margin-bottom: 20px; }
        .form-group.full-width { grid-column: span 2; }
        
        .form-label { display: block; font-weight: 600; margin-bottom: 8px; color: var(--navy-color); font-size: 0.9rem; }
        .form-control {
            width: 100%; padding: 12px 16px; border-radius: 10px;
            border: 2px solid var(--border-color); background: #f9fafb;
            font-family: 'Poppins', sans-serif; font-size: 0.9rem; transition: var(--transition);
            box-sizing: border-box;
        }
        .form-control:focus { border-color: var(--gold-color); outline: none; background: white; box-shadow: 0 0 0 4px rgba(201,168,76,0.1); }
        
        /* Toggle Switch */
        .toggle-item {
            display: flex; align-items: center; justify-content: space-between;
            background: #f9fafb; padding: 15px 20px; border-radius: 12px;
            border: 1px solid var(--border-color); transition: var(--transition);
        }
        .toggle-item:hover { border-color: var(--gold-color); background: white; }
        .toggle-info { flex: 1; margin-right: 15px; }
        .toggle-info strong { display: block; color: var(--navy-color); font-size: 0.9rem; }
        .toggle-info small { color: var(--text-gray); font-size: 0.8rem; }
        
        .toggle-switch {
            position: relative; display: inline-block; width: 46px; height: 24px; flex-shrink: 0;
        }
        .toggle-switch input { opacity: 0; width: 0; height: 0; }
        .slider {
            position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0;
            background-color: #ccc; transition: .4s; border-radius: 24px;
        }
        .slider:before {
            position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px;
            background-color: white; transition: .4s; border-radius: 50%;
        }
        input:checked + .slider { background-color: var(--gold-color); }
        input:checked + .slider:before { transform: translateX(22px); }
        
        .btn-submit {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            color: white; padding: 14px 30px; border-radius: 12px;
            font-size: 1rem; font-weight: 700; border: none; cursor: pointer;
            transition: var(--transition); width: 100%; display: flex; justify-content: center; align-items: center; gap: 10px;
        }
        .btn-submit:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(13,17,48,0.2); }
        
        .alert-success {
            background: #d1fae5; color: #065f46; padding: 15px 20px; border-radius: 12px;
            margin-bottom: 25px; font-weight: 600; display: flex; align-items: center; gap: 10px;
        }
        
        .barcode-preview {
            background: var(--bg-color); padding: 25px; border-radius: 16px;
            text-align: center; margin-top: 20px; border: 1px dashed var(--gold-color);
        }
        .barcode-preview img {
            border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin-top: 15px;
            background: white; padding: 10px;
        }
        
        @media (max-width: 768px) {
            .form-grid { grid-template-columns: 1fr; }
            .form-group.full-width { grid-column: span 1; }
        }
    </style>
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">
    @include('partials.navbar-css')
    @include('partials.navbar')

    <div class="main-container">
        <div class="page-header">
            <a href="{{ route('admin.dashboard') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
            <div class="page-title">
                <h1>Pengaturan Mobile App</h1>
                <p>Kelola fitur, tampilan, dan sinkronisasi konten aplikasi mobile jamaah.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="tabs-container">
            <button class="tab-btn active" onclick="switchTab('umum')"><i class="fa-solid fa-sliders"></i> Umum</button>
            <button class="tab-btn" onclick="switchTab('fitur')"><i class="fa-solid fa-cubes"></i> Fitur Mobile</button>
            <button class="tab-btn" onclick="switchTab('tampilan')"><i class="fa-solid fa-palette"></i> Tampilan</button>
            <button class="tab-btn" onclick="switchTab('keamanan')"><i class="fa-solid fa-shield-halved"></i> Keamanan</button>
            <button class="tab-btn" onclick="switchTab('kontak')"><i class="fa-solid fa-phone"></i> Kontak Darurat</button>
        </div>

        <form action="{{ route('admin.mobile_app.store') }}" method="POST">
            @csrf
            
            <div class="settings-card">
                <!-- TAB: UMUM -->
                <div id="tab-umum" class="tab-content active">
                    <div class="section-title"><i class="fa-solid fa-sliders"></i> Pengaturan Umum</div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Nama Aplikasi</label>
                            <input type="text" name="app_name" class="form-control" value="{{ $config['app_name'] ?? 'HaramainQu' }}" placeholder="Contoh: HaramainQu">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Versi Minimum</label>
                            <input type="text" name="min_version" class="form-control" value="{{ $config['min_version'] ?? '1.0.0' }}" placeholder="Contoh: 1.0.0">
                            <small style="color: var(--text-gray);">Digunakan untuk force update jika versi app terlalu lama.</small>
                        </div>
                        <div class="form-group full-width">
                            <label class="form-label">Link Aplikasi Mobile (PlayStore / AppStore / APK)</label>
                            <input type="url" name="app_link" class="form-control" value="{{ $config['app_link'] ?? '' }}" placeholder="https://play.google.com/store/apps/details?id=com.haramain.app">
                            <small style="color: var(--text-gray);">Link ini akan digunakan untuk membuat Barcode (QR Code).</small>
                        </div>
                    </div>

                    <div class="form-group full-width" style="margin-top: 15px;">
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <strong>Tampilkan Barcode di Dokumen Persetujuan</strong>
                                <small>Jika aktif, jamaah yang pendaftarannya disetujui akan melihat Barcode / Link untuk mengunduh aplikasi.</small>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="show_barcode" value="1" {{ !empty($config['show_barcode']) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    @if(!empty($config['app_link']) && !empty($config['show_barcode']))
                    <div class="barcode-preview">
                        <h4 style="color: var(--navy-color); margin: 0 0 5px 0;">Preview QR Code Aplikasi</h4>
                        <p style="color: var(--text-gray); font-size: 0.85rem; margin: 0;">Ini adalah barcode yang akan tampil di halaman persetujuan jamaah.</p>
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($config['app_link']) }}&margin=10" alt="QR Code App">
                    </div>
                    @endif
                </div>

                <!-- TAB: FITUR -->
                <div id="tab-fitur" class="tab-content">
                    <div class="section-title"><i class="fa-solid fa-cubes"></i> Fitur Aplikasi Mobile</div>
                    <p style="color: var(--text-gray); font-size: 0.9rem; margin-bottom: 20px;">Aktifkan atau nonaktifkan fitur yang tersedia di aplikasi mobile jamaah.</p>
                    
                    <div style="display: grid; gap: 15px;">
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <strong>Panduan Ibadah</strong>
                                <small>Sinkronisasi konten tata cara umroh lengkap.</small>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="feature_panduan" value="1" {{ ($config['feature_panduan'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <strong>Kamus Bahasa Arab</strong>
                                <small>Kosa kata penting untuk jamaah di tanah suci.</small>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="feature_kamus" value="1" {{ ($config['feature_kamus'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <strong>Doa-Doa Penting</strong>
                                <small>Kumpulan doa rujukan selama ibadah.</small>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="feature_doa" value="1" {{ ($config['feature_doa'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <strong>Berita & Info</strong>
                                <small>Update berita terbaru dari admin web ke mobile.</small>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="feature_berita" value="1" {{ ($config['feature_berita'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>


                <!-- TAB: TAMPILAN -->
                <div id="tab-tampilan" class="tab-content">
                    <div class="section-title"><i class="fa-solid fa-palette"></i> Tampilan & Branding</div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Warna Primer App</label>
                            <input type="color" name="primary_color" class="form-control" value="{{ $config['primary_color'] ?? '#0d1130' }}" style="height: 45px; padding: 5px;">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Warna Sekunder App</label>
                            <input type="color" name="secondary_color" class="form-control" value="{{ $config['secondary_color'] ?? '#c9a84c' }}" style="height: 45px; padding: 5px;">
                        </div>
                        <div class="form-group full-width">
                            <label class="form-label">Pesan Selamat Datang</label>
                            <input type="text" name="welcome_message" class="form-control" value="{{ $config['welcome_message'] ?? 'Selamat datang di HaramainQu' }}" placeholder="Teks yang muncul di dashboard mobile.">
                        </div>
                    </div>
                </div>

                <!-- TAB: KEAMANAN -->
                <div id="tab-keamanan" class="tab-content">
                    <div class="section-title"><i class="fa-solid fa-shield-halved"></i> Keamanan & Autentikasi</div>
                    
                    <div style="display: grid; gap: 15px;">
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <strong>Aktifkan Login dengan Google</strong>
                                <small>Izinkan jamaah login menggunakan akun Google di mobile app.</small>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="google_login_enabled" value="1" {{ ($config['google_login_enabled'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <strong>Wajib Akun Pembeli Paket</strong>
                                <small>Hanya akun yang telah membeli paket dan disetujui yang bisa login ke aplikasi mobile.</small>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="require_active_package" value="1" {{ ($config['require_active_package'] ?? true) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- TAB: KONTAK -->
                <div id="tab-kontak" class="tab-content">
                    <div class="section-title"><i class="fa-solid fa-phone"></i> Kontak Darurat & Bantuan</div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Nomor Pembimbing (Muthawwif)</label>
                            <input type="text" name="emergency_phone_1" class="form-control" value="{{ $config['emergency_phone_1'] ?? '' }}" placeholder="+62812345678">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor Kantor Pusat</label>
                            <input type="text" name="emergency_phone_2" class="form-control" value="{{ $config['emergency_phone_2'] ?? '' }}" placeholder="+62812345678">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor Lokal Saudi</label>
                            <input type="text" name="emergency_phone_3" class="form-control" value="{{ $config['emergency_phone_3'] ?? '' }}" placeholder="+96650123456">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Link WhatsApp Group Rombongan</label>
                            <input type="url" name="whatsapp_group_link" class="form-control" value="{{ $config['whatsapp_group_link'] ?? '' }}" placeholder="https://chat.whatsapp.com/...">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-save"></i> Simpan Semua Pengaturan
            </button>
        </form>
    </div>

    <script>
        function switchTab(tabId) {
            // Remove active class from all tabs and contents
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            
            // Add active class to selected tab and content
            event.currentTarget.classList.add('active');
            document.getElementById('tab-' + tabId).classList.add('active');
        }
    </script>
    
    @include('partials.chatbot')
</body>
</html>
