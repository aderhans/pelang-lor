@extends('layouts.app')
@section('title', 'Beranda')
@section('meta_description', 'Website resmi Desa Pelang Lor, Kecamatan Kedunggalar, Kabupaten Ngawi. Layanan administrasi desa online.')
@section('content')

{{-- HERO --}}
<section class="hero" id="beranda">
    <div class="hero__bg">
        <div class="hero__glow hero__glow--1"></div>
        <div class="hero__glow hero__glow--2"></div>
        <div class="hero__glow hero__glow--3"></div>
        <div class="hero__grid"></div>
    </div>
    <div class="container hero__wrap">
        <div class="hero__left">
            <div class="hero__eyebrow">
                <span class="hero__dot"></span>
                <span>Desa Digital Mandiri &middot; Kab. Ngawi</span>
            </div>
            <h1 class="hero__title">
                Selamat Datang di<br>
                <span class="hero__accent">Desa Pelang Lor</span>
            </h1>
            <p class="hero__desc">
                Layanan administrasi desa kini hadir secara digital. Buat surat keterangan resmi kapan saja dan di mana saja — cepat, mudah, dan terpercaya.
            </p>
            <div class="hero__btns">
                <a href="{{ route('surat.index') }}" class="btn-primary-hero">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    Buat Surat Keterangan
                </a>
                <a href="#layanan" class="btn-ghost-hero">
                    Lihat Layanan
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>
                </a>
            </div>
            <div class="hero__badges">
                <span class="hero__badge-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>Resmi &amp; Terpercaya</span>
                <span class="hero__badge-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Proses Cepat</span>
                <span class="hero__badge-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>Gratis 100%</span>
            </div>
        </div>
        <div class="hero__right">
            <div class="surat-card">
                <div class="surat-card__header">
                    <div class="surat-card__logo">
                        <svg viewBox="0 0 40 40" fill="none"><circle cx="20" cy="20" r="20" fill="rgba(255,255,255,0.12)"/><path d="M20 8L26 14H24V22H28V18L32 22V32H8V22L12 18V22H16V14H14L20 8Z" fill="#FFD600"/></svg>
                    </div>
                    <div>
                        <p class="surat-card__title">SURAT KETERANGAN</p>
                        <p class="surat-card__sub">Desa Pelang Lor</p>
                    </div>
                </div>
                <div class="surat-card__divider"></div>
                <div class="surat-card__rows">
                    <div class="surat-card__row"><span>Nama</span><strong>Warga Desa</strong></div>
                    <div class="surat-card__row"><span>NIK</span><strong>3521 XXXX XXXX</strong></div>
                    <div class="surat-card__row"><span>Keperluan</span><strong>Melamar Pekerjaan</strong></div>
                    <div class="surat-card__row"><span>Jenis Surat</span><strong>Surat Domisili</strong></div>
                </div>
                <div class="surat-card__divider"></div>
                <div class="surat-card__footer">
                    <span class="surat-card__status"><span class="surat-card__dot"></span>Siap Diunduh</span>
                    <span class="surat-card__fmt">Format JPG</span>
                </div>
            </div>
            <div class="hero__pill hero__pill--1">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                Surat berhasil dibuat!
            </div>
            <div class="hero__pill hero__pill--2">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/></svg>
                Download JPG
            </div>
        </div>
    </div>
    <div class="hero__wave">
        <svg viewBox="0 0 1440 80" fill="none" preserveAspectRatio="none"><path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#F8F7F4"/></svg>
    </div>
</section>

{{-- STATS --}}
<section class="stats">
    <div class="container">
        <div class="stats__row">
            @foreach($stats as $stat)
            <div class="stat-item">
                <div class="stat-item__icon">
                    @if($stat['icon'] === 'people')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    @elseif($stat['icon'] === 'house')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    @elseif($stat['icon'] === 'map')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/></svg>
                    @else
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    @endif
                </div>
                <div class="stat-item__val">{{ $stat['value'] }}</div>
                <div class="stat-item__label">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- HOW IT WORKS --}}
