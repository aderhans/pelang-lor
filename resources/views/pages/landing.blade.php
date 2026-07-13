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
                <a href="{{ route('surat.riwayat') }}" class="btn-maroon-hero">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                    Cek Surat
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
                <h3>Download JPG/PDF</h3>
                <p>Unduh surat dalam format JPG/PDF siap cetak dan dipergunakan</p>
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
                <a href="{{ route('surat.index') }}?jenis=belum_menikah" class="lay-card">
                    <span class="lay-card__num">05</span>
                    <div class="lay-card__ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <div class="lay-card__body">
                        <h3>Belum Menikah</h3>
                        <p>Keterangan status belum pernah menikah untuk warga</p>
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
                    <button class="p-tab active" data-tab="sejarah">Sejarah Desa</button>
                    <button class="p-tab" data-tab="produk-unggulan">Potensi Unggulan Desa</button>
                    <button class="p-tab" data-tab="struktur">Perangkat</button>
                </div>
                <div class="p-panel active" id="tab-sejarah">
                    <p>Pelanglor merupakan desa yang terletak di kecamatan Kedunggalar, meski tidak ada dokumentasi tertulis yang menceritakan sejarah desa Pelanglor, namun sejarah berikut ini berdasarkan cerita masyarakat Pelanglor dari mulut ke mulut.
Pelanglor memiliki dusun yang bernama Pelanggarem dan Tambakselo. Dinamakan Pelanggarem, karena wilayahnya yang dekat dengan bengawan dan mayoritas airnya asin, sehingga mendapat julukan dusun Pelanggarem. Selain itu, masyarakat Pelanggarem juga memanfaatkan kekayaan alam yaitu sungai yang kaya akan ikan sebagai mata pencaharian tambahan masyarakat sekitar.</p>
                    <p>Selain dusun Pelanggarem, Desa Pelanglor juga memiliki dusun yang bernama Tambakselo. Disebut Tambakselo, sebab di wilayah tersebut terdapat sebuah Tambak (sungai) dan Selo (Batu) yang setiap akhir masa panen padi ketiga selalu diadakan tradisi “Bersih Desa”. 
Tidak hanya di dusun Tambakselo, di dusun Pelanggarem juga diadakan tradisi “Bersih desa” yang diselenggarakan pada hari Jum’at Legi setiap akhir masa panen Padi ke tiga. Perbedaannya adalah terletak pada tempat pelaksanaanya. Di Pelanggarem tradisi tersebut dilaksanakan di area pemakaman Pelanggarem, sedangkan di Tambakselo, tradisi “Bersih Desa” dilaksanakan di Tambak.</p>
                </div>
<div class="p-panel" id="tab-produk-unggulan">
    <div class="produk-grid">
        <div class="produk-card">
            <div class="produk-card__img">
                <img src="{{ asset('images/produk/monumen_suryo.jpg') }}" alt="Monumen Suryo Desa Pelang Lor">
            </div>
            <div class="produk-card__body">
                <span class="produk-card__label">Wisata Sejarah</span>
                <h3>Monumen Suryo</h3>
                <p>Monumen Soeryo berdiri di tepi jalan raya Ngawi-Solo, tepat di wilayah Desa Pelang Lor. Monumen ini dibangun untuk mengenang Gubernur pertama Jawa Timur, Raden Mas Tumenggung Ario Soerjo, beserta dua perwira polisi (Kombes M. Doerjat dan Kompol Soeroko) yang gugur akibat kekejaman PKI pada November 1948. Monumen diresmikan pada 28 Oktober 1975 oleh Pangdam VIII/Brawijaya Mayjen TNI Witarmin, dan sekitar 100–200 meter dari monumen utama juga terdapat tugu peringatan di lokasi ditemukannya jenazah korban. Kawasan ini dilengkapi dengan puluhan jenis pohon langka serta kandang burung yang menampilkan koleksi perkutut, kepodang, dan bekisar, sehingga selain bernilai sejarah, kawasan ini juga menjadi tempat persinggahan yang teduh bagi para pelintas jalur Ngawi-Solo. Lokasinya yang strategis membuat Monumen Soeryo dikenal sebagai wisata sejarah berskala nasional di Kabupaten Ngawi.</p>
            </div>
        </div>
        <div class="produk-card">
            <div class="produk-card__img">
                <img src="{{ asset('images/produk/perkutut.jpg') }}" alt="Peternakan Perkutut Desa Pelang Lor">
            </div>
            <div class="produk-card__body">
                <span class="produk-card__label">Ikon Khas Desa</span>
                <h3>Perkutut</h3>
                <p>Julukan "Kampung Perkutut" melekat pada Desa Pelang Lor karena mayoritas warganya, khususnya di empat dusun (Tambakselo Timur, Tambakselo Barat, Tambakselo Selatan, dan Pelanggarem), menekuni budi daya burung perkutut. Usaha ini mulai berkembang sejak awal tahun 2000-an, dan pada 2019 Kepala Desa Pelang Lor, Hariyana, secara resmi menetapkan perkutut sebagai produk unggulan desa. Jumlah peternak terus bertambah — dari 44 orang pada 2017 menjadi 158 orang pada 2021 — dengan omzet penjualan mencapai ratusan ekor per bulan. Harga jual bervariasi, mulai dari puluhan ribu rupiah untuk anakan hingga puluhan juta rupiah untuk jenis langka seperti perkutut Majapahit. Pemerintah setempat turut mendukung melalui pembentukan kelompok usaha bersama (Kube) binaan Dinas Sosial Kabupaten Ngawi, menjadikan sektor ini sebagai salah satu penopang ekonomi rumah tangga yang signifikan di desa ini.</p>
            </div>
        </div>
        <div class="produk-card">
            <div class="produk-card__img">
                <img src="{{ asset('images/produk/lele.jpg') }}" alt="Peternakan Ikan Lele Desa Pelang Lor">
            </div>
            <div class="produk-card__body">
                <span class="produk-card__label">Peternakan</span>
                <h3>Budidaya Ikan Lele</h3>
                <p>Sebagai bagian dari upaya penguatan ketahanan pangan desa, budidaya ikan lele mulai dikembangkan sebagai salah satu unit usaha produktif warga. Pola ini sejalan dengan tren umum di desa-desa Kabupaten Ngawi, di mana budidaya lele — baik melalui kolam terpal, kolam pendederan, maupun sistem bioflok — banyak dikelola bersama BUMDes untuk mendukung kemandirian pangan protein warga sekaligus membuka peluang usaha tambahan.</p>
            </div>
        </div>
    </div>
