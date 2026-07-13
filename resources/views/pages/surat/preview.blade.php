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
            <span>Preview Surat</span>
        </nav>
        
        @if(auth()->guard('web')->check())
            <h1 class="page-hero__title">Arsip Surat Keterangan</h1>
            <p class="page-hero__desc">Pratinjau detail surat keterangan warga untuk keperluan arsip desa.</p>
        @elseif(request('from') == 'riwayat')
            <h1 class="page-hero__title">Riwayat Surat Keterangan</h1>
            <p class="page-hero__desc">Pratinjau detail surat keterangan warga yang pernah Anda buat.</p>
        @else
            <h1 class="page-hero__title">Surat Berhasil Dibuat</h1>
            <p class="page-hero__desc">Surat keterangan Anda telah selesai diproses. Silakan unduh untuk keperluan penandatanganan basah.</p>
        @endif
    </div>
</div>

<section class="preview-section">
    <div class="container container--narrow">

        @if(session('success'))
            <div class="preview-alert preview-alert--success" style="margin-bottom: 24px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <div>
                    <strong>Berhasil!</strong> {{ session('success') }}
                </div>
            </div>
        @endif

        @if(!auth()->guard('web')->check() && request('from') != 'riwayat')
        {{-- ============================================================ --}}
        {{-- WARGA: TTD SELECTOR (Seperti UI Lama yang Diperindah)        --}}
        {{-- ============================================================ --}}
        <div class="preview-alert preview-alert--success" style="margin-bottom: 24px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <div>
                <strong>Surat telah jadi!</strong> Silakan pilih siapa yang akan menandatangani surat Anda, lalu unduh format PDF/JPG.
            </div>
        </div>

        <div style="background: #fff; padding: 24px; border-radius: 12px; margin-bottom: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">
            <div style="margin-bottom: 16px;">
                <h3 style="margin: 0 0 4px; font-size: 16px; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#800000" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Pilih Penandatangan
                </h3>
                <p style="margin: 0; font-size: 14px; color: #64748b;">Nama dan jabatan di bawah surat akan menyesuaikan pilihan Anda.</p>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                <button type="button" id="btnKades" onclick="setTtd('kades')" style="display: flex; flex-direction: column; align-items: flex-start; padding: 16px; border-radius: 10px; border: 2px solid #800000; background: #fffafaf0; cursor: pointer; transition: all 0.2s; text-align: left;">
                    <span style="font-size: 13px; font-weight: 600; color: #800000; margin-bottom: 4px;">Kepala Desa</span>
                    <span style="font-size: 15px; font-weight: 700; color: #0f172a;">HARIYANA</span>
                </button>
                <button type="button" id="btnSekdes" onclick="setTtd('sekdes')" style="display: flex; flex-direction: column; align-items: flex-start; padding: 16px; border-radius: 10px; border: 2px solid #e2e8f0; background: #f8fafc; cursor: pointer; transition: all 0.2s; text-align: left;">
                    <span style="font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 4px;">Sekretaris Desa</span>
                    <span style="font-size: 15px; font-weight: 700; color: #0f172a;">DIDIK SUPRIYANTO</span>
                </button>
            </div>
        </div>
        @endif

        {{-- ============================================================ --}}
        {{-- SURAT PREVIEW                                                --}}
        {{-- ============================================================ --}}
        <div class="surat-preview" id="suratPreview" style="margin-bottom: 24px;">

            {{-- KOP SURAT --}}
            <div class="surat-kop">
                <div class="surat-kop__logo">
                    <img src="{{ asset('images/Lambang_Kabupaten_Ngawi.png') }}" alt="Logo Kabupaten Ngawi" style="width: 100%; height: auto; object-fit: contain;">
                </div>
                <div class="surat-kop__text">
                    <p class="surat-kop__prov">PEMERINTAH KABUPATEN NGAWI</p>
                    <p class="surat-kop__kec">KECAMATAN KEDUNGGALAR</p>
                    <h2 class="surat-kop__desa">DESA PELANG LOR</h2>
                    <p class="surat-kop__alamat">Jln. Raya Solo-Ngawi KM 18 Ngawi &nbsp; Kode Pos 63254</p>
                </div>
            </div>
            <div class="surat-kop__garis-tebal"></div>
            <div class="surat-kop__garis-tipis"></div>

            {{-- JUDUL & NOMOR --}}
            <div class="surat-judul">
                <h3 class="surat-judul__title">{{ $data['jenis_surat'] }}</h3>
                <p class="surat-judul__nomor">Nomor : {{ $data['nomor_surat'] }}</p>
            </div>

            {{-- BODY --}}
            <div class="surat-body">

                {{-- Pembuka --}}
                <p class="surat-pembuka">
                    Yang bertanda tangan di bawah ini Kepala Desa Pelang Lor Kecamatan Kedunggalar Kabupaten Ngawi Jawa Timur menerangkan dengan sesungguhnya bahwa:
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

                {{-- TTD --}}
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
        {{-- TOMBOL AKSI                                                  --}}
        {{-- ============================================================ --}}
        <div class="preview-actions" style="display:flex; flex-wrap:wrap; gap:16px; align-items:center;">
            
            <a id="btn-pdf" href="{{ route('surat.pdf', ['id' => $data['id'], 'ttd' => $ttd ?? 'kades']) }}" class="btn-maroon-hero">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                Unduh PDF
            </a>
            
            <a id="btn-jpg" href="{{ route('surat.jpg', ['id' => $data['id'], 'ttd' => $ttd ?? 'kades']) }}" class="btn-maroon-hero">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                Unduh JPG
            </a>

            @if(!auth()->guard('web')->check() && request('from') != 'riwayat')
            <a href="{{ route('surat.edit', $data['id']) }}" class="btn-back" style="margin-left:auto;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Edit Data
            </a>

            <a href="{{ route('surat.index') }}" class="btn-back">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Buat Surat Lainnya
            </a>
            @endif
        </div>

        @if(!auth()->guard('web')->check())
        <div class="preview-alert" style="margin-top: 28px; background: #eff6ff; border-color: #bfdbfe; color: #1e3a8a;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <p style="margin: 0;"><strong>Perhatian:</strong> Surat ini merupakan dokumen digital resmi Desa Pelang Lor. Untuk keperluan yang membutuhkan tanda tangan basah dan stempel asli, silakan cetak surat ini dan bawa ke Kantor Desa Pelang Lor pada jam kerja.</p>
        </div>
        @endif

    </div>
