<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Konten Mobile - Admin Dashboard</title>
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
            display: flex; gap: 10px; margin-bottom: 25px;
        }
        .tab-btn {
            background: white; border: 1px solid var(--border-color); padding: 12px 20px;
            border-radius: 12px; font-family: 'Poppins', sans-serif; font-size: 0.85rem;
            font-weight: 600; color: var(--text-gray); cursor: pointer; transition: var(--transition);
            display: flex; align-items: center; gap: 8px;
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
            margin-bottom: 10px; display: flex; align-items: center; gap: 10px;
        }
        .section-title i { color: var(--gold-color); }
        
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-weight: 600; margin-bottom: 8px; color: var(--navy-color); font-size: 0.9rem; }
        
        .json-editor {
            width: 100%; height: 500px; padding: 15px; border-radius: 10px;
            border: 2px solid var(--border-color); background: #1e1e1e;
            color: #d4d4d4; font-family: 'Courier New', Courier, monospace;
            font-size: 0.9rem; transition: var(--transition);
            box-sizing: border-box; resize: vertical;
        }
        .json-editor:focus { border-color: var(--gold-color); outline: none; }
        
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
        
        .alert-warning {
            background: #fef3c7; color: #92400e; padding: 15px 20px; border-radius: 12px;
            margin-bottom: 25px; font-size: 0.85rem; border-left: 4px solid #f59e0b;
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
                <h1>Kelola Konten Mobile</h1>
                <p>Edit konten panduan, kamus, dan doa dalam format JSON untuk disinkronisasikan ke aplikasi mobile.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="alert-warning">
            <i class="fa-solid fa-triangle-exclamation"></i> <strong>Perhatian:</strong> Anda sedang mengedit data mentah (JSON). Pastikan format JSON valid (tidak ada tanda koma berlebih, kurung kurawal lengkap, dll). Kesalahan format dapat menyebabkan aplikasi mobile gagal membaca data.
        </div>

        <div class="tabs-container">
            <button class="tab-btn active" onclick="switchTab('panduan')"><i class="fa-solid fa-book-quran"></i> Panduan Ibadah</button>
            <button class="tab-btn" onclick="switchTab('kamus')"><i class="fa-solid fa-language"></i> Kamus Arab</button>
            <button class="tab-btn" onclick="switchTab('doa')"><i class="fa-solid fa-hands-praying"></i> Doa-Doa</button>
        </div>

        <!-- TAB: PANDUAN -->
        <div id="tab-panduan" class="tab-content active">
            <div class="settings-card">
                <div class="section-title"><i class="fa-solid fa-book-quran"></i> Konten Panduan Ibadah</div>
                <p style="color: var(--text-gray); font-size: 0.85rem; margin-bottom: 15px;">Data ini digunakan untuk halaman Panduan di aplikasi mobile.</p>
                
                <form action="{{ route('admin.mobile_content.update_panduan') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="json_content" class="json-editor">{{ $panduan }}</textarea>
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-save"></i> Simpan Konten Panduan
                    </button>
                </form>
            </div>
        </div>

        <!-- TAB: KAMUS -->
        <div id="tab-kamus" class="tab-content">
            <div class="settings-card">
                <div class="section-title"><i class="fa-solid fa-language"></i> Konten Kamus Arab</div>
                <p style="color: var(--text-gray); font-size: 0.85rem; margin-bottom: 15px;">Data ini digunakan untuk halaman Kamus di aplikasi mobile.</p>
                
                <form action="{{ route('admin.mobile_content.update_kamus') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="json_content" class="json-editor">{{ $kamus }}</textarea>
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-save"></i> Simpan Konten Kamus
                    </button>
                </form>
            </div>
        </div>

        <!-- TAB: DOA -->
        <div id="tab-doa" class="tab-content">
            <div class="settings-card">
                <div class="section-title"><i class="fa-solid fa-hands-praying"></i> Konten Doa-Doa Penting</div>
                <p style="color: var(--text-gray); font-size: 0.85rem; margin-bottom: 15px;">Data ini digunakan untuk halaman Doa di aplikasi mobile.</p>
                
                <form action="{{ route('admin.mobile_content.update_doa') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="json_content" class="json-editor">{{ $doa }}</textarea>
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-save"></i> Simpan Konten Doa
                    </button>
                </form>
            </div>
        </div>
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
        
        // Simple JSON validation on submit
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const textarea = this.querySelector('textarea');
                try {
                    JSON.parse(textarea.value);
                } catch (error) {
                    alert('Format JSON tidak valid! Silakan periksa kembali tanda koma atau kurung yang kurang.\n\nError: ' + error.message);
                    e.preventDefault();
                }
            });
        });
    </script>
    
    @include('partials.chatbot')
</body>
</html>
