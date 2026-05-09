<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Doa - Admin Haramain Tour</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-color: #f5f3ee; --navy-color: #0d1130; --navy-light: #283375;
            --gold-color: #c9a84c; --gold-light: #d6b881; --gold-glow: rgba(201, 168, 76, 0.3);
            --text-dark: #2c2c2c; --text-gray: #6b7280; --card-bg: #ffffff;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); overflow-x: hidden; }
        .main-container { max-width: 1500px; margin: 30px auto; padding: 0 20px; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px; }
        .page-header-left { display: flex; align-items: center; gap: 15px; }
        .back-btn { width: 42px; height: 42px; display: flex; justify-content: center; align-items: center; border-radius: 12px; background: var(--card-bg); color: var(--navy-color); text-decoration: none; border: 1px solid rgba(0,0,0,0.06); }
        .back-btn:hover { background: var(--gold-color); color: var(--navy-color); border-color: var(--gold-color); }
        .page-title h1 { font-size: 1.5rem; font-weight: 800; color: var(--navy-color); }
        .page-title p { font-size: 0.85rem; color: var(--text-gray); }
        .add-btn { background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); color: var(--gold-color); padding: 12px 24px; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 0.88rem; display: flex; align-items: center; gap: 8px; }
        .add-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(13, 17, 48, 0.3); }

        .category-section { margin-bottom: 30px; }
        .category-title { font-size: 1.1rem; font-weight: 700; color: var(--navy-color); margin-bottom: 15px; display: flex; align-items: center; gap: 10px; }
        .category-title .badge { background: var(--gold-color); color: var(--navy-color); font-size: 0.7rem; padding: 3px 10px; border-radius: 50px; font-weight: 700; }

        .table-card { background: var(--card-bg); border-radius: 20px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); overflow-x: auto; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); color: var(--gold-color); padding: 14px 16px; text-align: left; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .data-table td { padding: 14px 16px; border-bottom: 1px solid rgba(0,0,0,0.04); font-size: 0.85rem; vertical-align: middle; }
        .data-table tr:hover { background-color: rgba(201,168,76,0.04); }
        .arabic-text { font-family: 'Traditional Arabic', 'Amiri', serif; font-size: 1.2rem; direction: rtl; text-align: right; line-height: 1.8; }

        .action-flex { display: flex; gap: 8px; }
        .btn-action { width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; border-radius: 8px; text-decoration: none; font-size: 0.85rem; transition: var(--transition); border: none; cursor: pointer; }
        .btn-action.edit { background: rgba(59,130,246,0.1); color: #2563eb; }
        .btn-action.edit:hover { background: #2563eb; color: white; }
        .btn-action.delete { background: rgba(239,68,68,0.1); color: #dc2626; }
        .btn-action.delete:hover { background: #dc2626; color: white; }
        .success-alert { background: #d4edda; color: #155724; padding: 16px; border-radius: 12px; margin-bottom: 20px; font-weight: 600; }
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
            <div class="page-header-left">
                <a href="{{ route('admin.dashboard') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
                <div class="page-title">
                    <h1><i class="fa-solid fa-hands-praying" style="color: var(--gold-color);"></i> Kelola Doa & Dzikir</h1>
                    <p>Kelola konten doa untuk aplikasi mobile</p>
                </div>
            </div>
            <a href="{{ route('admin.doa.create') }}" class="add-btn"><i class="fa-solid fa-plus"></i> Tambah Doa</a>
        </div>

        @foreach($categories as $catId => $catName)
            @php $catDoas = $doas->where('category', $catId); @endphp
            @if($catDoas->count())
            <div class="category-section">
                <div class="category-title">
                    <i class="fa-solid fa-mosque" style="color: var(--gold-color);"></i>
                    {{ $catName }}
                    <span class="badge">{{ $catDoas->count() }} doa</span>
                </div>
                <div class="table-card">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th width="40">#</th>
                                <th>Judul</th>
                                <th width="300">Teks Arab</th>
                                <th>Arti</th>
                                <th width="90">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($catDoas as $doa)
                            <tr>
                                <td>{{ $doa->order }}</td>
                                <td><strong>{{ $doa->title }}</strong></td>
                                <td class="arabic-text">{{ Str::limit($doa->arabic, 60) }}</td>
                                <td style="color: var(--text-gray); font-size: 0.82rem;">{{ Str::limit($doa->translation, 60) }}</td>
                                <td>
                                    <div class="action-flex">
                                        <a href="{{ route('admin.doa.edit', $doa->id) }}" class="btn-action edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                        <form action="{{ route('admin.doa.destroy', $doa->id) }}" method="POST" onsubmit="return confirm('Hapus doa ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-action delete" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        @endforeach
    </main>

    @include('partials.chatbot')
</body>
</html>
