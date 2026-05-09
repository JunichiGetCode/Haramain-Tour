<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Notifikasi - Haramain Tour</title>
    <meta name="description" content="Notifikasi pendaftaran paket umroh dan haji Haramain Tour.">
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
            --text-light: #e0e0e0;
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

        .btn-mark-all {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            color: var(--gold-color); border: none; padding: 10px 20px;
            border-radius: 12px; font-size: 0.82rem; font-weight: 700;
            cursor: pointer; font-family: 'Poppins', sans-serif; transition: var(--transition);
        }
        .btn-mark-all:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(13,17,48,0.3); }

        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724; padding: 16px 22px;
            border-radius: 14px; margin-bottom: 25px;
            border-left: 4px solid #28a745;
            font-weight: 600; font-size: 0.9rem;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.1);
            display: flex; align-items: center; gap: 10px;
        }

        .notif-list { display: flex; flex-direction: column; gap: 14px; }

        .notif-card {
            background: var(--card-bg); border-radius: 16px; padding: 22px 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04); transition: var(--transition);
            border-left: 4px solid transparent; display: flex; gap: 16px; align-items: flex-start;
            cursor: pointer; position: relative;
        }
        .notif-card:hover { transform: translateY(-3px); box-shadow: 0 8px 30px rgba(0,0,0,0.08); }
        .notif-card.unread { background: linear-gradient(135deg, rgba(201,168,76,0.04), rgba(255,255,255,1)); border-left-color: var(--gold-color); }
        .notif-card.type-success { border-left-color: #10b981; }
        .notif-card.type-danger { border-left-color: #ef4444; }
        .notif-card.type-warning { border-left-color: #f59e0b; }
        .notif-card.type-info { border-left-color: #3b82f6; }

        .notif-icon {
            width: 46px; height: 46px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; flex-shrink: 0;
        }
        .notif-icon.success { background: rgba(16,185,129,0.1); color: #10b981; }
        .notif-icon.danger { background: rgba(239,68,68,0.1); color: #ef4444; }
        .notif-icon.warning { background: rgba(245,158,11,0.1); color: #f59e0b; }
        .notif-icon.info { background: rgba(59,130,246,0.1); color: #3b82f6; }

        .notif-content { flex: 1; }
        .notif-title { font-size: 0.95rem; font-weight: 700; color: var(--navy-color); margin-bottom: 4px; }
        .notif-message { font-size: 0.85rem; color: var(--text-gray); line-height: 1.6; }
        .notif-time { font-size: 0.75rem; color: var(--text-gray); margin-top: 8px; display: flex; align-items: center; gap: 6px; }
        .notif-time i { font-size: 0.7rem; }

        .unread-dot {
            position: absolute; top: 24px; right: 20px;
            width: 10px; height: 10px; border-radius: 50%;
            background: var(--gold-color); box-shadow: 0 0 8px var(--gold-glow);
        }

        .empty-state {
            text-align: center; padding: 60px 20px;
            color: var(--text-gray);
        }
        .empty-state i { font-size: 3rem; color: var(--gold-color); margin-bottom: 15px; display: block; }

        .quick-links {
            display: flex; gap: 12px; margin-bottom: 25px; flex-wrap: wrap;
        }
        .quick-link {
            display: flex; align-items: center; gap: 8px;
            padding: 10px 20px; border-radius: 12px;
            text-decoration: none; font-size: 0.85rem; font-weight: 600;
            transition: var(--transition); background: var(--card-bg);
            color: var(--navy-color); border: 1px solid rgba(0,0,0,0.06);
        }
        .quick-link:hover { border-color: var(--gold-color); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.06); }
        .quick-link i { color: var(--gold-color); }

        /* Detail Modal */
        .detail-modal {
            display: none; position: fixed; z-index: 1000; left: 0; top: 0;
            width: 100%; height: 100%; overflow: auto;
            background-color: rgba(0,0,0,0.6); align-items: center; justify-content: center;
            backdrop-filter: blur(8px);
        }
        .detail-modal.show { display: flex; }

        .detail-modal-content {
            background: var(--navy-color); margin: auto; padding: 0;
            border-radius: 24px; width: 90%; max-width: 550px; color: white;
            position: relative; overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4);
            animation: modalSlideUp 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            max-height: 90vh; display: flex; flex-direction: column;
        }
        @keyframes modalSlideUp {
            from { transform: translateY(40px) scale(0.95); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }

        .detail-modal-header {
            padding: 24px 28px 18px; flex-shrink: 0;
            background: linear-gradient(135deg, var(--navy-light), var(--navy-color));
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .detail-modal-header h3 { font-size: 1.1rem; font-weight: 800; margin-bottom: 4px; }
        .detail-modal-header p { font-size: 0.78rem; color: var(--gold-color); font-weight: 600; }

        .detail-modal-body {
            padding: 24px 28px; overflow-y: auto; flex: 1;
        }

        .detail-section { margin-bottom: 20px; }
        .detail-section-title {
            font-size: 0.82rem; font-weight: 700; color: var(--gold-color);
            margin-bottom: 12px; display: flex; align-items: center; gap: 8px;
            text-transform: uppercase; letter-spacing: 0.5px;
        }
        .detail-section-title i { font-size: 0.85rem; }

        .detail-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 10px 14px;
        }
        .detail-item { }
        .detail-item .label {
            font-size: 0.7rem; color: rgba(255,255,255,0.4); font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 2px;
        }
        .detail-item .value {
            font-size: 0.85rem; color: white; font-weight: 600;
        }
        .detail-item.full { grid-column: 1 / -1; }

        .detail-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 12px; border-radius: 50px;
            font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
        }
        .detail-badge.approved { background: rgba(16,185,129,0.15); color: #34d399; border: 1px solid rgba(16,185,129,0.3); }
        .detail-badge.pending { background: rgba(245,158,11,0.15); color: #fcd34d; border: 1px solid rgba(245,158,11,0.3); }
        .detail-badge.rejected { background: rgba(239,68,68,0.15); color: #fca5a5; border: 1px solid rgba(239,68,68,0.3); }
        .detail-badge.paid { background: rgba(16,185,129,0.15); color: #34d399; border: 1px solid rgba(16,185,129,0.3); }
        .detail-badge.partial { background: rgba(59,130,246,0.15); color: #60a5fa; border: 1px solid rgba(59,130,246,0.3); }
        .detail-badge.unpaid { background: rgba(245,158,11,0.15); color: #fcd34d; border: 1px solid rgba(245,158,11,0.3); }


        .detail-catatan {
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px; padding: 14px; font-size: 0.82rem;
            color: rgba(255,255,255,0.7); line-height: 1.6;
        }

        .detail-signature-box {
            background: white; border-radius: 12px; padding: 10px;
            text-align: center;
        }
        .detail-signature-box img {
            max-width: 100%; max-height: 80px;
        }

        .detail-modal-footer {
            padding: 18px 28px; flex-shrink: 0;
            background: linear-gradient(to top, var(--navy-color), rgba(13,17,48,0.95));
            border-top: 1px solid rgba(255,255,255,0.06);
            display: flex; gap: 12px;
        }

        .btn-download-pdf {
            flex: 1; background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color); border: none; padding: 13px;
            border-radius: 14px; font-size: 0.9rem; font-weight: 700;
            cursor: pointer; transition: var(--transition);
            font-family: 'Poppins', sans-serif; text-decoration: none;
            text-align: center; display: flex; align-items: center; justify-content: center; gap: 8px;
            box-shadow: 0 4px 15px var(--gold-glow);
        }
        .btn-download-pdf:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(201,168,76,0.4); }

        .btn-close-detail {
            background: transparent; border: 2px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.7); padding: 13px 24px;
            border-radius: 14px; font-size: 0.88rem; font-weight: 600;
            cursor: pointer; font-family: 'Poppins', sans-serif; transition: var(--transition);
        }
        .btn-close-detail:hover { border-color: var(--gold-color); color: var(--gold-color); }

        .detail-loading {
            text-align: center; padding: 40px;
        }
        .detail-loading i { font-size: 2rem; color: var(--gold-color); animation: spin 0.8s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        @media (max-width: 768px) {
            .page-header { flex-direction: column; gap: 12px; align-items: flex-start; }
            .detail-grid { grid-template-columns: 1fr; }
        }
    </style>
    @include('partials.footer-css')
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

        <div class="quick-links">
            <a href="{{ route('pendaftaran.riwayat') }}" class="quick-link">
                <i class="fa-solid fa-list-check"></i> {{ __('Riwayat Pendaftaran') }}
            </a>
            <a href="{{ route('paket') }}" class="quick-link">
                <i class="fa-solid fa-box-open"></i> {{ __('Lihat Paket') }}
            </a>
        </div>

        <div class="page-header">
            <h2><i class="fa-solid fa-bell"></i> {{ __('Notifikasi') }}</h2>
            @if($notifikasis->where('dibaca', false)->count() > 0)
                <form action="{{ route('notifikasi.read-all') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-mark-all">
                        <i class="fa-solid fa-check-double"></i> {{ __('Tandai Semua Dibaca') }}
                    </button>
                </form>
            @endif
        </div>

        <div class="notif-list">
            @forelse($notifikasis as $notif)
                <div class="notif-card type-{{ $notif->tipe }} {{ !$notif->dibaca ? 'unread' : '' }}" 
                     onclick="openNotifDetail({{ $notif->id }}, this)" id="notif-{{ $notif->id }}">
                    <div class="notif-icon {{ $notif->tipe }}">
                        <i class="fa-solid {{ $notif->icon }}"></i>
                    </div>
                    <div class="notif-content">
                        <div class="notif-title">{{ $notif->judul }}</div>
                        <div class="notif-message">{{ $notif->pesan }}</div>
                        <div class="notif-time">
                            <i class="fa-regular fa-clock"></i>
                            {{ $notif->created_at->diffForHumans() }}
                            @if($notif->pendaftaran)
                                · Paket: {{ $notif->pendaftaran->paket->nama ?? '-' }}
                            @endif
                        </div>
                    </div>
                    @if(!$notif->dibaca)
                        <div class="unread-dot"></div>
                    @endif
                </div>
            @empty
                <div class="empty-state">
                    <i class="fa-solid fa-bell-slash"></i>
                    <p>{{ __('Belum ada notifikasi.') }}</p>
                </div>
            @endforelse
        </div>

    </main>

    <!-- Detail Pendaftaran Modal -->
    <div id="detailModal" class="detail-modal">
        <div class="detail-modal-content">
            <div class="detail-modal-header">
                <h3><i class="fa-solid fa-file-lines" style="color: var(--gold-color); margin-right: 8px;"></i> {{ __('Detail Pendaftaran') }}</h3>
                <p id="detailPaketNama">{{ __('Memuat...') }}</p>
            </div>

            <div class="detail-modal-body" id="detailBody">
                <div class="detail-loading" id="detailLoading">
                    <i class="fa-solid fa-spinner"></i>
                    <p style="color: rgba(255,255,255,0.5); margin-top: 12px; font-size: 0.85rem;">{{ __('Memuat detail pendaftaran...') }}</p>
                </div>
                <div id="detailContent" style="display: none;"></div>
            </div>

            <div class="detail-modal-footer">
                <button class="btn-close-detail" onclick="closeDetailModal()">{{ __('Tutup') }}</button>
                <a id="btnDownloadPdf" href="#" class="btn-download-pdf" style="display: none;" target="_blank">
                    <i class="fa-solid fa-file-pdf"></i> {{ __('Download PDF') }}
                </a>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <script>
        function markRead(id, el) {
            if (el.classList.contains('unread')) {
                fetch(`/notifikasi/${id}/read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                }).then(res => res.json()).then(data => {
                    if (data.success) {
                        el.classList.remove('unread');
                        const dot = el.querySelector('.unread-dot');
                        if (dot) dot.remove();
                    }
                });
            }
        }

        function openNotifDetail(notifId, el) {
            // Mark as read first
            markRead(notifId, el);

            // Show modal
            const modal = document.getElementById('detailModal');
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';

            // Show loading
            document.getElementById('detailLoading').style.display = 'block';
            document.getElementById('detailContent').style.display = 'none';
            document.getElementById('btnDownloadPdf').style.display = 'none';
            document.getElementById('detailPaketNama').textContent = 'Memuat...';

            // Fetch detail
            fetch(`/notifikasi/${notifId}/detail`, {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            })
            .then(res => res.json())
            .then(result => {
                document.getElementById('detailLoading').style.display = 'none';

                if (!result.success) {
                    document.getElementById('detailContent').innerHTML = `
                        <div style="text-align: center; padding: 30px;">
                            <i class="fa-solid fa-circle-info" style="font-size: 2rem; color: var(--gold-color); margin-bottom: 10px; display: block;"></i>
                            <p style="color: rgba(255,255,255,0.6);">${result.message || 'Data tidak ditemukan.'}</p>
                        </div>
                    `;
                    document.getElementById('detailContent').style.display = 'block';
                    return;
                }

                const d = result.data;
                document.getElementById('detailPaketNama').textContent = d.paket_nama;

                let html = `
                    <!-- Status -->
                    <div class="detail-section" style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <span class="detail-badge ${d.status}">${d.status_label}</span>
                        <span class="detail-badge ${d.payment_status}">${d.payment_status_label}</span>
                    </div>

                    <!-- Paket Info -->
                    <div class="detail-section">
                        <div class="detail-section-title"><i class="fa-solid fa-kaaba"></i> {{ __('Informasi Paket') }}</div>
                        <div class="detail-grid">
                            <div class="detail-item">
                                <div class="label">{{ __('Paket') }}</div>
                                <div class="value">${d.paket_nama}</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">{{ __('Harga') }}</div>
                                <div class="value" style="color: var(--gold-color);">${d.paket_harga}</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">{{ __('Durasi') }}</div>
                                <div class="value">${d.paket_durasi} {{ __('Hari') }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">{{ __('Keberangkatan') }}</div>
                                <div class="value">${d.paket_tanggal}</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">{{ __('Hotel Makkah') }}</div>
                                <div class="value">${d.hotel_makkah}</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">{{ __('Hotel Madinah') }}</div>
                                <div class="value">${d.hotel_madinah}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Jamaah Info -->
                    <div class="detail-section">
                        <div class="detail-section-title"><i class="fa-solid fa-user"></i> {{ __('Data Jamaah') }}</div>
                        <div class="detail-grid">
                            <div class="detail-item full">
                                <div class="label">{{ __('Nama Lengkap') }}</div>
                                <div class="value">${d.nama_lengkap}</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">{{ __('NIK') }}</div>
                                <div class="value">${d.nik}</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">{{ __('Jenis Kelamin') }}</div>
                                <div class="value">${d.jenis_kelamin}</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">{{ __('Tempat Lahir') }}</div>
                                <div class="value">${d.tempat_lahir}</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">{{ __('Tanggal Lahir') }}</div>
                                <div class="value">${d.tanggal_lahir}</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">{{ __('No. HP') }}</div>
                                <div class="value">${d.no_hp}</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">{{ __('Golongan Darah') }}</div>
                                <div class="value">${d.golongan_darah}</div>
                            </div>
                            <div class="detail-item full">
                                <div class="label">{{ __('Alamat') }}</div>
                                <div class="value">${d.alamat_lengkap}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Pembayaran -->
                    <div class="detail-section">
                        <div class="detail-section-title"><i class="fa-solid fa-credit-card"></i> {{ __('Pembayaran') }}</div>
                        <div class="detail-grid">
                            <div class="detail-item">
                                <div class="label">{{ __('Metode') }}</div>
                                <div class="value">${d.metode_pembayaran}</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">{{ __('Didaftarkan') }}</div>
                                <div class="value">${d.created_at}</div>
                            </div>
                        </div>
                    </div>
                `;

                // Tanda Tangan
                if (d.tanda_tangan_url) {
                    html += `
                        <div class="detail-section">
                            <div class="detail-section-title"><i class="fa-solid fa-pen-nib"></i> {{ __('Tanda Tangan Digital') }}</div>
                            <div class="detail-signature-box">
                                <img loading="lazy" src="${d.tanda_tangan_url}" alt="Tanda Tangan">
                            </div>
                        </div>
                    `;
                }

                // Catatan Admin
                if (d.catatan_admin && d.catatan_admin !== '-') {
                    html += `
                        <div class="detail-section">
                            <div class="detail-section-title"><i class="fa-solid fa-message"></i> Catatan Admin</div>
                            <div class="detail-catatan">
                                <i class="fa-solid fa-quote-left" style="color: var(--gold-color); margin-right: 6px;"></i>
                                ${d.catatan_admin}
                            </div>
                        </div>
                    `;
                }

                document.getElementById('detailContent').innerHTML = html;
                document.getElementById('detailContent').style.display = 'block';

                // Show PDF download button if approved
                if (d.can_download_pdf && d.pdf_url) {
                    const pdfBtn = document.getElementById('btnDownloadPdf');
                    pdfBtn.href = d.pdf_url;
                    pdfBtn.style.display = 'flex';
                }
            })
            .catch(err => {
                console.error('Error:', err);
                document.getElementById('detailLoading').style.display = 'none';
                document.getElementById('detailContent').innerHTML = `
                    <div style="text-align: center; padding: 30px;">
                        <i class="fa-solid fa-circle-exclamation" style="font-size: 2rem; color: #ef4444; margin-bottom: 10px; display: block;"></i>
                        <p style="color: rgba(255,255,255,0.6);">Gagal memuat detail. Silakan coba lagi.</p>
                    </div>
                `;
                document.getElementById('detailContent').style.display = 'block';
            });
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Close modal on backdrop click
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) closeDetailModal();
        });
    </script>
    @include('partials.chatbot')
</body>
</html>


