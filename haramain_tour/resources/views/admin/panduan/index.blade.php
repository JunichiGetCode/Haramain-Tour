<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Panduan Ibadah - Admin Haramain Tour</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --bg-color: #f5f3ee; --navy-color: #0d1130; --navy-light: #283375; --gold-color: #c9a84c; --text-dark: #2c2c2c; --text-gray: #6b7280; --card-bg: #ffffff; --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); }
        .main-container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .page-header { display: flex; align-items: center; gap: 15px; margin-bottom: 30px; }
        .back-btn { width: 42px; height: 42px; display: flex; justify-content: center; align-items: center; border-radius: 12px; background: var(--card-bg); color: var(--navy-color); text-decoration: none; border: 1px solid rgba(0,0,0,0.06); }
        .back-btn:hover { background: var(--gold-color); }
        .page-title h1 { font-size: 1.5rem; font-weight: 800; color: var(--navy-color); }
        .page-title p { font-size: 0.85rem; color: var(--text-gray); }
        .success-alert { background: #d4edda; color: #155724; padding: 16px; border-radius: 12px; margin-bottom: 20px; font-weight: 600; }

        .steps-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 20px; }
        .step-card { background: var(--card-bg); border-radius: 20px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.04); transition: var(--transition); }
        .step-card:hover { transform: translateY(-4px); box-shadow: 0 8px 30px rgba(0,0,0,0.08); }
        .step-header { background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); padding: 20px; color: white; }
        .step-label { background: var(--gold-color); color: var(--navy-color); padding: 4px 14px; border-radius: 50px; font-size: 0.7rem; font-weight: 800; display: inline-block; margin-bottom: 10px; text-transform: uppercase; }
        .step-header h3 { font-size: 1.15rem; font-weight: 700; margin-bottom: 6px; }
        .step-header p { font-size: 0.8rem; color: rgba(255,255,255,0.7); line-height: 1.5; }
        .step-body { padding: 20px; }
        .step-meta { display: flex; align-items: center; gap: 8px; font-size: 0.8rem; color: var(--text-gray); margin-bottom: 12px; }
        .step-meta i { color: var(--gold-color); }
        .section-preview { font-size: 0.78rem; color: var(--text-gray); margin-bottom: 15px; line-height: 1.6; }
        .btn-edit-step { background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); color: var(--gold-color); padding: 10px 20px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 0.82rem; display: inline-flex; align-items: center; gap: 8px; transition: var(--transition); }
        .btn-edit-step:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(13,17,48,0.25); }
    </style>
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">
    @include('partials.navbar-css')
    @include('partials.navbar')

    <main class="main-container">
        @if(session('success'))
            <div class="success-alert">{{ session('success') }}</div>
        @endif

        <div class="page-header">
            <a href="{{ route('admin.dashboard') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
            <div class="page-title">
                <h1><i class="fa-solid fa-book-quran" style="color: var(--gold-color);"></i> Kelola Panduan Ibadah</h1>
                <p>Edit langkah-langkah panduan umroh untuk aplikasi mobile</p>
            </div>
        </div>

        <div class="steps-grid">
            @foreach($steps as $step)
            <div class="step-card">
                <div class="step-header">
                    <span class="step-label">{{ $step->step_label }}</span>
                    <h3>{{ $step->title }}</h3>
                    <p>{{ $step->description }}</p>
                </div>
                <div class="step-body">
                    <div class="step-meta">
                        <i class="fa-solid fa-{{ $step->icon }}"></i>
                        <span>Icon: {{ $step->icon }}</span>
                        <span style="margin-left: auto;">{{ count($step->sections ?? []) }} section</span>
                    </div>
                    <div class="section-preview">
                        @foreach(($step->sections ?? []) as $section)
                            <strong>{{ $section['title'] ?? '' }}</strong>: {{ count($section['items'] ?? []) }} item<br>
                        @endforeach
                    </div>
                    <a href="{{ route('admin.panduan.edit', $step->id) }}" class="btn-edit-step">
                        <i class="fa-solid fa-pen-to-square"></i> Edit Panduan
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </main>
    @include('partials.chatbot')
</body>
</html>
