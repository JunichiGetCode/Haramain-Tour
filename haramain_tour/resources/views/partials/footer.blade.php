<footer class="footer">
    <div class="footer-content">
        <div class="footer-brand">
            <h3>HARAMAIN TOUR</h3>
            <p>{{ __('Mitra perjalanan ibadah terpercaya. Kami membantu mewujudkan impian ibadah Anda ke Tanah Suci dengan pelayanan terbaik.') }}</p>
            <div class="footer-social">
                <a href="javascript:void(0)"><i class="fa-brands fa-instagram"></i></a>
                <a href="javascript:void(0)"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="javascript:void(0)"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="javascript:void(0)"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
        <div class="footer-links">
            <h4>{{ __('Navigasi') }}</h4>
            <ul>
                <li><a href="{{ Auth::check() ? route('dashboard') : route('home') }}">{{ __('Beranda') }}</a></li>
                <li><a href="{{ route('paket') }}">{{ __('Paket Umroh') }}</a></li>
                <li><a href="{{ (Auth::check() ? route('dashboard') : route('home')) . '#about' }}">{{ __('Tentang Kami') }}</a></li>
                <li><a href="{{ route('faq') . '#contact' }}">{{ __('Kontak') }}</a></li>
            </ul>
        </div>
        <div class="footer-links">
            <h4>{{ __('Informasi') }}</h4>
            <ul>
                <li><a href="{{ route('faq') }}">{{ __('FAQ') }}</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} Haramain Tour. {{ __('All rights reserved.') }}</p>
    </div>
</footer>
