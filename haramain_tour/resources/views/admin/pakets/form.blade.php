<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($paket) ? 'Edit Paket' : 'Tambah Paket Baru' }} - Admin Haramain Tour</title>
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
            --text-dark: #2c2c2c;
            --text-gray: #6b7280;
            --card-bg: #ffffff;
            --transition: all 0.3s ease;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); }

        .main-container { max-width: 1500px; margin: 30px auto; padding: 0 20px; }

        .page-header { display: flex; align-items: center; gap: 15px; margin-bottom: 30px; }
        .back-btn {
            width: 42px; height: 42px; display: flex; justify-content: center; align-items: center;
            border-radius: 12px; background: var(--card-bg); color: var(--navy-color);
            text-decoration: none; border: 1px solid rgba(0,0,0,0.06); transition: var(--transition);
        }
        .back-btn:hover { background: var(--gold-color); color: white; border-color: var(--gold-color); }
        .page-title h1 { font-size: 1.5rem; font-weight: 800; color: var(--navy-color); }

        .form-card { background: var(--card-bg); border-radius: 20px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 8px; color: var(--navy-color); font-size: 0.9rem; }
        .form-control {
            width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 12px;
            font-size: 0.95rem; font-family: 'Poppins', sans-serif; transition: var(--transition);
        }
        .form-control:focus { border-color: var(--gold-color); outline: none; }
        select.form-control { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; }
        
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        .fasilitas-list { border: 2px solid #e5e7eb; border-radius: 12px; padding: 15px; margin-bottom: 10px; }
        .fasilitas-row { display: flex; gap: 10px; margin-bottom: 10px; }
        .fasilitas-row input { flex: 1; }
        .btn-remove-fasilitas { background: #fee2e2; color: #ef4444; border: none; padding: 0 15px; border-radius: 8px; cursor: pointer; }
        .btn-add-fasilitas { background: #e0e7ff; color: #4f46e5; border: none; padding: 10px 15px; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.85rem; }

        .checkbox-group { display: flex; align-items: center; gap: 10px; font-size: 0.95rem; font-weight: 500; cursor: pointer; }
        .checkbox-group input { width: 18px; height: 18px; accent-color: var(--gold-color); }

        .btn-save {
            width: 100%; padding: 14px; background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            color: white; border: none; border-radius: 12px; font-size: 1rem; font-weight: 700;
            cursor: pointer; transition: var(--transition); margin-top: 20px;
        }
        .btn-save:hover { box-shadow: 0 8px 20px rgba(13, 17, 48, 0.3); transform: translateY(-2px); }

        .current-image { width: 150px; border-radius: 10px; margin-top: 10px; display: block; }
    </style>
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">

    @include('partials.navbar-css')
    @include('partials.navbar')

    <main class="main-container">
        <div class="page-header">
            <a href="{{ route('admin.pakets.index') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
            <div class="page-title">
                <h1>{{ isset($paket) ? 'Edit Paket' : 'Tambah Paket Baru' }}</h1>
            </div>
        </div>

        <div class="form-card">
            @if($errors->any())
                <div style="background: #fee2e2; color: #b91c1c; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                    <ul style="margin-left: 20px;">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ isset($paket) ? route('admin.pakets.update', $paket->id) : route('admin.pakets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($paket)) @method('PUT') @endif

                <div class="form-group">
                    <label>Nama Paket *</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $paket->nama ?? '') }}" required>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Kategori *</label>
                        <select name="kategori" class="form-control" required>
                            <option value="reguler" {{ old('kategori', $paket->kategori ?? '') == 'reguler' ? 'selected' : '' }}>Umroh Reguler</option>
                            <option value="plus" {{ old('kategori', $paket->kategori ?? '') == 'plus' ? 'selected' : '' }}>Umroh Plus</option>
                            <option value="furoda" {{ old('kategori', $paket->kategori ?? '') == 'furoda' ? 'selected' : '' }}>Haji Furoda / VIP</option>
                            <option value="haji_basic" {{ old('kategori', $paket->kategori ?? '') == 'haji_basic' ? 'selected' : '' }}>Haji Basic</option>
                            <option value="haji_plus" {{ old('kategori', $paket->kategori ?? '') == 'haji_plus' ? 'selected' : '' }}>Haji Plus</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Durasi (Hari) *</label>
                        <input type="number" name="durasi_hari" class="form-control" value="{{ old('durasi_hari', $paket->durasi_hari ?? '') }}" required>
                    </div>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Harga (Rp) *</label>
                        <input type="number" name="harga" class="form-control" value="{{ old('harga', $paket->harga ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Keberangkatan</label>
                        <input type="date" name="tanggal_keberangkatan" class="form-control" value="{{ old('tanggal_keberangkatan', isset($paket) && $paket->tanggal_keberangkatan ? $paket->tanggal_keberangkatan->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Hotel Makkah</label>
                        <input type="text" name="hotel_makkah" class="form-control" value="{{ old('hotel_makkah', $paket->hotel_makkah ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>Hotel Madinah</label>
                        <input type="text" name="hotel_madinah" class="form-control" value="{{ old('hotel_madinah', $paket->hotel_madinah ?? '') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi Paket</label>
                    <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $paket->deskripsi ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Fasilitas</label>
                    <div class="fasilitas-list" id="fasilitasList">
                        @php
                            $fasilitasArr = old('fasilitas_text') ? null : (isset($paket) ? $paket->fasilitas : [['icon' => 'fa-plane', 'text' => 'Tiket Pesawat']]);
                        @endphp

                        @if(old('fasilitas_text'))
                            @foreach(old('fasilitas_icon') as $index => $icon)
                            <div class="fasilitas-row">
                                <input type="text" name="fasilitas_icon[]" class="form-control" value="{{ $icon }}" placeholder="Icon Class (ex: fa-plane)" style="width: 150px; flex: none;">
                                <input type="text" name="fasilitas_text[]" class="form-control" value="{{ old('fasilitas_text')[$index] }}" placeholder="Teks Fasilitas">
                                <button type="button" class="btn-remove-fasilitas" onclick="this.parentElement.remove()"><i class="fa-solid fa-trash"></i></button>
                            </div>
                            @endforeach
                        @elseif($fasilitasArr && is_array($fasilitasArr))
                            @foreach($fasilitasArr as $fasilitas)
                            <div class="fasilitas-row">
                                <input type="text" name="fasilitas_icon[]" class="form-control" value="{{ $fasilitas['icon'] ?? '' }}" placeholder="Icon Class" style="width: 150px; flex: none;">
                                <input type="text" name="fasilitas_text[]" class="form-control" value="{{ $fasilitas['text'] ?? '' }}" placeholder="Teks Fasilitas">
                                <button type="button" class="btn-remove-fasilitas" onclick="this.parentElement.remove()"><i class="fa-solid fa-trash"></i></button>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn-add-fasilitas" onclick="addFasilitas()"><i class="fa-solid fa-plus"></i> Tambah Fasilitas</button>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Gambar Utama (Thumbnail)</label>
                        <input type="file" name="gambar_utama" class="form-control" accept="image/*">
                        @if(isset($paket) && $paket->gambar_utama)
                            <img loading="lazy" src="{{ str_starts_with($paket->gambar_utama, 'http') ? $paket->gambar_utama : (str_starts_with($paket->gambar_utama, 'storage/') ? asset($paket->gambar_utama) : asset('storage/' . $paket->gambar_utama)) }}" class="current-image">
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Gambar Rincian (Bisa pilih lebih dari 1)</label>
                        <input type="file" name="gambar_rincian[]" class="form-control" accept="image/*" multiple>
                        <small style="color:var(--text-gray); display:block; margin-top:5px;">Upload ulang akan menimpa gambar rincian sebelumnya.</small>
                    </div>
                </div>

                <div class="form-group">
                    <label>Pengaturan Visibilitas</label>
                    <div class="grid-2">
                        <label class="checkbox-group">
                            <input type="checkbox" name="status_populer" {{ old('status_populer', isset($paket) && $paket->status_populer) ? 'checked' : '' }}>
                            Beri Badge "Populer"
                        </label>
                        <label class="checkbox-group">
                            <input type="checkbox" name="status_premium" {{ old('status_premium', isset($paket) && $paket->status_premium) ? 'checked' : '' }}>
                            Tandai Sebagai "Premium"
                        </label>
                    </div>
                </div>

                <input type="hidden" name="rating" value="{{ old('rating', $paket->rating ?? 5.0) }}">

                <button type="submit" class="btn-save">
                    <i class="fa-solid fa-save"></i> Simpan Paket
                </button>
            </form>
        </div>
    </main>

    <script>
        function addFasilitas() {
            const container = document.getElementById('fasilitasList');
            const row = document.createElement('div');
            row.className = 'fasilitas-row';
            row.innerHTML = `
                <input type="text" name="fasilitas_icon[]" class="form-control" value="fa-check" placeholder="Icon Class (ex: fa-plane)" style="width: 150px; flex: none;">
                <input type="text" name="fasilitas_text[]" class="form-control" placeholder="Teks Fasilitas">
                <button type="button" class="btn-remove-fasilitas" onclick="this.parentElement.remove()"><i class="fa-solid fa-trash"></i></button>
            `;
            container.appendChild(row);
        }
    </script>
</body>
</html>