<section class="how">
    <div class="container">
        <div class="how__head">
            <span class="label-pill">Cara Penggunaan</span>
            <h2 class="sec-title">Mudah Dalam 3 Langkah</h2>
        </div>
        <div class="how__grid">
            <div class="how-card">
                <div class="how-card__num">01</div>
                <div class="how-card__icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </div>
                <h3>Isi Formulir</h3>
                <p>Pilih jenis surat dan isi data diri sesuai KTP/KK Anda</p>
            </div>
            <div class="how__arrow">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </div>
            <div class="how-card">
                <div class="how-card__num">02</div>
                <div class="how-card__icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </div>
                <h3>Preview Surat</h3>
                <p>Cek tampilan surat dan pilih penandatangan Kades/Sekdes</p>
            </div>
            <div class="how__arrow">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </div>
            <div class="how-card">
                <div class="how-card__num">03</div>
                <div class="how-card__icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </div>
                <h3>Download JPG</h3>
                <p>Unduh surat dalam format JPG siap cetak dan gunakan</p>
            </div>
        </div>
        <div class="how__cta">
            <a href="{{ route('surat.index') }}" class="btn-primary-hero">
                Mulai Buat Surat Sekarang
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- LAYANAN --}}
<section class="layanan" id="layanan">
    <div class="layanan__inner">
        <div class="container">
            <div class="layanan__top">
                <div>
                    <span class="label-pill label-pill--light">Layanan Digital</span>
                    <h2 class="sec-title sec-title--light">Jenis Surat yang Tersedia</h2>
                </div>
                <p class="layanan__desc">Pilih layanan sesuai kebutuhan Anda</p>
            </div>
            <div class="layanan__grid">
                <a href="{{ route('surat.index') }}?jenis=domisili" class="lay-card">
                    <span class="lay-card__num">01</span>
                    <div class="lay-card__ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <div class="lay-card__body">
                        <h3>Surat Domisili</h3>
                        <p>Keterangan tempat tinggal resmi warga desa</p>
                    </div>
                    <div class="lay-card__arr">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </div>
                </a>
                <a href="{{ route('surat.index') }}?jenis=tidak_mampu" class="lay-card">
                    <span class="lay-card__num">02</span>
                    <div class="lay-card__ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    </div>
                    <div class="lay-card__body">
                        <h3>SKTM</h3>
                        <p>Surat Keterangan Tidak Mampu untuk keperluan sosial &amp; pendidikan</p>
                    </div>
                    <div class="lay-card__arr">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </div>
                </a>
                <a href="{{ route('surat.index') }}?jenis=usaha" class="lay-card">
                    <span class="lay-card__num">03</span>
                    <div class="lay-card__ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                    </div>
                    <div class="lay-card__body">
                        <h3>Surat Usaha (SKU)</h3>
                        <p>Keterangan usaha atau wirausaha yang dijalankan warga</p>
                    </div>
                    <div class="lay-card__arr">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </div>
                </a>
                <a href="{{ route('surat.index') }}?jenis=pengantar" class="lay-card">
                    <span class="lay-card__num">04</span>
                    <div class="lay-card__ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/></svg>
                    </div>
                    <div class="lay-card__body">
                        <h3>Surat Pengantar</h3>
                        <p>Pengantar untuk SKCK, KTP, KK, dan dokumen lainnya</p>
                    </div>
                    <div class="lay-card__arr">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </div>
                </a>
                <a href="{{ route('surat.index') }}" class="lay-card lay-card--cta">
                    <div class="lay-card__ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                    </div>
                    <div class="lay-card__body">
                        <h3>Jenis Lainnya</h3>
                        <p>Buat surat dengan jenis yang Anda tentukan sendiri</p>
                    </div>
                    <div class="lay-card__arr">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- PROFIL --}}
