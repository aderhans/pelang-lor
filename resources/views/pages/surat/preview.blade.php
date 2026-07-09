@extends('layouts.app')

@section('title', 'Status Permohonan — ' . ($data['jenis_surat'] ?? 'Surat Keterangan'))

@section('content')

<div class="page-hero page-hero--primary">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('landing') }}">Beranda</a>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <a href="{{ route('surat.index') }}">Surat Keterangan</a>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Status Permohonan</span>
        </nav>
        <h1 class="page-hero__title">Status Permohonan Surat</h1>
        @if($data['status'] === 'Disetujui')
            <p class="page-hero__desc">Surat Anda telah disetujui oleh Admin Desa. Silakan unduh dalam format JPG atau PDF.</p>
        @elseif($data['status'] === 'Ditolak')
            <p class="page-hero__desc">Permohonan surat Anda tidak dapat diproses. Silakan ajukan permohonan baru jika diperlukan.</p>
        @else
            <p class="page-hero__desc">Permohonan Anda telah diterima dan sedang menunggu verifikasi dari Admin Desa Pelang Lor.</p>
        @endif
    </div>
</div>

<section class="preview-section">
    <div class="container container--narrow">

        {{-- ============================================================ --}}
        {{-- STATUS ALERT                                                 --}}
        {{-- ============================================================ --}}

        @if($data['status'] === 'Disetujui')
            {{-- DISETUJUI --}}
            <div class="preview-alert preview-alert--success" style="margin-bottom: 24px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <div>
                    <strong>Surat telah disetujui & diarsipkan!</strong> Surat Keterangan Anda sudah resmi dan dapat diunduh dalam format JPG atau PDF.
                </div>
            </div>

        @elseif($data['status'] === 'Ditolak')
            {{-- DITOLAK --}}
            <div class="preview-alert preview-alert--error" style="margin-bottom: 24px; background: #fef2f2; border-color: #fca5a5; color: #991b1b;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                <div>
                    <strong>Permohonan ditolak.</strong> Surat ini tidak dapat disetujui oleh Admin. Silakan hubungi Kantor Desa Pelang Lor untuk informasi lebih lanjut, atau ajukan permohonan baru.
                </div>
            </div>

        @else
            {{-- MENUNGGU (default) --}}
            <div class="preview-alert preview-alert--success" style="margin-bottom: 12px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                <div>
                    <strong>Permintaan berhasil dikirim!</strong> Surat Anda telah masuk ke sistem dan sedang menunggu verifikasi dari Admin Desa Pelang Lor.
                </div>
            </div>
            <div class="preview-alert preview-alert--pending" style="margin-bottom: 24px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <div>
                    <strong>Menunggu persetujuan Admin.</strong> Surat ini akan resmi dan dapat diunduh setelah disetujui oleh Admin Desa. Simpan halaman ini atau catat link URL ini untuk mengecek status dan mengunduh surat nantinya.
                </div>
            </div>
        @endif



        {{-- ============================================================ --}}
        {{-- SURAT PREVIEW                                                --}}
        {{-- ============================================================ --}}
        <div class="surat-preview" id="suratPreview">

            {{-- KOP SURAT --}}
            <div class="surat-kop">
                <div class="surat-kop__logo">
                    <img src="{{ asset('images/Lambang_Kabupaten_Ngawi.png') }}" alt="Logo Kabupaten Ngawi" style="width: 100%; height: auto; object-fit: contain;">
                </div>
                <div class="surat-kop__text">
                    <p>PEMERINTAH KABUPATEN NGAWI</p>
                    <p>KECAMATAN KEDUNGGALAR</p>
                    <h2 class="surat-kop__desa">DESA PELANG LOR</h2>
                    <p class="surat-kop__alamat">Jln. Raya Solo-Ngawi KM 18 Ngawi &nbsp; Kode Pos 63254</p>
                </div>
            </div>
            <div class="surat-kop__garis-tebal"></div>
            <div class="surat-kop__garis-tipis"></div>

            {{-- JUDUL & NOMOR --}}
            <div class="surat-judul">
                <p class="surat-judul-text"><strong><u>{{ $data['jenis_surat'] }}</u></strong></p>
                <p class="surat-judul-no" style="font-style: italic;">Nomor  :  {{ $data['nomor_surat'] }}</p>
            </div>

            {{-- BODY --}}
            <div class="surat-body">

                {{-- Pembuka --}}
                <p class="surat-pembuka">
                    Yang bertanda tangan di bawah ini Kami Kepala Desa Pelang Lor Kecamatan Kedunggalar Kabupaten Ngawi Jawa Timur menerangkan dengan sesungguhnya bahwa :
                </p>

                {{-- Data Fields --}}
                <table class="surat-data-table">
                    <tr>
                        <td class="surat-no">1.</td>
                        <td class="surat-key">Nama</td>
                        <td class="surat-sep">:</td>
                        <td class="surat-val">{{ $data['nama'] }}</td>
                    </tr>
                    <tr>
                        <td class="surat-no">2.</td>
                        <td class="surat-key">Nomor Induk Kependudukan</td>
                        <td class="surat-sep">:</td>
                        <td class="surat-val">{{ $data['nik'] }}</td>
                    </tr>
                    <tr>
                        <td class="surat-no">3.</td>
                        <td class="surat-key">Jenis Kelamin</td>
                        <td class="surat-sep">:</td>
                        <td class="surat-val">{{ $data['jenis_kelamin'] }}</td>
                    </tr>
                    <tr>
                        <td class="surat-no">4.</td>
                        <td class="surat-key">Tempat dan Tanggal Lahir</td>
                        <td class="surat-sep">:</td>
                        <td class="surat-val">{{ $data['tempat_lahir'] }}, {{ $data['tanggal_lahir'] }}</td>
                    </tr>
                    <tr>
                        <td class="surat-no">5.</td>
                        <td class="surat-key">Kewarganegaraan</td>
                        <td class="surat-sep">:</td>
                        <td class="surat-val">{{ $data['kewarganegaraan'] }}</td>
                    </tr>
                    <tr>
                        <td class="surat-no">6.</td>
                        <td class="surat-key">Agama</td>
                        <td class="surat-sep">:</td>
                        <td class="surat-val">{{ $data['agama'] }}</td>
                    </tr>
                    <tr>
                        <td class="surat-no">7.</td>
                        <td class="surat-key">Pekerjaan</td>
                        <td class="surat-sep">:</td>
                        <td class="surat-val">{{ $data['pekerjaan'] }}</td>
                    </tr>
                    <tr>
                        <td class="surat-no">8.</td>
                        <td class="surat-key">Alamat</td>
                        <td class="surat-sep">:</td>
                        <td class="surat-val">{{ $data['alamat'] }}</td>
                    </tr>
                    <tr>
                        <td class="surat-no">9.</td>
                        <td class="surat-key">Keperluan</td>
                        <td class="surat-sep">:</td>
                        <td class="surat-val">{{ $data['keperluan'] }}</td>
                    </tr>
                </table>

                {{-- Masa Berlaku --}}
                <p class="surat-masa-berlaku" style="font-style: italic;">
                    Surat Keterangan ini berlaku tiga bulan setelah surat dikeluarkan.
                </p>

                {{-- Penutup --}}
                <p class="surat-penutup">
                    Demikian surat keterangan ini kami buat dengan sebenarnya agar dapatnya dipergunakan sebagaimana mestinya.
                </p>

                {{-- TTD Placeholder (Kosong) --}}
                <div class="surat-ttd">
                    <div class="surat-ttd-box">
                        <p>Pelang Lor, {{ $data['tanggal_surat'] }}</p>
                        <p id="preview-jabatan">Kepala Desa Pelang Lor</p>
                        <div class="surat-ttd-space"></div>
                        <p id="preview-nama" class="surat-ttd-name"><strong><u>HARIYANA</u></strong></p>
                    </div>
                </div>

            </div>{{-- /.surat-body --}}
        </div>{{-- /.surat-preview --}}

        {{-- ============================================================ --}}
        {{-- TOMBOL AKSI — kondisional berdasarkan status                 --}}
        {{-- ============================================================ --}}
        <div class="preview-actions">

            {{-- Tombol kembali/ajukan baru (selalu ada) --}}
            <a href="{{ route('surat.index') }}" class="btn-back">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                @if($data['status'] === 'Ditolak')
                    Ajukan Permohonan Baru
                @else
                    Kirim Permintaan Baru
                @endif
            </a>

        </div>

        {{-- ============================================================ --}}
        {{-- CATATAN BAWAH                                                --}}
        {{-- ============================================================ --}}
        @if($data['status'] === 'Disetujui')
        <div class="preview-alert" style="margin-top: 28px; background: #eff6ff; border-color: #bfdbfe; color: #1e3a8a;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <p style="margin: 0;">Surat resmi telah <strong>dikirimkan ke email Anda</strong> beserta tanda tangan digital dan stempel. Anda tidak dapat mengunduhnya dari halaman ini.</p>
        </div>
        @elseif($data['status'] === 'Menunggu')
        <div class="preview-alert" style="margin-top: 28px; background: #fffbeb; border-color: #fcd34d; color: #92400e;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <p style="margin: 0;"><strong>Penting:</strong> Surat akan dikirimkan ke email Anda (yang Anda gunakan saat mendaftar) setelah disetujui admin.</p>
        </div>
        @endif

    </div>
</section>

@endsection
