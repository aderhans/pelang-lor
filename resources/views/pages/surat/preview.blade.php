@extends('layouts.app')

@section('title', 'Preview Surat — ' . ($data['jenis_surat'] ?? 'Keterangan'))

@section('content')

<div class="page-hero page-hero--green">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('landing') }}">Beranda</a>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <a href="{{ route('surat.index') }}">Surat Keterangan</a>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Preview</span>
        </nav>
        <h1 class="page-hero__title">Preview Surat</h1>
        <p class="page-hero__desc">Periksa kembali data, pilih penandatangan, lalu download surat dalam format JPG.</p>
    </div>
</div>

<section class="preview-section">
    <div class="container container--narrow">

        {{-- Status --}}
        <div class="preview-status preview-status--ready">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            Surat berhasil di-generate! Pilih penandatangan lalu klik Download.
        </div>

        {{-- Toggle Penandatangan --}}
        <div class="ttd-toggle-card">
            <div class="ttd-toggle-card__label">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Pilih Penandatangan Surat:
            </div>
            <div class="ttd-toggle-btns">
                <button type="button" class="ttd-btn ttd-btn--active" id="btnKades" onclick="setTtd('kades')">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    Kepala Desa
                    <span class="ttd-btn__name">HARIYANA</span>
                </button>
                <button type="button" class="ttd-btn" id="btnSekdes" onclick="setTtd('sekdes')">
                    Sekretaris Desa
                    <span class="ttd-btn__name">DIDIK SUPRIYANTO</span>
                </button>
            </div>
        </div>

        {{-- SURAT PREVIEW — tampilan persis template asli --}}
        <div class="surat-preview" id="suratPreview">

            {{-- KOP SURAT --}}
            <div class="surat-kop">
                <div class="surat-kop__logo">
                    <img src="{{ asset('images/logo-ngawi.png') }}" alt="Logo Kabupaten Ngawi" width="90" height="90" style="object-fit:contain;">
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
                <p class="surat-judul__nomor">Nomor&nbsp; :&nbsp; {{ $data['nomor_surat'] }}</p>
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
                        <td class="surat-no">10.</td>
                        <td class="surat-key">Keperluan</td>
                        <td class="surat-sep">:</td>
                        <td class="surat-val">{{ $data['keperluan'] }}</td>
                    </tr>
                </table>

                {{-- Masa Berlaku --}}
                <p class="surat-masa-berlaku">
                    <strong><u>Surat Keterangan ini berlaku tiga bulan setelah dikeluarkan.</u></strong>
                </p>

                {{-- Penutup --}}
                <p class="surat-penutup">
                    Demikian surat keterangan ini kami buat dengan sebenarnya agar dapatnya dipergunakan sebagaimana mestinya.
                </p>

                {{-- TTD --}}
                <div class="surat-ttd">
                    <div class="surat-ttd__right">
                        <p>Pelang Lor, {{ $data['tanggal_surat'] }}</p>
                        <p id="preview-jabatan"><strong>Kepala Desa Pelang Lor</strong></p>
                        <div class="surat-ttd__space"></div>
                        <p id="preview-nama" class="surat-ttd__nama"><strong><u>HARIYANA</u></strong></p>
                    </div>
                </div>

            </div>{{-- /.surat-body --}}
        </div>{{-- /.surat-preview --}}

        {{-- Tombol Aksi --}}
        <div class="preview-actions">
            <a href="{{ route('surat.index') }}" class="btn btn--outline">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Buat Surat Baru
            </a>
            <a href="{{ route('surat.download', $id) }}?ttd=kades"
               class="btn btn--primary btn--lg" id="downloadBtn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Download Surat (JPG)
            </a>
        </div>

        {{-- Catatan --}}
        <div class="preview-note">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <p>Surat ini merupakan dokumen digital resmi Desa Pelang Lor. Untuk keperluan yang membutuhkan tanda tangan basah dan stempel asli, silakan datang ke Kantor Desa Pelang Lor pada jam kerja.</p>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
let currentTtd = 'kades';

const ttdData = {
    kades: {
        jabatan: '<strong>Kepala Desa Pelang Lor</strong>',
        nama:    '<strong><u>HARIYANA</u></strong>',
        param:   'kades'
    },
    sekdes: {
        jabatan: '<strong>Sekretaris Desa Pelang Lor</strong>',
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

    // Update link download
    const base = '{{ route('surat.download', $id) }}';
    document.getElementById('downloadBtn').href = base + '?ttd=' + type;
}
</script>
@endpush