</div>
                <div class="p-panel" id="tab-struktur">
                    <div class="org-chart-container">
                        <div class="oc-layout">
                            <!-- KADES -->
                            <div class="oc-kades">
                                <div class="oc-card">
                                    <div class="oc-card-title">KEPALA DESA</div>
                                    <div class="oc-card-name">HARIYANA</div>
                                </div>
                                <div class="oc-line-v"></div>
                            </div>

                            <!-- SEKDES ROW -->
                            <div class="oc-sekdes-row">
                                <div class="oc-line-v-main"></div>
                                <div class="oc-line-h-sekdes"></div>
                                <div class="oc-sekdes-card-wrap">
                                    <div class="oc-line-v-drop"></div>
                                    <div class="oc-card">
                                        <div class="oc-card-title">SEKRETARIS DESA</div>
                                        <div class="oc-card-name">YARMANA</div>
                                    </div>
                                    <div class="oc-line-v"></div>
                                </div>
                            </div>

                            <!-- KASI / KAUR ROW -->
                            <div class="oc-kasi-kaur-row">
                                <!-- Left Group: Kasi -->
                                <div class="oc-kasi-group">
                                    <div class="oc-line-h-group"></div>
                                    <div class="oc-group-cards">
                                        <div><div class="oc-line-v-drop"></div><div class="oc-card"><div class="oc-card-title">KEPALA SEKSI<br>PEMERINTAHAN</div><div class="oc-card-name">DIDIK SUPRIYANTO</div></div></div>
                                        <div><div class="oc-line-v-drop"></div><div class="oc-card"><div class="oc-card-title">KEPALA SEKSI<br>KESEJAHTERAAN</div><div class="oc-card-name">KUSNAN</div></div></div>
                                        <div><div class="oc-line-v-drop"></div><div class="oc-card"><div class="oc-card-title">KEPALA SEKSI<br>PELAYANAN</div><div class="oc-card-name">KASNI</div></div></div>
                                    </div>
                                </div>
                                
                                <!-- Main Vertical Line -->
                                <div class="oc-line-v-main"></div>

                                <!-- Right Group: Kaur -->
                                <div class="oc-kaur-group">
                                    <div class="oc-line-h-group"></div>
                                    <div class="oc-group-cards">
                                        <div><div class="oc-line-v-drop"></div><div class="oc-card"><div class="oc-card-title">KEPALA URUSAN<br>TATA USAHA DAN UMUM</div><div class="oc-card-name">IPAH DWI LESTARI</div></div></div>
                                        <div><div class="oc-line-v-drop"></div><div class="oc-card"><div class="oc-card-title">KEPALA URUSAN<br>KEUANGAN</div><div class="oc-card-name">TIYARA ERMITA SARI</div></div></div>
                                        <div><div class="oc-line-v-drop"></div><div class="oc-card"><div class="oc-card-title">KEPALA URUSAN<br>PERENCANAAN</div><div class="oc-card-name">SUWITO</div></div></div>
                                    </div>
                                </div>
                            </div>

                            <!-- DUSUN ROW -->
                            <div class="oc-dusun-row">
                                <div class="oc-line-v-main" style="height: 40px; margin-bottom: -2px; position: relative;"></div>
                                <div class="oc-dusun-group">
                                    <div class="oc-line-h-group"></div>
                                    <div class="oc-group-cards">
                                        <div><div class="oc-line-v-drop"></div><div class="oc-card"><div class="oc-card-title">KEPALA DUSUN<br>TAMBAKSELO TIMUR</div><div class="oc-card-name">SEPTYAN YOGA K.</div></div></div>
                                        <div><div class="oc-line-v-drop"></div><div class="oc-card"><div class="oc-card-title">KEPALA DUSUN<br>TAMBAKSELO SELATAN</div><div class="oc-card-name">JOKO SULISTIYO</div></div></div>
                                        <div><div class="oc-line-v-drop"></div><div class="oc-card"><div class="oc-card-title">KEPALA DUSUN<br>TAMBAKSELO BARAT</div><div class="oc-card-name">MARIYANTO</div></div></div>
                                        <div><div class="oc-line-v-drop"></div><div class="oc-card"><div class="oc-card-title">KEPALA DUSUN<br>PELANGGAREM</div><div class="oc-card-name">AGUS SUPRIYANTO</div></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profil__right">
                <div class="map-card">
                    <div class="map-card__embed">
                        <iframe src="https://maps.google.com/maps?q=Kantor%20Desa%20Pelang%20Lor,%20Ngawi&t=&z=16&ie=UTF8&iwloc=&output=embed" width="100%" height="260" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Peta Desa Pelang Lor"></iframe>
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