<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doa-Doa Penting Umroh & Haji - Haramain Tour</title>
    <meta name="description" content="Kumpulan doa-doa penting saat umroh dan haji lengkap dengan teks Arab, latin, dan artinya.">
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



        /* Filter Tabs */
        .filter-section { background: var(--card-bg); padding: 15px 20px; border-bottom: 1px solid rgba(0,0,0,0.05); position: sticky; top: 60px; z-index: 50; margin-bottom: 50px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); }
        .filter-tabs { max-width: 900px; margin: 0 auto; display: flex; gap: 10px; flex-wrap: wrap; justify-content: center; }
        .filter-tab {
            padding: 8px 20px; border-radius: 50px; font-size: 0.82rem; font-weight: 700;
            border: 1.5px solid rgba(0,0,0,0.1); background: transparent; cursor: pointer;
            transition: var(--transition); color: var(--text-gray); font-family: 'Poppins', sans-serif;
        }
        .filter-tab:hover { border-color: var(--gold-color); color: var(--gold-color); }
        .filter-tab.active { background: var(--navy-color); color: var(--gold-color); border-color: var(--navy-color); }

        /* Container */
        .container { max-width: 1500px; margin: 0 auto; padding: 0 20px 80px; }
        
        /* Section Header */
        .section-hdr { display: flex; align-items: center; gap: 15px; margin-bottom: 25px; padding-top: 30px; }
        .section-hdr-icon { width: 48px; height: 48px; border-radius: 14px; background: linear-gradient(135deg, var(--navy-color), var(--navy-light)); display: flex; align-items: center; justify-content: center; color: var(--gold-color); font-size: 1.2rem; flex-shrink: 0; }
        .section-hdr h2 { font-size: 1.4rem; font-weight: 800; color: var(--navy-color); }
        .section-hdr p { font-size: 0.85rem; color: var(--text-gray); }

        /* Doa Card */
        .doa-card {
            background: var(--card-bg);
            border-radius: 20px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            border: 1px solid rgba(0,0,0,0.04);
            transition: var(--transition);
        }
        .doa-card:hover { transform: translateY(-4px); box-shadow: 0 12px 35px rgba(0,0,0,0.08); }
        
        .doa-card-header {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            padding: 18px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }
        .doa-card-title { font-size: 1rem; font-weight: 700; color: white; display: flex; align-items: center; gap: 12px; }
        .doa-card-title .doa-num {
            width: 30px; height: 30px; border-radius: 8px;
            background: rgba(201,168,76,0.3); color: var(--gold-color);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem; font-weight: 800; flex-shrink: 0;
        }
        .doa-card-chevron { color: rgba(255,255,255,0.5); transition: 0.3s; }
        .doa-card.open .doa-card-chevron { transform: rotate(180deg); color: var(--gold-color); }
        
        .doa-card-body { padding: 25px; display: none; }
        .doa-card.open .doa-card-body { display: block; }
        
        .doa-arabic {
            font-family: 'Amiri', serif;
            font-size: 1.8rem;
            color: var(--navy-color);
            text-align: center;
            direction: rtl;
            line-height: 2.2;
            padding: 25px;
            background: linear-gradient(135deg, rgba(13,17,48,0.03), rgba(201,168,76,0.05));
            border-radius: 16px;
            margin-bottom: 20px;
            border: 1px solid rgba(201,168,76,0.2);
        }
        .doa-latin {
            font-style: italic;
            color: var(--text-gray);
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 15px;
            padding: 15px 20px;
            background: rgba(0,0,0,0.02);
            border-radius: 12px;
            border-left: 3px solid var(--gold-color);
        }
        .doa-latin strong { color: var(--navy-color); font-style: normal; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 6px; }
        .doa-arti { font-size: 0.95rem; color: var(--text-dark); line-height: 1.7; padding: 15px 20px; background: rgba(201,168,76,0.06); border-radius: 12px; }
        .doa-arti strong { color: var(--gold-color); font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 6px; }
        
        .copy-btn {
            background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
            color: var(--navy-color); border: none; padding: 10px 20px; border-radius: 50px;
            font-size: 0.82rem; font-weight: 700; cursor: pointer; margin-top: 18px;
            display: flex; align-items: center; gap: 7px; transition: 0.3s; font-family: 'Poppins', sans-serif;
        }
        .copy-btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px var(--gold-glow); }

        .category-section { display: none; }
        .category-section.active { display: block; }

        /* Tips box */
        .tips-box {
            background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
            border-radius: 20px; padding: 30px; color: white; margin-top: 40px; display: flex; gap: 20px; align-items: flex-start;
        }
        .tips-box i { font-size: 2rem; color: var(--gold-color); margin-top: 4px; }
        .tips-box p { font-size: 0.92rem; color: rgba(255,255,255,0.8); line-height: 1.7; }
        .tips-box strong { color: var(--gold-color); font-size: 1rem; display: block; margin-bottom: 8px; }

        @media (max-width: 768px) {
            .doa-arabic { font-size: 1.5rem; padding: 20px 15px; }
            .container { padding: 0 15px 60px; }
            .filter-tabs { gap: 8px; }
            .filter-tab { padding: 7px 14px; font-size: 0.78rem; }
        }
    </style>
    @include('partials.footer-css')
    @include('partials.dark-mode')
