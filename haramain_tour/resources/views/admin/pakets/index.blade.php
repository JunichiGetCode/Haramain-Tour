<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Paket - Admin Haramain Tour</title>
    <meta name="description" content="Kelola Paket - Admin Dashboard Haramain Tour">
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
            --error-color: #e3342f;
            --card-bg: #ffffff;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', 'Segoe UI', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); overflow-x: hidden; }

        .main-container { max-width: 1500px; margin: 30px auto; padding: 0 30px; }

        /* Breadcrumb & Page Title */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .back-btn {
            width: 42px; height: 42px;
            display: flex; justify-content: center; align-items: center;
            border-radius: 12px;
            background: var(--card-bg);
            color: var(--navy-color);
            text-decoration: none;
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.06);
            font-size: 1rem;
        }
        .back-btn:hover {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color);
            border-color: var(--gold-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px var(--gold-glow);
        }

        .page-title h1 { font-size: 1.5rem; font-weight: 800; color: var(--navy-color); }
        .page-title p { font-size: 0.85rem; color: var(--text-gray); font-weight: 500; }

        .btn-add {
            padding: 12px 24px;
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color);
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            box-shadow: 0 4px 15px var(--gold-glow);
        }
        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(201, 168, 76, 0.4);
        }

        /* Alert messages */
        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724; padding: 16px 22px;
            border-radius: 14px; margin-bottom: 25px;
            border-left: 4px solid #28a745;
            font-weight: 600; font-size: 0.9rem;
        }

        /* Table */
        .table-card {
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            margin-bottom: 30px;
        }
        .table-wrapper { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .data-table { width: 100%; border-collapse: collapse; min-width: 1000px; }
        .data-table thead { background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); }
        .data-table thead th {
            padding: 16px 18px; text-align: left; color: var(--gold-color);
            font-size: 0.82rem; font-weight: 700; text-transform: uppercase; white-space: nowrap;
        }
        .data-table tbody tr { border-bottom: 1px solid rgba(0, 0, 0, 0.04); transition: var(--transition); }
        .data-table tbody tr:hover { background-color: rgba(201, 168, 76, 0.04); }
        .data-table tbody td { padding: 16px 18px; font-size: 0.88rem; color: var(--text-dark); vertical-align: middle; white-space: nowrap; }

        .paket-img { width: 60px; height: 60px; border-radius: 10px; object-fit: cover; flex-shrink: 0; }
        .badge { padding: 5px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; white-space: nowrap; display: inline-block; }
        .badge.reguler { background: rgba(59, 130, 246, 0.1); color: #2563eb; }
        .badge.plus { background: rgba(16, 185, 129, 0.1); color: #059669; }
        .badge.furoda { background: rgba(201, 168, 76, 0.15); color: #b8941f; }
        .badge.haji_basic { background: rgba(139, 92, 246, 0.1); color: #7c3aed; }
        .badge.haji_plus { background: rgba(236, 72, 153, 0.1); color: #db2777; }

        .table-actions { display: flex; gap: 8px; white-space: nowrap; }
        .btn-sm {
            padding: 7px 14px; border-radius: 8px; font-size: 0.78rem; font-weight: 600;
            border: none; cursor: pointer; transition: var(--transition); text-decoration: none;
            display: inline-flex; align-items: center; gap: 5px; white-space: nowrap;
        }
        .btn-sm.edit { background: rgba(59, 130, 246, 0.1); color: #2563eb; }
        .btn-sm.edit:hover { background: #2563eb; color: white; }
        .btn-sm.danger { background: rgba(239, 68, 68, 0.1); color: #dc2626; }
        .btn-sm.danger:hover { background: #dc2626; color: white; }

        .empty-state { text-align: center; padding: 60px 20px; color: var(--text-gray); }
        .empty-state i { font-size: 3rem; color: var(--gold-color); margin-bottom: 15px; display: block; }

        /* Pagination */
        .pagination-wrapper { display: flex; justify-content: center; padding: 20px; gap: 6px; }
        .pagination-wrapper .page-link {
            padding: 8px 14px; border-radius: 10px; font-size: 0.82rem; font-weight: 600;
            text-decoration: none; border: 1px solid rgba(0,0,0,0.06); color: var(--text-dark); background: var(--card-bg);
        }
        .pagination-wrapper .page-link.active {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            color: var(--gold-color); border-color: var(--navy-color);
        }
        .pagination-wrapper svg { width: 20px; height: 20px; }
    </style>
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">

    @include('partials.navbar-css')
    @include('partials.navbar')

    <main class="main-container">
        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <div class="page-header">
            <div class="page-header-left">
                <a href="{{ route('admin.dashboard') }}" class="back-btn">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div class="page-title">
                    <h1><i class="fa-solid fa-box" style="color: var(--gold-color);"></i> Kelola Paket</h1>
                    <p>Daftar semua paket umroh dan haji</p>
                </div>
            </div>
            <a href="{{ route('admin.pakets.create') }}" class="btn-add">
                <i class="fa-solid fa-plus"></i> Tambah Paket Baru
            </a>
        </div>

        <div class="table-card">
            <div class="table-wrapper">
                @if($pakets->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Paket</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Durasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pakets as $paket)
                        <tr>
                            <td>
                                @if($paket->gambar_utama)
                                    <img loading="lazy" src="{{ str_starts_with($paket->gambar_utama, 'http') ? $paket->gambar_utama : (str_starts_with($paket->gambar_utama, 'storage/') ? asset($paket->gambar_utama) : asset('storage/' . $paket->gambar_utama)) }}" alt="{{ $paket->nama }}" class="paket-img">
                                @else
                                    <div class="paket-img" style="background: #e0e0e0; display:flex; align-items:center; justify-content:center;">
                                        <i class="fa-solid fa-image" style="color: #9e9e9e;"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong style="color: var(--navy-color); display:block;">{{ $paket->nama }}</strong>
                                @if($paket->status_populer)<span style="font-size:0.7rem; color: #e67e22;"><i class="fa-solid fa-fire"></i> Populer</span>@endif
                                @if($paket->status_premium)<span style="font-size:0.7rem; color: #f39c12;"><i class="fa-solid fa-crown"></i> Premium</span>@endif
                            </td>
                            <td><span class="badge {{ $paket->kategori }}">{{ ucwords(str_replace('_', ' ', $paket->kategori)) }}</span></td>
                            <td style="font-weight: 700; color: var(--gold-color);">{{ $paket->harga_rupiah }}</td>
                            <td>{{ $paket->durasi_hari }} Hari</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.pakets.edit', $paket->id) }}" class="btn-sm edit"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    <form action="{{ route('admin.pakets.destroy', $paket->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-sm danger"><i class="fa-solid fa-trash"></i> Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="empty-state">
                    <i class="fa-solid fa-box-open"></i>
                    <p>Belum ada daftar paket.</p>
                </div>
                @endif
            </div>

            @if($pakets->hasPages())
            <div class="pagination-wrapper">
                {{ $pakets->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </main>

    @include('partials.chatbot')
</body>
</html>