</section>

@endsection

@push('scripts')
<script>
    function setTtd(value) {
        // Update DOM Labels (Styling)
        const btnKades = document.getElementById('btnKades');
        const btnSekdes = document.getElementById('btnSekdes');
        
        if (value === 'kades') {
            btnKades.style.borderColor = '#800000';
            btnKades.style.background = '#fffafaf0';
            btnKades.querySelector('span').style.color = '#800000';
            
            btnSekdes.style.borderColor = '#e2e8f0';
            btnSekdes.style.background = '#f8fafc';
            btnSekdes.querySelector('span').style.color = '#64748b';
        } else {
            btnSekdes.style.borderColor = '#800000';
            btnSekdes.style.background = '#fffafaf0';
            btnSekdes.querySelector('span').style.color = '#800000';
            
            btnKades.style.borderColor = '#e2e8f0';
            btnKades.style.background = '#f8fafc';
            btnKades.querySelector('span').style.color = '#64748b';
        }

        // Update Preview Text
        const previewJabatan = document.getElementById('preview-jabatan');
        const previewNama = document.getElementById('preview-nama');
        
        if (value === 'kades') {
            previewJabatan.textContent = 'Kepala Desa Pelang Lor';
            previewNama.innerHTML = '<strong><u>HARIYANA</u></strong>';
        } else {
            previewJabatan.textContent = 'Sekretaris Desa Pelang Lor';
            previewNama.innerHTML = '<strong><u>DIDIK SUPRIYANTO</u></strong>';
        }

        // Update Button URLs
        const btnPdf = document.getElementById('btn-pdf');
        const btnJpg = document.getElementById('btn-jpg');
        
        if(btnPdf) {
            const url = new URL(btnPdf.href);
            url.searchParams.set('ttd', value);
            btnPdf.href = url.toString();
        }
        
        if(btnJpg) {
            const urlJpg = new URL(btnJpg.href);
            urlJpg.searchParams.set('ttd', value);
            btnJpg.href = urlJpg.toString();
        }
    }
</script>
@endpush
