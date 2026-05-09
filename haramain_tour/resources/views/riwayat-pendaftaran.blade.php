<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pendaftaran - Haramain Tour</title>
    <meta name="description" content="Riwayat pendaftaran paket umroh dan haji Haramain Tour.">
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

        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724; padding: 16px 22px;
            border-radius: 14px; margin-bottom: 25px;
            border-left: 4px solid #28a745;
            font-weight: 600; font-size: 0.9rem;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.1);
            display: flex; align-items: center; gap: 10px;
        }

        .riwayat-list { display: flex; flex-direction: column; gap: 16px; }

        .riwayat-card {
            background: var(--card-bg); border-radius: 18px; padding: 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04); overflow: hidden;
            transition: var(--transition); border: 1px solid rgba(0,0,0,0.04);
        }
        .riwayat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 30px rgba(0,0,0,0.08); }

        .riwayat-top {
            display: flex; align-items: center; justify-content: space-between;
            padding: 20px 24px; border-bottom: 1px solid rgba(0,0,0,0.04);
        }

        .riwayat-paket { display: flex; align-items: center; gap: 14px; }
        .riwayat-paket-icon {
            width: 48px; height: 48px; border-radius: 14px;
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            display: flex; align-items: center; justify-content: center;
            color: var(--gold-color); font-size: 1.1rem;
        }
        .riwayat-paket-info h4 { font-size: 1rem; font-weight: 700; color: var(--navy-color); }
        .riwayat-paket-info p { font-size: 0.82rem; color: var(--text-gray); }

        .status-badge {
            padding: 6px 16px; border-radius: 50px; font-size: 0.75rem;
            font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;
        }
        .status-badge.pending {
            background: linear-gradient(135deg, rgba(245,158,11,0.12), rgba(245,158,11,0.06));
            color: #d97706; border: 1px solid rgba(245,158,11,0.25);
        }
        .status-badge.approved {
            background: linear-gradient(135deg, rgba(16,185,129,0.12), rgba(16,185,129,0.06));
            color: #059669; border: 1px solid rgba(16,185,129,0.25);
        }
        .status-badge.rejected {
            background: linear-gradient(135deg, rgba(239,68,68,0.12), rgba(239,68,68,0.06));
            color: #dc2626; border: 1px solid rgba(239,68,68,0.25);
        }

        /* Payment Status Badges */
        .payment-badge {
            padding: 5px 12px; border-radius: 50px; font-size: 0.72rem;
            font-weight: 700; letter-spacing: 0.3px; display: inline-flex;
            align-items: center; gap: 5px;
        }
        .payment-badge.unpaid {
            background: rgba(245,158,11,0.1); color: #d97706;
            border: 1px solid rgba(245,158,11,0.2);
        }
        .payment-badge.paid {
            background: rgba(16,185,129,0.1); color: #059669;
            border: 1px solid rgba(16,185,129,0.2);
        }
        .payment-badge.partial {
            background: rgba(59,130,246,0.1); color: #2563eb;
            border: 1px solid rgba(59,130,246,0.2);
        }

        .payment-badge.expired {
            background: rgba(107,114,128,0.1); color: #6b7280;
            border: 1px solid rgba(107,114,128,0.2);
        }
        .payment-badge.failed {
            background: rgba(239,68,68,0.1); color: #dc2626;
            border: 1px solid rgba(239,68,68,0.2);
        }

        .riwayat-badges { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; }

        .riwayat-body { padding: 20px 24px; }

        .riwayat-detail-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
        }
        .riwayat-detail-item { }
        .riwayat-detail-item span { display: block; font-size: 0.72rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .riwayat-detail-item strong { font-size: 0.88rem; color: var(--navy-color); font-weight: 700; }

        .riwayat-catatan {
            margin-top: 16px; padding: 14px 18px;
            border-radius: 12px; font-size: 0.85rem; line-height: 1.6;
        }
        .riwayat-catatan.rejected {
            background: rgba(239,68,68,0.06); border: 1px solid rgba(239,68,68,0.15);
            color: #b91c1c;
        }
        .riwayat-catatan.approved {
            background: rgba(16,185,129,0.06); border: 1px solid rgba(16,185,129,0.15);
            color: #047857;
        }
        .riwayat-catatan i { margin-right: 6px; }

        .empty-state {
            text-align: center; padding: 60px 20px; color: var(--text-gray);
        }
        .empty-state i { font-size: 3rem; color: var(--gold-color); margin-bottom: 15px; display: block; }

        @media (max-width: 768px) {
            .riwayat-top { flex-direction: column; gap: 12px; align-items: flex-start; }
            .riwayat-detail-grid { grid-template-columns: 1fr 1fr; }
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
            <a href="{{ route('notifikasi') }}" class="quick-link">
                <i class="fa-solid fa-bell"></i> {{ __('Notifikasi') }}
            </a>
            <a href="{{ route('paket') }}" class="quick-link">
                <i class="fa-solid fa-box-open"></i> {{ __('Lihat Paket') }}
            </a>
        </div>

        <div class="page-header">
            <h2><i class="fa-solid fa-list-check"></i> {{ __('Riwayat Pendaftaran') }}</h2>
        </div>

        <div class="riwayat-list">
            @forelse($pendaftarans as $p)
                <div class="riwayat-card">
                    <div class="riwayat-top">
                        <div class="riwayat-paket">
                            <div class="riwayat-paket-icon">
                                <i class="fa-solid fa-kaaba"></i>
                            </div>
                            <div class="riwayat-paket-info">
                                <h4>{{ __($p->paket->nama ?? 'Paket Tidak Tersedia') }}</h4>
                                <p>{{ __('Didaftarkan pada') }} {{ $p->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        <div class="riwayat-badges">
                            {{-- Payment Status Badge --}}
                            <span class="payment-badge {{ ($p->payment_status === 'unpaid' && $p->total_bayar > 0) ? 'partial' : ($p->payment_status ?? 'unpaid') }}">
                                @if($p->payment_status === 'unpaid' && $p->total_bayar > 0)
                                    <i class="fa-solid fa-credit-card"></i> {{ __('Belum Lunas') }}
                                @elseif(($p->payment_status ?? 'unpaid') === 'paid')
                                    <i class="fa-solid fa-circle-check"></i> {{ __('Lunas') }}
                                @elseif(($p->payment_status ?? 'unpaid') === 'expired')
                                    <i class="fa-solid fa-clock"></i> {{ __('Kadaluarsa') }}
                                @elseif(($p->payment_status ?? 'unpaid') === 'failed')
                                    <i class="fa-solid fa-circle-xmark"></i> {{ __('Gagal Bayar') }}
                                @else
                                    <i class="fa-solid fa-hourglass-half"></i> {{ __('Belum Bayar') }}
                                @endif
                            </span>


                            {{-- Admin Status Badge (only show if paid) --}}
                            @if(($p->payment_status ?? 'unpaid') === 'paid')
                            <span class="status-badge {{ $p->status }}">
                                @if($p->status === 'pending') <i class="fa-solid fa-clock"></i>
                                @elseif($p->status === 'approved') <i class="fa-solid fa-circle-check"></i>
                                @else <i class="fa-solid fa-circle-xmark"></i>
                                @endif
                                {{ $p->status_label }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="riwayat-body">
                        <div class="riwayat-detail-grid">
                            <div class="riwayat-detail-item">
                                <span>{{ __('Nama Jamaah') }}</span>
                                <strong>{{ $p->nama_lengkap }}</strong>
                            </div>
                            <div class="riwayat-detail-item">
                                <span>{{ __('Total Biaya') }}</span>
                                <strong>{{ 'Rp ' . number_format($p->paket->harga ?? 0, 0, ',', '.') }}</strong>
                            </div>
                            <div class="riwayat-detail-item">
                                <span>{{ __('Sudah Dibayar') }}</span>
                                <strong style="color: #059669;">{{ 'Rp ' . number_format($p->total_bayar, 0, ',', '.') }}</strong>
                            </div>
                            <div class="riwayat-detail-item">
                                <span>{{ __('Sisa Tagihan') }}</span>
                                <strong style="color: #dc2626;">{{ 'Rp ' . number_format($p->sisa_tagihan, 0, ',', '.') }}</strong>
                            </div>
                        </div>

                        <!-- Progress Bar Pembayaran -->
                        @if($p->sisa_tagihan > 0)
                        <div style="margin-top: 15px;">
                            <div style="display: flex; justify-content: space-between; font-size: 0.75rem; color: var(--text-gray); margin-bottom: 5px;">
                                <span>{{ __('Progress Pembayaran') }}</span>
                                <span>{{ round(($p->total_bayar / ($p->paket->harga ?? 1)) * 100) }}%</span>
                            </div>
                            <div style="width: 100%; height: 8px; background: rgba(0,0,0,0.05); border-radius: 4px; overflow: hidden;">
                                <div style="width: {{ ($p->total_bayar / ($p->paket->harga ?? 1)) * 100 }}%; height: 100%; background: var(--gold-color); border-radius: 4px;"></div>
                            </div>
                        </div>
                        @endif

                        <!-- Tombol Bayar Cicilan / Refund -->
                        <div style="margin-top: 15px; display: flex; justify-content: flex-end; gap: 10px;">
                            @if($p->sisa_tagihan > 0 && $p->payment_status !== 'expired' && $p->status !== 'rejected')
                                <button class="btn-bayar-cicilan" onclick="openModalCicilan({{ $p->id }}, {{ $p->sisa_tagihan }})" style="background: var(--navy-color); color: white; border: none; padding: 8px 16px; border-radius: 8px; font-size: 0.8rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                    <i class="fa-solid fa-credit-card"></i> {{ __('Bayar Cicilan') }}
                                </button>
                            @endif

                            @if($p->status === 'rejected' && $p->total_bayar > 0 && ($p->refund_status ?? 'none') === 'none')
                                <button class="btn-refund" onclick="openModalRefund({{ $p->id }})" style="background: #ef4444; color: white; border: none; padding: 8px 16px; border-radius: 8px; font-size: 0.8rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                    <i class="fa-solid fa-arrow-rotate-left"></i> {{ __('Ajukan Refund') }}
                                </button>
                            @elseif(($p->refund_status ?? 'none') === 'requested')
                                <span style="background: #3b82f6; color: white; padding: 6px 12px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; gap: 5px;">
                                    <i class="fa-solid fa-hourglass-half"></i> {{ __('Refund Diajukan') }}
                                </span>
                            @elseif(($p->refund_status ?? 'none') === 'processed')
                                <span style="background: #f59e0b; color: white; padding: 6px 12px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; gap: 5px;">
                                    <i class="fa-solid fa-spinner fa-spin"></i> {{ __('Refund Diproses') }}
                                </span>
                            @elseif(($p->refund_status ?? 'none') === 'completed')
                                <span style="background: #10b981; color: white; padding: 6px 12px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; gap: 5px;">
                                    <i class="fa-solid fa-check"></i> {{ __('Refund Selesai') }}
                                </span>
                            @endif
                        </div>



                        @if($p->catatan_admin)
                            <div class="riwayat-catatan {{ $p->status }}">
                                <i class="fa-solid {{ $p->status === 'approved' ? 'fa-circle-check' : 'fa-circle-info' }}"></i>
                                <strong>{{ __('Catatan Admin') }}:</strong> {{ $p->catatan_admin }}
                            </div>
                        @endif

                        @php
                            $mobileAppConfig = \App\Http\Controllers\AdminMobileAppController::getConfigStatic();
                        @endphp

                        @if($p->status === 'approved' && !empty($mobileAppConfig['app_link']) && !empty($mobileAppConfig['show_barcode']))
                            <div style="margin-top: 20px; padding: 20px; border-radius: 16px; background: linear-gradient(135deg, rgba(201,168,76,0.1), rgba(201,168,76,0.02)); border: 1px dashed var(--gold-color); display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
                                <div style="flex-shrink: 0; background: white; padding: 10px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ urlencode($mobileAppConfig['app_link']) }}&margin=0" alt="QR Code Aplikasi HaramainQu" width="100" height="100">
                                </div>
                                <div style="flex: 1; min-width: 200px;">
                                    <h4 style="color: var(--navy-color); font-size: 1.05rem; margin-bottom: 5px;"><i class="fa-solid fa-mobile-screen-button" style="color: var(--gold-color);"></i> Unduh Aplikasi Pendamping</h4>
                                    <p style="font-size: 0.85rem; color: var(--text-gray); margin-bottom: 12px; line-height: 1.5;">Scan QR Code di samping atau klik tombol di bawah untuk mengunduh aplikasi HaramainQu guna memantau jadwal dan panduan ibadah Anda.</p>
                                    <a href="{{ $mobileAppConfig['app_link'] }}" target="_blank" style="display: inline-block; background: var(--navy-color); color: white; padding: 8px 16px; border-radius: 8px; font-size: 0.8rem; font-weight: 700; text-decoration: none;">
                                        Unduh Sekarang <i class="fa-solid fa-download" style="margin-left: 5px;"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fa-solid fa-folder-open"></i>
                    <p>{{ __('Belum ada riwayat pendaftaran.') }}</p>
                    <a href="{{ route('paket') }}" style="color: var(--gold-color); text-decoration: none; font-weight: 600; margin-top: 10px; display: inline-block;">{{ __('Lihat paket yang tersedia →') }}</a>
                </div>
            @endforelse
        </div>

    </main>

    <!-- Modal Bayar Cicilan -->
    <div id="modalCicilan" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
        <div style="background: white; padding: 25px; border-radius: 16px; width: 90%; max-width: 400px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <h3 style="color: var(--navy-color); margin-bottom: 10px; font-size: 1.1rem; font-weight: 700;">{{ __('Bayar Cicilan') }}</h3>
            <p style="font-size: 0.85rem; color: var(--text-gray); margin-bottom: 20px;">{{ __('Silakan masukkan nominal yang ingin dibayar. Minimal Rp 1.000.000.') }}</p>
            
            <input type="hidden" id="cicilanPendaftaranId">
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--navy-color); margin-bottom: 8px;">{{ __('Nominal (Rp)') }}</label>
                <input type="number" id="cicilanAmount" value="1000000" min="1000000" step="500000" style="width: 100%; padding: 12px; border: 1px solid rgba(0,0,0,0.15); border-radius: 10px; font-size: 0.95rem;">
                <small id="sisaTagihanLabel" style="color: var(--text-gray); font-size: 0.75rem; margin-top: 6px; display: block;"></small>
            </div>
            
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button onclick="closeModalCicilan()" style="background: #f3f4f6; color: var(--text-dark); border: none; padding: 10px 18px; border-radius: 10px; font-size: 0.85rem; font-weight: 600; cursor: pointer;">{{ __('Batal') }}</button>
                <button onclick="submitCicilan()" style="background: var(--gold-color); color: var(--navy-color); border: none; padding: 10px 18px; border-radius: 10px; font-size: 0.85rem; font-weight: 700; cursor: pointer;">{{ __('Lanjut Bayar') }}</button>
            </div>
        </div>
    </div>

    @include('partials.footer')

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
    <!-- Midtrans Snap.js -->
    <script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
    
    <script>
        function openModalCicilan(id, sisa) {
            document.getElementById('cicilanPendaftaranId').value = id;
            document.getElementById('sisaTagihanLabel').textContent = 'Sisa Tagihan: Rp ' + new Intl.NumberFormat('id-ID').format(sisa);
            document.getElementById('cicilanAmount').max = sisa;
            document.getElementById('modalCicilan').style.display = 'flex';
        }
        
        function closeModalCicilan() {
            document.getElementById('modalCicilan').style.display = 'none';
        }

        function openModalRefund(id) {
            const form = document.getElementById('formRefund');
            form.action = `/pendaftaran/${id}/refund`;
            document.getElementById('modalRefund').style.display = 'flex';
        }
        
        function closeModalRefund() {
            document.getElementById('modalRefund').style.display = 'none';
        }

        
        function submitCicilan() {
            const id = document.getElementById('cicilanPendaftaranId').value;
            const amount = document.getElementById('cicilanAmount').value;
            
            if (amount < 1000000) {
                alert('Minimal pembayaran Rp 1.000.000');
                return;
            }
            
            const btn = document.querySelector('#modalCicilan button:last-child');
            btn.disabled = true;
            btn.textContent = 'Memproses...';
            
            fetch(`/pendaftaran/${id}/installment`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ amount: amount })
            })
            .then(response => response.json())
            .then(data => {
                if (data.snap_token) {
                    closeModalCicilan();
                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            // Sync status pembayaran ke backend sebelum reload
                            fetch(`/pendaftaran/${id}/check-payment`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            }).finally(() => {
                                window.location.reload();
                            });
                        },
                        onPending: function(result) {
                            fetch(`/pendaftaran/${id}/check-payment`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            }).finally(() => {
                                window.location.reload();
                            });
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal');
                            btn.disabled = false;
                            btn.textContent = 'Lanjut Bayar';
                        },
                        onClose: function() {
                            btn.disabled = false;
                            btn.textContent = 'Lanjut Bayar';
                        }
                    });
                } else if (data.error) {
                    alert(data.error);
                    btn.disabled = false;
                    btn.textContent = 'Lanjut Bayar';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan jaringan');
                btn.disabled = false;
                btn.textContent = 'Lanjut Bayar';
            });
        }
    </script>

    @include('partials.chatbot')

</body>
</html>