<section class="profil" id="profil">
    <div class="container">
        <div class="profil__wrap">
            <div class="profil__left">
                <span class="label-pill">Tentang Kami</span>
                <h2 class="sec-title">Profil Desa Pelang Lor</h2>
                <p class="profil__sub">Kecamatan Kedunggalar &bull; Kabupaten Ngawi &bull; Jawa Timur</p>
                <div class="profil__tabs">
                    <button class="p-tab active" data-tab="sejarah">Sejarah</button>
                    <button class="p-tab" data-tab="visi-misi">Visi &amp; Misi</button>
                    <button class="p-tab" data-tab="struktur">Perangkat</button>
                </div>
                <div class="p-panel active" id="tab-sejarah">
                    <p>Desa Pelang Lor terletak di Kecamatan Kedunggalar, Kabupaten Ngawi, Provinsi Jawa Timur — desa agraris dengan sejarah panjang yang erat kaitannya dengan perkembangan wilayah Ngawi.</p>
                    <p>Dengan kondisi geografis yang strategis, Desa Pelang Lor berkembang menjadi desa yang sejahtera dengan potensi pertanian dan sumber daya alam yang melimpah. Masyarakatnya dikenal dengan semangat gotong royong yang tinggi.</p>
                </div>
                <div class="p-panel" id="tab-visi-misi">
                    <div class="visi-box">
                        <p class="visi-box__label">Visi</p>
                        <p>"Terwujudnya Desa Pelang Lor yang Maju, Mandiri, dan Sejahtera Berlandaskan Gotong Royong"</p>
                    </div>
                    <p class="misi-label">Misi</p>
                    <ul class="misi-list">
                        <li>Meningkatkan kualitas pelayanan publik yang transparan dan akuntabel</li>
                        <li>Mengembangkan potensi ekonomi lokal dan sumber daya masyarakat</li>
                        <li>Membangun infrastruktur desa yang berkelanjutan</li>
                        <li>Mewujudkan digitalisasi layanan administrasi desa</li>
                        <li>Meningkatkan kualitas pendidikan dan kesehatan warga</li>
                    </ul>
                </div>
                <div class="p-panel" id="tab-struktur">
                    <div class="perangkat-grid">
                        <div class="perangkat-item">
                            <div class="perangkat-item__av">KD</div>
                            <p class="perangkat-item__pos">Kepala Desa</p>
                            <p class="perangkat-item__name">HARIYANA</p>
                        </div>
                        <div class="perangkat-item">
                            <div class="perangkat-item__av">SK</div>
                            <p class="perangkat-item__pos">Sekretaris Desa</p>
                            <p class="perangkat-item__name">DIDIK SUPRIYANTO</p>
                        </div>
                        <div class="perangkat-item">
                            <div class="perangkat-item__av">BK</div>
                            <p class="perangkat-item__pos">Bendahara</p>
                            <p class="perangkat-item__name">— Diperbarui</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profil__right">
                <div class="map-card">
                    <div class="map-card__embed">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.0!2d111.47!3d-7.41!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMjQnMzYuMCJTIDExMcKwMjgnMTIuMCJF!5e0!3m2!1sid!2sid!4v1234567890" width="100%" height="260" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Peta Desa Pelang Lor"></iframe>
                    </div>
                    <div class="map-card__info">
                        <div class="map-info-row"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg><span>Kecamatan Kedunggalar</span></div>
                        <div class="map-info-row"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/></svg><span>Kabupaten Ngawi</span></div>
                        <div class="map-info-row"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg><span>Provinsi Jawa Timur</span></div>
                        <div class="map-info-row"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg><span>Kode Pos 63254</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- BERITA --}}
<section class="berita" id="berita">
    <div class="container">
        <div class="berita__head">
            <span class="label-pill">Informasi Terkini</span>
            <h2 class="sec-title">Berita Desa</h2>
        </div>
        <div class="berita__grid">
            @foreach($berita as $index => $item)
            <article class="berita-card {{ $index === 0 ? 'berita-card--featured' : '' }}">
                <div class="berita-card__img">
                    <div class="berita-card__placeholder">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
                    </div>
                    @if($index === 0)<span class="berita-card__badge">Utama</span>@endif
                </div>
                <div class="berita-card__body">
                    <span class="berita-card__date">{{ $item['tanggal'] }}</span>
                    <h3 class="berita-card__title">{{ $item['judul'] }}</h3>
                    <p class="berita-card__excerpt">{{ $item['ringkasan'] }}</p>
                    <a href="#" class="berita-card__more">Selengkapnya <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

@endsection