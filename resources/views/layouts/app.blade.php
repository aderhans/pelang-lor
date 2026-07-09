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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
    @stack('styles')
</head>
<body>

{{-- NAVBAR --}}
    @unless(request()->is('admin*'))
    <nav class="navbar" id="navbar">
        <div class="container navbar__inner">
            <a href="{{ route('landing') }}" class="navbar__brand">
                <div class="navbar__logo">
                    <img src="{{ asset('images/Lambang_Kabupaten_Ngawi.png') }}" alt="Logo Kabupaten Ngawi" style="width: 38px; height: auto;">
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

                @auth('warga')
                {{-- WARGA SUDAH LOGIN: tampilkan avatar + logout --}}
                <li class="navbar__warga-menu" id="wargaMenuWrap">
                    <button class="navbar__warga-avatar" id="wargaAvatarBtn" type="button" title="Akun Anda">
                        <span>{{ strtoupper(substr(Auth::guard('warga')->user()->email, 0, 1)) }}</span>
                    </button>
                    <div class="navbar__warga-dropdown" id="wargaDropdown">
                        <div class="navbar__warga-info">
                            <p class="navbar__warga-email">{{ Auth::guard('warga')->user()->email }}</p>
                            <p class="navbar__warga-wa">WA: {{ Auth::guard('warga')->user()->whatsapp }}</p>
                        </div>
                        <div class="navbar__warga-divider"></div>
                        <form action="{{ route('warga.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="navbar__warga-logout" id="warga-logout-btn">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </li>
                @endauth
            </ul>
        </div>
    </nav>
    @endunless

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
    @unless(request()->is('admin*'))
    <footer class="footer">
        <div class="container footer__inner">
            <div>
                <div class="footer__brand">
                    <img src="{{ asset('images/Lambang_Kabupaten_Ngawi.png') }}" alt="Logo Kabupaten Ngawi" style="width: 42px; height: auto;">
                    <div>
                        <p class="footer__name">Desa Pelang Lor</p>
                        <p class="footer__sub">Kec. Kedunggalar, Kab. Ngawi, Jawa Timur</p>
                    </div>
                </div>
                <p class="footer__desc">Melayani warga dengan hati, membangun desa dengan semangat gotong royong.</p>
            </div>
            <div>
                <h4 class="footer__col-title">Layanan</h4>
                <div class="footer__links">
                    <a href="{{ route('surat.index') }}" class="footer__link">Buat Surat Keterangan</a>
                    <a href="{{ route('landing') }}#profil" class="footer__link">Profil Desa</a>
                    <a href="{{ route('landing') }}#berita" class="footer__link">Berita Desa</a>
                    <a href="{{ route('landing') }}#layanan" class="footer__link">Jenis Layanan</a>
                </div>
            </div>
            <div>
                <h4 class="footer__col-title">Kontak</h4>
                <div class="footer__contact">
                    <div class="footer__contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>Pelang Lor, Kec. Kedunggalar, Kab. Ngawi 63254</span>
                    </div>
                    <div class="footer__contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <span>kdesapelanglor@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <p>© {{ date('Y') }} Desa Pelang Lor. Dikembangkan dalam rangka KKN Kelompok 29 UINSA.</p>
            </div>
        </div>
    </footer>
    @endunless


    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
