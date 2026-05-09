<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Panduan: {{ $step->title }} - Admin Haramain Tour</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --bg-color: #f5f3ee; --navy-color: #0d1130; --navy-light: #283375; --gold-color: #c9a84c; --text-dark: #2c2c2c; --text-gray: #6b7280; --card-bg: #ffffff; --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); }
        .main-container { max-width: 900px; margin: 30px auto; padding: 0 20px; }
        .page-header { display: flex; align-items: center; gap: 15px; margin-bottom: 30px; }
        .back-btn { width: 42px; height: 42px; display: flex; justify-content: center; align-items: center; border-radius: 12px; background: var(--card-bg); color: var(--navy-color); text-decoration: none; border: 1px solid rgba(0,0,0,0.06); }
        .back-btn:hover { background: var(--gold-color); }
        .page-title h1 { font-size: 1.4rem; font-weight: 800; color: var(--navy-color); }
        .page-title p { font-size: 0.85rem; color: var(--text-gray); }
        .form-card { background: var(--card-bg); border-radius: 20px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 20px; }
        .form-card h3 { font-size: 1rem; font-weight: 700; color: var(--navy-color); margin-bottom: 15px; display: flex; align-items: center; gap: 8px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 700; font-size: 0.85rem; color: var(--navy-color); margin-bottom: 8px; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 12px 16px; border: 2px solid rgba(0,0,0,0.08); border-radius: 12px; font-size: 0.9rem; font-family: 'Poppins', sans-serif; transition: var(--transition); background: var(--bg-color); }
        .form-group input:focus, .form-group textarea:focus { outline: none; border-color: var(--gold-color); box-shadow: 0 0 0 3px rgba(201,168,76,0.15); }
        .form-group textarea { min-height: 100px; resize: vertical; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .hint { font-size: 0.75rem; color: var(--text-gray); margin-top: 5px; }

        .section-editor { background: var(--bg-color); border-radius: 16px; padding: 20px; margin-bottom: 15px; border: 2px solid rgba(0,0,0,0.04); }
        .section-editor h4 { font-size: 0.9rem; font-weight: 700; color: var(--navy-color); margin-bottom: 10px; }
        .section-editor .item-input { display: flex; gap: 8px; margin-bottom: 8px; align-items: center; }
        .section-editor .item-input input { flex: 1; }
        .btn-remove { width: 32px; height: 32px; background: rgba(239,68,68,0.1); color: #dc2626; border: none; border-radius: 8px; cursor: pointer; font-size: 0.8rem; flex-shrink: 0; }
        .btn-remove:hover { background: #dc2626; color: white; }
        .btn-add-item { background: rgba(59,130,246,0.1); color: #2563eb; border: none; padding: 8px 16px; border-radius: 8px; font-size: 0.8rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 5px; }
        .btn-add-item:hover { background: #2563eb; color: white; }
        .btn-add-section { background: rgba(16,185,129,0.1); color: #059669; border: none; padding: 10px 20px; border-radius: 10px; font-size: 0.85rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 8px; margin-bottom: 20px; }
        .btn-add-section:hover { background: #059669; color: white; }

        .btn-submit { background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); color: var(--gold-color); padding: 14px 32px; border: none; border-radius: 12px; font-weight: 700; font-size: 0.95rem; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: var(--transition); }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(13,17,48,0.3); }
        .error-msg { color: #dc2626; font-size: 0.78rem; margin-top: 4px; background: rgba(239,68,68,0.05); padding: 8px 12px; border-radius: 8px; }
    </style>
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">
    @include('partials.navbar-css')
    @include('partials.navbar')

    <main class="main-container">
        <div class="page-header">
            <a href="{{ route('admin.panduan.index') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
            <div class="page-title">
                <h1><i class="fa-solid fa-book-quran" style="color: var(--gold-color);"></i> Edit: {{ $step->title }}</h1>
                <p>{{ $step->step_label }} — Perbarui konten panduan ibadah</p>
            </div>
        </div>

        <form action="{{ route('admin.panduan.update', $step->id) }}" method="POST" id="panduanForm">
            @csrf @method('PUT')
            <input type="hidden" name="sections" id="sectionsInput">

            {{-- Basic Info --}}
            <div class="form-card">
                <h3><i class="fa-solid fa-info-circle" style="color: var(--gold-color);"></i> Informasi Dasar</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label>Label Langkah</label>
                        <input type="text" name="step_label" value="{{ old('step_label', $step->step_label) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Icon (FontAwesome)</label>
                        <input type="text" name="icon" value="{{ old('icon', $step->icon) }}" required>
                        <div class="hint">Contoh: clipboard-list, hands-praying, kaaba, mosque</div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" value="{{ old('title', $step->title) }}" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" rows="3" required>{{ old('description', $step->description) }}</textarea>
                </div>
            </div>

            {{-- Sections Editor --}}
            <div class="form-card">
                <h3><i class="fa-solid fa-list-check" style="color: var(--gold-color);"></i> Sections & Items</h3>
                @error('sections') <div class="error-msg" style="margin-bottom:15px;">{{ $message }}</div> @enderror

                <div id="sectionsContainer"></div>

                <button type="button" class="btn-add-section" onclick="addSection()">
                    <i class="fa-solid fa-plus"></i> Tambah Section
                </button>

                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </main>

    <script>
        let sections = @json($step->sections ?? []);

        function render() {
            const c = document.getElementById('sectionsContainer');
            c.innerHTML = '';
            sections.forEach((sec, si) => {
                const div = document.createElement('div');
                div.className = 'section-editor';
                let itemsHtml = '';
                (sec.items || []).forEach((item, ii) => {
                    itemsHtml += `<div class="item-input">
                        <input type="text" value="${escHtml(item)}" onchange="updateItem(${si},${ii},this.value)" placeholder="Item...">
                        <button type="button" class="btn-remove" onclick="removeItem(${si},${ii})"><i class="fa-solid fa-times"></i></button>
                    </div>`;
                });

                let doaHtml = '';
                if (sec.doa) {
                    doaHtml = `<div style="margin-top:10px;padding:12px;background:rgba(201,168,76,0.08);border-radius:10px;">
                        <strong style="font-size:0.8rem;color:#0d1130;">Doa (opsional):</strong>
                        <input type="text" value="${escHtml(sec.doa.arabic||'')}" onchange="updateDoa(${si},'arabic',this.value)" placeholder="Arab" style="margin-top:6px;font-family:'Traditional Arabic',serif;direction:rtl;text-align:right;font-size:1.1rem;">
                        <input type="text" value="${escHtml(sec.doa.latin||'')}" onchange="updateDoa(${si},'latin',this.value)" placeholder="Latin" style="margin-top:4px;">
                        <input type="text" value="${escHtml(sec.doa.arti||'')}" onchange="updateDoa(${si},'arti',this.value)" placeholder="Arti" style="margin-top:4px;">
                        <button type="button" class="btn-remove" style="margin-top:6px;width:auto;height:auto;padding:4px 10px;font-size:0.72rem;" onclick="removeDoa(${si})"><i class="fa-solid fa-times"></i> Hapus Doa</button>
                    </div>`;
                }

                div.innerHTML = `
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                        <h4>Section ${si+1}: <input type="text" value="${escHtml(sec.title||'')}" onchange="sections[${si}].title=this.value" style="border:none;background:transparent;font-weight:700;font-size:0.9rem;padding:4px 8px;border-bottom:2px solid var(--gold-color);width:200px;"></h4>
                        <button type="button" class="btn-remove" onclick="removeSection(${si})" title="Hapus Section"><i class="fa-solid fa-trash"></i></button>
                    </div>
                    ${itemsHtml}
                    <div style="display:flex;gap:8px;margin-top:8px;">
                        <button type="button" class="btn-add-item" onclick="addItem(${si})"><i class="fa-solid fa-plus"></i> Item</button>
                        ${!sec.doa ? `<button type="button" class="btn-add-item" onclick="addDoa(${si})" style="background:rgba(201,168,76,0.15);color:#c9a84c;"><i class="fa-solid fa-plus"></i> Doa</button>` : ''}
                    </div>
                    ${doaHtml}
                `;
                c.appendChild(div);
            });
        }

        function escHtml(s) { const d=document.createElement('div'); d.textContent=s; return d.innerHTML.replace(/"/g,'&quot;'); }
        function addSection() { sections.push({title:'Section Baru',number:sections.length+1,items:[]}); render(); }
        function removeSection(i) { if(confirm('Hapus section ini?')){sections.splice(i,1); render();} }
        function addItem(si) { sections[si].items = sections[si].items||[]; sections[si].items.push(''); render(); }
        function removeItem(si,ii) { sections[si].items.splice(ii,1); render(); }
        function updateItem(si,ii,v) { sections[si].items[ii]=v; }
        function addDoa(si) { sections[si].doa={arabic:'',latin:'',arti:''}; render(); }
        function removeDoa(si) { delete sections[si].doa; render(); }
        function updateDoa(si,k,v) { sections[si].doa[k]=v; }

        document.getElementById('panduanForm').addEventListener('submit', function(e) {
            document.getElementById('sectionsInput').value = JSON.stringify(sections);
        });

        render();
    </script>
    @include('partials.chatbot')
</body>
</html>
