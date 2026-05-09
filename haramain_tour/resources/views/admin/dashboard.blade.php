<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Haramain Tour</title>
    <meta name="description" content="Admin Dashboard Haramain Tour - Kelola data dan pengguna.">
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

        /* --- KONTEN UTAMA --- */
        .main-container { max-width: 1500px; margin: 30px auto; padding: 0 20px; }

        /* Welcome Card - Admin Version */
        .welcome-card {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            border-radius: 20px;
            padding: 35px 40px;
            color: white;
            margin-bottom: 35px;
            position: relative;
            overflow: hidden;
        }

        .welcome-card::after {
            content: '';
            position: absolute;
            right: -50px; top: -50px;
            width: 200px; height: 200px;
            background: radial-gradient(circle, var(--gold-glow) 0%, transparent 70%);
            border-radius: 50%;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            left: -30px; bottom: -60px;
            width: 150px; height: 150px;
            background: radial-gradient(circle, rgba(201, 168, 76, 0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .welcome-top { display: flex; justify-content: space-between; align-items: flex-start; position: relative; z-index: 2; }

        .welcome-card h2 {
            font-size: 1.5rem; font-weight: 700; margin-bottom: 6px;
        }
        .welcome-card h2 span { color: var(--gold-color); }
        .welcome-card p {
            font-size: 0.9rem; color: rgba(255, 255, 255, 0.6);
            position: relative; z-index: 2;
        }

        .admin-badge {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color);
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 1px;
            display: flex; align-items: center; gap: 6px;
            box-shadow: 0 4px 15px var(--gold-glow);
        }

        /* Notifikasi */
        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724; padding: 16px 22px;
            border-radius: 14px; margin-bottom: 25px;
            border-left: 4px solid #28a745;
            font-weight: 600; font-size: 0.9rem;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.1);
            display: flex; align-items: center; gap: 10px;
        }
        .alert-error {
            background: linear-gradient(135deg, #fde8e8, #fcd2d2);
            color: #991b1b; padding: 16px 22px;
            border-radius: 14px; margin-bottom: 25px;
            border-left: 4px solid #e3342f;
            font-weight: 600; font-size: 0.9rem;
            box-shadow: 0 4px 12px rgba(227, 52, 47, 0.1);
            display: flex; align-items: center; gap: 10px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 35px;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0,0,0,0.03);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 80px; height: 80px;
            border-radius: 0 0 0 80px;
            opacity: 0.08;
            transition: var(--transition);
        }

        .stat-card:nth-child(1)::before { background: var(--gold-color); }
        .stat-card:nth-child(2)::before { background: #3b82f6; }
        .stat-card:nth-child(3)::before { background: #10b981; }
        .stat-card:nth-child(4)::before { background: #8b5cf6; }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 50px; height: 50px;
            border-radius: 14px;
            display: flex; justify-content: center; align-items: center;
            margin-bottom: 16px;
            font-size: 1.2rem;
        }

        .stat-card:nth-child(1) .stat-icon { background: linear-gradient(135deg, var(--gold-color), var(--gold-light)); color: var(--navy-color); }
        .stat-card:nth-child(2) .stat-icon { background: linear-gradient(135deg, #3b82f6, #60a5fa); color: white; }
        .stat-card:nth-child(3) .stat-icon { background: linear-gradient(135deg, #10b981, #34d399); color: white; }
        .stat-card:nth-child(4) .stat-icon { background: linear-gradient(135deg, #8b5cf6, #a78bfa); color: white; }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--navy-color);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 0.82rem;
            color: var(--text-gray);
            font-weight: 600;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 15px;
            margin-bottom: 35px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 24px;
            border-radius: 14px;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 700;
            transition: var(--transition);
            border: 2px solid transparent;
        }

        .action-btn.primary {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            color: var(--gold-color);
        }
        .action-btn.primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(13, 17, 48, 0.3);
        }

        .action-btn.secondary {
            background: var(--card-bg);
            color: var(--navy-color);
            border-color: var(--gold-color);
        }
        .action-btn.secondary:hover {
            border-color: var(--gold-color);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        /* Section Header */
        .section-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 1.3rem; color: var(--navy-color); font-weight: 800;
            display: flex; align-items: center; gap: 10px;
        }
        .section-title i { color: var(--gold-color); font-size: 1.1rem; }
        .section-badge {
            background: var(--bg-color); color: var(--text-gray);
            padding: 6px 16px; border-radius: 50px;
            font-size: 0.78rem; font-weight: 600;
        }

        /* Recent Users Table */
        .table-card {
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            margin-bottom: 40px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
        }

        .data-table thead th {
            padding: 16px 20px;
            text-align: left;
            color: var(--gold-color);
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .data-table tbody tr {
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
            transition: var(--transition);
        }

        .data-table tbody tr:hover {
            background-color: rgba(201, 168, 76, 0.04);
        }

        .data-table tbody td {
            padding: 16px 20px;
            font-size: 0.88rem;
            color: var(--text-dark);
            vertical-align: middle;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 38px; height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            display: flex; justify-content: center; align-items: center;
            color: var(--gold-color);
            font-size: 0.85rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .user-info-text strong {
            display: block;
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--navy-color);
        }

        .user-info-text small {
            font-size: 0.78rem;
            color: var(--text-gray);
        }

        .role-badge {
            padding: 4px 14px;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .role-badge.admin {
            background: linear-gradient(135deg, rgba(201, 168, 76, 0.15), rgba(201, 168, 76, 0.08));
            color: #b8941f;
            border: 1px solid rgba(201, 168, 76, 0.3);
        }

        .role-badge.user {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.05));
            color: #2563eb;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .date-text {
            font-size: 0.82rem;
            color: var(--text-gray);
        }

        .table-actions {
            display: flex;
            gap: 8px;
        }

        .btn-sm {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-sm.edit {
            background: rgba(59, 130, 246, 0.1);
            color: #2563eb;
        }
        .btn-sm.edit:hover {
            background: #2563eb;
            color: white;
        }

        .btn-sm.danger {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }
        .btn-sm.danger:hover {
            background: #dc2626;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-gray);
        }
        .empty-state i {
            font-size: 3rem;
            color: var(--gold-color);
            margin-bottom: 15px;
            display: block;
        }

        /* View All Link */
        .view-all-link {
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            color: var(--gold-color);
            font-size: 0.85rem;
            font-weight: 700;
            transition: var(--transition);
        }
        .view-all-link:hover {
            color: var(--navy-color);
            gap: 10px;
        }

        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
        .modal-overlay.show { display: flex; }

        .modal-content {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 35px;
            max-width: 420px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            animation: modalIn 0.3s ease;
        }

        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.9) translateY(20px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }

        .modal-content h3 {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--navy-color);
            margin-bottom: 10px;
        }

        .modal-content p {
            font-size: 0.88rem;
            color: var(--text-gray);
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .modal-btn {
            padding: 10px 24px;
            border-radius: 12px;
            font-size: 0.88rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            font-family: 'Poppins', sans-serif;
        }

        .modal-btn.cancel {
            background: var(--bg-color);
            color: var(--text-dark);
        }
        .modal-btn.cancel:hover { background: #e5e2dc; }

        .modal-btn.confirm-delete {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
        }
        .modal-btn.confirm-delete:hover {
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
            transform: translateY(-2px);
        }

        /* --- FOOTER --- */
        .footer {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            padding: 50px 20px 30px;
            color: white;
            margin-top: 50px;
        }
        .footer-content { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 40px; margin-bottom: 35px; }
        .footer-brand h3 { font-size: 1.4rem; font-weight: 800; color: var(--gold-color); margin-bottom: 12px; letter-spacing: 1px; }
        .footer-brand p { font-size: 0.85rem; color: rgba(255, 255, 255, 0.6); line-height: 1.6; max-width: 300px; }
        .footer-links h4 { font-size: 0.95rem; font-weight: 700; margin-bottom: 15px; color: var(--gold-color); }
        .footer-links ul { list-style: none; }
        .footer-links li { margin-bottom: 8px; }
        .footer-links a { color: rgba(255, 255, 255, 0.6); text-decoration: none; font-size: 0.85rem; transition: var(--transition); }
        .footer-links a:hover { color: var(--gold-color); padding-left: 5px; }
        .footer-social { display: flex; gap: 12px; margin-top: 20px; }
        .footer-social a { width: 40px; height: 40px; border-radius: 50%; border: 1px solid rgba(255, 255, 255, 0.2); display: flex; justify-content: center; align-items: center; color: rgba(255, 255, 255, 0.6); text-decoration: none; transition: var(--transition); }
        .footer-social a:hover { background: var(--gold-color); color: var(--navy-color); border-color: var(--gold-color); transform: translateY(-3px); }
        .footer-bottom { text-align: center; padding-top: 25px; border-top: 1px solid rgba(255, 255, 255, 0.1); font-size: 0.82rem; color: rgba(255, 255, 255, 0.4); }

        /* Responsive */
        @media (max-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .navbar { flex-wrap: wrap; gap: 12px; justify-content: center; padding: 12px 15px; }
            .search-bar { order: 3; max-width: 100%; margin: 0; }
            .nav-icons { order: 2; }
            .stats-grid { grid-template-columns: 1fr; }
            .quick-actions { grid-template-columns: 1fr; }
            .welcome-top { flex-direction: column; gap: 15px; }
            .welcome-card { padding: 25px; }
            .welcome-card h2 { font-size: 1.2rem; }
            .dropdown-menu { right: -50px; }
            .footer-content { grid-template-columns: 1fr; gap: 30px; text-align: center; }
            .footer-brand p { max-width: 100%; margin: 0 auto; }
            .footer-social { justify-content: center; }
            .data-table thead th, .data-table tbody td { padding: 12px 14px; font-size: 0.82rem; }
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

        @if(session('error'))
            <div class="alert-error">
                <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
            </div>
        @endif

        {{-- Welcome Card Admin --}}
        <div class="welcome-card">
            <div class="welcome-top">
                <div>
                    <h2>{{ __('Assalamualaikum,') }} <span>{{ Auth::user()->name ?? 'Admin' }}</span> 👋</h2>
                    <p>{{ __('Selamat datang di Panel Admin. Kelola data dan pengguna dari sini.') }}</p>
                </div>
                <div class="admin-badge">
                    <i class="fa-solid fa-shield-halved"></i> ADMIN
                </div>
            </div>
        </div>

        {{-- Statistics --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="stat-number">{{ $totalUsers }}</div>
                <div class="stat-label">Total Pengguna</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div class="stat-number">{{ $totalAdmins }}</div>
                <div class="stat-label">Total Admin</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-file-signature"></i>
                </div>
                <div class="stat-number">{{ $totalPendaftaran }}</div>
                <div class="stat-label">Total Pendaftaran</div>
            </div>
        </div>

        {{-- Pendaftaran Alert --}}
        @if($pendaftaranPending > 0)
        <div style="background: linear-gradient(135deg, rgba(245,158,11,0.1), rgba(245,158,11,0.04)); border: 1px solid rgba(245,158,11,0.2); border-radius: 14px; padding: 16px 22px; margin-bottom: 25px; display: flex; align-items: center; gap: 12px;">
            <i class="fa-solid fa-bell" style="color: #f59e0b; font-size: 1.2rem;"></i>
            <span style="font-weight: 600; font-size: 0.9rem; color: #92400e;">Ada <strong>{{ $pendaftaranPending }}</strong> pendaftaran yang menunggu review Anda!</span>
            <a href="{{ route('admin.pendaftaran.index', ['status' => 'pending']) }}" style="margin-left: auto; background: #f59e0b; color: white; padding: 8px 18px; border-radius: 10px; text-decoration: none; font-size: 0.82rem; font-weight: 700; transition: all 0.3s ease;">Review Sekarang</a>
        </div>
        @endif

        {{-- Quick Actions --}}
        <div class="quick-actions">
            <a href="{{ route('admin.users') }}" class="action-btn secondary">
                <i class="fa-solid fa-users-gear" style="color: var(--gold-color);"></i> Kelola Pengguna
            </a>
            <a href="{{ route('admin.pendaftaran.index') }}" class="action-btn secondary">
                <i class="fa-solid fa-file-signature" style="color: var(--gold-color);"></i> Kelola Pendaftaran
                @if($pendaftaranPending > 0)
                    <span style="background: var(--gold-color); color: white; padding: 2px 10px; border-radius: 50px; font-size: 0.72rem; font-weight: 800; margin-left: 5px;">{{ $pendaftaranPending }}</span>
                @endif
            </a>
            <a href="{{ route('admin.laporan') }}" class="action-btn secondary">
                <i class="fa-solid fa-file-invoice-dollar" style="color: var(--gold-color);"></i> Kelola Laporan Keuangan
            </a>
            <a href="{{ route('admin.pakets.index') }}" class="action-btn secondary">
                <i class="fa-solid fa-box-open" style="color: var(--gold-color);"></i> Kelola Paket
            </a>
            <a href="{{ route('admin.berita.index') }}" class="action-btn secondary">
                <i class="fa-solid fa-newspaper" style="color: var(--gold-color);"></i> Kelola Berita
            </a>
            <a href="{{ route('admin.doa.index') }}" class="action-btn secondary">
                <i class="fa-solid fa-hands-praying" style="color: var(--gold-color);"></i> Kelola Doa
            </a>
            <a href="{{ route('admin.kamus.index') }}" class="action-btn secondary">
                <i class="fa-solid fa-book-open" style="color: var(--gold-color);"></i> Kelola Kamus
            </a>
            <a href="{{ route('admin.panduan.index') }}" class="action-btn secondary">
                <i class="fa-solid fa-book-quran" style="color: var(--gold-color);"></i> Kelola Panduan
            </a>
            <a href="{{ route('admin.mobile_app.index') }}" class="action-btn secondary">
                <i class="fa-solid fa-mobile-screen-button" style="color: var(--gold-color);"></i> Kelola Mobile App
            </a>
            <a href="{{ route('dashboard') }}" class="action-btn secondary">
                <i class="fa-solid fa-house" style="color: var(--gold-color);"></i> Dashboard User
            </a>
            <a href="{{ route('settings', ['from' => 'admin']) }}" class="action-btn secondary">
                <i class="fa-solid fa-gear" style="color: var(--gold-color);"></i> Pengaturan
            </a>
        </div>


        {{-- Recent Users Table --}}
        <div class="section-header">
            <h2 class="section-title"><i class="fa-solid fa-clock-rotate-left"></i> Pengguna Terbaru</h2>
            <a href="{{ route('admin.users') }}" class="view-all-link">
                Lihat Semua <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="table-card">
            <div class="table-wrapper">
                @if($recentUsers->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengguna</th>
                            <th>Role</th>
                            <th>Bergabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentUsers as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="user-info-text">
                                        <strong>{{ $user->name }}</strong>
                                        <small>{{ $user->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="role-badge {{ $user->role }}">{{ $user->role }}</span>
                            </td>
                            <td>
                                <span class="date-text">{{ $user->created_at->format('d M Y') }}</span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    @if($user->role === 'user')
                                    <form action="{{ route('admin.users.updateRole', $user) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="role" value="admin">
                                        <button type="submit" class="btn-sm edit" title="Jadikan Admin">
                                            <i class="fa-solid fa-arrow-up"></i> Admin
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('admin.users.updateRole', $user) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="role" value="user">
                                        <button type="submit" class="btn-sm edit" title="Jadikan User">
                                            <i class="fa-solid fa-arrow-down"></i> User
                                        </button>
                                    </form>
                                    @endif

                                    @if($user->id !== Auth::id())
                                    <button class="btn-sm danger" onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="empty-state">
                    <i class="fa-solid fa-users-slash"></i>
                    <p>Belum ada pengguna terdaftar.</p>
                </div>
                @endif
            </div>
        </div>

    </main>

    {{-- Delete Confirmation Modal --}}
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-content">
            <h3><i class="fa-solid fa-triangle-exclamation" style="color: var(--error-color);"></i> Hapus Pengguna</h3>
            <p>Apakah Anda yakin ingin menghapus pengguna <strong id="deleteUserName"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="modal-actions">
                <button class="modal-btn cancel" onclick="closeDeleteModal()">Batal</button>
                <form id="deleteForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="modal-btn confirm-delete">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>



    <script>
        function toggleProfileDropdown() {
            document.getElementById("profileMenu").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.closest('.profile-dropdown')) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        function confirmDelete(userId, userName) {
            document.getElementById('deleteUserName').textContent = userName;
            document.getElementById('deleteForm').action = '/admin/users/' + userId;
            document.getElementById('deleteModal').classList.add('show');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('show');
        }

        // Close modal on overlay click
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });
    </script>
    @include('partials.chatbot')
</body>
</html>


