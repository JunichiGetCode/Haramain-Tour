<nav class="navbar">
    <a href="{{ route('dashboard') }}" class="brand-logo">
        <img loading="lazy" src="{{ asset('storage/image/LOGO.png') }}" alt="Logo Haramain Tour">
        <h1>HARAMAIN TOUR</h1>
    </a>

    @auth
        <form id="globalSearchForm" action="{{ route('search') }}" method="GET" class="search-bar" autocomplete="off" style="position:relative;">
            <i class="fa fa-search" style="flex-shrink:0;"></i>
            <input type="text" name="q" id="globalSearchInput" placeholder="{{ __('Cari paket, berita, doa...') }}" value="{{ request('q') }}" autocomplete="off">
            <!-- Live Dropdown -->
            <div id="searchDropdown" style="display:none; position:absolute; top:calc(100% + 8px); left:0; right:0; background:white; border-radius:16px; box-shadow:0 15px 50px rgba(0,0,0,0.15); z-index:9999; overflow:hidden; max-height:420px; overflow-y:auto; border:1px solid rgba(0,0,0,0.06);">
                <div id="searchResults"></div>
            </div>
        </form>

        <div class="nav-icons">
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="nav-icon-btn {{ request()->is('admin*') ? 'active' : '' }}" title="Admin Dashboard">
                    <i class="fa-solid fa-shield-halved"></i>
                </a>
            @endif
            <a href="{{ route('notifikasi') }}" class="nav-icon-btn {{ request()->routeIs('notifikasi') ? 'active' : '' }}" style="position:relative;">
                <i class="fa-regular fa-bell"></i>
                @if(Auth::user()->unreadNotifikasiCount() > 0)
                    <span style="position:absolute;top:2px;right:2px;background:#ef4444;color:white;font-size:0.6rem;font-weight:800;min-width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid white;">{{ Auth::user()->unreadNotifikasiCount() > 9 ? '9+' : Auth::user()->unreadNotifikasiCount() }}</span>
                @endif
            </a>
            <a href="{{ route('dashboard') }}" class="nav-icon-btn {{ request()->routeIs('dashboard') ? 'active' : '' }}" title="Dashboard"><i class="fa-solid fa-house"></i></a>
            <a href="{{ route('panduan') }}" class="nav-icon-btn {{ request()->routeIs('panduan') ? 'active' : '' }}" title="Panduan"><i class="fa-solid fa-book"></i></a>
            <a href="{{ route('berita.index') }}" class="nav-icon-btn {{ request()->routeIs('berita.*') ? 'active' : '' }}" title="Berita & Info"><i class="fa-solid fa-newspaper"></i></a>
            <a href="{{ route('wishlist') }}" class="nav-icon-btn {{ request()->routeIs('wishlist') ? 'active' : '' }}" title="Wishlist"><i class="fa-regular fa-bookmark"></i></a>

            <div class="profile-dropdown">
                <button class="profile-trigger" id="profileBtn">
                    <i class="fa-regular fa-user"></i>
                </button>

                <div class="dropdown-menu" id="profileMenu">
                    <div class="dropdown-header">
                        {{ Auth::user()->name ?? 'Pengguna' }}
                        <small>{{ __('Selamat datang kembali!') }}</small>
                    </div>

                    <a href="{{ route('profile') }}"><i class="fa-solid fa-user-circle"></i> {{ __('Profil Saya') }}</a>
                    <a href="{{ route('settings') }}"><i class="fa-solid fa-gear"></i> {{ __('Pengaturan') }}</a>
                    <a href="{{ route('faq') }}"><i class="fa-solid fa-circle-question"></i> {{ __('Bantuan & FAQ') }}</a>

                    <div class="dropdown-divider"></div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> {{ __('Keluar') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="nav-links">
            <a href="{{ route('login') }}" class="btn-nav btn-nav-login">{{ __('Masuk') }}</a>
            <a href="{{ route('register') }}" class="btn-nav btn-nav-login">{{ __('Daftar') }}</a>
        </div>
    @endauth
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileBtn = document.getElementById('profileBtn');
        if(profileBtn) {
            profileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                document.getElementById('profileMenu').classList.toggle('show');
            });
        }
    });

    window.addEventListener('click', function(event) {
        if (!event.target.closest('.profile-trigger') && !event.target.closest('.profile-dropdown')) {
            var dropdowns = document.getElementsByClassName("dropdown-menu");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown && openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
        // Close search dropdown on click outside
        if (!event.target.closest('#globalSearchForm')) {
            const dd = document.getElementById('searchDropdown');
            if (dd) dd.style.display = 'none';
        }
    });
</script>

@auth
<script>
(function() {
    const input = document.getElementById('globalSearchInput');
    const dropdown = document.getElementById('searchDropdown');
    const results = document.getElementById('searchResults');
    if (!input) return;

    let debounceTimer;
    let selectedIndex = -1;

    const typeIcons = { paket: '📦', berita: '📰', page: '🔗' };
    const typeLabel = { 
        paket: "{{ __('Paket') }}", 
        berita: "{{ __('Berita') }}", 
        page: "{{ __('Halaman') }}" 
    };
    const typeBg   = { paket: '#fff7e6', berita: '#f0fdf4', page: '#f0f4ff' };
    const typeColor = { paket: '#d97706', berita: '#16a34a', page: '#4f46e5' };

    input.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        const q = this.value.trim();
        selectedIndex = -1;

        if (q.length < 2) { dropdown.style.display = 'none'; return; }

        debounceTimer = setTimeout(() => doSearch(q), 250);
    });

    input.addEventListener('keydown', function(e) {
        const items = dropdown.querySelectorAll('.sd-item');
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            selectedIndex = Math.min(selectedIndex + 1, items.length - 1);
            highlightItem(items);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            selectedIndex = Math.max(selectedIndex - 1, -1);
            highlightItem(items);
        } else if (e.key === 'Enter') {
            if (selectedIndex >= 0 && items[selectedIndex]) {
                e.preventDefault();
                window.location.href = items[selectedIndex].dataset.url;
            }
        } else if (e.key === 'Escape') {
            dropdown.style.display = 'none';
        }
    });

    function highlightItem(items) {
        items.forEach((el, i) => {
            el.style.background = (i === selectedIndex) ? '#f0f4ff' : '';
        });
        if (selectedIndex >= 0 && items[selectedIndex]) {
            items[selectedIndex].scrollIntoView({ block: 'nearest' });
        }
    }

    function doSearch(q) {
        const url = "{{ route('search.ajax') }}?q=" + encodeURIComponent(q);
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(r => r.json())
            .then(data => renderResults(data.results, q));
    }

    function renderResults(items, q) {
        if (!items || items.length === 0) {
            results.innerHTML = `
                <div style="padding:30px 20px; text-align:center; color:#9ca3af;">
                    <i class="fa-solid fa-search" style="font-size:2rem; margin-bottom:10px; display:block;"></i>
                    <p style="font-size:0.9rem;">{{ __('Tidak ada hasil untuk') }} "<strong>${q}</strong>"</p>
                    <p style="font-size:0.8rem; margin-top:6px;">{{ __('Coba kata kunci lain') }}</p>
                </div>`;
        } else {
            results.innerHTML = items.map((item, i) => `
                <div class="sd-item" data-url="${item.url}" onclick="window.location.href='${item.url}'"
                     style="display:flex; align-items:center; gap:14px; padding:13px 18px; cursor:pointer; border-bottom:1px solid rgba(0,0,0,0.04); transition:background 0.15s;">
                    <div style="width:36px;height:36px;border-radius:10px;background:${typeBg[item.type] || '#f3f4f6'};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fa-solid ${item.icon}" style="color:${typeColor[item.type] || '#6b7280'}; font-size:0.9rem;"></i>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-weight:700;font-size:0.9rem;color:#1f2937;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${item.title}</div>
                        <div style="font-size:0.78rem;color:#6b7280;margin-top:2px;">${item.sub}</div>
                    </div>
                    <span style="font-size:0.7rem;font-weight:700;padding:3px 9px;border-radius:50px;background:${typeBg[item.type] || '#f3f4f6'};color:${typeColor[item.type] || '#6b7280'};">${typeLabel[item.type] || ''}</span>
                </div>
            `).join('');

            // Add footer link to full search
            results.innerHTML += `
                <div style="padding:10px 18px;text-align:center;">
                    <a href="{{ route('search') }}?q=${encodeURIComponent(q)}" style="font-size:0.82rem;color:#4f46e5;font-weight:700;text-decoration:none;display:flex;align-items:center;justify-content:center;gap:6px;">
                        {{ __('Lihat semua hasil untuk') }} "${q}" <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>`;
        }

        // Hover css
        results.querySelectorAll('.sd-item').forEach(el => {
            el.addEventListener('mouseover', () => { el.style.background = '#f8f9fa'; selectedIndex = -1; });
            el.addEventListener('mouseout', () => { el.style.background = ''; });
        });

        dropdown.style.display = 'block';
    }
})();
</script>
@endauth
