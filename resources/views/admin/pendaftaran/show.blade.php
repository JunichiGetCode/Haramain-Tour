<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pendaftaran - Admin Haramain Tour</title>
    <meta name="description" content="Admin - Detail pendaftaran jamaah.">
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

        .page-header {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;
        }
        .page-header h2 {
            color: var(--navy-color); font-weight: 800; font-size: 1.4rem;
            display: flex; align-items: center; gap: 10px;
        }
        .page-header h2 i { color: var(--gold-color); }

        .btn-back {
            display: flex; align-items: center; gap: 8px;
            text-decoration: none; color: var(--navy-color); font-weight: 600;
            font-size: 0.85rem; padding: 10px 20px; border-radius: 12px;
            background: var(--card-bg); border: 1px solid rgba(0,0,0,0.06);
            transition: var(--transition);
        }
        .btn-back:hover { border-color: var(--gold-color); }
        .btn-back i { color: var(--gold-color); }

        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724; padding: 16px 22px;
            border-radius: 14px; margin-bottom: 25px;
            border-left: 4px solid #28a745;
            font-weight: 600; font-size: 0.9rem;
            display: flex; align-items: center; gap: 10px;
        }

        /* Status Banner */
        .status-banner {
            border-radius: 16px; padding: 20px 24px; margin-bottom: 25px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .status-banner.pending { background: linear-gradient(135deg, rgba(245,158,11,0.1), rgba(245,158,11,0.04)); border: 1px solid rgba(245,158,11,0.2); }
        .status-banner.approved { background: linear-gradient(135deg, rgba(16,185,129,0.1), rgba(16,185,129,0.04)); border: 1px solid rgba(16,185,129,0.2); }
        .status-banner.rejected { background: linear-gradient(135deg, rgba(239,68,68,0.1), rgba(239,68,68,0.04)); border: 1px solid rgba(239,68,68,0.2); }
        .status-banner .status-text { font-weight: 700; font-size: 0.95rem; }
        .status-banner.pending .status-text { color: #d97706; }
        .status-banner.approved .status-text { color: #059669; }
        .status-banner.rejected .status-text { color: #dc2626; }

        .status-badge-lg {
            padding: 8px 20px; border-radius: 50px; font-size: 0.82rem;
            font-weight: 800; letter-spacing: 0.5px; text-transform: uppercase;
        }
        .status-badge-lg.pending { background: rgba(245,158,11,0.15); color: #d97706; }
        .status-badge-lg.approved { background: rgba(16,185,129,0.15); color: #059669; }
        .status-badge-lg.rejected { background: rgba(239,68,68,0.15); color: #dc2626; }

        /* Payment Status Badges */
        .payment-badge {
            padding: 5px 12px; border-radius: 50px; font-size: 0.72rem;
            font-weight: 700; letter-spacing: 0.3px; display: inline-flex;
            align-items: center; gap: 5px; margin-top: 4px;
        }
        .payment-badge.unpaid { background: rgba(245,158,11,0.1); color: #d97706; border: 1px solid rgba(245,158,11,0.2); }
        .payment-badge.paid { background: rgba(16,185,129,0.1); color: #059669; border: 1px solid rgba(16,185,129,0.2); }
        .payment-badge.partial { background: rgba(59,130,246,0.1); color: #2563eb; border: 1px solid rgba(59,130,246,0.2); }
        .payment-badge.requested { background: rgba(59,130,246,0.1); color: #2563eb; border: 1px solid rgba(59,130,246,0.2); }
        .payment-badge.processed { background: rgba(245,158,11,0.1); color: #d97706; border: 1px solid rgba(245,158,11,0.2); }
        .payment-badge.completed { background: rgba(16,185,129,0.1); color: #059669; border: 1px solid rgba(16,185,129,0.2); }


        .payment-badge.expired { background: rgba(107,114,128,0.1); color: #6b7280; border: 1px solid rgba(107,114,128,0.2); }
        .payment-badge.failed { background: rgba(239,68,68,0.1); color: #dc2626; border: 1px solid rgba(239,68,68,0.2); }

        /* Section Cards */
        .detail-card {
            background: var(--card-bg); border-radius: 18px; padding: 28px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 20px;
            border: 1px solid rgba(0,0,0,0.03);
        }
        .detail-card h3 {
            font-size: 1.05rem; font-weight: 800; color: var(--navy-color);
            margin-bottom: 20px; display: flex; align-items: center; gap: 10px;
            padding-bottom: 14px; border-bottom: 2px solid rgba(0,0,0,0.04);
        }
        .detail-card h3 i { color: var(--gold-color); }

        .detail-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 18px;
        }
        .detail-item { }
        .detail-item .label {
            font-size: 0.72rem; color: var(--text-gray); font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;
        }
        .detail-item .value { font-size: 0.92rem; font-weight: 600; color: var(--navy-color); }

        /* Document Preview */
        .doc-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px;
        }
        .doc-item { }
        .doc-item .label {
            font-size: 0.72rem; color: var(--text-gray); font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;
        }
        .doc-preview {
            width: 100%; height: 160px; border-radius: 14px; overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08); cursor: pointer;
            transition: var(--transition); border: 2px solid rgba(0,0,0,0.04);
        }
        .doc-preview:hover { transform: scale(1.03); border-color: var(--gold-color); }
        .doc-preview img { width: 100%; height: 100%; object-fit: cover; }
        .doc-empty {
            width: 100%; height: 160px; border-radius: 14px;
            background: rgba(0,0,0,0.03); display: flex; align-items: center;
            justify-content: center; color: var(--text-gray); font-size: 0.82rem;
        }

        /* Action Buttons */
        .action-section {
            background: var(--card-bg); border-radius: 18px; padding: 28px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 20px;
            border: 1px solid rgba(0,0,0,0.03);
        }
        .action-section h3 {
            font-size: 1.05rem; font-weight: 800; color: var(--navy-color);
            margin-bottom: 20px; display: flex; align-items: center; gap: 10px;
        }
        .action-section h3 i { color: var(--gold-color); }

        .action-btns { display: flex; gap: 14px; flex-wrap: wrap; }

        .btn-approve {
            background: linear-gradient(135deg, #10b981, #34d399);
            color: white; border: none; padding: 14px 28px; border-radius: 14px;
            font-size: 0.92rem; font-weight: 700; cursor: pointer;
            font-family: 'Poppins', sans-serif; transition: var(--transition);
            display: flex; align-items: center; gap: 8px;
            box-shadow: 0 4px 15px rgba(16,185,129,0.3);
        }
        .btn-approve:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(16,185,129,0.4); }

        .btn-reject-toggle {
            background: transparent; border: 2px solid #ef4444; color: #ef4444;
            padding: 14px 28px; border-radius: 14px;
            font-size: 0.92rem; font-weight: 700; cursor: pointer;
            font-family: 'Poppins', sans-serif; transition: var(--transition);
            display: flex; align-items: center; gap: 8px;
        }
        .btn-reject-toggle:hover { background: #ef4444; color: white; }

        .approve-form-wrapper, .reject-form-wrapper {
            display: none; margin-top: 20px; padding: 20px;
            border-radius: 14px; animation: fadeIn 0.3s ease;
        }
        .approve-form-wrapper {
            background: rgba(16,185,129,0.04); border: 1px solid rgba(16,185,129,0.15);
        }
        .reject-form-wrapper {
            background: rgba(239,68,68,0.04); border: 1px solid rgba(239,68,68,0.15);
        }
        .approve-form-wrapper.show, .reject-form-wrapper.show { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        .approve-form-wrapper label { display: block; font-size: 0.85rem; font-weight: 700; color: #059669; margin-bottom: 8px; }
        .reject-form-wrapper label { display: block; font-size: 0.85rem; font-weight: 700; color: #b91c1c; margin-bottom: 8px; }

        .approve-form-wrapper textarea, .reject-form-wrapper textarea {
            width: 100%; padding: 14px; border-radius: 12px; font-family: 'Poppins', sans-serif;
            font-size: 0.88rem; outline: none; resize: vertical; min-height: 80px;
            transition: var(--transition); background: white;
        }
        .approve-form-wrapper textarea { border: 2px solid rgba(16,185,129,0.2); }
        .approve-form-wrapper textarea:focus { border-color: #10b981; }
        .reject-form-wrapper textarea { border: 2px solid rgba(239,68,68,0.2); }
        .reject-form-wrapper textarea:focus { border-color: #ef4444; }

        .btn-form-submit {
            margin-top: 12px; color: white; border: none; padding: 12px 24px; border-radius: 12px;
            font-size: 0.88rem; font-weight: 700; cursor: pointer;
            font-family: 'Poppins', sans-serif; transition: var(--transition);
            display: flex; align-items: center; gap: 8px;
        }
        .btn-approve-submit { background: linear-gradient(135deg, #10b981, #059669); }
        .btn-approve-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(16,185,129,0.3); }
        .btn-reject-submit { background: linear-gradient(135deg, #dc2626, #ef4444); }
        .btn-reject-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(220,38,38,0.3); }

        /* Image Modal */
        .img-modal {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.85); z-index: 9999; align-items: center;
            justify-content: center; backdrop-filter: blur(8px);
        }
        .img-modal.show { display: flex; }
        .img-modal img { max-width: 90%; max-height: 90vh; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.5); }
        .img-modal-close {
            position: absolute; top: 20px; right: 20px;
            background: rgba(255,255,255,0.15); color: white; width: 44px; height: 44px;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            cursor: pointer; border: none; font-size: 1.2rem; transition: var(--transition);
        }
        .img-modal-close:hover { background: var(--error-color); }

        @media (max-width: 768px) {
            .detail-grid { grid-template-columns: 1fr; }
            .doc-grid { grid-template-columns: 1fr 1fr; }
            .action-btns { flex-direction: column; }
            .status-banner { flex-direction: column; gap: 12px; align-items: flex-start; }
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
            <h2><i class="fa-solid fa-file-lines"></i> Detail Pendaftaran</h2>
            <a href="{{ route('admin.pendaftaran.index') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Status Banner -->
        <div class="status-banner {{ $pendaftaran->status }}">
            <span class="status-text">
                @if($pendaftaran->status === 'pending')
                    <i class="fa-solid fa-clock"></i> Pendaftaran ini menunggu review Anda
                @elseif($pendaftaran->status === 'approved')
                    <i class="fa-solid fa-circle-check"></i> Pendaftaran ini sudah disetujui
                @else
                    <i class="fa-solid fa-circle-xmark"></i> Pendaftaran ini sudah ditolak
                @endif
            </span>
            <span class="status-badge-lg {{ $pendaftaran->status }}">{{ $pendaftaran->status_label }}</span>
        </div>

        <!-- Identitas -->
        <div class="detail-card">
            <h3><i class="fa-solid fa-user"></i> Data Identitas Jamaah</h3>
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="label">Nama Lengkap</div>
                    <div class="value">{{ $pendaftaran->nama_lengkap }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">NIK</div>
                    <div class="value">{{ $pendaftaran->nik }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Tempat, Tanggal Lahir</div>
                    <div class="value">{{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir->format('d F Y') }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Jenis Kelamin</div>
                    <div class="value">{{ $pendaftaran->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">No. HP / WhatsApp</div>
                    <div class="value">{{ $pendaftaran->no_hp }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Alamat Lengkap</div>
                    <div class="value">{{ $pendaftaran->alamat_lengkap }}</div>
                </div>
                @if($pendaftaran->nama_mahram)
                <div class="detail-item">
                    <div class="label">Nama Mahram</div>
                    <div class="value">{{ $pendaftaran->nama_mahram }}</div>
                </div>
                @endif
                <div class="detail-item">
                    <div class="label">Akun User</div>
                    <div class="value">{{ $pendaftaran->user->name ?? '-' }} ({{ $pendaftaran->user->email ?? '-' }})</div>
                </div>
            </div>
        </div>

        <!-- Paket -->
        <div class="detail-card">
            <h3><i class="fa-solid fa-kaaba"></i> Paket yang Dipilih</h3>
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="label">Nama Paket</div>
                    <div class="value">{{ $pendaftaran->paket->nama ?? '-' }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Harga Paket</div>
                    <div class="value" style="color: var(--gold-color);">{{ $pendaftaran->paket->harga_rupiah ?? '-' }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Kategori</div>
                    <div class="value" style="text-transform: capitalize;">{{ $pendaftaran->paket->kategori ?? '-' }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Keberangkatan</div>
                    <div class="value">{{ $pendaftaran->paket->tanggal_keberangkatan ? $pendaftaran->paket->tanggal_keberangkatan->format('d F Y') : 'TBA' }}</div>
                </div>
            </div>
        </div>

        <!-- Dokumen & Kesehatan -->
        <div class="detail-card">
            <h3><i class="fa-solid fa-file-medical"></i> Dokumen & Kesehatan</h3>
            <div class="doc-grid">
                <div class="doc-item">
                    <div class="label">Foto KTP</div>
                    <div class="doc-preview" onclick="openImg('{{ asset('storage/' . $pendaftaran->foto_ktp) }}')">
                        <img loading="lazy" src="{{ asset('storage/' . $pendaftaran->foto_ktp) }}" alt="KTP">
                    </div>
                </div>
                <div class="doc-item">
                    <div class="label">Foto Paspor</div>
                    <div class="doc-preview" onclick="openImg('{{ asset('storage/' . $pendaftaran->foto_paspor) }}')">
                        <img loading="lazy" src="{{ asset('storage/' . $pendaftaran->foto_paspor) }}" alt="Paspor">
                    </div>
                </div>
                <div class="doc-item">
                    <div class="label">Foto Visa</div>
                    @if($pendaftaran->foto_visa)
                        <div class="doc-preview" onclick="openImg('{{ asset('storage/' . $pendaftaran->foto_visa) }}')">
                            <img loading="lazy" src="{{ asset('storage/' . $pendaftaran->foto_visa) }}" alt="Visa">
                        </div>
                    @else
                        <div class="doc-empty"><i class="fa-solid fa-minus" style="margin-right: 6px;"></i> Tidak diupload</div>
                    @endif
                </div>
                <div class="doc-item">
                    <div class="label">Sertifikat Vaksin</div>
                    <div class="doc-preview" onclick="openImg('{{ asset('storage/' . $pendaftaran->foto_buku_vaksin) }}')">
                        <img loading="lazy" src="{{ asset('storage/' . $pendaftaran->foto_buku_vaksin) }}" alt="Vaksin">
                    </div>
                </div>
            </div>

            <div class="detail-grid" style="margin-top: 20px;">
                <div class="detail-item">
                    <div class="label">Golongan Darah</div>
                    <div class="value">{{ $pendaftaran->golongan_darah }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Riwayat Penyakit</div>
                    <div class="value">{{ $pendaftaran->riwayat_penyakit ?? 'Tidak ada' }}</div>
                </div>
            </div>
        </div>

        <!-- Pembayaran -->
        <div class="detail-card">
            <h3><i class="fa-solid fa-credit-card"></i> Informasi Pembayaran</h3>
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="label">Metode Pembayaran</div>
                    <div class="value">{{ $pendaftaran->metode_pembayaran_label }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Total Biaya Paket</div>
                    <div class="value" style="color: var(--navy-color); font-weight: 700;">{{ 'Rp ' . number_format($pendaftaran->paket->harga ?? 0, 0, ',', '.') }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Sudah Dibayar</div>
                    <div class="value" style="color: #10b981; font-weight: 700;">{{ 'Rp ' . number_format($pendaftaran->total_bayar, 0, ',', '.') }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Sisa Tagihan</div>
                    <div class="value" style="color: #ef4444; font-weight: 700;">{{ 'Rp ' . number_format($pendaftaran->sisa_tagihan, 0, ',', '.') }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Status Pembayaran</div>
                    <div class="value">
                        <span class="payment-badge {{ ($pendaftaran->payment_status === 'unpaid' && $pendaftaran->total_bayar > 0) ? 'partial' : ($pendaftaran->payment_status ?? 'unpaid') }}">
                            @if($pendaftaran->payment_status === 'unpaid' && $pendaftaran->total_bayar > 0)
                                <i class="fa-solid fa-credit-card"></i> Belum Lunas
                            @elseif(($pendaftaran->payment_status ?? 'unpaid') === 'paid')
                                <i class="fa-solid fa-circle-check"></i> Lunas
                            @elseif(($pendaftaran->payment_status ?? 'unpaid') === 'expired')
                                <i class="fa-solid fa-clock"></i> Kadaluarsa
                            @elseif(($pendaftaran->payment_status ?? 'unpaid') === 'failed')
                                <i class="fa-solid fa-circle-xmark"></i> Gagal Bayar
                            @else
                                <i class="fa-solid fa-hourglass-half"></i> Belum Bayar
                            @endif
                        </span>
                    </div>
                </div>
                @if($pendaftaran->midtrans_transaction_id)
                <div class="detail-item">
                    <div class="label">Transaction ID (Midtrans)</div>
                    <div class="value" style="font-family: monospace; font-size: 0.8rem; background: rgba(0,0,0,0.03); padding: 4px 8px; border-radius: 6px; display: inline-block; margin-top: 4px;">{{ $pendaftaran->midtrans_transaction_id }}</div>
                </div>
                @endif
            </div>

            <!-- Refund Info -->
            @if(($pendaftaran->refund_status ?? 'none') !== 'none')
            <div style="margin-top: 24px; padding: 16px; background: rgba(239,68,68,0.04); border: 1px solid rgba(239,68,68,0.15); border-radius: 12px;">
                <div class="label" style="font-size: 0.72rem; color: #ef4444; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Informasi Refund</div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <div>
                        <span class="payment-badge {{ $pendaftaran->refund_status }}" style="font-size: 0.75rem;">
                            @if($pendaftaran->refund_status === 'requested')
                                <i class="fa-solid fa-hourglass-half"></i> Menunggu Proses
                            @elseif($pendaftaran->refund_status === 'processed')
                                <i class="fa-solid fa-spinner fa-spin"></i> Sedang Diproses
                            @elseif($pendaftaran->refund_status === 'completed')
                                <i class="fa-solid fa-check"></i> Selesai
                            @endif
                        </span>
                    </div>
                    @if($pendaftaran->refund_status === 'requested')
                        <form action="{{ route('admin.pendaftaran.process-refund', $pendaftaran->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-form-submit btn-approve-submit" style="margin-top: 0; padding: 8px 16px; font-size: 0.8rem;">
                                <i class="fa-solid fa-spinner"></i> Proses Refund
                            </button>
                        </form>
                    @elseif($pendaftaran->refund_status === 'processed')
                        <form action="{{ route('admin.pendaftaran.complete-refund', $pendaftaran->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-form-submit btn-approve-submit" style="margin-top: 0; padding: 8px 16px; font-size: 0.8rem; background: #10b981;">
                                <i class="fa-solid fa-check"></i> Tandai Selesai
                            </button>
                        </form>
                    @endif
                </div>
                <div style="margin-top: 12px; font-size: 0.85rem; color: var(--text-dark);">
                    <strong>Detail Rekening & Catatan:</strong><br>
                    {{ $pendaftaran->catatan_refund ?? '-' }}
                </div>
            </div>
            @endif


            <!-- Riwayat Cicilan -->
            @if($pendaftaran->pembayarans->count() > 0)
            <div style="margin-top: 24px;">
                <div class="label" style="font-size: 0.72rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px;">Riwayat Transaksi (Midtrans)</div>
                <div style="background: rgba(0,0,0,0.02); border-radius: 12px; overflow: hidden; border: 1px solid rgba(0,0,0,0.05);">
                    <table style="width: 100%; border-collapse: collapse; font-size: 0.85rem;">
                        <thead>
                            <tr style="background: rgba(0,0,0,0.05); text-align: left;">
                                <th style="padding: 10px 15px; font-weight: 700; color: var(--navy-color);">Tanggal</th>
                                <th style="padding: 10px 15px; font-weight: 700; color: var(--navy-color);">Nominal</th>
                                <th style="padding: 10px 15px; font-weight: 700; color: var(--navy-color);">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftaran->pembayarans->sortByDesc('created_at') as $pb)
                            <tr style="border-bottom: 1px solid rgba(0,0,0,0.05);">
                                <td style="padding: 10px 15px;">{{ $pb->created_at->format('d M Y, H:i') }}</td>
                                <td style="padding: 10px 15px; font-weight: 600;">Rp {{ number_format($pb->amount, 0, ',', '.') }}</td>
                                <td style="padding: 10px 15px;">
                                    <span class="payment-badge {{ $pb->payment_status }}" style="font-size: 0.6rem; padding: 2px 8px;">
                                        {{ $pb->payment_status === 'paid' ? 'Berhasil' : ($pb->payment_status === 'unpaid' ? 'Pending' : $pb->payment_status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            
            @if($pendaftaran->bukti_pembayaran)
            <div style="margin-top: 20px;">
                <div class="label" style="font-size: 0.72rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Bukti Transfer Manual</div>
                <div class="doc-preview" style="max-width: 300px;" onclick="openImg('{{ asset('storage/' . $pendaftaran->bukti_pembayaran) }}')">
                    <img loading="lazy" src="{{ asset('storage/' . $pendaftaran->bukti_pembayaran) }}" alt="Bukti Transfer">
                </div>
            </div>
            @endif
        </div>


        <!-- Action Section (only for pending) -->
        @if($pendaftaran->status === 'pending')
        <div class="action-section">
            <h3><i class="fa-solid fa-gavel"></i> Keputusan Admin</h3>
            <div class="action-btns">
                <button type="button" class="btn-approve" onclick="toggleForm('approveForm')">
                    <i class="fa-solid fa-check"></i> Setujui Pendaftaran
                </button>
                <button type="button" class="btn-reject-toggle" onclick="toggleForm('rejectForm')">
                    <i class="fa-solid fa-xmark"></i> Tolak Pendaftaran
                </button>
            </div>

            <!-- Approval Form -->
            <div class="approve-form-wrapper" id="approveForm">
                <form action="{{ route('admin.pendaftaran.approve', $pendaftaran->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menyetujui pendaftaran ini?')">
                    @csrf
                    <label for="catatan_approve"><i class="fa-solid fa-pen"></i> Catatan Persetujuan (opsional)</label>
                    <textarea name="catatan_admin" id="catatan_approve" placeholder="Tambahkan catatan untuk jamaah, misal: Silakan datang ke kantor untuk verifikasi dokumen asli."></textarea>
                    <button type="submit" class="btn-form-submit btn-approve-submit">
                        <i class="fa-solid fa-circle-check"></i> Konfirmasi Persetujuan
                    </button>
                </form>
            </div>

            <!-- Rejection Form -->
            <div class="reject-form-wrapper" id="rejectForm">
                <form action="{{ route('admin.pendaftaran.reject', $pendaftaran->id) }}" method="POST">
                    @csrf
                    <label for="catatan_reject"><i class="fa-solid fa-pen"></i> Alasan Penolakan (wajib, min 10 karakter)</label>
                    <textarea name="catatan_admin" id="catatan_reject" required minlength="10" placeholder="Tuliskan alasan penolakan, misal: dokumen foto KTP buram atau tidak terbaca."></textarea>
                    <button type="submit" class="btn-form-submit btn-reject-submit">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Penolakan
                    </button>
                </form>
            </div>
        </div>
        @endif

        @if($pendaftaran->catatan_admin && $pendaftaran->status !== 'pending')
        <div class="detail-card" style="border-left: 4px solid {{ $pendaftaran->status === 'approved' ? '#10b981' : '#ef4444' }};">
            <h3><i class="fa-solid fa-message"></i> Catatan Admin</h3>
            <p style="font-size: 0.9rem; color: var(--text-dark); line-height: 1.7;">{{ $pendaftaran->catatan_admin }}</p>
        </div>
        @endif

        {{-- Kirim Notifikasi ke Jamaah --}}
        @if($pendaftaran->status === 'approved')
        <div class="action-section">
            <h3><i class="fa-solid fa-bell"></i> Kirim Notifikasi ke Jamaah</h3>
            <p style="font-size: 0.85rem; color: var(--text-gray); margin-bottom: 18px;">
                Kirim pesan atau informasi penting kepada <strong>{{ $pendaftaran->user->name ?? $pendaftaran->nama_lengkap }}</strong>.
                Notifikasi akan muncul di aplikasi mobile jamaah.
            </p>

            <form action="{{ route('admin.pendaftaran.notify', $pendaftaran->id) }}" method="POST" onsubmit="return confirm('Kirim notifikasi ke jamaah?')">
                @csrf
                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-color); margin-bottom: 6px;">
                        <i class="fa-solid fa-heading"></i> Judul Notifikasi
                    </label>
                    <input type="text" name="judul" required maxlength="200"
                        placeholder="Contoh: Informasi Keberangkatan"
                        style="width: 100%; padding: 12px 16px; border: 2px solid rgba(0,0,0,0.08); border-radius: 12px; font-family: 'Poppins', sans-serif; font-size: 0.88rem; outline: none; transition: var(--transition);"
                        onfocus="this.style.borderColor='var(--gold-color)'" onblur="this.style.borderColor='rgba(0,0,0,0.08)'"
                    >
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-color); margin-bottom: 6px;">
                        <i class="fa-solid fa-pen"></i> Isi Pesan
                    </label>
                    <textarea name="pesan" required maxlength="2000" rows="4"
                        placeholder="Tuliskan pesan untuk jamaah..."
                        style="width: 100%; padding: 12px 16px; border: 2px solid rgba(0,0,0,0.08); border-radius: 12px; font-family: 'Poppins', sans-serif; font-size: 0.88rem; outline: none; resize: vertical; transition: var(--transition);"
                        onfocus="this.style.borderColor='var(--gold-color)'" onblur="this.style.borderColor='rgba(0,0,0,0.08)'"
                    ></textarea>
                </div>

                <div style="margin-bottom: 18px;">
                    <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--navy-color); margin-bottom: 6px;">
                        <i class="fa-solid fa-tag"></i> Tipe Notifikasi
                    </label>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <label style="display: flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 10px; border: 2px solid rgba(59,130,246,0.2); background: rgba(59,130,246,0.05); cursor: pointer; font-size: 0.82rem; font-weight: 600; color: #3b82f6;">
                            <input type="radio" name="tipe" value="info" checked style="accent-color: #3b82f6;"> <i class="fa-solid fa-circle-info"></i> Info
                        </label>
                        <label style="display: flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 10px; border: 2px solid rgba(16,185,129,0.2); background: rgba(16,185,129,0.05); cursor: pointer; font-size: 0.82rem; font-weight: 600; color: #10b981;">
                            <input type="radio" name="tipe" value="success" style="accent-color: #10b981;"> <i class="fa-solid fa-circle-check"></i> Sukses
                        </label>
                        <label style="display: flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 10px; border: 2px solid rgba(245,158,11,0.2); background: rgba(245,158,11,0.05); cursor: pointer; font-size: 0.82rem; font-weight: 600; color: #f59e0b;">
                            <input type="radio" name="tipe" value="warning" style="accent-color: #f59e0b;"> <i class="fa-solid fa-clock"></i> Peringatan
                        </label>
                        <label style="display: flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 10px; border: 2px solid rgba(239,68,68,0.2); background: rgba(239,68,68,0.05); cursor: pointer; font-size: 0.82rem; font-weight: 600; color: #ef4444;">
                            <input type="radio" name="tipe" value="danger" style="accent-color: #ef4444;"> <i class="fa-solid fa-triangle-exclamation"></i> Penting
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn-form-submit" style="background: linear-gradient(135deg, var(--gold-color), var(--gold-light)); color: white; margin-top: 0;">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Notifikasi
                </button>
            </form>
        </div>
        @endif

    </main>

    <!-- Image Preview Modal -->
    <div class="img-modal" id="imgModal" onclick="closeImg()">
        <button class="img-modal-close" onclick="closeImg()"><i class="fa-solid fa-xmark"></i></button>
        <img loading="lazy" id="imgModalSrc" src="" alt="Preview">
    </div>

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

        function toggleForm(formId) {
            const forms = ['approveForm', 'rejectForm'];
            forms.forEach(id => {
                const el = document.getElementById(id);
                if (id === formId) {
                    el.classList.toggle('show');
                } else {
                    el.classList.remove('show');
                }
            });
        }

        function openImg(src) {
            document.getElementById('imgModalSrc').src = src;
            document.getElementById('imgModal').classList.add('show');
        }

        function closeImg() {
            document.getElementById('imgModal').classList.remove('show');
        }
    </script>
    @include('partials.chatbot')
</body>
</html>


