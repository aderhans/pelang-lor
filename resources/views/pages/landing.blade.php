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


{{-- RIWAYAT SURAT WARGA (Jika Login) --}}
@if(Auth::guard('warga')->check())
<section class="how" style="background: #f8f9fa;">
    <div class="container">
        <div class="how__head">
            <span class="label-pill" style="background: rgba(16,185,129,0.1); color: #10b981;">Arsip Warga</span>
            <h2 class="sec-title">Riwayat Pengajuan Surat</h2>
            <p style="color: #64748b; margin-top: 8px;">Daftar surat keterangan yang pernah Anda ajukan beserta statusnya.</p>
        </div>

        @if(session('success'))
            <div style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.2); color: #10b981; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px; display:flex; align-items:center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #ef4444; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px; display:flex; align-items:center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ session('error') }}
            </div>
        @endif

        @if(count($riwayatSurat) > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                    <thead>
                        <tr style="background: #f1f5f9; text-align: left;">
                            <th style="padding: 16px; color: #334155; font-weight: 600;">Nomor Surat / Jenis</th>
                            <th style="padding: 16px; color: #334155; font-weight: 600;">Tanggal Pengajuan</th>
                            <th style="padding: 16px; color: #334155; font-weight: 600;">Status</th>
                            <th style="padding: 16px; color: #334155; font-weight: 600; text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayatSurat as $surat)
                        <tr style="border-top: 1px solid #e2e8f0;">
                            <td style="padding: 16px;">
                                <div style="font-weight: 600; color: #0f172a;">{{ $surat->jenis_surat }}</div>
                                <div style="font-size: 13px; color: #64748b;">{{ $surat->nomor_surat }}</div>
                            </td>
                            <td style="padding: 16px; color: #475569;">{{ $surat->created_at->format('d M Y, H:i') }}</td>
                            <td style="padding: 16px;">
                                @if($surat->status === 'Menunggu')
                                    <span style="display:inline-flex; align-items:center; gap:6px; background:#fef3c7; color:#d97706; padding:4px 10px; border-radius:20px; font-size:13px; font-weight:600;"><span style="width:6px;height:6px;border-radius:50%;background:#d97706;"></span>Menunggu</span>
                                @elseif($surat->status === 'Disetujui')
                                    <span style="display:inline-flex; align-items:center; gap:6px; background:#d1fae5; color:#059669; padding:4px 10px; border-radius:20px; font-size:13px; font-weight:600;"><span style="width:6px;height:6px;border-radius:50%;background:#059669;"></span>Disetujui</span>
                                @else
                                    <span style="display:inline-flex; align-items:center; gap:6px; background:#fee2e2; color:#dc2626; padding:4px 10px; border-radius:20px; font-size:13px; font-weight:600;"><span style="width:6px;height:6px;border-radius:50%;background:#dc2626;"></span>Ditolak</span>
                                @endif
                            </td>
                            <td style="padding: 16px; text-align: right;">
                                @if($surat->status === 'Menunggu')
                                    <a href="{{ route('surat.edit', $surat->id) }}" style="display:inline-flex; align-items:center; gap:6px; padding:8px 16px; background:#f1f5f9; color:#475569; border-radius:6px; text-decoration:none; font-size:13px; font-weight:600; transition:0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                        Edit Surat
                                    </a>
                                @elseif($surat->status === 'Disetujui')
                                    <a href="{{ route('surat.preview', $surat->id) }}" style="display:inline-flex; align-items:center; gap:6px; padding:8px 16px; background:#10b981; color:#fff; border-radius:6px; text-decoration:none; font-size:13px; font-weight:600; transition:0.2s;" onmouseover="this.style.background='#059669'" onmouseout="this.style.background='#10b981'">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                        Download
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align: center; padding: 40px 20px; background: #fff; border-radius: 12px; border: 1px dashed #cbd5e1;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" style="margin: 0 auto 12px;"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                <h3 style="font-size: 16px; color: #334155; margin-bottom: 4px;">Belum Ada Riwayat Surat</h3>
                <p style="color: #64748b; font-size: 14px; margin-bottom: 16px;">Anda belum pernah mengajukan surat keterangan. Ajukan sekarang untuk kebutuhan Anda.</p>
                <a href="{{ route('surat.index') }}" class="btn-primary-hero" style="display: inline-flex; font-size: 14px; padding: 10px 20px;">Buat Surat Keterangan</a>
            </div>
        @endif
    </div>
</section>
@endif


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
                    <button class="p-tab active" data-tab="sejarah">Sejarah</button>
                    <button class="p-tab" data-tab="produk-unggulan">Produk Unggulan</button>
                    <button class="p-tab" data-tab="struktur">Perangkat</button>
                </div>
                <div class="p-panel active" id="tab-sejarah">
                    <p>Desa Pelang Lor terletak di Kecamatan Kedunggalar, Kabupaten Ngawi, Provinsi Jawa Timur, merupakan sebuah desa dengan sejarah panjang yang erat kaitannya dengan perkembangan wilayah Ngawi.</p>
                    <p>Dengan kondisi geografis yang strategis, Desa Pelang Lor berkembang menjadi desa yang sejahtera dengan potensi pertanian dan sumber daya alam yang melimpah. Masyarakatnya dikenal dengan semangat gotong royong yang tinggi.</p>
                </div>
<div class="p-panel" id="tab-produk-unggulan">
    <div class="produk-grid">
        <div class="produk-card">
            <div class="produk-card__img">
                <img src="{{ asset('images/produk/perkutut.jpg') }}" alt="Peternakan Perkutut Desa Pelang Lor">
            </div>
            <div class="produk-card__body">
                <span class="produk-card__label">Peternakan</span>
                <h3>Perkutut</h3>
                <p>Desa Pelang Lor dikenal sebagai salah satu sentra budidaya burung perkutut di Kabupaten Ngawi. Warga secara turun-temurun mengembangkan perkutut unggulan dengan suara merdu dan kualitas juara, menjadi sumber penghasilan tambahan sekaligus kebanggaan desa.</p>
            </div>
        </div>
        <div class="produk-card">
            <div class="produk-card__img">
                <img src="{{ asset('images/produk/lele.jpg') }}" alt="Peternakan Ikan Lele Desa Pelang Lor">
            </div>
            <div class="produk-card__body">
                <span class="produk-card__label">Peternakan</span>
                <h3>Ikan Lele</h3>
                <p>Peternakan ikan lele menjadi salah satu produk unggulan warga Desa Pelang Lor, dikelola secara mandiri melalui kolam-kolam budidaya yang tersebar di beberapa dusun. Usaha ini menjadi sumber penghasilan tambahan yang menjanjikan bagi warga sekaligus mendukung ketahanan pangan desa.</p>
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