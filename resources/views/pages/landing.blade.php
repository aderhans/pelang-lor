@extends('layouts.app')

@section('title', 'Beranda')
@section('meta_description', 'Website resmi Desa Pelang Lor, Kecamatan Kedunggalar, Kabupaten Ngawi. Layanan administrasi desa online — surat keterangan, profil desa, dan berita terkini.')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<section class="hero" id="beranda">
    <div class="hero__bg">
        <div class="hero__overlay"></div>
        <div class="hero__particles" id="particles"></div>
    </div>
    <div class="container hero__inner">
        <div class="hero__badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            Desa Digital Mandiri
        </div>
        <h1 class="hero__title">
            Selamat Datang di<br>
            <span class="hero__title-accent">Desa Pelang Lor</span>
        </h1>
        <p class="hero__subtitle">
            Kecamatan Kedunggalar &bull; Kabupaten Ngawi &bull; Jawa Timur
        </p>
        <p class="hero__desc">
            Kami hadir untuk memudahkan layanan administrasi desa secara digital.
            Buat surat keterangan kapan saja dan di mana saja — cepat, mudah, dan resmi.
        </p>
        <div class="hero__actions">
            <a href="{{ route('surat.index') }}" class="btn btn--primary btn--lg">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10,9 9,9 8,9"/></svg>
                Buat Surat Keterangan
            </a>
            <a href="#profil" class="btn btn--ghost btn--lg">
                Profil Desa
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>
            </a>
        </div>
        <div class="hero__scroll-hint">
            <div class="hero__scroll-dot"></div>
        </div>
    </div>
</section>

{{-- ===== STATS SECTION ===== --}}
<section class="stats">
    <div class="container">
        <div class="stats__grid">
            @foreach($stats as $stat)
            <div class="stats__card">
                <div class="stats__icon stats__icon--{{ $stat['icon'] }}">
                    @if($stat['icon'] === 'people')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    @elseif($stat['icon'] === 'house')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    @elseif($stat['icon'] === 'map')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
                    @else
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    @endif
                </div>
                <div class="stats__value">{{ $stat['value'] }}</div>
                <div class="stats__label">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== PROFIL DESA ===== --}}
<section class="profil" id="profil">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Tentang Kami</span>
            <h2 class="section-title">Profil Desa Pelang Lor</h2>
            <p class="section-desc">Mengenal lebih dekat Desa Pelang Lor — sejarah, visi, dan misi kami dalam melayani masyarakat.</p>
        </div>
        <div class="profil__grid">
            <div class="profil__content">
                <div class="profil__tab-nav">
                    <button class="profil__tab-btn active" data-tab="sejarah">Sejarah</button>
                    <button class="profil__tab-btn" data-tab="visi-misi">Visi & Misi</button>
                    <button class="profil__tab-btn" data-tab="struktur">Perangkat Desa</button>
                </div>
                <div class="profil__tab-content">
                    <div class="profil__tab-panel active" id="tab-sejarah">
                        <h3>Sejarah Singkat</h3>
                        <p>Desa Pelang Lor merupakan salah satu desa yang terletak di Kecamatan Kedunggalar, Kabupaten Ngawi, Provinsi Jawa Timur. Desa ini memiliki sejarah panjang yang erat kaitannya dengan perkembangan wilayah Ngawi.</p>
                        <p>Dengan kondisi geografis yang strategis di kawasan dataran Ngawi, Desa Pelang Lor berkembang menjadi desa agraris yang sejahtera dengan potensi pertanian dan sumber daya alam yang melimpah.</p>
                        <p>Masyarakat Pelang Lor dikenal dengan semangat gotong royong yang tinggi, menjadi fondasi kuat dalam setiap pembangunan dan kegiatan sosial di desa.</p>
                    </div>
                    <div class="profil__tab-panel" id="tab-visi-misi">
                        <h3>Visi</h3>
                        <p class="profil__visi">"Terwujudnya Desa Pelang Lor yang Maju, Mandiri, dan Sejahtera Berlandaskan Gotong Royong"</p>
                        <h3>Misi</h3>
                        <ul class="profil__misi-list">
                            <li>Meningkatkan kualitas pelayanan publik yang transparan dan akuntabel</li>
                            <li>Mengembangkan potensi ekonomi lokal dan sumber daya masyarakat</li>
                            <li>Membangun infrastruktur desa yang berkelanjutan</li>
                            <li>Mewujudkan digitalisasi layanan administrasi desa</li>
                            <li>Meningkatkan kualitas pendidikan dan kesehatan warga</li>
                        </ul>
                    </div>
                    <div class="profil__tab-panel" id="tab-struktur">
                        <h3>Perangkat Desa</h3>
                        <div class="struktur-grid">
                            <div class="struktur-card">
                                <div class="struktur-card__avatar">KD</div>
                                <div class="struktur-card__info">
                                    <p class="struktur-card__jabatan">Kepala Desa</p>
                                    <p class="struktur-card__nama">— (Sedang Diperbarui)</p>
                                </div>
                            </div>
                            <div class="struktur-card">
                                <div class="struktur-card__avatar">SK</div>
                                <div class="struktur-card__info">
                                    <p class="struktur-card__jabatan">Sekretaris Desa</p>
                                    <p class="struktur-card__nama">— (Sedang Diperbarui)</p>
                                </div>
                            </div>
                            <div class="struktur-card">
                                <div class="struktur-card__avatar">BK</div>
                                <div class="struktur-card__info">
                                    <p class="struktur-card__jabatan">Bendahara</p>
                                    <p class="struktur-card__nama">— (Sedang Diperbarui)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profil__map-wrap">
                <div class="profil__map-card">
                    <div class="profil__map-header">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        Lokasi Desa
                    </div>
                    <div class="profil__map-embed">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.0!2d111.47!3d-7.41!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMjQnMzYuMCJTIDExMcKwMjgnMTIuMCJF!5e0!3m2!1sid!2sid!4v1234567890"
                            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="Peta Desa Pelang Lor">
                        </iframe>
                    </div>
                    <div class="profil__map-info">
                        <div class="profil__map-row">
                            <span class="profil__map-key">Kecamatan</span>
                            <span>Kedunggalar</span>
                        </div>
                        <div class="profil__map-row">
                            <span class="profil__map-key">Kabupaten</span>
                            <span>Ngawi</span>
                        </div>
                        <div class="profil__map-row">
                            <span class="profil__map-key">Provinsi</span>
                            <span>Jawa Timur</span>
                        </div>
                        <div class="profil__map-row">
                            <span class="profil__map-key">Kode Pos</span>
                            <span>63254</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== LAYANAN SURAT (CTA) ===== --}}
