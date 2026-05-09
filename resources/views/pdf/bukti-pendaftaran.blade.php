<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran - Haramain Tour</title>
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

        .page-break {
            page-break-before: always;
        }

        /* Header */
        .header {
            text-align: center;
            border-bottom: 3px solid #c9a84c;
            padding-bottom: 18px;
            margin-bottom: 22px;
        }

        .header h1 {
            font-size: 22px;
            color: #0d1130;
            letter-spacing: 2px;
            margin-bottom: 3px;
        }

        .header p {
            font-size: 10px;
            color: #6b7280;
        }

        .header .doc-title {
            font-size: 15px;
            font-weight: bold;
            color: #c9a84c;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header .kode {
            font-size: 10px;
            color: #6b7280;
            margin-top: 3px;
        }

        /* Section */
        .section {
            margin-bottom: 18px;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #0d1130;
            background: linear-gradient(135deg, #f0ebe3, #faf8f4);
            padding: 7px 12px;
            border-left: 3px solid #c9a84c;
            margin-bottom: 10px;
        }

        /* Table Info */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }

        .info-table td {
            padding: 5px 10px;
            vertical-align: top;
            font-size: 10.5px;
        }

        .info-table .label {
            width: 160px;
            color: #6b7280;
            font-weight: 600;
        }

        .info-table .separator {
            width: 10px;
            text-align: center;
        }

        .info-table .value {
            color: #1a1a2e;
            font-weight: 600;
        }

        /* Status Badges */
        .badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-approved { background-color: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; }
        .badge-pending { background-color: #fef3c7; color: #92400e; border: 1px solid #fcd34d; }
        .badge-rejected { background-color: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .badge-paid { background-color: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; }
        .badge-unpaid { background-color: #fef3c7; color: #92400e; border: 1px solid #fcd34d; }

        /* Perjanjian Section */
        .agreement-box {
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 14px 16px;
            margin-bottom: 12px;
            background: #fafafa;
            font-size: 10px;
            line-height: 1.7;
            color: #374151;
        }

        .agreement-box h4 {
            color: #0d1130;
            margin-bottom: 8px;
            font-size: 11px;
            text-align: center;
        }

        .agreement-box P.subtitle {
            text-align: center;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .agreement-box ol {
            padding-left: 18px;
        }

        .agreement-box ol li {
            margin-bottom: 8px;
            text-align: justify;
        /* Signature */
        .signature-table {
            width: 100%;
            margin-top: 30px;
        }

        .signature-table td {
            width: 50%;
            vertical-align: bottom;
        }

        .signature-section {
            text-align: right; /* Set on the right for official document feel */
        }

        .signature-section .sig-label {
            font-size: 10px;
            color: #6b7280;
            margin-bottom: 5px;
        }

        .signature-section img {
            max-width: 160px;
            max-height: 70px;
            display: block;
            margin-left: auto;
            border-bottom: 1px solid #d1d5db;
        }

        .signature-section .sig-name {
            font-size: 11px;
            font-weight: bold;
            color: #0d1130;
            margin-top: 5px;
        }

        .signature-section .sig-date {
            font-size: 9px;
            color: #9ca3af;
        }

        /* Price Box */
        .price-box {
            background: #0d1130;
            color: white;
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 12px;
        }

        .price-box .price-label {
            font-size: 9px;
            color: #9ca3af;
        }

        .price-box .price-value {
            font-size: 18px;
            font-weight: bold;
            color: #c9a84c;
        }

        /* Footer */
        .footer {
            margin-top: 25px;
            text-align: center;
            border-top: 2px solid #e5e7eb;
            padding-top: 12px;
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
    <!-- PAGE 1: Bukti Registrasi Pribadi & Pembayaran -->
    <div class="page-container">
        <!-- Header -->
        <div class="header">
            <h1>HARAMAIN TOUR</h1>
            <p>Biro Perjalanan Umroh & Haji Terpercaya</p>
            <div class="doc-title">Invoice & Bukti Pendaftaran</div>
            <div class="kode">Kode Pendaftaran: HT-{{ str_pad($pendaftaran->id, 6, '0', STR_PAD_LEFT) }} | Tanggal: {{ $pendaftaran->created_at->format('d F Y, H:i') }} WIB</div>
        </div>

        <!-- Status -->
        <div class="section" style="text-align: center; margin-bottom: 16px;">
            <span class="badge badge-{{ $pendaftaran->status ?? 'pending' }}">
                Status Pendaftaran: {{ $pendaftaran->status_label ?? 'Menunggu Review' }}
            </span>
            &nbsp;&nbsp;
            <span class="badge badge-{{ $pendaftaran->payment_status ?? 'unpaid' }}">
                Pembayaran: {{ $pendaftaran->payment_status_label ?? 'Belum Bayar' }}
            </span>
        </div>

        <!-- Info Paket -->
        <div class="section">
            <div class="section-title">Informasi Paket Ibadah</div>
            <div class="price-box">
                <span class="price-label">Total Harga Paket</span><br>
                <span class="price-value">{{ $pendaftaran->jumlah_bayar_rupiah ?? '-' }}</span>
            </div>
            <table class="info-table">
                <tr>
                    <td class="label">Nama Paket</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $pendaftaran->paket->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Durasi</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $pendaftaran->paket->durasi_hari ?? '-' }} Hari</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Keberangkatan</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $pendaftaran->paket && $pendaftaran->paket->tanggal_keberangkatan ? $pendaftaran->paket->tanggal_keberangkatan->format('d F Y') : '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Hotel Makkah</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $pendaftaran->paket->hotel_makkah ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Hotel Madinah</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $pendaftaran->paket->hotel_madinah ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Metode Pembayaran</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $pendaftaran->metode_pembayaran_label ?? 'Menunggu Pembayaran' }}</td>
                </tr>
            </table>
        </div>

        <!-- Identitas Jamaah -->
        <div class="section">
            <div class="section-title">Data Identitas Jamaah</div>
            <table class="info-table">
                <tr>
                    <td class="label">Nama Lengkap Sesuai KTP</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $pendaftaran->nama_lengkap ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Nomor Induk Kependudukan (NIK)</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $pendaftaran->nik ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Tempat, Tanggal Lahir</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $pendaftaran->tempat_lahir ?? '-' }}, {{ $pendaftaran->tanggal_lahir ? $pendaftaran->tanggal_lahir->format('d F Y') : '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Jenis Kelamin</td>
                    <td class="separator">:</td>
                    <td class="value">{{ ($pendaftaran->jenis_kelamin ?? '') === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <td class="label">No. HP / WhatsApp</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $pendaftaran->no_hp ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Alamat Lengkap</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $pendaftaran->alamat_lengkap ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Golongan Darah</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $pendaftaran->golongan_darah ?? '-' }}</td>
                </tr>
                @if(!empty($pendaftaran->nama_mahram))
                <tr>
                    <td class="label">Nama Mahram</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $pendaftaran->nama_mahram }}</td>
                </tr>
                @endif
                @if(!empty($pendaftaran->riwayat_penyakit))
                <tr>
                    <td class="label">Riwayat Penyakit</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $pendaftaran->riwayat_penyakit }}</td>
                </tr>
                @endif
            </table>
        </div>

        @if(!empty($pendaftaran->catatan_admin))
        <div class="section">
            <div class="section-title">Catatan Reviewer / Admin</div>
            <div class="agreement-box" style="border-left: 4px solid #c9a84c;">
                {{ $pendaftaran->catatan_admin }}
            </div>
        </div>
        @endif

        <div class="footer">
            <p class="company">HARAMAIN TOUR</p>
            <p>Halaman 1/2 - Invoice & Data Pemesan</p>
            <p>Dicetak pada: {{ now()->format('d F Y, H:i:s') }}</p>
        </div>
    </div>


    <!-- PAGE 2: Syarat & Perjanjian Detail dengan Tanda Tangan -->
    <div class="page-break"></div>

    <div class="page-container">
        <!-- Header -->
        <div class="header">
            <h1>HARAMAIN TOUR</h1>
            <p>Biro Perjalanan Umroh & Haji Terpercaya</p>
            <div class="doc-title">Lampiran: Surat Perjanjian & Syarat Ketentuan</div>
        </div>

        <div class="section">
            <p style="text-align: justify; margin-bottom: 12px; font-size: 10px;">
                Dokumen ini merupakan lampiran yang terpisahkan dari bukti registrasi atas nama <strong>{{ $pendaftaran->nama_lengkap ?? '-' }}</strong> tertanggal <strong>{{ $pendaftaran->created_at ? $pendaftaran->created_at->format('d F Y') : '-' }}</strong>.
            </p>
            
            <div class="section-title">Bab I: Pernyataan Pemenuhan Persyaratan Asing</div>
            <div class="agreement-box">
                <ol>
                    <li>Jamaah menyanggupi kepemilikan Paspor dalam keadaan aktif minimal berumur panjang 6 (enam) bulan terhitung sejak tanggal penetapan keberangkatan.</li>
                    <li>Jamaah secara sah akan mengikuti prosedur penyuntikan Vaksinasi Meningitis secara mandiri maupun terkoordinir, yang pada saat keberangkatan dibuktikan pada kepemilikan Buku Kuning (Yellow Fever).</li>
                    <li>Jamaah menyanggupi melampirkan berkas scan/foto KTP Asli dan Pas Foto khusus latar belakang putih terbaru (ukuran 4x6 diperbesar 80% area wajah) maksimum 30 hari sebelum hari Keberangkatan.</li>
                </ol>
            </div>

            <div class="section-title">Bab II: Surat Perjanjian Perjalanan Ibadah Umroh</div>
            <div class="agreement-box">
                <h4>PERJANJIAN PERJALANAN IBADAH UMROH (PPIU)</h4>
                <p class="subtitle">Antara Pihak Haramain Tour dengan Jamaah</p>
                <ol style="margin-top: 10px;">
                    <li><strong>Pasal 1: Biaya dan Pembayaran.</strong> Pelunasan biaya perjalanan harus ditunaikan maksimal H-30 sebelum hari keberangkatan. Harga paket dapat berubah jika terdapat perubahan ekstrem valuta asing atau kebijakan Kerajaan Saudi Arabia di luar kuasa Pihak Tavel.</li>
                    <li><strong>Pasal 2: Dokumen Kelengkapan.</strong> Pihak Travel bertanggung jawab dalam proses urusan Visa, dengan catatan keseluruhan kelengkapan administrasi telah diterima penuh sebelum tempo yang disepakati. Kegagalan jamaah memenuhi timeline dokumen yang berdampak kepada kegagalan terbitnya visa sepenuhnya menjadi resiko jamaah.</li>
                    <li><strong>Pasal 3: Kesehatan dan Keselamatan.</strong> Jamaah menjamin status kesehatan berada di level normal saat pendaftaran. Kepemilikan resiko penyakit berat/kambuhan harap wajib disetakan pada data (riwayat penyakit). Jika terjadi musibah tak terduga selama ibadah atas komplikasi riwayat yang dirahasiakan, biaya RS dsb berada diluar pertanggung jawaban mutlak Travel.</li>
                    <li><strong>Pasal 4: Pembatalan Sepihak.</strong> Pembatalan perjalanan oleh Pihak Jamaah akan dikenakan klausula penalti:
                        <ul>
                            <li>Pembatalan maksimal H-30 dikenakan biaya administrasi 20% dari total tagihan.</li>
                            <li>Pembatalan H-15 hingga H-7 hari dipotong 50%.</li>
                            <li>Pembatalan H-6 ke bawah dianggap hangus (No-Refund).</li>
                        </ul>
                    </li>
                    <li><strong>Pasal 5: Force Majeure.</strong> Keadaan mendesak, bencana alam, wabah darurat, perubahan darurat kebijakan Pemerintah, penolakan visa imigrasi secara teknikal, atau situasi diluar kehendak nalar agen akan diselesaikan dengan perundingan Musyawarah Mufakat antara Jamaah & Pelaksana Tour.</li>
                </ol>
            </div>
            
            <p style="text-align: justify; margin-top: 15px; font-size: 10.5px;">
                Dengan munculnya persetujuan digital / tanda tangan di dokumen cetak ini, Pihak Jamaah menerangkan bahwa Ia hadir dalam keadaan sadar mental, tidak sedang pada paksaan siapa pun, dan bersedia mentaati seluruh pasal yang terkandung dalam ketentuan perundangan Haramain Tour tersebut.
            </p>

            <!-- Tanda Tangan Table Layout for DomPDF compatibility -->
            <table class="signature-table">
                <tr>
                    <td></td>
                    <td>
                        <div class="signature-section">
                            <div class="sig-label">Tanda Tangan Elektronik Jamaah (Sistem)</div>
                            @if(!empty($signatureBase64))
                                <img loading="lazy" src="{{ $signatureBase64 }}" alt="Tanda Tangan Jamaah">
                            @else
                                <!-- Kotak placeholder tanda tangan jika secara kasus tidak ada -->
                                <div style="height: 60px; border-bottom: 1px dotted #999; margin: 10px 0;"></div>
                            @endif
                            <div class="sig-name">{{ $pendaftaran->nama_lengkap ?? 'Jamaah' }}</div>
                            <div class="sig-date">
                                @if($pendaftaran->surat_perjanjian_accepted_at)
                                    Persetujuan Tanggal: <br>{{ $pendaftaran->surat_perjanjian_accepted_at->format('d F Y, H:i') }} WIB
                                @else
                                    Tertanggal: {{ now()->format('d F Y') }}
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer" style="margin-top: 30px;">
            <p class="company">HARAMAIN TOUR</p>
            <p>Halaman 2 - Surat Perjanjian Bersetuju</p>
        </div>
    </div>
</body>
</html>
