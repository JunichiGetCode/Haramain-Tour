@props([
    'badgeIcon' => 'fa-star',
    'badgeText' => 'Fitur',
    'title' => 'Judul',
    'arabic' => null,
    'description' => 'Deskripsi',
    'bgIcon' => '\f54b'
])

<style>
.hero {
    background: linear-gradient(135deg, #1a0533 0%, #2c1260 50%, var(--navy-light) 100%);
    padding: 70px 20px 60px;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 20px;
    flex-shrink: 0;
    width: 100%;
}
.hero::before {
    content: '{!! $bgIcon !!}'; font-family: 'Font Awesome 6 Free'; font-weight: 900;
    position: absolute; font-size: 22rem; color: rgba(255,255,255,0.02);
    top: -70px; right: -100px; line-height: 1; pointer-events: none;
}
.hero::after {
    content: ''; position: absolute; bottom: -30px; left: 0; width: 100%;
    height: 60px; background: var(--bg-color); transform: skewY(-2deg); pointer-events: none;
}
.hero-badge {
    display: inline-block; background: rgba(160,100,220,0.2); color: #c8a0ef;
    border: 1px solid rgba(160,100,220,0.4); padding: 8px 20px; border-radius: 50px;
    font-size: 0.8rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;
    margin-bottom: 20px; position: relative; z-index: 2;
}
.hero-title { font-size: 2.8rem; font-weight: 900; color: var(--gold-color); margin-bottom: 8px; line-height: 1.2; position: relative; z-index: 2; }
.hero-arabic { font-family: 'Amiri', serif; font-size: 2.5rem; color: rgba(255,255,255,0.6); margin-bottom: 20px; direction: rtl; position: relative; z-index: 2; }
.hero-subtitle { color: rgba(255,255,255,0.7); font-size: 1rem; max-width: 600px; margin: 0 auto 30px; line-height: 1.7; position: relative; z-index: 2; }
.hero-back { display: inline-flex; align-items: center; gap: 8px; color: rgba(255,255,255,0.5); text-decoration: none; font-size: 0.88rem; transition: 0.2s; position: relative; z-index: 2; }
.hero-back:hover { color: var(--gold-color); }
@media (max-width: 768px) {
    .hero-title { font-size: 2rem; }
    .hero-arabic { font-size: 1.8rem; }
}
</style>

<div class="hero">
    <div class="hero-badge"><i class="{{ $badgeIcon }}"></i> {{ $badgeText }}</div>
    <h1 class="hero-title">{{ $title }}</h1>
    @if($arabic)
    <div class="hero-arabic">{{ $arabic }}</div>
    @endif
    <p class="hero-subtitle">{{ $description }}</p>
    <a href="{{ route('dashboard') }}" class="hero-back"><i class="fa-solid fa-arrow-left"></i> {{ __('Kembali ke Dashboard') }}</a>
</div>
