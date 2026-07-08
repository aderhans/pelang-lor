@extends('layouts.app')

@section('title', 'Preview Surat — ' . ($data['jenis_surat'] ?? 'Keterangan'))

@section('content')

<div class="page-hero page-hero--primary">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('landing') }}">Beranda</a>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <a href="{{ route('surat.index') }}">Surat Keterangan</a>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Preview</span>
        </nav>
        <h1 class="page-hero__title">Preview Surat</h1>
        <p class="page-hero__desc">Periksa kembali data, pilih penandatangan, lalu download surat dalam format JPG atau PDF.</p>
    </div>
</div>

<section class="preview-section">
    <div class="container container--narrow">

        {{-- Status Alert: Menunggu Persetujuan Admin --}}
        <div class="preview-alert preview-alert--success" style="margin-bottom: 12px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <div>
                <strong>Permohonan berhasil dikirim!</strong> Surat Anda telah masuk ke sistem dan sedang menunggu verifikasi dari Admin Desa Pelang Lor.
            </div>
        </div>
        <div class="preview-alert preview-alert--pending" style="margin-bottom: 24px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <div>
                <strong>Surat belum resmi.</strong> Surat ini akan diarsipkan secara resmi setelah disetujui oleh Admin. Anda tetap dapat mengunduh preview surat untuk referensi pribadi.
            </div>
        </div>

        {{-- Toggle Penandatangan --}}
        <div class="ttd-selector">
            <div class="ttd-selector__label">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Pilih Penandatangan Surat:
            </div>
            <div class="ttd-btns">
                <button type="button" class="ttd-btn ttd-btn--active" id="btnKades" onclick="setTtd('kades')">
                    <div class="ttd-btn__avatar">K</div>
                    <div>
                        <div class="ttd-btn__role">Kepala Desa</div>
                        <div class="ttd-btn__name">HARIYANA</div>
                    </div>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left:auto;"><polyline points="20 6 9 17 4 12"/></svg>
                </button>
                <button type="button" class="ttd-btn" id="btnSekdes" onclick="setTtd('sekdes')">
                    <div class="ttd-btn__avatar">S</div>
                    <div>
                        <div class="ttd-btn__role">Sekretaris Desa</div>
                        <div class="ttd-btn__name">DIDIK SUPRIYANTO</div>
                    </div>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left:auto;"><polyline points="20 6 9 17 4 12"/></svg>
                </button>
            </div>
        </div>

        {{-- SURAT PREVIEW — tampilan persis template asli --}}
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

        {{-- Tombol Aksi --}}
        <div class="preview-actions">
            <a href="{{ route('surat.index') }}" class="btn-back">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Buat Surat Baru
            </a>
            <div class="download-group">
                <a href="{{ route('surat.download', $id) }}?ttd=kades"
                   class="btn-download btn-download--jpg" id="downloadBtn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M8.5 8.5v7M8.5 12h7M15.5 8.5v7"/></svg>
                    Download JPG
                </a>
                <a href="{{ route('surat.download.pdf', $id) }}?ttd=kades"
                   class="btn-download btn-download--pdf" id="downloadBtnPdf">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    Download PDF
                </a>
            </div>
        </div>

        {{-- Catatan --}}
        <div class="preview-alert" style="margin-top: 28px; background: #eff6ff; border-color: #bfdbfe; color: #1e3a8a;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <p style="margin: 0;">Surat ini merupakan dokumen digital resmi Desa Pelang Lor. Untuk keperluan yang membutuhkan tanda tangan basah dan stempel asli, silakan datang ke Kantor Desa Pelang Lor pada jam kerja.</p>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
let currentTtd = 'kades';

const ttdData = {
    kades: {
        jabatan: 'Kepala Desa Pelang Lor',
        nama:    '<strong><u>HARIYANA</u></strong>',
        param:   'kades'
    },
    sekdes: {
        jabatan: 'Sekretaris Desa Pelang Lor',
        nama:    '<strong><u>DIDIK SUPRIYANTO</u></strong>',
        param:   'sekdes'
    }
};

function setTtd(type) {
    currentTtd = type;

    // Update preview jabatan & nama
    document.getElementById('preview-jabatan').innerHTML = ttdData[type].jabatan;
    document.getElementById('preview-nama').innerHTML    = ttdData[type].nama;

    // Update tombol aktif
    document.getElementById('btnKades').classList.toggle('ttd-btn--active', type === 'kades');
    document.getElementById('btnSekdes').classList.toggle('ttd-btn--active', type === 'sekdes');

    const ts = new Date().getTime();

    // Update link download JPG dengan cache buster
    const baseJpg = '{{ route('surat.download', $id) }}';
    document.getElementById('downloadBtn').href = baseJpg + '?ttd=' + type + '&t=' + ts;

    // Update link download PDF dengan cache buster
    const basePdf = '{{ route('surat.download.pdf', $id) }}';
    document.getElementById('downloadBtnPdf').href = basePdf + '?ttd=' + type + '&t=' + ts;
}
</script>
@endpush
