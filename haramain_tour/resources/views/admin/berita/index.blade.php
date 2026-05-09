<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita - Admin Haramain Tour</title>
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

        .table-card { background: var(--card-bg); border-radius: 20px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); overflow-x: auto; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); color: var(--gold-color); padding: 16px; text-align: left; font-size: 0.82rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .data-table td { padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.04); font-size: 0.88rem; vertical-align: middle; }
        .data-table tr:hover { background-color: rgba(201,168,76,0.04); }
        
        .status-badge { padding: 5px 14px; border-radius: 50px; font-size: 0.75rem; font-weight: 700; }
        .status-badge.published { background: rgba(16,185,129,0.1); color: #059669; }
        .status-badge.draft { background: rgba(107,114,128,0.1); color: #4b5563; }
        
        .action-flex { display: flex; gap: 8px; }
        .btn-action { width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; border-radius: 8px; text-decoration: none; font-size: 0.85rem; transition: var(--transition); border: none; cursor: pointer; }
        .btn-action.edit { background: rgba(59,130,246,0.1); color: #2563eb; }
        .btn-action.edit:hover { background: #2563eb; color: white; }
        .btn-action.delete { background: rgba(239,68,68,0.1); color: #dc2626; }
        .btn-action.delete:hover { background: #dc2626; color: white; }

        .pagination-wrapper { padding: 20px; display: flex; justify-content: center; }
        .pagination-wrapper svg { width: 20px; height: 20px; }


    </style>
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">

    @include('partials.navbar-css')
    @include('partials.navbar')

    <main class="main-container">
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 16px; border-radius: 12px; margin-bottom: 20px; font-weight: 600;">{{ session('success') }}</div>
        @endif

        <div class="page-header">
            <div class="page-header-left">
                <a href="{{ route('admin.dashboard') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
                <div class="page-title">
                    <h1><i class="fa-solid fa-newspaper" style="color: var(--gold-color);"></i> Kelola Berita</h1>
                    <p>Kelola artikel dan pengumuman untuk jamaah</p>
                </div>
            </div>
            <a href="{{ route('admin.berita.create') }}" class="add-btn"><i class="fa-solid fa-plus"></i> Tambah Berita</a>
        </div>

        <div class="table-card">
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th>Judul Berita</th>
                        <th>Penulis</th>
                        <th>Tanggal Terbit</th>
                        <th>Status</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritas as $berita)
                    <tr>
                        <td>{{ $berita->id }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                @if($berita->thumbnail)
                                <img loading="lazy" src="{{ asset('storage/' . $berita->thumbnail) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                @else
                                <div style="width: 50px; height: 50px; background: #f3f4f6; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #9ca3af;"><i class="fa-solid fa-image"></i></div>
                                @endif
                                <strong>{{ $berita->judul }}</strong>
                            </div>
                        </td>
                        <td>{{ $berita->user->name ?? 'Unknown' }}</td>
                        <td>{{ $berita->created_at->format('d M Y') }}</td>
                        <td>
                            <span class="status-badge {{ $berita->status }}">{{ ucfirst($berita->status) }}</span>
                        </td>
                        <td>
                            <div class="action-flex">
                                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn-action edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action delete" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #6b7280;">Daftar berita masih kosong. Mulai tulis artikel pertama Anda!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>



    @include('partials.chatbot')
</body>
</html>


