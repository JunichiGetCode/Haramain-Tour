<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan - Haramain Tour</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'DejaVu Sans', 'Segoe UI', Arial, sans-serif;
            font-size: 11px;
            color: #1a1a2e;
            line-height: 1.5;
        }

        .page-container {
            padding: 30px 40px;
        }

        /* Header / Kop Surat */
        .header {
            text-align: center;
            border-bottom: 3px solid #c9a84c;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #0d1130;
            letter-spacing: 2px;
            margin-bottom: 3px;
            font-weight: bold;
        }

        .header p {
            font-size: 10px;
            color: #6b7280;
        }

        .header .doc-title {
            font-size: 16px;
            font-weight: bold;
            color: #c9a84c;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header .subtitle {
            font-size: 10px;
            color: #1a1a2e;
            margin-top: 5px;
        }

        /* Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table th, .data-table td {
            border: 1px solid #e5e7eb;
            padding: 10px 12px;
            font-size: 10px;
            text-align: left;
        }

        .data-table th {
            background-color: #0d1130;
            color: #c9a84c;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9px;
        }

        .data-table tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .data-table .amount-td {
            text-align: right;
            font-weight: bold;
            color: #0d1130;
        }

        .data-table .total-row {
            background-color: #f0ebe3;
            font-weight: bold;
        }

        .data-table .total-row td {
            font-size: 11px;
            color: #0d1130;
            border-top: 2px solid #0d1130;
        }

        /* Badge */
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .badge-paid {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        /* Footer */
        .footer {
            margin-top: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }

        .footer p {
            font-size: 9px;
            color: #9ca3af;
            margin-bottom: 2px;
        }

        .footer .company {
            font-size: 10px;
            font-weight: bold;
            color: #0d1130;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <!-- Header / Kop Surat -->
        <div class="header">
            <h1>HARAMAIN TOUR</h1>
            <p>Biro Perjalanan Umroh & Haji Terpercaya</p>
            <div class="doc-title">Laporan Keuangan Pendapatan</div>
            <div class="subtitle">
                @if(request('start_date') && request('end_date'))
                    Periode: {{ \Carbon\Carbon::parse(request('start_date'))->format('d M Y') }} s/d {{ \Carbon\Carbon::parse(request('end_date'))->format('d M Y') }}
                @elseif(request('start_date'))
                    Dari Tanggal: {{ \Carbon\Carbon::parse(request('start_date'))->format('d M Y') }}
                @elseif(request('end_date'))
                    Sampai Tanggal: {{ \Carbon\Carbon::parse(request('end_date'))->format('d M Y') }}
                @else
                    Periode: Semua Data
                @endif
            </div>
        </div>

        <!-- Data Table -->
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Tanggal</th>
                    <th style="width: 20%;">Nama Jamaah</th>
                    <th style="width: 25%;">Paket Ibadah</th>
                    <th style="width: 15%;">Metode</th>
                    <th style="width: 10%;">Status</th>
                    <th style="width: 15%;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @if($pembayarans->count() > 0)
                    @foreach($pembayarans as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                        <td>{{ $item->pendaftaran->nama_lengkap ?? '-' }}</td>
                        <td>{{ $item->pendaftaran->paket->nama ?? '-' }}</td>
                        <td>{{ $item->pendaftaran->metode_pembayaran_label ?? '-' }}</td>
                        <td>
                            @if($item->amount >= ($item->pendaftaran->paket->harga ?? 0))
                                <span class="badge badge-paid">Lunas</span>
                            @else
                                <span class="badge badge-paid" style="background-color: #fef3c7; color: #92400e; border: 1px solid #fcd34d;">Cicilan</span>
                            @endif
                        </td>
                        <td class="amount-td">Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    <!-- Total Row -->
                    <tr class="total-row">
                        <td colspan="6" style="text-align: right;">TOTAL PENDAPATAN :</td>
                        <td class="amount-td">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 20px;">Tidak ada data laporan keuangan.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Footer -->
        <div class="footer">
            <p class="company">HARAMAIN TOUR</p>
            <p>Dokumen ini digenerate secara otomatis oleh sistem.</p>
            <p>Dicetak pada: {{ now()->format('d F Y, H:i:s') }} WIB</p>
        </div>
    </div>
</body>
</html>
