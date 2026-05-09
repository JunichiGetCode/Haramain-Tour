{{-- Dark Mode CSS Override --}}
<style>
    body.dark-mode {
        --bg-color: #0f1117;
        --card-bg: #1a1d2e;
        --text-dark: #ffffff;
        --text-gray: #ffffff;
        --navy-color: #c9a84c;
        --navy-light: #1a1f4e;
    }

    /* Override all typography to white */
    body.dark-mode h1, body.dark-mode h2, body.dark-mode h3, 
    body.dark-mode h4, body.dark-mode h5, body.dark-mode h6, 
    body.dark-mode p, body.dark-mode span, body.dark-mode a, 
    body.dark-mode li, body.dark-mode label, body.dark-mode button,
    body.dark-mode small, body.dark-mode strong, body.dark-mode i,
    body.dark-mode div, body.dark-mode input, body.dark-mode textarea, body.dark-mode select {
        color: #ffffff !important;
    }

    /* Override all icon backgrounds to gold */
    body.dark-mode .sidebar-item i,
    body.dark-mode .section-title i,
    body.dark-mode .account-icon,
    body.dark-mode .nav-icon-btn,
    body.dark-mode .profile-trigger,
    body.dark-mode .feature-icon,
    body.dark-mode .value-item i,
    body.dark-mode .visi-card h4 i,
    body.dark-mode .misi-card h4 i,
    body.dark-mode .menu-card i,
    body.dark-mode .social-link {
        background-color: var(--gold-color) !important;
        color: #ffffff !important;
        border-color: var(--gold-color) !important;
    }

    /* Format inline icons so they look good with a background */
    body.dark-mode .sidebar-item i,
    body.dark-mode .section-title i,
    body.dark-mode .visi-card h4 i,
    body.dark-mode .misi-card h4 i {
        width: 32px;
        height: 32px;
        display: inline-flex !important;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
    }
    
    body.dark-mode .value-item i {
        width: 45px; height: 45px;
        display: inline-flex !important;
        justify-content: center; align-items: center;
        border-radius: 12px; margin: 0 auto 10px auto;
    }

    body.dark-mode .navbar {
        background-color: #141625;
        border-bottom-color: rgba(255,255,255,0.05);
        box-shadow: 0 2px 20px rgba(0,0,0,0.3);
    }

    body.dark-mode .brand-logo h1 { color: #e2e4e9; }

    body.dark-mode .nav-icon-btn { color: #8b8fa3; }
    body.dark-mode .nav-icon-btn:hover { background: rgba(255,255,255,0.06); color: #e2e4e9; }

    body.dark-mode .profile-trigger { background: rgba(255,255,255,0.06); color: #e2e4e9; }
    body.dark-mode .profile-trigger:hover { border-color: var(--gold-color); color: var(--gold-color); }

    body.dark-mode .dropdown-menu { background-color: #1a1d2e; border-color: rgba(255,255,255,0.08); }
    body.dark-mode .dropdown-header { background: linear-gradient(135deg, #1e2136, #22253a); color: #e2e4e9; border-bottom-color: rgba(255,255,255,0.06); }
    body.dark-mode .dropdown-menu a, body.dark-mode .dropdown-menu button { color: #c5c8d6; }
    body.dark-mode .dropdown-menu a:hover, body.dark-mode .dropdown-menu button:hover { background-color: rgba(255,255,255,0.05); color: var(--gold-color); }
    body.dark-mode .dropdown-divider { background-color: rgba(255,255,255,0.06); }

    body.dark-mode .search-bar { box-shadow: 0 4px 15px rgba(201,168,76,0.15); }

    body.dark-mode .welcome-card { background: linear-gradient(135deg, #1a1d2e, #252840); }
    body.dark-mode .welcome-card h2 { color: #e2e4e9; }
    body.dark-mode .welcome-card p { color: rgba(255,255,255,0.4); }

    body.dark-mode .alert-success { background: linear-gradient(135deg, #1a3329, #1a3329); color: #6ee7b7; border-left-color: #059669; }

    body.dark-mode .menu-card { background-color: #1a1d2e; color: #e2e4e9; box-shadow: 0 4px 20px rgba(0,0,0,0.2); }
    body.dark-mode .menu-card:hover { border-color: var(--gold-color); box-shadow: 0 12px 35px rgba(0,0,0,0.3); }

    body.dark-mode .banner { background: linear-gradient(135deg, #1a1d2e, #252840); box-shadow: 0 8px 30px rgba(0,0,0,0.2); }

    body.dark-mode .section-title { color: #e2e4e9; }
    body.dark-mode .section-badge { background: #1a1d2e; color: #8b8fa3; }

    body.dark-mode .doc-wrapper { background-color: #1a1d2e; box-shadow: 0 4px 20px rgba(0,0,0,0.2); }
    body.dark-mode .doc-header { color: #e2e4e9; }
    body.dark-mode .carousel-btn { background: #1a1d2e; border-color: rgba(255,255,255,0.1); color: #e2e4e9; }
    body.dark-mode .carousel-btn:hover { border-color: var(--gold-color); }

    /* Profile Page Dark Mode */
    body.dark-mode .back-btn { background: #1a1d2e; border-color: rgba(255,255,255,0.08); color: #e2e4e9; }
    body.dark-mode .back-btn:hover { border-color: var(--gold-color); color: var(--gold-color); }
    body.dark-mode .page-title-bar h2 { color: #e2e4e9; }

    body.dark-mode .profile-header { background: linear-gradient(135deg, #1a1d2e, #252840); }

    body.dark-mode .profile-tabs { background: #1a1d2e; box-shadow: 0 2px 12px rgba(0,0,0,0.2); }
    body.dark-mode .tab-btn { color: #8b8fa3; }
    body.dark-mode .tab-btn:not(.active):hover { background: rgba(255,255,255,0.05); color: #e2e4e9; }

    body.dark-mode .form-card { background: #1a1d2e; box-shadow: 0 4px 20px rgba(0,0,0,0.2); }
    body.dark-mode .form-card-title { color: #e2e4e9; }
    body.dark-mode .form-card-subtitle { color: #8b8fa3; }
    body.dark-mode .form-group label { color: #c5c8d6; }

    body.dark-mode .input-wrapper input,
    body.dark-mode .input-wrapper select,
    body.dark-mode .input-wrapper textarea {
        background: #141625; border-color: rgba(255,255,255,0.08); color: #e2e4e9;
    }
    body.dark-mode .input-wrapper input:focus,
    body.dark-mode .input-wrapper select:focus,
    body.dark-mode .input-wrapper textarea:focus {
        border-color: var(--gold-color); background: #1a1d2e;
    }
    body.dark-mode .input-wrapper input::placeholder,
    body.dark-mode .input-wrapper textarea::placeholder { color: #555870; }

    body.dark-mode .avatar-upload-area { border-color: rgba(255,255,255,0.08); }
    body.dark-mode .avatar-upload-area:hover { border-color: var(--gold-color); background: rgba(201,168,76,0.03); }
    body.dark-mode .avatar-upload-placeholder { background: #141625; color: #555870; }
    body.dark-mode .avatar-upload-text h4 { color: #e2e4e9; }
    body.dark-mode .avatar-upload-text label { background: #141625; color: #e2e4e9; }
    body.dark-mode .avatar-upload-text label:hover { background: var(--gold-color); color: #0f1117; }

    body.dark-mode .info-item { background: #141625; }
    body.dark-mode .info-item-text span { color: #8b8fa3; }
    body.dark-mode .info-item-text strong { color: #e2e4e9; }

    /* Settings Dark Mode */
    body.dark-mode .settings-sidebar { background: #1a1d2e; box-shadow: 0 4px 20px rgba(0,0,0,0.2); }
    body.dark-mode .sidebar-item { color: #8b8fa3; }
    body.dark-mode .sidebar-item:hover { background: rgba(255,255,255,0.04); color: #e2e4e9; }
    body.dark-mode .sidebar-item.danger:hover { background: rgba(227,52,47,0.1); }

    body.dark-mode .section-card { background: #1a1d2e; box-shadow: 0 4px 20px rgba(0,0,0,0.2); }
    body.dark-mode .section-subtitle { color: #8b8fa3; }

    body.dark-mode .setting-row { border-bottom-color: rgba(255,255,255,0.06); }
    body.dark-mode .setting-info h4 { color: #e2e4e9; }
    body.dark-mode .setting-info p { color: #8b8fa3; }

    body.dark-mode .toggle-slider { background-color: #333650; }

    body.dark-mode .setting-select { background-color: #141625; border-color: rgba(255,255,255,0.08); color: #e2e4e9; }
    body.dark-mode .setting-select:focus { border-color: var(--gold-color); }

    body.dark-mode .account-row { border-bottom-color: rgba(255,255,255,0.06); }
    body.dark-mode .account-icon.google { background: rgba(234,67,53,0.1); }
    body.dark-mode .account-icon.facebook { background: rgba(24,119,242,0.1); }
    body.dark-mode .account-info h4 { color: #e2e4e9; }
    body.dark-mode .account-info p { color: #8b8fa3; }
    body.dark-mode .btn-connect { background: #141625; border-color: rgba(255,255,255,0.08); color: #e2e4e9; }

    body.dark-mode .about-header h3 { color: #e2e4e9; }
    body.dark-mode .visi-card, body.dark-mode .misi-card { background: #141625; border-color: rgba(255,255,255,0.05); }
    body.dark-mode .visi-card h4, body.dark-mode .misi-card h4 { color: #e2e4e9; }
    body.dark-mode .visi-card p, body.dark-mode .misi-card p, body.dark-mode .misi-card ol li { color: #8b8fa3; }
    body.dark-mode .misi-card ol li { border-bottom-color: rgba(255,255,255,0.04); }

    body.dark-mode .company-footer { background: #141625; }

    body.dark-mode .danger-zone { background: rgba(127,29,29,0.15); border-color: rgba(239,68,68,0.3); }
    body.dark-mode .danger-desc { color: #fca5a5; }
    body.dark-mode .input-delete { background: #141625; border-color: rgba(239,68,68,0.2); color: #e2e4e9; }

    /* Paket page dark overrides */
    body.dark-mode .paket-header { background: linear-gradient(135deg, #1a1d2e, #252840); }
    body.dark-mode .filter-bar { background: #1a1d2e; box-shadow: 0 4px 20px rgba(0,0,0,0.2); }
    body.dark-mode .filter-select { background: #141625; border-color: rgba(255,255,255,0.08); color: #e2e4e9; }
    body.dark-mode .paket-card { background: #1a1d2e; box-shadow: 0 5px 25px rgba(0,0,0,0.2); }
    body.dark-mode .paket-card:hover { box-shadow: 0 15px 40px rgba(0,0,0,0.3); }
    body.dark-mode .paket-detail h3 { color: #e2e4e9; }
    body.dark-mode .paket-detail p { color: #8b8fa3; }
    body.dark-mode .modal-content { background: #1a1d2e; }
    body.dark-mode .modal-content h2 { color: #e2e4e9; }

    /* ===== PANDUAN TIPS - Dark Mode ===== */
    body.dark-mode .panduan-tips {
        background: linear-gradient(135deg, #1a1d2e, #1e2136) !important;
        border-color: rgba(201, 168, 76, 0.2) !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
    }
    body.dark-mode .panduan-tips-content h3 { color: #e2e4e9 !important; }
    body.dark-mode .panduan-tips-content p { color: #8b8fa3 !important; }
    body.dark-mode .panduan-tips-icon { background: rgba(201, 168, 76, 0.12) !important; }

    body.dark-mode .panduan-card { background: #1a1d2e !important; box-shadow: 0 4px 20px rgba(0,0,0,0.2) !important; }
    body.dark-mode .panduan-title { color: #e2e4e9 !important; }
    body.dark-mode .panduan-desc { color: #8b8fa3 !important; }
    body.dark-mode .panduan-icon { background: #141625 !important; }
    body.dark-mode .panduan-btn { border-color: rgba(255,255,255,0.1) !important; color: #e2e4e9 !important; }

    /* ===== KAMUS - Dark Mode ===== */
    /* Entry cards */
    body.dark-mode .entry-card {
        background: #1a1d2e !important;
        border-color: rgba(255,255,255,0.06) !important;
    }
    body.dark-mode .entry-card:hover { border-color: rgba(201,168,76,0.3) !important; box-shadow: 0 8px 25px rgba(0,0,0,0.2) !important; }
    body.dark-mode .entry-arabic { color: var(--gold-color) !important; }
    body.dark-mode .entry-indo { color: #e2e4e9 !important; }
    body.dark-mode .entry-latin { color: #8b8fa3 !important; }

    /* Angka cards */
    body.dark-mode .angka-card {
        background: #1a1d2e !important;
        border-color: rgba(255,255,255,0.06) !important;
    }
    body.dark-mode .angka-card:hover { border-color: var(--gold-color) !important; box-shadow: 0 6px 20px rgba(201,168,76,0.15) !important; }
    body.dark-mode .angka-arab { color: #e2e4e9 !important; }
    body.dark-mode .angka-latin { color: #8b8fa3 !important; }

    /* Frasa darurat cards */
    body.dark-mode .darurat-card {
        background: linear-gradient(135deg, rgba(239,68,68,0.08), #1a1d2e) !important;
        border-color: rgba(239,68,68,0.15) !important;
    }
    body.dark-mode .darurat-card:hover { border-color: #ef4444 !important; }
    body.dark-mode .darurat-text strong { color: #fca5a5 !important; }
    body.dark-mode .darurat-text small { color: #8b8fa3 !important; }
    body.dark-mode .darurat-arabic { color: #f87171 !important; }

    /* Kamus search and tabs */
    body.dark-mode .search-section { background: #1a1d2e !important; border-bottom-color: rgba(255,255,255,0.05) !important; }
    body.dark-mode .search-input { background: #141625 !important; border-color: rgba(255,255,255,0.08) !important; color: #e2e4e9 !important; }
    body.dark-mode .search-input:focus { border-color: var(--gold-color) !important; background: #1a1d2e !important; }
    body.dark-mode .cat-tab { border-color: rgba(255,255,255,0.1) !important; color: #8b8fa3 !important; }
    body.dark-mode .cat-tab:hover { border-color: var(--gold-color) !important; color: var(--gold-color) !important; }
    body.dark-mode .cat-tab.active { background: var(--gold-color) !important; color: #0f1117 !important; border-color: var(--gold-color) !important; }

    /* ===== DASHBOARD TENTANG KAMI - Dark Mode ===== */
    body.dark-mode .feature-card {
        background: #1a1d2e !important;
        border-color: rgba(255,255,255,0.05) !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
    }
    body.dark-mode .feature-card:hover { border-color: var(--gold-color) !important; }
    body.dark-mode .feature-card h4 { color: #e2e4e9 !important; }
    body.dark-mode .feature-card p { color: #8b8fa3 !important; }

    body.dark-mode .testi-card {
        background: #1a1d2e !important;
        border-left-color: var(--gold-color) !important;
    }
    body.dark-mode .testi-text { color: #8b8fa3 !important; }
    body.dark-mode .testi-info h5 { color: #e2e4e9 !important; }
    body.dark-mode .testi-info span { color: #6b7280 !important; }

    /* ===== FAQ - Dark Mode ===== */
    body.dark-mode .faq-card { background: #1a1d2e !important; border-color: rgba(255,255,255,0.05) !important; }
    body.dark-mode .faq-card.open { border-color: rgba(201,168,76,0.3) !important; }
    body.dark-mode .faq-q-text { color: #e2e4e9 !important; }
    body.dark-mode .faq-card.open .faq-q-text { color: var(--gold-color) !important; }
    body.dark-mode .faq-chevron { background: #141625 !important; color: #8b8fa3 !important; }
    body.dark-mode .faq-answer-inner { border-top-color: rgba(255,255,255,0.06) !important; color: #8b8fa3 !important; }
    body.dark-mode .faq-answer-inner strong { color: #e2e4e9 !important; }
    body.dark-mode .faq-search { background: #1a1d2e !important; border-color: rgba(255,255,255,0.08) !important; color: #e2e4e9 !important; }
    body.dark-mode .faq-search:focus { border-color: var(--gold-color) !important; }
    body.dark-mode .cat-tabs-section { background: #1a1d2e !important; border-bottom-color: rgba(255,255,255,0.05) !important; }

    /* ===== FILTER SIDEBAR (Paket) - Dark Mode ===== */
    body.dark-mode .filter-sidebar { background: #1a1d2e !important; box-shadow: 0 4px 20px rgba(0,0,0,0.2) !important; }
    body.dark-mode .filter-title { color: #e2e4e9 !important; border-bottom-color: rgba(255,255,255,0.06) !important; }
    body.dark-mode .filter-group > label:first-child { color: #c5c8d6 !important; }
    body.dark-mode .checkbox-group { color: #e2e4e9 !important; }
    body.dark-mode .checkbox-group:hover { background: rgba(255,255,255,0.04) !important; }

    /* ===== WISHLIST - Dark Mode ===== */
    body.dark-mode .page-header-icon { box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important; }
    body.dark-mode .wishlist-count { background: linear-gradient(135deg, rgba(201,168,76,0.12), rgba(201,168,76,0.06)) !important; border-color: rgba(201,168,76,0.2) !important; }
    body.dark-mode .package-card { background: #1a1d2e !important; border-color: rgba(255,255,255,0.06) !important; }
    body.dark-mode .package-card.premium { border-color: var(--gold-color) !important; }
    body.dark-mode .card-title { color: #e2e4e9 !important; }
    body.dark-mode .card-meta-item { color: #8b8fa3 !important; }
    body.dark-mode .card-footer { border-top-color: rgba(255,255,255,0.06) !important; }
    body.dark-mode .btn-rm { background: rgba(239,68,68,0.1) !important; border-color: rgba(239,68,68,0.2) !important; }
    body.dark-mode .empty-state { background: #1a1d2e !important; box-shadow: 0 4px 20px rgba(0,0,0,0.2) !important; }

    /* ===== DOA TIPS BOX - Dark Mode (match panduan-tips) ===== */
    body.dark-mode .tips-box {
        background: linear-gradient(135deg, #1a1d2e, #1e2136) !important;
        border: 1px solid rgba(201, 168, 76, 0.2) !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
    }
    body.dark-mode .tips-box strong { color: var(--gold-color) !important; }
    body.dark-mode .tips-box p { color: #8b8fa3 !important; }
    body.dark-mode .tips-box i { color: var(--gold-color) !important; }

    /* ===== BERITA PAGE - Dark Mode fixes ===== */
    /* Date badge in berita index */
    body.dark-mode .berita-date-badge { background: rgba(26, 29, 46, 0.9) !important; }
    body.dark-mode .berita-date-badge span { color: var(--gold-color) !important; }

    /* Social media share links in berita show */
    body.dark-mode .share-links a { background: #141625 !important; color: #8b8fa3 !important; }
    body.dark-mode .share-links a:hover { background: var(--gold-color) !important; color: var(--navy-color) !important; }
    body.dark-mode .share-links a i { color: inherit !important; }
    body.dark-mode .share-title { color: #e2e4e9 !important; }

    /* Article content in berita show */
    body.dark-mode .article-content { background: #1a1d2e !important; }
    body.dark-mode .article-body { color: #c5c8d6 !important; }
    body.dark-mode .article-body h2, body.dark-mode .article-body h3, body.dark-mode .article-body h4 { color: #e2e4e9 !important; }
    body.dark-mode .share-box { border-top-color: rgba(255,255,255,0.08) !important; }

    /* Sidebar widgets in berita show */
    body.dark-mode .sidebar-widget { background: #1a1d2e !important; }
    body.dark-mode .widget-title { color: #e2e4e9 !important; }
    body.dark-mode .sn-info h4 { color: #e2e4e9 !important; }
    body.dark-mode .sn-info span { color: #8b8fa3 !important; }

    /* Berita card in index */
    body.dark-mode .berita-card { background: #1a1d2e !important; border-color: rgba(255,255,255,0.06) !important; }
    body.dark-mode .berita-title { color: #e2e4e9 !important; }
    body.dark-mode .berita-footer { border-top-color: rgba(255,255,255,0.08) !important; }

    /* ===== PAKET RATING BADGE - Dark Mode ===== */
    body.dark-mode .rating-badge { background: rgba(26, 29, 46, 0.95) !important; color: #e2e4e9 !important; }
    body.dark-mode .rating-badge i { color: #f39c12 !important; }

    /* Smooth transition */
    body.dark-mode, body.dark-mode * { transition: background-color 0.3s, color 0.3s, border-color 0.3s, box-shadow 0.3s; }
</style>
