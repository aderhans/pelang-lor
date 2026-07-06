<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="@yield('meta_description', 'Website resmi Desa Pelang Lor, Kecamatan Kedunggalar, Kabupaten Ngawi — layanan administrasi desa online untuk warga.')">
    <title>@yield('title', 'Desa Pelang Lor') — Kedunggalar, Ngawi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar" id="navbar">
        <div class="container navbar__inner">
            <a href="{{ route('landing') }}" class="navbar__brand">
                <div class="navbar__logo">
                    <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="20" cy="20" r="20" fill="#1B5E20"/>
                        <path d="M20 8L26 14H24V22H28V18L32 22V32H8V22L12 18V22H16V14H14L20 8Z" fill="#FFD600"/>
                        <path d="M16 32V26H24V32H16Z" fill="#A5D6A7"/>
                    </svg>
                </div>
                <div class="navbar__brand-text">
                    <span class="navbar__brand-name">Desa Pelang Lor</span>
                    <span class="navbar__brand-sub">Kec. Kedunggalar, Kab. Ngawi</span>
                </div>
            </a>
            <button class="navbar__toggle" id="navToggle" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
            <ul class="navbar__menu" id="navMenu">
                <li><a href="{{ route('landing') }}" class="navbar__link {{ request()->routeIs('landing') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="{{ route('landing') }}#profil" class="navbar__link">Profil Desa</a></li>
                <li><a href="{{ route('landing') }}#berita" class="navbar__link">Berita</a></li>
                <li>
                    <a href="{{ route('surat.index') }}" class="navbar__cta {{ request()->routeIs('surat.*') ? 'active' : '' }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
                        Buat Surat
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    {{-- FLASH MESSAGES --}}
    @if(session('success'))
        <div class="flash flash--success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash flash--error">{{ session('error') }}</div>
    @endif
    @if(session('info'))
        <div class="flash flash--info">{{ session('info') }}</div>
    @endif

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="footer">
        <div class="container footer__inner">
            <div class="footer__col">
                <div class="footer__brand">
                    <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" width="36" height="36">
                        <circle cx="20" cy="20" r="20" fill="#2E7D32"/>
                        <path d="M20 8L26 14H24V22H28V18L32 22V32H8V22L12 18V22H16V14H14L20 8Z" fill="#FFD600"/>
                        <path d="M16 32V26H24V32H16Z" fill="#A5D6A7"/>
                    </svg>
                    <div>
                        <p class="footer__name">Desa Pelang Lor</p>
                        <p class="footer__sub">Kec. Kedunggalar, Kab. Ngawi, Jawa Timur</p>
                    </div>
                </div>
                <p class="footer__desc">Melayani warga dengan hati, membangun desa dengan semangat gotong royong.</p>
            </div>
            <div class="footer__col">
                <h4 class="footer__heading">Layanan</h4>
                <ul class="footer__links">
                    <li><a href="{{ route('surat.index') }}">Buat Surat Keterangan</a></li>
                    <li><a href="{{ route('landing') }}#profil">Profil Desa</a></li>
                    <li><a href="{{ route('landing') }}#berita">Berita Desa</a></li>
                </ul>
            </div>
            <div class="footer__col">
                <h4 class="footer__heading">Kontak</h4>
                <ul class="footer__contact">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        Jl. Raya Pelang Lor, Kec. Kedunggalar, Kab. Ngawi 63254
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.41 2 2 0 0 1 3.6 1.24h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 6 6l.77-.77a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21.73 16.92z"/></svg>
                        (0351) XXXXXX
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <p>© {{ date('Y') }} Desa Pelang Lor. Dikembangkan dalam rangka KKN Universitas.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
