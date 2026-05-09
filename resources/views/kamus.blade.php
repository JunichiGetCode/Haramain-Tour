<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamus Bahasa Arab - Haramain Tour</title>
    <meta name="description" content="Kamus kosakata Bahasa Arab penting untuk jamaah umroh dan haji, dilengkapi dengan angka, sapaan, dan frasa darurat.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-color: #f5f3ee; --navy-color: #0d1130; --navy-light: #283375;
            --gold-color: #c9a84c; --gold-light: #d6b881; --gold-glow: rgba(201,168,76,0.3);
            --text-dark: #2c2c2c; --text-gray: #6b7280; --card-bg: #ffffff;
            --transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); overflow-x: hidden; }



        /* Search & Filter */
        .search-section { background: var(--card-bg); padding: 20px; border-bottom: 1px solid rgba(0,0,0,0.05); position: sticky; top: 60px; z-index: 50; box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 50px; }
        .search-inner { max-width: 900px; margin: 0 auto; display: flex; flex-direction: column; gap: 12px; }
        .search-input-wrapper { position: relative; }
        .search-input {
            width: 100%; padding: 14px 20px 14px 48px; border: 2px solid rgba(0,0,0,0.1);
            border-radius: 14px; font-size: 0.95rem; font-family: 'Poppins', sans-serif;
            outline: none; transition: 0.3s; background: var(--bg-color);
        }
        .search-input:focus { border-color: var(--gold-color); background: white; box-shadow: 0 0 0 4px var(--gold-glow); }
        .search-icon { position: absolute; left: 17px; top: 50%; transform: translateY(-50%); color: var(--text-gray); font-size: 1rem; pointer-events: none; }
        .cat-tabs { display: flex; gap: 8px; flex-wrap: wrap; }
        .cat-tab { padding: 7px 18px; border-radius: 50px; font-size: 0.8rem; font-weight: 700; border: 1.5px solid rgba(0,0,0,0.1); background: transparent; cursor: pointer; transition: var(--transition); color: var(--text-gray); font-family: 'Poppins', sans-serif; }
        .cat-tab:hover { border-color: var(--gold-color); color: var(--gold-color); }
        .cat-tab.active { background: var(--navy-color); color: var(--gold-color); border-color: var(--navy-color); }

        /* Container */
        .container { max-width: 1500px; margin: 0 auto; padding: 0 20px 80px; }

        /* Category Sections */
        .cat-section { margin-bottom: 50px; }
        .cat-section-title {
            display: flex; align-items: center; gap: 15px; margin-bottom: 20px;
            padding-bottom: 15px; border-bottom: 2px solid rgba(0,0,0,0.06);
        }
        .cat-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
        .cat-icon.sapaan { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
        .cat-icon.tempat { background: linear-gradient(135deg, #10b981, #059669); color: white; }
        .cat-icon.sehari { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; }
        .cat-icon.angka { background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; }
        .cat-icon.darurat { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
        .cat-section-title h2 { font-size: 1.3rem; font-weight: 800; color: var(--navy-color); }
        .cat-section-title p { font-size: 0.82rem; color: var(--text-gray); }

        /* Entry Cards */
        .entries-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; }
        .entry-card {
            background: var(--card-bg); border-radius: 16px; padding: 20px;
            border: 1px solid rgba(0,0,0,0.05);
            display: flex; flex-direction: column; gap: 8px;
            transition: var(--transition);
            cursor: pointer;
        }
        .entry-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.07); border-color: rgba(201,168,76,0.3); }
        .entry-card:active { transform: translateY(0); }
        .entry-row { display: flex; justify-content: space-between; align-items: flex-start; gap: 15px; }
        .entry-arabic { font-family: 'Amiri', serif; font-size: 1.5rem; color: var(--navy-color); direction: rtl; line-height: 1.4; }
        .entry-indo { font-weight: 700; color: var(--text-dark); font-size: 0.95rem; text-align: right; }
        .entry-latin { font-style: italic; color: var(--text-gray); font-size: 0.82rem; }

        /* Angka Grid */
        .angka-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
        }
        .angka-card {
            background: var(--card-bg); border-radius: 14px; padding: 18px 12px;
            text-align: center; border: 1px solid rgba(0,0,0,0.05);
            transition: var(--transition); cursor: default;
        }
        .angka-card:hover { border-color: var(--gold-color); transform: translateY(-3px); box-shadow: 0 6px 20px var(--gold-glow); }
        .angka-num { font-size: 1.6rem; font-weight: 900; color: var(--gold-color); line-height: 1; }
        .angka-arab { font-family: 'Amiri', serif; font-size: 1.3rem; color: var(--navy-color); margin: 6px 0 4px; }
        .angka-latin { font-style: italic; color: var(--text-gray); font-size: 0.72rem; }

        /* Frasa darurat menonjol */
        .darurat-grid { display: flex; flex-direction: column; gap: 12px; }
        .darurat-card {
            background: linear-gradient(135deg, #fff5f5, #fff);
            border: 1.5px solid rgba(239,68,68,0.2);
            border-radius: 16px; padding: 18px 20px;
            display: flex; align-items: center; gap: 15px;
            transition: var(--transition);
        }
        .darurat-card:hover { border-color: #ef4444; transform: translateX(5px); }
        .darurat-icon { width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0; }
        .darurat-arabic { font-family: 'Amiri', serif; font-size: 1.3rem; color: #dc2626; direction: rtl; }
        .darurat-text strong { font-size: 0.95rem; font-weight: 700; color: var(--text-dark); display: block; }
        .darurat-text small { font-style: italic; color: var(--text-gray); font-size: 0.8rem; }

        /* no results */
        .no-results { text-align: center; padding: 60px 20px; color: var(--text-gray); display: none; }
        .no-results i { font-size: 3rem; margin-bottom: 15px; color: #d1d5db; display: block; }

        @media (max-width: 768px) {
            .entries-grid { grid-template-columns: 1fr; }
            .angka-grid { grid-template-columns: repeat(3, 1fr); }
            .container { padding: 0 15px 60px; }
        }
        @media (max-width: 480px) {
            .angka-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
    @include('partials.footer-css')
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">
    @include('partials.navbar-css')
    @include('partials.navbar')

    <x-hero 
        badgeIcon="fa-solid fa-language" 
        :badgeText="__('Perbendaharaan Bahasa')" 
        :title="__('Kamus Bahasa Arab')" 
        arabic="قَامُوس عَرَبِي" 
        :description="__('Kosa kata dan frasa penting yang wajib dikuasai jamaah selama di Tanah Suci. Cari, pelajari, dan bawa bersama Anda!')"
        bgIcon="\f1ab" 
    />

    <div class="search-section">
        <div class="search-inner">
            <div class="search-input-wrapper">
                <i class="fa-solid fa-search search-icon"></i>
                <input type="text" id="searchInput" class="search-input" placeholder="Cari kata Arab atau artinya... (contoh: masjid, hotel, tolong)" oninput="filterKamus()">
            </div>
            <div class="cat-tabs">
                <button class="cat-tab active" onclick="scrollToSection('cat-sapaan', this)">{{ __('Sapaan & Umum') }}</button>
                <button class="cat-tab" onclick="scrollToSection('cat-tempat', this)">{{ __('Tempat & Arah') }}</button>
                <button class="cat-tab" onclick="scrollToSection('cat-sehari', this)">{{ __('Sehari-hari') }}</button>
                <button class="cat-tab" onclick="scrollToSection('cat-angka', this)">{{ __('Angka') }}</button>
                <button class="cat-tab" onclick="scrollToSection('cat-darurat', this)">{{ __('Frasa Darurat') }}</button>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="no-results" id="noResults">
            <i class="fa-solid fa-search"></i>
            Tidak ditemukan kata "<span id="searchTerm"></span>"
        </div>

        <!-- Sapaan & Umum -->
        <div class="cat-section" id="cat-sapaan">
            <div class="cat-section-title">
                <div class="cat-icon sapaan"><i class="fa-solid fa-hand-wave"></i></div>
                <div><h2>{{ __('Sapaan & Umum') }}</h2><p>{{ __('Kata-kata yang sering diucapkan setiap hari') }}</p></div>
            </div>
            <div class="entries-grid" id="grid-sapaan">
                <div class="entry-card kamus-item" data-search="assalamu alaikum semoga keselamatan salam">
                    <div class="entry-row"><span class="entry-arabic">السَّلاَمُ عَلَيْكُمْ</span><span class="entry-indo">Semoga keselamatan atas kamu</span></div>
                    <span class="entry-latin">Assalamu'alaikum</span>
                </div>
                <div class="entry-card kamus-item" data-search="syukran terima kasih">
                    <div class="entry-row"><span class="entry-arabic">شُكْرًا</span><span class="entry-indo">Terima kasih</span></div>
                    <span class="entry-latin">Syukran</span>
                </div>
                <div class="entry-card kamus-item" data-search="afwan maaf permisi">
                    <div class="entry-row"><span class="entry-arabic">عَفْوًا</span><span class="entry-indo">Maaf / Permisi</span></div>
                    <span class="entry-latin">'Afwan</span>
                </div>
                <div class="entry-card kamus-item" data-search="na'am laa ya tidak">
                    <div class="entry-row"><span class="entry-arabic">نَعَمْ / لاَ</span><span class="entry-indo">Ya / Tidak</span></div>
                    <span class="entry-latin">Na'am / Laa</span>
                </div>
                <div class="entry-card kamus-item" data-search="min fadhlika tolong mohon">
                    <div class="entry-row"><span class="entry-arabic">مِنْ فَضْلِكَ</span><span class="entry-indo">Tolong / Mohon</span></div>
                    <span class="entry-latin">Min Fadhlika</span>
                </div>
                <div class="entry-card kamus-item" data-search="insyaallah jika allah menghendaki">
                    <div class="entry-row"><span class="entry-arabic">إِنْ شَاءَ اللَّهُ</span><span class="entry-indo">Jika Allah menghendaki</span></div>
                    <span class="entry-latin">Insya Allah</span>
                </div>
                <div class="entry-card kamus-item" data-search="alhamdulillah segala puji bagi allah">
                    <div class="entry-row"><span class="entry-arabic">الْحَمْدُ لِلَّهِ</span><span class="entry-indo">Segala puji bagi Allah</span></div>
                    <span class="entry-latin">Alhamdulillah</span>
                </div>
                <div class="entry-card kamus-item" data-search="subhanallah maha suci allah">
                    <div class="entry-row"><span class="entry-arabic">سُبْحَانَ اللَّهِ</span><span class="entry-indo">Maha suci Allah</span></div>
                    <span class="entry-latin">Subhanallah</span>
                </div>
            </div>
        </div>

        <!-- Tempat & Arah -->
        <div class="cat-section" id="cat-tempat">
            <div class="cat-section-title">
                <div class="cat-icon tempat"><i class="fa-solid fa-map-location-dot"></i></div>
                <div><h2>{{ __('Tempat & Arah') }}</h2><p>{{ __('Navigasi dan lokasi penting') }}</p></div>
            </div>
            <div class="entries-grid" id="grid-tempat">
                <div class="entry-card kamus-item" data-search="masjid al-masjid">
                    <div class="entry-row"><span class="entry-arabic">اَلْمَسْجِد</span><span class="entry-indo">Masjid</span></div>
                    <span class="entry-latin">Al-Masjid</span>
                </div>
                <div class="entry-card kamus-item" data-search="funduq hotel">
                    <div class="entry-row"><span class="entry-arabic">اَلْفُنْدُق</span><span class="entry-indo">Hotel</span></div>
                    <span class="entry-latin">Al-Funduq</span>
                </div>
                <div class="entry-card kamus-item" data-search="yamiin yasaar kanan kiri">
                    <div class="entry-row"><span class="entry-arabic">يَمِين / يَسَار</span><span class="entry-indo">Kanan / Kiri</span></div>
                    <span class="entry-latin">Yamiin / Yasaar</span>
                </div>
                <div class="entry-card kamus-item" data-search="aina di mana">
                    <div class="entry-row"><span class="entry-arabic">أَيْنَ؟</span><span class="entry-indo">Di mana?</span></div>
                    <span class="entry-latin">Aina?</span>
                </div>
                <div class="entry-card kamus-item" data-search="hammam kamar mandi toilet">
                    <div class="entry-row"><span class="entry-arabic">اَلْحَمَّام</span><span class="entry-indo">Kamar mandi / Toilet</span></div>
                    <span class="entry-latin">Al-Hammaam</span>
                </div>
                <div class="entry-card kamus-item" data-search="suuq pasar market">
                    <div class="entry-row"><span class="entry-arabic">اَلسُّوق</span><span class="entry-indo">Pasar</span></div>
                    <span class="entry-latin">As-Suuq</span>
                </div>
                <div class="entry-card kamus-item" data-search="mustasyfa rumah sakit hospital">
                    <div class="entry-row"><span class="entry-arabic">اَلْمُسْتَشْفَى</span><span class="entry-indo">Rumah Sakit</span></div>
                    <span class="entry-latin">Al-Mustasyfa</span>
                </div>
                <div class="entry-card kamus-item" data-search="matar bandara airport">
                    <div class="entry-row"><span class="entry-arabic">اَلْمَطَار</span><span class="entry-indo">Bandara</span></div>
                    <span class="entry-latin">Al-Mataar</span>
                </div>
            </div>
        </div>

        <!-- Sehari-hari -->
        <div class="cat-section" id="cat-sehari">
            <div class="cat-section-title">
                <div class="cat-icon sehari"><i class="fa-solid fa-basket-shopping"></i></div>
                <div><h2>{{ __('Kebutuhan Sehari-hari') }}</h2><p>{{ __('Belanja, makan, transportasi') }}</p></div>
            </div>
            <div class="entries-grid" id="grid-sehari">
                <div class="entry-card kamus-item" data-search="maa air water">
                    <div class="entry-row"><span class="entry-arabic">مَاء</span><span class="entry-indo">Air</span></div>
                    <span class="entry-latin">Maa'</span>
                </div>
                <div class="entry-card kamus-item" data-search="tha'aam makanan food">
                    <div class="entry-row"><span class="entry-arabic">طَعَام</span><span class="entry-indo">Makanan</span></div>
                    <span class="entry-latin">Tha'aam</span>
                </div>
                <div class="entry-card kamus-item" data-search="bikam berapa harganya price">
                    <div class="entry-row"><span class="entry-arabic">بِكَمْ؟</span><span class="entry-indo">Berapa harganya?</span></div>
                    <span class="entry-latin">Bikam?</span>
                </div>
                <div class="entry-card kamus-item" data-search="ghaalii mahal expensive">
                    <div class="entry-row"><span class="entry-arabic">غَالِي</span><span class="entry-indo">Mahal</span></div>
                    <span class="entry-latin">Ghaalii</span>
                </div>
                <div class="entry-card kamus-item" data-search="rakhiish murah cheap">
                    <div class="entry-row"><span class="entry-arabic">رَخِيص</span><span class="entry-indo">Murah</span></div>
                    <span class="entry-latin">Rakhiish</span>
                </div>
                <div class="entry-card kamus-item" data-search="sayyaarah mobil taksi car taxi">
                    <div class="entry-row"><span class="entry-arabic">سَيَّارَة</span><span class="entry-indo">Mobil / Taksi</span></div>
                    <span class="entry-latin">Sayyaarah</span>
                </div>
                <div class="entry-card kamus-item" data-search="tabib dokter doctor">
                    <div class="entry-row"><span class="entry-arabic">طَبِيب</span><span class="entry-indo">Dokter</span></div>
                    <span class="entry-latin">Thabiib</span>
                </div>
                <div class="entry-card kamus-item" data-search="dawa obat medicine">
                    <div class="entry-row"><span class="entry-arabic">دَوَاء</span><span class="entry-indo">Obat</span></div>
                    <span class="entry-latin">Dawaa'</span>
                </div>
            </div>
        </div>

        <!-- Angka -->
        <div class="cat-section" id="cat-angka">
            <div class="cat-section-title">
                <div class="cat-icon angka"><i class="fa-solid fa-hashtag"></i></div>
                <div><h2>{{ __('Angka Dasar') }}</h2><p>{{ __('Bilangan dalam bahasa Arab') }}</p></div>
            </div>
            <div class="angka-grid">
                <div class="angka-card"><div class="angka-num">1</div><div class="angka-arab">وَاحِد</div><div class="angka-latin">Waahid</div></div>
                <div class="angka-card"><div class="angka-num">2</div><div class="angka-arab">اِثْنَان</div><div class="angka-latin">Itsnaan</div></div>
                <div class="angka-card"><div class="angka-num">3</div><div class="angka-arab">ثَلاَثَة</div><div class="angka-latin">Tsalaatsah</div></div>
                <div class="angka-card"><div class="angka-num">4</div><div class="angka-arab">أَرْبَعَة</div><div class="angka-latin">Arba'ah</div></div>
                <div class="angka-card"><div class="angka-num">5</div><div class="angka-arab">خَمْسَة</div><div class="angka-latin">Khamsah</div></div>
                <div class="angka-card"><div class="angka-num">6</div><div class="angka-arab">سِتَّة</div><div class="angka-latin">Sittah</div></div>
                <div class="angka-card"><div class="angka-num">7</div><div class="angka-arab">سَبْعَة</div><div class="angka-latin">Sab'ah</div></div>
                <div class="angka-card"><div class="angka-num">8</div><div class="angka-arab">ثَمَانِيَة</div><div class="angka-latin">Tsamaaniyah</div></div>
                <div class="angka-card"><div class="angka-num">9</div><div class="angka-arab">تِسْعَة</div><div class="angka-latin">Tis'ah</div></div>
                <div class="angka-card"><div class="angka-num">10</div><div class="angka-arab">عَشَرَة</div><div class="angka-latin">'Asyarah</div></div>
                <div class="angka-card"><div class="angka-num">20</div><div class="angka-arab">عِشْرُون</div><div class="angka-latin">'Isyruun</div></div>
                <div class="angka-card"><div class="angka-num">100</div><div class="angka-arab">مِائَة</div><div class="angka-latin">Mi'ah</div></div>
            </div>
        </div>

        <!-- Frasa Darurat -->
        <div class="cat-section" id="cat-darurat">
            <div class="cat-section-title">
                <div class="cat-icon darurat"><i class="fa-solid fa-triangle-exclamation"></i></div>
                <div><h2>{{ __('Frasa Darurat') }}</h2><p>{{ __('Kalimat penting saat membutuhkan bantuan') }}</p></div>
            </div>
            <div class="darurat-grid">
                <div class="darurat-card">
                    <div class="darurat-icon"><i class="fa-solid fa-hand-wave"></i></div>
                    <div style="flex:1;">
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <div class="darurat-text"><strong>Tolong saya!</strong><small>Saa'idnii!</small></div>
                            <span class="darurat-arabic">سَاعِدْنِي!</span>
                        </div>
                    </div>
                </div>
                <div class="darurat-card">
                    <div class="darurat-icon"><i class="fa-solid fa-face-dizzy"></i></div>
                    <div style="flex:1;">
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <div class="darurat-text"><strong>Saya sakit</strong><small>Ana mariidh</small></div>
                            <span class="darurat-arabic">أَنَا مَرِيض</span>
                        </div>
                    </div>
                </div>
                <div class="darurat-card">
                    <div class="darurat-icon"><i class="fa-solid fa-map-location"></i></div>
                    <div style="flex:1;">
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <div class="darurat-text"><strong>Saya tersesat</strong><small>Ana dhaa'i'</small></div>
                            <span class="darurat-arabic">أَنَا ضَائِع</span>
                        </div>
                    </div>
                </div>
                <div class="darurat-card">
                    <div class="darurat-icon"><i class="fa-solid fa-shield-halved"></i></div>
                    <div style="flex:1;">
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <div class="darurat-text"><strong>Hubungi polisi!</strong><small>Ittashil bisy-syurthah!</small></div>
                            <span class="darurat-arabic">اِتَّصِلْ بِالشُّرْطَة!</span>
                        </div>
                    </div>
                </div>
                <div class="darurat-card">
                    <div class="darurat-icon"><i class="fa-solid fa-phone"></i></div>
                    <div style="flex:1;">
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <div class="darurat-text"><strong>Di mana rumah sakit?</strong><small>Aina al-mustasyfa?</small></div>
                            <span class="darurat-arabic">أَيْنَ الْمُسْتَشْفَى؟</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('partials.footer')

    <script>
        function filterKamus() {
            const q = document.getElementById('searchInput').value.toLowerCase().trim();
            const items = document.querySelectorAll('.kamus-item');
            let visible = 0;
            items.forEach(item => {
                const text = item.dataset.search + item.textContent.toLowerCase();
                if (!q || text.includes(q)) { item.style.display = ''; visible++; }
                else { item.style.display = 'none'; }
            });
            const noRes = document.getElementById('noResults');
            document.getElementById('searchTerm').textContent = q;
            noRes.style.display = (visible === 0 && q) ? 'block' : 'none';
        }

        function scrollToSection(id, btn) {
            document.querySelectorAll('.cat-tab').forEach(t => t.classList.remove('active'));
            btn.classList.add('active');
            const el = document.getElementById(id);
            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    </script>

    @include('partials.chatbot')
</body>
</html>


