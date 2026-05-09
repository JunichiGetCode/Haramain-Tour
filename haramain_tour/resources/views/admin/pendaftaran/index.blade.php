<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pendaftaran - Admin Haramain Tour</title>
    <meta name="description" content="Admin - Kelola pendaftaran paket umroh dan haji.">
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

        .page-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 25px; flex-wrap: wrap; gap: 15px;
        }
        .page-header-left {
            display: flex; align-items: center; gap: 15px;
        }
        .back-btn {
            width: 42px; height: 42px;
            display: flex; justify-content: center; align-items: center;
            border-radius: 12px; background: var(--card-bg); color: var(--navy-color);
            text-decoration: none; transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.06); font-size: 1rem;
        }
        .back-btn:hover {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color); border-color: var(--gold-color);
            transform: translateY(-2px); box-shadow: 0 4px 15px var(--gold-glow);
        }
        .page-title h1 { font-size: 1.5rem; font-weight: 800; color: var(--navy-color); display: flex; align-items: center; gap: 10px; }
        .page-title h1 i { color: var(--gold-color); }
        .page-title p { font-size: 0.85rem; color: var(--text-gray); font-weight: 500; }

        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724; padding: 16px 22px;
            border-radius: 14px; margin-bottom: 25px;
            border-left: 4px solid #28a745;
            font-weight: 600; font-size: 0.9rem;
            display: flex; align-items: center; gap: 10px;
        }

        /* Stats Mini */
        .stats-mini {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 25px;
        }
        .stat-mini {
            background: var(--card-bg); border-radius: 16px; padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04); text-align: center;
            transition: var(--transition); border: 1px solid rgba(0,0,0,0.03);
        }
        .stat-mini:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
        .stat-mini .stat-num { font-size: 1.8rem; font-weight: 800; color: var(--navy-color); }
        .stat-mini .stat-lbl { font-size: 0.78rem; color: var(--text-gray); font-weight: 600; }
        .stat-mini:nth-child(1) .stat-num { color: #f59e0b; }
        .stat-mini:nth-child(2) .stat-num { color: #10b981; }
        .stat-mini:nth-child(3) .stat-num { color: #ef4444; }

        /* Filter Bar */
        .filter-bar {
            display: flex; gap: 12px; margin-bottom: 20px; flex-wrap: wrap; align-items: center;
        }
        .filter-bar form { display: flex; gap: 12px; flex-wrap: wrap; flex: 1; }
        .filter-input {
            padding: 10px 16px; border: 2px solid rgba(0,0,0,0.06); border-radius: 12px;
            font-family: 'Poppins', sans-serif; font-size: 0.85rem; outline: none;
            transition: var(--transition); background: var(--card-bg);
        }
        .filter-input:focus { border-color: var(--gold-color); }
        .filter-select { min-width: 160px; }
        .btn-filter {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            color: var(--gold-color); border: none; padding: 10px 20px;
            border-radius: 12px; font-size: 0.85rem; font-weight: 700;
            cursor: pointer; font-family: 'Poppins', sans-serif; transition: var(--transition);
        }
        .btn-filter:hover { transform: translateY(-2px); }

        .table-card {
            background: var(--card-bg); border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04); overflow: hidden;
        }
        .table-wrapper { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .data-table { width: 100%; border-collapse: collapse; min-width: 1100px; }
        .data-table thead { background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); }
        .data-table thead th {
            padding: 16px 18px; text-align: left; color: var(--gold-color);
            font-size: 0.78rem; font-weight: 700; letter-spacing: 0.5px;
            text-transform: uppercase; white-space: nowrap;
        }
        .data-table tbody tr { border-bottom: 1px solid rgba(0,0,0,0.04); transition: var(--transition); }
        .data-table tbody tr:hover { background-color: rgba(201,168,76,0.04); }
        .data-table tbody td { padding: 16px 18px; font-size: 0.85rem; vertical-align: middle; white-space: nowrap; }

        .user-cell { display: flex; align-items: center; gap: 12px; min-width: 200px; }
        .user-avatar {
            width: 38px; height: 38px; border-radius: 12px;
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            display: flex; align-items: center; justify-content: center;
            color: var(--gold-color); font-weight: 700; font-size: 0.85rem; flex-shrink: 0;
        }
        .user-info-text strong { display: block; font-size: 0.85rem; font-weight: 700; color: var(--navy-color); white-space: nowrap; }
        .user-info-text small { font-size: 0.75rem; color: var(--text-gray); white-space: nowrap; }

        .status-badge {
            padding: 4px 14px; border-radius: 50px; font-size: 0.72rem;
            font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;
            white-space: nowrap; display: inline-block;
        }
        .status-badge.pending {
            background: rgba(245,158,11,0.12); color: #d97706; border: 1px solid rgba(245,158,11,0.25);
        }
        .status-badge.approved {
            background: rgba(16,185,129,0.12); color: #059669; border: 1px solid rgba(16,185,129,0.25);
        }
        .status-badge.rejected {
            background: rgba(239,68,68,0.12); color: #dc2626; border: 1px solid rgba(239,68,68,0.25);
        }

        /* Payment Status Badges */
        .payment-badge {
            padding: 3px 10px; border-radius: 50px; font-size: 0.65rem;
            font-weight: 700; letter-spacing: 0.3px; display: inline-block; margin-top: 4px;
            white-space: nowrap;
        }
        .payment-badge.unpaid { background: rgba(245,158,11,0.1); color: #d97706; border: 1px solid rgba(245,158,11,0.2); }
        .payment-badge.paid { background: rgba(16,185,129,0.1); color: #059669; border: 1px solid rgba(16,185,129,0.2); }
        .payment-badge.partial { background: rgba(59,130,246,0.1); color: #2563eb; border: 1px solid rgba(59,130,246,0.2); }

        .payment-badge.expired { background: rgba(107,114,128,0.1); color: #6b7280; border: 1px solid rgba(107,114,128,0.2); }
        .payment-badge.failed { background: rgba(239,68,68,0.1); color: #dc2626; border: 1px solid rgba(239,68,68,0.2); }

        .btn-sm {
            padding: 8px 16px; border-radius: 10px; font-size: 0.78rem; font-weight: 600;
            border: none; cursor: pointer; transition: var(--transition);
            font-family: 'Poppins', sans-serif; text-decoration: none;
            display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;
        }
        .btn-sm.view { background: rgba(59,130,246,0.1); color: #2563eb; }
        .btn-sm.view:hover { background: #2563eb; color: white; }

        .empty-state {
            text-align: center; padding: 60px 20px; color: var(--text-gray);
        }
        .empty-state i { font-size: 3rem; color: var(--gold-color); margin-bottom: 15px; display: block; }

        .pagination-wrapper { padding: 20px; display: flex; justify-content: center; }
        .pagination-wrapper nav > div:first-child { display: none; }
        .pagination-wrapper svg { width: 20px; height: 20px; }

        @media (max-width: 768px) {
            .stats-mini { grid-template-columns: 1fr; }
            .filter-bar form { flex-direction: column; }
            .data-table thead th, .data-table tbody td { padding: 12px 14px; font-size: 0.8rem; }
        }
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
                <a href="{{ route('admin.dashboard') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
                <div class="page-title">
                    <h1><i class="fa-solid fa-file-signature"></i> Kelola Pendaftaran</h1>
                    <p>Kelola dan review pendaftaran jamaah</p>
                </div>
            </div>
        </div>

        <!-- Stats Mini -->
        <div class="stats-mini">
            <div class="stat-mini">
                <div class="stat-num">{{ $totalPending }}</div>
                <div class="stat-lbl"><i class="fa-solid fa-clock"></i> Menunggu Review</div>
            </div>
            <div class="stat-mini">
                <div class="stat-num">{{ $totalApproved }}</div>
                <div class="stat-lbl"><i class="fa-solid fa-circle-check"></i> Disetujui</div>
            </div>
            <div class="stat-mini">
                <div class="stat-num">{{ $totalRejected }}</div>
                <div class="stat-lbl"><i class="fa-solid fa-circle-xmark"></i> Ditolak</div>
            </div>
        </div>

        <!-- Filter -->
        <div class="filter-bar">
            <form method="GET" action="{{ route('admin.pendaftaran.index') }}">
                <input type="text" name="search" class="filter-input" placeholder="Cari nama jamaah..." value="{{ request('search') }}">
                <select name="status" class="filter-input filter-select">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <button type="submit" class="btn-filter"><i class="fa-solid fa-search"></i> Filter</button>
            </form>
        </div>

        <!-- Table -->
        <div class="table-card">
            <div class="table-wrapper">
                @if($pendaftarans->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jamaah</th>
                            <th>Paket</th>
                            <th>Tanggal Daftar</th>
                            <th>Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftarans as $index => $p)
                        <tr>
                            <td>{{ $pendaftarans->firstItem() + $index }}</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">{{ strtoupper(substr($p->nama_lengkap, 0, 1)) }}</div>
                                    <div class="user-info-text">
                                        <strong>{{ $p->nama_lengkap }}</strong>
                                        <small>{{ $p->user->email ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $p->paket->nama ?? '-' }}</td>
                            <td><span style="color: var(--text-gray); font-size: 0.82rem;">{{ $p->created_at->format('d M Y') }}</span></td>
                            <td>
                                <strong style="color: var(--gold-color); display: block;">{{ $p->jumlah_bayar_rupiah }}</strong>
                                <span class="payment-badge {{ ($p->payment_status === 'unpaid' && $p->total_bayar > 0) ? 'partial' : ($p->payment_status ?? 'unpaid') }}">{{ $p->payment_status_label }}</span>
                            </td>

                            <td><span class="status-badge {{ $p->status }}">{{ $p->status_label }}</span></td>
                            <td>
                                <a href="{{ route('admin.pendaftaran.show', $p->id) }}" class="btn-sm view">
                                    <i class="fa-solid fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="empty-state">
                    <i class="fa-solid fa-folder-open"></i>
                    <p>Belum ada data pendaftaran.</p>
                </div>
                @endif
            </div>

            @if($pendaftarans->hasPages())
            <div class="pagination-wrapper">
                {{ $pendaftarans->withQueryString()->links() }}
            </div>
            @endif
        </div>

    </main>

    <script>
        function toggleProfileDropdown() {
            document.getElementById("profileMenu").classList.toggle("show");
        }
        window.onclick = function(event) {
            if (!event.target.closest('.profile-dropdown')) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    if (dropdowns[i].classList.contains('show')) dropdowns[i].classList.remove('show');
                }
            }
        }
    </script>
    @include('partials.chatbot')
</body>
</html>


