<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - Admin Haramain Tour</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            --card-bg: #ffffff;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', 'Segoe UI', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); }

        .main-container { max-width: 1500px; margin: 30px auto; padding: 0 20px; min-height: 70vh; }

        .page-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 30px; flex-wrap: wrap; gap: 15px;
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

        .page-title h1 {
            font-size: 1.5rem; font-weight: 800; color: var(--navy-color);
            display: flex; align-items: center; gap: 10px;
        }
        .page-title h1 i { color: var(--gold-color); }
        .page-title p {
            font-size: 0.85rem; color: var(--text-gray); font-weight: 500;
        }

        /* Summary Card */
        .summary-card {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            border-radius: 20px; padding: 35px 40px; color: white;
            margin-bottom: 30px; position: relative; overflow: hidden;
            display: flex; align-items: center; justify-content: space-between;
        }

        .summary-card::after {
            content: ''; position: absolute; right: -50px; top: -50px;
            width: 200px; height: 200px;
            background: radial-gradient(circle, var(--gold-glow) 0%, transparent 70%);
            border-radius: 50%;
        }

        .summary-info h3 {
            font-size: 1.1rem; font-weight: 600; color: rgba(255,255,255,0.8); margin-bottom: 8px;
        }

        .summary-info .amount {
            font-size: 2.5rem; font-weight: 800; color: var(--gold-color);
            text-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        /* Filter Section */
        .filter-section {
            background: var(--card-bg); padding: 20px 25px; border-radius: 16px;
            margin-bottom: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            display: flex; gap: 15px; align-items: flex-end;
        }

        .filter-group {
            display: flex; flex-direction: column; gap: 6px;
        }

        .filter-group label {
            font-size: 0.85rem; font-weight: 600; color: var(--text-gray);
        }

        .filter-input {
            padding: 10px 16px; border-radius: 10px; border: 1px solid rgba(0,0,0,0.1);
            font-size: 0.9rem; outline: none; transition: var(--transition);
        }

        .filter-input:focus { border-color: var(--gold-color); box-shadow: 0 0 0 3px var(--gold-glow); }

        .btn-filter, .btn-print {
            padding: 10px 24px; border-radius: 10px; font-weight: 700; font-size: 0.9rem;
            cursor: pointer; border: none; transition: var(--transition);
            display: inline-flex; align-items: center; gap: 8px;
            text-decoration: none;
        }

        .btn-filter {
            background: var(--gold-color); color: var(--navy-color);
        }

        .btn-filter:hover {
            transform: translateY(-2px); box-shadow: 0 4px 15px var(--gold-glow);
        }

        .btn-print {
            background: rgba(59, 130, 246, 0.1); color: #2563eb; margin-left: auto;
        }

        .btn-print:hover {
            background: #2563eb; color: white; transform: translateY(-2px);
        }

        /* Table */
        .table-card {
            background: var(--card-bg); border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .table-wrapper { overflow-x: auto; }

        .data-table { width: 100%; border-collapse: collapse; }
        .data-table thead { background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); }
        .data-table th {
            padding: 16px 20px; text-align: left; color: var(--gold-color);
            font-size: 0.85rem; font-weight: 700; text-transform: uppercase; white-space: nowrap;
        }
        .data-table tbody tr { border-bottom: 1px solid rgba(0,0,0,0.04); transition: var(--transition); }
        .data-table tbody tr:hover { background: rgba(201,168,76,0.04); }
        .data-table td { padding: 16px 20px; font-size: 0.9rem; color: var(--text-dark); vertical-align: middle; }

        .badge-status {
            padding: 6px 14px; border-radius: 50px; font-size: 0.75rem; font-weight: 700;
        }
        .badge-status.paid {
            background: rgba(16, 185, 129, 0.1); color: #059669; border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .amount-td { font-weight: 700; color: var(--navy-color); }

        .empty-state { text-align: center; padding: 60px 20px; color: var(--text-gray); }
        .empty-state i { font-size: 3rem; color: var(--gold-color); margin-bottom: 15px; display: block; }
        
        .footer { background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); padding: 30px 20px; color: white; margin-top: 50px; text-align: center; font-size: 0.9rem; }

        @media (max-width: 768px) {
            .filter-section { flex-wrap: wrap; }
            .btn-print { margin-left: 0; width: 100%; justify-content: center; margin-top: 10px; }
            .summary-card { flex-direction: column; text-align: center; gap: 20px; }
        }
    </style>
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">

    @include('partials.navbar-css')
    @include('partials.navbar')

    <main class="main-container">
        
        <div class="page-header">
            <div class="page-header-left">
                <a href="{{ route('admin.dashboard') }}" class="back-btn">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div class="page-title">
                    <h1><i class="fa-solid fa-file-invoice-dollar"></i> Laporan Keuangan</h1>
                    <p>Lihat dan cetak rincian pendapatan dari pendaftaran</p>
                </div>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-info">
                <h3>Total Pendapatan (Paid)</h3>
                <div class="amount">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            </div>
            <i class="fa-solid fa-wallet" style="font-size: 4rem; opacity: 0.2;"></i>
        </div>

        <form action="{{ route('admin.laporan') }}" method="GET" class="filter-section">
            <div class="filter-group">
                <label>Dari Tanggal</label>
                <input type="date" name="start_date" class="filter-input" value="{{ request('start_date') }}">
            </div>
            <div class="filter-group">
                <label>Sampai Tanggal</label>
                <input type="date" name="end_date" class="filter-input" value="{{ request('end_date') }}">
            </div>
            <button type="submit" class="btn-filter"><i class="fa-solid fa-filter"></i> Filter</button>
            <a href="{{ route('admin.laporan.pdf', request()->all()) }}" class="btn-print"><i class="fa-solid fa-file-pdf"></i> Export PDF</a>
        </form>

        <div class="table-card">
            <div class="table-wrapper">
                @if($pembayarans->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Jamaah</th>
                            <th>Paket</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayarans as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <strong>{{ $item->pendaftaran->nama_lengkap ?? '-' }}</strong><br>
                                <span style="font-size: 0.8rem; color: #6b7280;">{{ $item->pendaftaran->user->email ?? '' }}</span>
                            </td>
                            <td>{{ $item->pendaftaran->paket->nama ?? '-' }}</td>
                            <td>{{ $item->pendaftaran->metode_pembayaran_label ?? '-' }}</td>
                            <td>
                                @if($item->amount >= ($item->pendaftaran->paket->harga ?? 0))
                                    <span class="badge-status paid">Lunas</span>
                                @else
                                    <span class="badge-status paid" style="background: rgba(245, 158, 11, 0.1); color: #d97706; border-color: rgba(245, 158, 11, 0.2);">Cicilan</span>
                                @endif
                            </td>
                            <td class="amount-td">Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="empty-state">
                    <i class="fa-solid fa-folder-open"></i>
                    <p>Tidak ada data laporan keuangan.</p>
                </div>
                @endif
            </div>
        </div>

    </main>



    <style>
        @media print {
            @page { size: landscape; margin: 10mm; }
            .navbar, .back-btn, .filter-section, .footer, .chatbot-container, .summary-card { display: none !important; }
            body { background: white !important; }
            .main-container { margin: 0; padding: 0; max-width: 100%; box-shadow: none; min-height: auto; }
            .table-card { box-shadow: none; border: none; overflow: visible !important; border-radius: 0; }
            .table-wrapper { overflow-x: visible !important; overflow: visible !important; }
            .page-title h1 { color: black; text-align: center; justify-content: center; margin-bottom: 20px; font-size: 18pt; }
            .page-title h1 i { display: none; }
            .page-title p { display: none; }
            .data-table { border: 1px solid #000; width: 100%; }
            .data-table th, .data-table td { border: 1px solid #000; padding: 8px; font-size: 10pt; color: #000; }
            .data-table thead { background: #f0f0f0 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .data-table th { color: #000 !important; font-weight: bold; }
            .badge-status.paid { border: none; padding: 0; background: transparent; color: #000; }
            .amount-td { color: #000; }
        }
    </style>
</body>
</html>
