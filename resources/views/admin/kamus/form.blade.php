<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $entry ? 'Edit' : 'Tambah' }} Kamus - Admin Haramain Tour</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --bg-color: #f5f3ee; --navy-color: #0d1130; --navy-light: #283375; --gold-color: #c9a84c; --text-dark: #2c2c2c; --text-gray: #6b7280; --card-bg: #ffffff; --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); }
        .main-container { max-width: 800px; margin: 30px auto; padding: 0 20px; }
        .page-header { display: flex; align-items: center; gap: 15px; margin-bottom: 30px; }
        .back-btn { width: 42px; height: 42px; display: flex; justify-content: center; align-items: center; border-radius: 12px; background: var(--card-bg); color: var(--navy-color); text-decoration: none; border: 1px solid rgba(0,0,0,0.06); }
        .back-btn:hover { background: var(--gold-color); }
        .page-title h1 { font-size: 1.4rem; font-weight: 800; color: var(--navy-color); }
        .page-title p { font-size: 0.85rem; color: var(--text-gray); }
        .form-card { background: var(--card-bg); border-radius: 20px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 700; font-size: 0.85rem; color: var(--navy-color); margin-bottom: 8px; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 12px 16px; border: 2px solid rgba(0,0,0,0.08); border-radius: 12px; font-size: 0.9rem; font-family: 'Poppins', sans-serif; transition: var(--transition); background: var(--bg-color); }
        .form-group input:focus, .form-group select:focus { outline: none; border-color: var(--gold-color); box-shadow: 0 0 0 3px rgba(201,168,76,0.15); }
        .form-group textarea.arabic-input { font-family: 'Traditional Arabic', 'Amiri', serif; font-size: 1.3rem; direction: rtl; text-align: right; line-height: 2; min-height: 80px; resize: vertical; }
        .form-group textarea.arabic-input:focus { outline: none; border-color: var(--gold-color); box-shadow: 0 0 0 3px rgba(201,168,76,0.15); }
        .btn-submit { background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); color: var(--gold-color); padding: 14px 32px; border: none; border-radius: 12px; font-weight: 700; font-size: 0.95rem; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: var(--transition); }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(13,17,48,0.3); }
        .error-msg { color: #dc2626; font-size: 0.78rem; margin-top: 4px; }
    </style>
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">
    @include('partials.navbar-css')
    @include('partials.navbar')

    <main class="main-container">
        <div class="page-header">
            <a href="{{ route('admin.kamus.index') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
            <div class="page-title">
                <h1><i class="fa-solid fa-book-open" style="color: var(--gold-color);"></i> {{ $entry ? 'Edit Kata' : 'Tambah Kata Baru' }}</h1>
                <p>{{ $entry ? 'Perbarui kosa kata' : 'Isi form untuk menambahkan kosa kata baru' }}</p>
            </div>
        </div>

        <div class="form-card">
            <form action="{{ $entry ? route('admin.kamus.update', $entry->id) : route('admin.kamus.store') }}" method="POST">
                @csrf
                @if($entry) @method('PUT') @endif

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="category" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category', $entry->category ?? '') === $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                    @error('category') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Teks Arab</label>
                    <textarea name="arabic" class="arabic-input" placeholder="اكتب الكلمة بالعربية" required>{{ old('arabic', $entry->arabic ?? '') }}</textarea>
                    @error('arabic') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Latin / Transliterasi</label>
                    <input type="text" name="latin" value="{{ old('latin', $entry->latin ?? '') }}" placeholder="Contoh: Syukran" required>
                    @error('latin') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Arti (Indonesia)</label>
                    <input type="text" name="indonesian" value="{{ old('indonesian', $entry->indonesian ?? '') }}" placeholder="Contoh: Terima kasih" required>
                    @error('indonesian') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-save"></i> {{ $entry ? 'Simpan Perubahan' : 'Tambah Kata' }}
                </button>
            </form>
        </div>
    </main>
    @include('partials.chatbot')
</body>
</html>