</head>
<body class="{{ ($userSettings['dark_mode'] ?? false) ? 'dark-mode' : '' }}">
    @include('partials.navbar-css')
    @include('partials.navbar')

    <x-hero 
        badgeIcon="fa-solid fa-hands-praying" 
        :badgeText="__('Referensi Ibadah')" 
        :title="__('Doa Penting Umroh & Haji')" 
        arabic="أَدْعِيَةٌ مُهِمَّةٌ" 
        :description="__('Pahami dan hafal doa-doa yang dibaca selama ibadah umroh dan haji. Dilengkapi teks Arab, latin, dan terjemahan untuk kemudahan jamaah.')"
        bgIcon="\f683" 
    />

    <div class="filter-section">
        <div class="filter-tabs">
            <button class="filter-tab active" onclick="showCategory('semua', this)">{{ __('Semua Doa') }}</button>
            <button class="filter-tab" onclick="showCategory('masjid', this)">{{ __('Masjid') }}</button>
            <button class="filter-tab" onclick="showCategory('tawaf', this)">{{ __('Tawaf') }}</button>
            <button class="filter-tab" onclick="showCategory('sai', this)">{{ __('Sa\'i') }}</button>
            <button class="filter-tab" onclick="showCategory('arafah', this)">{{ __('Arafah') }}</button>
        </div>
    </div>

    <div class="container">

        <!-- SEMUA DOA / MASJID -->
        <div id="cat-masjid" class="category-section active">
            <div class="section-hdr">
                <div class="section-hdr-icon"><i class="fa-solid fa-mosque"></i></div>
                <div>
                    <h2>{{ __('Doa di Masjidil Haram') }}</h2>
                    <p>{{ __('Doa masuk, keluar, dan saat melihat Ka\'bah pertama kali') }}</p>
                </div>
            </div>

            <div class="doa-card open">
                <div class="doa-card-header" onclick="toggleDoa(this)">
                    <div class="doa-card-title"><span class="doa-num">1</span> Doa Masuk Masjidil Haram</div>
                    <i class="fa-solid fa-chevron-down doa-card-chevron"></i>
                </div>
                <div class="doa-card-body">
                    <div class="doa-arabic">بِسْمِ اللَّهِ وَالصَّلاَةُ وَالسَّلاَمُ عَلَى رَسُولِ اللَّهِ، اللَّهُمَّ افْتَحْ لِي أَبْوَابَ رَحْمَتِكَ</div>
                    <div class="doa-latin"><strong>Latin</strong>Bismillahi wash-shalaatu was-salaamu 'ala Rasulillah, Allahummaf-tah li abwaaba rahmatik</div>
                    <div class="doa-arti"><strong>Artinya</strong>Dengan nama Allah, shalawat dan salam atas Rasulullah. Ya Allah bukakanlah untukku pintu-pintu rahmat-Mu.</div>
                    <button class="copy-btn" onclick="copyDoa(this, 'Bismillahi wash-shalaatu was-salaamu \'ala Rasulillah, Allahummaf-tah li abwaaba rahmatik')"><i class="fa-solid fa-copy"></i> Salin Latin</button>
                </div>
            </div>

            <div class="doa-card">
                <div class="doa-card-header" onclick="toggleDoa(this)">
                    <div class="doa-card-title"><span class="doa-num">2</span> Doa Melihat Ka'bah Pertama Kali</div>
                    <i class="fa-solid fa-chevron-down doa-card-chevron"></i>
                </div>
                <div class="doa-card-body">
                    <div class="doa-arabic">اللَّهُمَّ أَنْتَ السَّلاَمُ وَمِنْكَ السَّلاَمُ فَحَيِّنَا رَبَّنَا بِالسَّلاَمِ</div>
                    <div class="doa-latin"><strong>Latin</strong>Allahumma antas-salaam, wa minkas-salaam, fa hayyinaa rabbanaa bis-salaam</div>
                    <div class="doa-arti"><strong>Artinya</strong>Ya Allah, Engkaulah As-Salaam (Yang Maha Sejahtera), dari-Mu segala kesejahteraan. Maka hidupkanlah kami wahai Tuhan kami dengan kesejahteraan.</div>
                    <button class="copy-btn" onclick="copyDoa(this, 'Allahumma antas-salaam, wa minkas-salaam, fa hayyinaa rabbanaa bis-salaam')"><i class="fa-solid fa-copy"></i> Salin Latin</button>
                </div>
            </div>

            <div class="doa-card">
                <div class="doa-card-header" onclick="toggleDoa(this)">
                    <div class="doa-card-title"><span class="doa-num">3</span> Doa Keluar Masjid</div>
                    <i class="fa-solid fa-chevron-down doa-card-chevron"></i>
                </div>
                <div class="doa-card-body">
                    <div class="doa-arabic">بِسْمِ اللَّهِ وَالصَّلاَةُ وَالسَّلاَمُ عَلَى رَسُولِ اللَّهِ، اللَّهُمَّ إِنِّي أَسْأَلُكَ مِنْ فَضْلِكَ</div>
                    <div class="doa-latin"><strong>Latin</strong>Bismillahi wash-shalaatu was-salaamu 'ala Rasulillah, Allahumma inni as'aluka min fadlik</div>
                    <div class="doa-arti"><strong>Artinya</strong>Dengan nama Allah, shalawat dan salam atas Rasulullah. Ya Allah, aku memohon keutamaan dari-Mu.</div>
                    <button class="copy-btn" onclick="copyDoa(this, 'Bismillahi wash-shalaatu was-salaamu \'ala Rasulillah, Allahumma inni as\'aluka min fadlik')"><i class="fa-solid fa-copy"></i> Salin Latin</button>
                </div>
            </div>
        </div>

        <!-- TAWAF -->
        <div id="cat-tawaf" class="category-section active">
            <div class="section-hdr">
                <div class="section-hdr-icon"><i class="fa-solid fa-kaaba"></i></div>
                <div>
                    <h2>{{ __('Doa saat Tawaf') }}</h2>
                    <p>{{ __('Dibaca ketika mengelilingi Ka\'bah') }}</p>
                </div>
            </div>

            <div class="doa-card">
                <div class="doa-card-header" onclick="toggleDoa(this)">
                    <div class="doa-card-title"><span class="doa-num">4</span> Doa Memulai Tawaf (Hajar Aswad)</div>
                    <i class="fa-solid fa-chevron-down doa-card-chevron"></i>
                </div>
                <div class="doa-card-body">
                    <div class="doa-arabic">بِسْمِ اللَّهِ وَاللَّهُ أَكْبَرُ</div>
                    <div class="doa-latin"><strong>Latin</strong>Bismillahi wallahu akbar</div>
                    <div class="doa-arti"><strong>Artinya</strong>Dengan nama Allah dan Allah Maha Besar. (Dibaca saat memulai setiap putaran di Hajar Aswad)</div>
                    <button class="copy-btn" onclick="copyDoa(this, 'Bismillahi wallahu akbar')"><i class="fa-solid fa-copy"></i> Salin Latin</button>
                </div>
            </div>

            <div class="doa-card">
                <div class="doa-card-header" onclick="toggleDoa(this)">
                    <div class="doa-card-title"><span class="doa-num">5</span> Doa Antara Rukun Yamani & Hajar Aswad</div>
                    <i class="fa-solid fa-chevron-down doa-card-chevron"></i>
                </div>
                <div class="doa-card-body">
                    <div class="doa-arabic">رَبَّنَا آتِنَا فِي الدُّنْيَا حَسَنَةً وَفِي الآخِرَةِ حَسَنَةً وَقِنَا عَذَابَ النَّارِ</div>
                    <div class="doa-latin"><strong>Latin</strong>Rabbanaa aatinaa fid-dunyaa hasanah, wa fil-aakhirati hasanah, wa qinaa 'adzaaban-naar</div>
                    <div class="doa-arti"><strong>Artinya</strong>Ya Tuhan kami, berilah kami kebaikan di dunia dan kebaikan di akhirat, dan lindungilah kami dari azab neraka.</div>
                    <button class="copy-btn" onclick="copyDoa(this, 'Rabbanaa aatinaa fid-dunyaa hasanah, wa fil-aakhirati hasanah, wa qinaa \'adzaaban-naar')"><i class="fa-solid fa-copy"></i> Salin Latin</button>
                </div>
            </div>

            <div class="doa-card">
                <div class="doa-card-header" onclick="toggleDoa(this)">
                    <div class="doa-card-title"><span class="doa-num">6</span> Doa Setelah Shalat di Maqam Ibrahim</div>
                    <i class="fa-solid fa-chevron-down doa-card-chevron"></i>
                </div>
                <div class="doa-card-body">
                    <div class="doa-arabic">وَاتَّخِذُوا مِنْ مَقَامِ إِبْرَاهِيمَ مُصَلًّى</div>
                    <div class="doa-latin"><strong>Latin</strong>Wattakhidzuu min maqaami Ibraahiima mushalla</div>
                    <div class="doa-arti"><strong>Artinya</strong>Dan jadikanlah sebagian maqam Ibrahim tempat shalat. (QS Al-Baqarah: 125)</div>
                    <button class="copy-btn" onclick="copyDoa(this, 'Wattakhidzuu min maqaami Ibraahiima mushalla')"><i class="fa-solid fa-copy"></i> Salin Latin</button>
                </div>
            </div>
        </div>

        <!-- SA'I -->
        <div id="cat-sai" class="category-section active">
            <div class="section-hdr">
                <div class="section-hdr-icon"><i class="fa-solid fa-person-walking"></i></div>
                <div>
                    <h2>{{ __('Doa saat Sa\'i') }}</h2>
                    <p>{{ __('Doa di bukit Shafa, Marwah, dan air Zamzam') }}</p>
                </div>
            </div>

            <div class="doa-card">
                <div class="doa-card-header" onclick="toggleDoa(this)">
                    <div class="doa-card-title"><span class="doa-num">7</span> Doa di Bukit Shafa & Marwah</div>
                    <i class="fa-solid fa-chevron-down doa-card-chevron"></i>
                </div>
                <div class="doa-card-body">
                    <div class="doa-arabic">إِنَّ الصَّفَا وَالْمَرْوَةَ مِنْ شَعَائِرِ اللَّهِ</div>
                    <div class="doa-latin"><strong>Latin</strong>Innash-shafaa wal-marwata min sya'aa'irillah</div>
                    <div class="doa-arti"><strong>Artinya</strong>Sesungguhnya Shafa dan Marwah adalah sebagian dari syi'ar Allah. (QS Al-Baqarah: 158 — dibaca saat pertama naik ke Shafa)</div>
                    <button class="copy-btn" onclick="copyDoa(this, 'Innash-shafaa wal-marwata min sya\'aa\'irillah')"><i class="fa-solid fa-copy"></i> Salin Latin</button>
                </div>
            </div>

            <div class="doa-card">
                <div class="doa-card-header" onclick="toggleDoa(this)">
                    <div class="doa-card-title"><span class="doa-num">8</span> Doa Minum Air Zamzam</div>
                    <i class="fa-solid fa-chevron-down doa-card-chevron"></i>
                </div>
                <div class="doa-card-body">
                    <div class="doa-arabic">اللَّهُمَّ إِنِّي أَسْأَلُكَ عِلْمًا نَافِعًا وَرِزْقًا وَاسِعًا وَشِفَاءً مِنْ كُلِّ دَاءٍ</div>
                    <div class="doa-latin"><strong>Latin</strong>Allahumma inni as'aluka 'ilman naafi'an, wa rizqan waasi'an, wa syifaa'an min kulli daa'</div>
                    <div class="doa-arti"><strong>Artinya</strong>Ya Allah, aku memohon kepada-Mu ilmu yang bermanfaat, rezeki yang luas, dan kesembuhan dari segala penyakit.</div>
                    <button class="copy-btn" onclick="copyDoa(this, 'Allahumma inni as\'aluka \'ilman naafi\'an, wa rizqan waasi\'an, wa syifaa\'an min kulli daa\'')"><i class="fa-solid fa-copy"></i> Salin Latin</button>
                </div>
            </div>
        </div>

        <!-- ARAFAH -->
        <div id="cat-arafah" class="category-section active">
            <div class="section-hdr">
                <div class="section-hdr-icon"><i class="fa-solid fa-sun"></i></div>
                <div>
                    <h2>{{ __('Doa di Padang Arafah & Talbiyah') }}</h2>
                    <p>{{ __('Doa utama haji dan bacaan talbiyah') }}</p>
                </div>
            </div>

            <div class="doa-card">
                <div class="doa-card-header" onclick="toggleDoa(this)">
                    <div class="doa-card-title"><span class="doa-num">9</span> Bacaan Talbiyah</div>
                    <i class="fa-solid fa-chevron-down doa-card-chevron"></i>
                </div>
                <div class="doa-card-body">
                    <div class="doa-arabic">لَبَّيْكَ اللَّهُمَّ لَبَّيْكَ، لَبَّيْكَ لاَ شَرِيكَ لَكَ لَبَّيْكَ، إِنَّ الْحَمْدَ وَالنِّعْمَةَ لَكَ وَالْمُلْكَ، لاَ شَرِيكَ لَكَ</div>
                    <div class="doa-latin"><strong>Latin</strong>Labbaikallahumma labbaik, labbaika laa syariika laka labbaik, innal-hamda wan-ni'mata laka wal-mulk, laa syariika lak</div>
                    <div class="doa-arti"><strong>Artinya</strong>Aku penuhi panggilan-Mu ya Allah, aku penuhi. Aku penuhi, tiada sekutu bagi-Mu. Sesungguhnya segala puji, nikmat, dan kekuasaan milik-Mu. Tiada sekutu bagi-Mu.</div>
                    <button class="copy-btn" onclick="copyDoa(this, 'Labbaikallahumma labbaik, labbaika laa syariika laka labbaik, innal-hamda wan-ni\'mata laka wal-mulk, laa syariika lak')"><i class="fa-solid fa-copy"></i> Salin Latin</button>
                </div>
            </div>

            <div class="doa-card">
                <div class="doa-card-header" onclick="toggleDoa(this)">
                    <div class="doa-card-title"><span class="doa-num">10</span> Doa Terbaik di Hari Arafah</div>
                    <i class="fa-solid fa-chevron-down doa-card-chevron"></i>
                </div>
                <div class="doa-card-body">
                    <div class="doa-arabic">لاَ إِلَهَ إِلاَّ اللَّهُ وَحْدَهُ لاَ شَرِيكَ لَهُ، لَهُ الْمُلْكُ وَلَهُ الْحَمْدُ وَهُوَ عَلَى كُلِّ شَيْءٍ قَدِيرٌ</div>
                    <div class="doa-latin"><strong>Latin</strong>Laa ilaaha illallahu wahdahu laa syariika lah, lahul-mulku wa lahu al-hamdu wa huwa 'alaa kulli syai'in qadiir</div>
                    <div class="doa-arti"><strong>Artinya</strong>Tiada Tuhan selain Allah semata, tiada sekutu bagi-Nya. Milik-Nya segala kerajaan dan pujian, dan Dia Maha Kuasa atas segala sesuatu. (HR. Tirmidzi — doa terbaik di Arafah)</div>
                    <button class="copy-btn" onclick="copyDoa(this, 'Laa ilaaha illallahu wahdahu laa syariika lah, lahul-mulku wa lahu al-hamdu wa huwa \'alaa kulli syai\'in qadiir')"><i class="fa-solid fa-copy"></i> Salin Latin</button>
                </div>
            </div>
        </div>

        <div class="tips-box">
            <i class="fa-solid fa-lightbulb"></i>
            <div>
                <strong>{{ __('Tips Hafalan Doa') }}</strong>
                <p>{{ __('Mulailah menghafal 2–3 doa wajib terlebih dahulu (Talbiyah, Doa Tawaf, Doa Zamzam). Baca 10 menit setiap hari sebelum keberangkatan. Anda bisa membuka halaman ini kapan saja sebagai referensi cepat selama di tanah suci.') }}</p>
            </div>
        </div>

    </div>

    @include('partials.footer')

    <script>
        function toggleDoa(header) {
            const card = header.closest('.doa-card');
            card.classList.toggle('open');
        }

        function showCategory(cat, btn) {
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            btn.classList.add('active');
            if (cat === 'semua') {
                document.querySelectorAll('.category-section').forEach(s => s.classList.add('active'));
            } else {
                document.querySelectorAll('.category-section').forEach(s => s.classList.remove('active'));
                const el = document.getElementById('cat-' + cat);
                if (el) el.classList.add('active');
            }
        }

        function copyDoa(btn, text) {
            navigator.clipboard.writeText(text).then(() => {
                const orig = btn.innerHTML;
                btn.innerHTML = '<i class="fa-solid fa-check"></i> Tersalin!';
                btn.style.background = 'linear-gradient(135deg, #10b981, #059669)';
                btn.style.color = 'white';
                setTimeout(() => { btn.innerHTML = orig; btn.style.background = ''; btn.style.color = ''; }, 2000);
            });
        }
    </script>

    @include('partials.chatbot')
</body>
</html>


