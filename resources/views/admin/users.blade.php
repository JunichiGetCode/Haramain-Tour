<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna - Admin Haramain Tour</title>
    <meta name="description" content="Kelola Pengguna - Admin Dashboard Haramain Tour">
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

        .main-container { max-width: 1500px; margin: 30px auto; padding: 0 20px; }

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

        .page-title h1 {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--navy-color);
        }
        .page-title p {
            font-size: 0.85rem;
            color: var(--text-gray);
            font-weight: 500;
        }

        /* Alert messages */
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

        /* Filter & Search Bar */
        .filter-card {
            background: var(--card-bg);
            border-radius: 18px;
            padding: 20px 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            margin-bottom: 25px;
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-input-wrapper {
            flex: 1;
            min-width: 200px;
            display: flex;
            align-items: center;
            background: var(--bg-color);
            border-radius: 12px;
            padding: 0 16px;
            border: 2px solid transparent;
            transition: var(--transition);
        }
        .search-input-wrapper:focus-within {
            border-color: var(--gold-color);
            background: white;
        }
        .search-input-wrapper i {
            color: var(--text-gray);
            font-size: 0.9rem;
        }
        .search-input-wrapper input {
            border: none;
            background: transparent;
            padding: 12px;
            font-size: 0.88rem;
            outline: none;
            width: 100%;
            color: var(--text-dark);
            font-family: 'Poppins', sans-serif;
        }
        .search-input-wrapper input::placeholder {
            color: var(--text-gray);
        }

        .filter-select {
            padding: 12px 18px;
            border-radius: 12px;
            border: 2px solid transparent;
            background: var(--bg-color);
            font-size: 0.88rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--text-dark);
            cursor: pointer;
            transition: var(--transition);
            outline: none;
        }
        .filter-select:focus {
            border-color: var(--gold-color);
            background: white;
        }

        .filter-btn {
            padding: 12px 24px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            color: var(--gold-color);
            border: none;
            font-size: 0.88rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 17, 48, 0.3);
        }

        .reset-btn {
            padding: 12px 18px;
            border-radius: 12px;
            background: var(--bg-color);
            color: var(--text-gray);
            border: none;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .reset-btn:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        /* Users Count Badge */
        .users-count {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: linear-gradient(135deg, rgba(201, 168, 76, 0.1), rgba(201, 168, 76, 0.05));
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--gold-color);
            border: 1px solid rgba(201, 168, 76, 0.2);
        }

        /* Table */
        .table-card {
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .table-wrapper { overflow-x: auto; }

        .data-table { width: 100%; border-collapse: collapse; }

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

        .user-cell { display: flex; align-items: center; gap: 12px; }
        .user-avatar {
            width: 42px; height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            display: flex; justify-content: center; align-items: center;
            color: var(--gold-color);
            font-size: 0.9rem;
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
            padding: 5px 16px;
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

        .date-text { font-size: 0.82rem; color: var(--text-gray); }

        .contact-text {
            font-size: 0.82rem;
            color: var(--text-gray);
        }

        .table-actions { display: flex; gap: 8px; flex-wrap: wrap; }

        .btn-sm {
            padding: 7px 14px;
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
            gap: 5px;
        }
        .btn-sm.promote {
            background: linear-gradient(135deg, rgba(201, 168, 76, 0.12), rgba(201, 168, 76, 0.06));
            color: #b8941f;
            border: 1px solid rgba(201, 168, 76, 0.25);
        }
        .btn-sm.promote:hover {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color);
            border-color: var(--gold-color);
        }
        .btn-sm.demote {
            background: rgba(59, 130, 246, 0.1);
            color: #2563eb;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }
        .btn-sm.demote:hover {
            background: #2563eb;
            color: white;
            border-color: #2563eb;
        }
        .btn-sm.danger {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        .btn-sm.danger:hover {
            background: #dc2626;
            color: white;
            border-color: #dc2626;
        }

        .self-badge {
            padding: 5px 14px;
            border-radius: 8px;
            font-size: 0.72rem;
            font-weight: 700;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05));
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.2);
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
        .empty-state p {
            font-size: 0.95rem;
            font-weight: 600;
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            padding: 20px;
            gap: 6px;
            flex-wrap: wrap;
        }

        .pagination-wrapper .page-link {
            padding: 8px 14px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.06);
            color: var(--text-dark);
            background: var(--card-bg);
        }
        .pagination-wrapper .page-link:hover {
            background: var(--bg-color);
            border-color: var(--gold-color);
            color: var(--gold-color);
        }
        .pagination-wrapper .page-link.active {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            color: var(--gold-color);
            border-color: var(--navy-color);
        }
        .pagination-wrapper .page-link.disabled {
            opacity: 0.4;
            pointer-events: none;
        }

        /* Modal */
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
            display: flex;
            align-items: center;
            gap: 10px;
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

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            padding: 50px 20px 30px; color: white; margin-top: 50px;
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
        @media (max-width: 768px) {
            .navbar { flex-wrap: wrap; gap: 12px; justify-content: center; padding: 12px 15px; }
            .search-bar { order: 3; max-width: 100%; margin: 0; }
            .nav-icons { order: 2; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .filter-card { flex-direction: column; }
            .search-input-wrapper { min-width: 100%; }
            .dropdown-menu { right: -50px; }
            .data-table thead th, .data-table tbody td { padding: 12px 14px; font-size: 0.82rem; }
            .footer-content { grid-template-columns: 1fr; gap: 30px; text-align: center; }
            .footer-brand p { max-width: 100%; margin: 0 auto; }
            .footer-social { justify-content: center; }
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

        {{-- Page Header --}}
        <div class="page-header">
            <div class="page-header-left">
                <a href="{{ route('admin.dashboard') }}" class="back-btn">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div class="page-title">
                    <h1><i class="fa-solid fa-users-gear" style="color: var(--gold-color);"></i> Kelola Pengguna</h1>
                    <p>Kelola semua data pengguna dari sini</p>
                </div>
            </div>
            <div class="users-count">
                <i class="fa-solid fa-users"></i> {{ $users->total() }} Pengguna
            </div>
        </div>

        {{-- Filter & Search --}}
        <form action="{{ route('admin.users') }}" method="GET" class="filter-card">
            <div class="search-input-wrapper">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" placeholder="Cari nama atau email..."
                       value="{{ request('search') }}">
            </div>
            <select name="role" class="filter-select">
                <option value="">Semua Role</option>
                <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            <button type="submit" class="filter-btn">
                <i class="fa-solid fa-filter"></i> Filter
            </button>
            @if(request('search') || request('role'))
                <a href="{{ route('admin.users') }}" class="reset-btn">
                    <i class="fa-solid fa-xmark"></i> Reset
                </a>
            @endif
        </form>

        {{-- Users Table --}}
        <div class="table-card">
            <div class="table-wrapper">
                @if($users->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengguna</th>
                            <th>Telepon</th>
                            <th>Role</th>
                            <th>Bergabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $index }}</td>
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
                                <span class="contact-text">{{ $user->phone ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="role-badge {{ $user->role }}">{{ $user->role }}</span>
                            </td>
                            <td>
                                <span class="date-text">{{ $user->created_at->format('d M Y') }}</span>
                            </td>
                            <td>
                                @if($user->id === Auth::id())
                                    <span class="self-badge"><i class="fa-solid fa-check"></i> Anda</span>
                                @else
                                    <div class="table-actions">
                                        @if($user->role === 'user')
                                        <form action="{{ route('admin.users.updateRole', $user) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="role" value="admin">
                                            <button type="submit" class="btn-sm promote" title="Jadikan Admin">
                                                <i class="fa-solid fa-shield-halved"></i> Jadikan Admin
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('admin.users.updateRole', $user) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="role" value="user">
                                            <button type="submit" class="btn-sm demote" title="Jadikan User">
                                                <i class="fa-solid fa-user"></i> Jadikan User
                                            </button>
                                        </form>
                                        @endif

                                        <button class="btn-sm danger" onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')" title="Hapus Pengguna">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                @if($users->hasPages())
                <div class="pagination-wrapper">
                    {{-- Previous --}}
                    @if($users->onFirstPage())
                        <span class="page-link disabled"><i class="fa-solid fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="page-link"><i class="fa-solid fa-chevron-left"></i></a>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        @if($page == $users->currentPage())
                            <span class="page-link active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="page-link"><i class="fa-solid fa-chevron-right"></i></a>
                    @else
                        <span class="page-link disabled"><i class="fa-solid fa-chevron-right"></i></span>
                    @endif
                </div>
                @endif

                @else
                <div class="empty-state">
                    <i class="fa-solid fa-users-slash"></i>
                    <p>Tidak ada pengguna yang ditemukan.</p>
                </div>
                @endif
            </div>
        </div>

    </main>

    {{-- Delete Confirmation Modal --}}
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-content">
            <h3><i class="fa-solid fa-triangle-exclamation" style="color: var(--error-color);"></i> Hapus Pengguna</h3>
            <p>Apakah Anda yakin ingin menghapus pengguna <strong id="deleteUserName"></strong>? Semua data pengguna ini akan dihapus secara permanen.</p>
            <div class="modal-actions">
                <button class="modal-btn cancel" onclick="closeDeleteModal()">Batal</button>
                <form id="deleteForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="modal-btn confirm-delete">
                        <i class="fa-solid fa-trash"></i> Hapus Permanen
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
                    if (dropdowns[i].classList.contains('show')) {
                        dropdowns[i].classList.remove('show');
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

        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });
    </script>
    @include('partials.chatbot')
</body>
</html>