<section class="layanan" id="layanan">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Layanan Digital</span>
            <h2 class="section-title">Surat Keterangan Online</h2>
            <p class="section-desc">Urus surat keterangan tanpa perlu antri. Isi form, generate surat, dan download langsung dalam format JPG.</p>
        </div>
        <div class="layanan__grid">
            <a href="{{ route('surat.index') }}?jenis=domisili" class="layanan__card">
                <div class="layanan__card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <h3>Surat Domisili</h3>
                <p>Keterangan tempat tinggal / domisili resmi warga desa</p>
                <span class="layanan__card-arrow">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </span>
            </a>
            <a href="{{ route('surat.index') }}?jenis=tidak_mampu" class="layanan__card">
                <div class="layanan__card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                </div>
                <h3>SKTM</h3>
                <p>Surat Keterangan Tidak Mampu untuk keperluan sosial & pendidikan</p>
                <span class="layanan__card-arrow">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </span>
            </a>
            <a href="{{ route('surat.index') }}?jenis=usaha" class="layanan__card">
                <div class="layanan__card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                </div>
                <h3>Surat Usaha (SKU)</h3>
                <p>Keterangan usaha atau wirausaha yang dijalankan oleh warga</p>
                <span class="layanan__card-arrow">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </span>
            </a>
            <a href="{{ route('surat.index') }}?jenis=pengantar" class="layanan__card">
                <div class="layanan__card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                </div>
                <h3>Surat Pengantar</h3>
                <p>Pengantar untuk keperluan SKCK, KTP, KK, dan dokumen lainnya</p>
                <span class="layanan__card-arrow">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </span>
            </a>
        </div>
        <div class="layanan__cta-wrap">
            <a href="{{ route('surat.index') }}" class="btn btn--primary btn--lg">
                Ajukan Permohonan Surat Sekarang
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ===== BERITA DESA ===== --}}
<section class="berita" id="berita">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Informasi Terkini</span>
            <h2 class="section-title">Berita Desa</h2>
            <p class="section-desc">Informasi terbaru seputar kegiatan dan perkembangan Desa Pelang Lor.</p>
        </div>
        <div class="berita__grid">
            @foreach($berita as $index => $item)
            <article class="berita__card {{ $index === 0 ? 'berita__card--featured' : '' }}">
                <div class="berita__card-img">
                    <div class="berita__card-placeholder">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
                    </div>
                </div>
                <div class="berita__card-body">
                    <span class="berita__date">{{ $item['tanggal'] }}</span>
                    <h3 class="berita__title">{{ $item['judul'] }}</h3>
                    <p class="berita__excerpt">{{ $item['ringkasan'] }}</p>
                    <a href="#" class="berita__read-more">Selengkapnya →</a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

@endsection
