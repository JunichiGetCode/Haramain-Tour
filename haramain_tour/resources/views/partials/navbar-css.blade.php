<style>
/* --- NAVBAR UNIVERSAL --- */
.navbar {
    background-color: white; padding: 14px 5%; display: flex; align-items: center;
    justify-content: space-between; box-shadow: 0 2px 20px rgba(0, 0, 0, 0.04);
    position: sticky; top: 0; z-index: 100; border-bottom: 1px solid rgba(0, 0, 0, 0.04);
}
.brand-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
.brand-logo img { width: 40px; height: 40px; object-fit: contain; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1)); }
.brand-logo h1 { font-size: 1.3rem; font-weight: 800; color: var(--navy-color); letter-spacing: 1px; margin: 0; }

.search-bar {
    flex: 1; max-width: 380px; background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
    border-radius: 14px; display: flex; align-items: center; padding: 12px 20px;
    color: white; margin: 0 25px; box-shadow: 0 4px 15px var(--gold-glow); transition: var(--transition);
}
.search-bar:focus-within { box-shadow: 0 6px 25px rgba(201, 168, 76, 0.4); transform: translateY(-1px); }
.search-bar i { font-size: 1rem; opacity: 0.9; }
.search-bar input {
    border: none; background: transparent; color: white; font-size: 0.9rem; margin: 0;
    outline: none; width: 100%; margin-left: 12px; font-weight: 500; font-family: 'Poppins', sans-serif;
}
.search-bar input::placeholder { color: rgba(255,255,255,0.75); }

.nav-icons { display: flex; align-items: center; gap: 8px; }
.nav-icon-btn {
    width: 42px; height: 42px; display: flex; justify-content: center; align-items: center;
    border-radius: 12px; color: var(--text-gray); text-decoration: none;
    transition: var(--transition); font-size: 1.15rem; position: relative;
}
.nav-icon-btn:hover { background: var(--bg-color); color: var(--navy-color); }
.nav-icon-btn.active {
    background: linear-gradient(135deg, var(--gold-color), var(--gold-light));
    color: white; box-shadow: 0 4px 12px var(--gold-glow);
}

.profile-dropdown { position: relative; display: inline-block; }
.profile-trigger {
    background: var(--bg-color); border: 2px solid transparent; width: 42px; height: 42px; border-radius: 12px;
    font-size: 1.1rem; color: var(--navy-color); cursor: pointer; transition: var(--transition);
    display: flex; align-items: center; justify-content: center; padding: 0; outline: none;
}
.profile-trigger:hover { border-color: var(--gold-color); color: var(--gold-color); }

.dropdown-menu {
    display: none; position: absolute; right: 0; top: calc(100% + 10px); background-color: white; min-width: 220px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12); border-radius: 16px; overflow: hidden; z-index: 1000;
    flex-direction: column; border: 1px solid rgba(0, 0, 0, 0.05); animation: dropIn 0.2s ease-out;
}
@keyframes dropIn { from { opacity: 0; transform: translateY(-8px); } to { opacity: 1; transform: translateY(0); } }
.dropdown-menu.show { display: flex; }
.dropdown-header {
    padding: 18px 20px; font-weight: 700; color: var(--navy-color); border-bottom: 1px solid #f0f0f0;
    background: linear-gradient(135deg, #fafafa, #f5f5f5); font-size: 0.95rem; margin: 0;
}
.dropdown-header small { display: block; font-weight: 400; color: var(--text-gray); font-size: 0.8rem; margin-top: 2px; }
.dropdown-menu a, .dropdown-menu button {
    padding: 14px 20px; text-decoration: none; color: var(--text-dark); font-size: 0.9rem; font-weight: 500;
    display: flex; align-items: center; gap: 12px; transition: var(--transition); border: none; background: none;
    width: 100%; text-align: left; cursor: pointer; font-family: 'Poppins', sans-serif;
}
.dropdown-menu a:hover, .dropdown-menu button:hover { background-color: #f8f9fa; color: var(--gold-color); }
.dropdown-divider { height: 1px; background-color: #f0f0f0; margin: 4px 0; }
.logout-btn { color: var(--error-color) !important; }
.logout-btn:hover { background-color: #fef2f2 !important; color: var(--error-color) !important; }

.nav-links { display: flex; gap: 12px; }
.btn-nav-login {
    padding: 10px 28px; border-radius: 50px; font-weight: 600; text-decoration: none; font-size: 0.9rem;
    background-color: var(--navy-color); color: var(--gold-color); border: 2px solid var(--gold-color);
    transition: var(--transition); text-align: center; display: inline-block; letter-spacing: 0.3px;
}
.btn-nav-login:hover {
    background-color: var(--gold-color); color: var(--navy-color); transform: translateY(-2px);
    box-shadow: 0 4px 15px var(--gold-glow);
}

@media (max-width: 900px) {
    .navbar { padding: 12px 4%; flex-wrap: wrap; justify-content: space-between; gap: 10px; }
    .brand-logo h1 { font-size: 1rem; letter-spacing: 0.5px; }
    .brand-logo img { width: 32px; height: 32px; }
    
    .search-bar { order: 3; width: 100%; max-width: 100%; margin: 5px 0 0 0; padding: 10px 15px; border-radius: 12px; }
    .search-bar input { font-size: 0.82rem; }
    
    .nav-icons { gap: 4px; }
    .nav-icon-btn { width: 36px; height: 36px; font-size: 1rem; border-radius: 10px; }
    
    .dropdown-menu { right: -10px; min-width: 200px; }
    .btn-nav-login { padding: 8px 16px; font-size: 0.78rem; border-radius: 40px; }
}

@media (max-width: 480px) {
    .brand-logo h1 { display: none; }
    .nav-icons { gap: 2px; }
}
</style>
