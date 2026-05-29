<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($berita) ? 'Edit Berita' : 'Tambah Berita' }} - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        :root { --bg-color: #f5f3ee; --navy-color: #0d1130; --navy-light: #283375; --gold-color: #c9a84c; --text-dark: #2c2c2c; --card-bg: #ffffff; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); }
        .main-container { max-width: 1500px; margin: 30px auto; padding: 0 20px; }
        
        .page-header { display: flex; align-items: center; gap: 15px; margin-bottom: 30px; }
        .back-btn { width: 42px; height: 42px; display: flex; justify-content: center; align-items: center; border-radius: 12px; background: var(--card-bg); color: var(--navy-color); text-decoration: none; border: 1px solid rgba(0,0,0,0.06); }
        
        .card { background: var(--card-bg); border-radius: 20px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); }
        .form-group { margin-bottom: 24px; }
        .form-label { display: block; margin-bottom: 8px; font-weight: 600; color: #374151; }
        .form-control { width: 100%; padding: 12px 16px; border: 1px solid #d1d5db; border-radius: 8px; font-family: 'Poppins', sans-serif; }
        .form-control:focus { outline: none; border-color: var(--gold-color); }
        
        .btn-submit { background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); color: var(--gold-color); width: 100%; padding: 14px; border-radius: 12px; border: none; font-weight: 700; font-size: 1rem; cursor: pointer; transition: 0.3s; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(13, 17, 48, 0.3); }

        .note-editor { border-radius: 8px !important; border-color: #d1d5db !important; }
        .note-toolbar { background-color: #f9fafb !important; border-radius: 8px 8px 0 0 !important; }


        @media (max-width: 768px) {
            .grid-form { grid-template-columns: 1fr !important; }
            .page-header { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>
    @include('partials.navbar-css')
    @include('partials.navbar')

    <main class="main-container">
        <div class="page-header">
            <a href="{{ route('admin.berita.index') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
            <div>
                <h1 style="font-size: 1.5rem; color: var(--navy-color);">{{ isset($berita) ? 'Edit Berita' : 'Buat Berita Baru' }}</h1>
            </div>
        </div>

        @if($errors->any())
        <div style="background: #fde8e8; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <form id="beritaForm" action="{{ isset($berita) ? route('admin.berita.update', $berita->id) : route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($berita)) @method('PUT') @endif

                <div class="grid-form" style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
                    <div>
                        <div class="form-group">
                            <label class="form-label">Judul Berita</label>
                            <input type="text" name="judul" class="form-control" value="{{ old('judul', $berita->judul ?? '') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Isi Berita</label>
                            <textarea name="konten" id="summernote">{!! old('konten', $berita->konten ?? '') !!}</textarea>
                        </div>
                    </div>
                    <div>
                        <div style="border: 1px solid #e5e7eb; padding: 20px; border-radius: 12px;">
                            <div class="form-group">
                                <label class="form-label">Status Terbit</label>
                                <select name="status" class="form-control" required>
                                    <option value="draft" {{ old('status', $berita->status ?? 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status', $berita->status ?? '') == 'published' ? 'selected' : '' }}>Publish</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Foto Thumbnail</label>
                                @if(isset($berita) && $berita->thumbnail)
                                    <img loading="lazy" src="{{ asset('storage/' . $berita->thumbnail) }}" style="width: 100%; height: 160px; object-fit: cover; border-radius: 8px; margin-bottom: 10px;">
                                @endif
                                <input type="file" name="thumbnail" class="form-control" accept="image/*">
                            </div>
                            <button type="submit" class="btn-submit"><i class="fa-solid fa-save"></i> Simpan Berita</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>



    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Ketik isi berita di sini...',
                tabsize: 2, height: 400,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
            
            // Prevent double commit
            $('#beritaForm').on('submit', function() {
                var btn = $(this).find('button[type="submit"]');
                btn.prop('disabled', true);
                btn.html('<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...');
            });
        });
    </script>
</body>
</html>


