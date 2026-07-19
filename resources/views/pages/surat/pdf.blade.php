<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $data['jenis_surat'] }}</title>
    <style>
        /* ── Reset ───────────────────────────────── */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        /* ── Body — padding sebagai margin halaman (paling reliable di DomPDF) ── */
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            color: #000000;
            background: #ffffff;
            padding: 2.54cm;
            box-sizing: border-box;
            margin: 0 auto;
        }

        /* Hanya berlaku saat dipanggil via iframe untuk html2canvas (bukan DomPDF) */
        @media screen {
            body {
                width: 210mm;
                min-height: 297mm;
            }
        }

        /* ── KOP SURAT ─────────────────────────── */
        .surat-kop {
            display: table;
            width: 100%;
            margin-bottom: 4pt;
        }
        .surat-kop__logo {
            display: table-cell;
            width: 80pt;
            vertical-align: middle;
            text-align: center;
            padding-right: 8pt;
        }
        .surat-kop__logo img {
            width: 72pt;
            height: auto;
        }
        .surat-kop__text {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }
        .surat-kop__text p {
            font-size: 13pt;
            font-weight: bold;
            line-height: 1.5;
        }
        .surat-kop__desa {
            font-size: 20pt;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.3;
        }
        .surat-kop__alamat {
            font-size: 10pt;
            font-weight: normal;
        }
        .surat-kop__garis-tebal {
            border-top: 4pt solid #000000;
            margin-top: 4pt;
        }
        .surat-kop__garis-tipis {
            border-top: 1pt solid #000000;
            margin-top: 2pt;
            margin-bottom: 0;
        }

        /* ── JUDUL SURAT ─────────────────────────── */
        .surat-judul {
            text-align: center;
            margin-top: 16pt;
            margin-bottom: 10pt;
        }
        .surat-judul-text {
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
        }
        .surat-judul-no {
            font-size: 12pt;
            font-style: italic;
            margin-top: 3pt;
        }

        /* ── ISI SURAT ───────────────────────────── */
        .surat-pembuka {
            font-size: 12pt;
            text-align: justify;
            text-indent: 28pt;
            line-height: 1.6;
            margin-bottom: 10pt;
        }

        .surat-data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12pt;
            margin-bottom: 10pt;
        }
        .surat-data-table td {
            padding: 2pt 0;
            vertical-align: top;
        }
        .surat-no  { width: 6%;  }
        .surat-key { width: 35%; }
        .surat-sep { width: 4%;  text-align: center; }
        .surat-val { width: 55%; }

        .surat-masa-berlaku {
            font-size: 12pt;
            font-style: italic;
            text-align: center;
            margin-top: 10pt;
            margin-bottom: 10pt;
        }

        .surat-penutup {
            font-size: 12pt;
            text-align: justify;
            text-indent: 28pt;
            line-height: 1.6;
            margin-bottom: 18pt;
        }

        /* ── TTD ─────────────────────────────────── */
        .surat-ttd-table {
            width: 100%;
            border-collapse: collapse;
        }
        .surat-ttd-left  { width: 55%; }
        .surat-ttd-right {
            width: 45%;
            text-align: center;
            vertical-align: top;
            font-size: 12pt;
            line-height: 1.7;
        }
        .surat-ttd-space { height: 70pt; }
        .surat-ttd-name {
            font-weight: bold;
            text-decoration: underline;
            font-size: 12pt;
        }
    </style>
</head>
<body>

    {{-- KOP SURAT --}}
    <div class="surat-kop">
        <div class="surat-kop__logo">
            <img src="{{ $logoImagePath }}" alt="Logo Ngawi">
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

    {{-- JUDUL --}}
    <div class="surat-judul">
        <p class="surat-judul-text"><strong><u>{{ $data['jenis_surat'] }}</u></strong></p>
        <p class="surat-judul-no">Nomor &nbsp; : &nbsp; {{ $data['nomor_surat'] }}</p>
    </div>

    {{-- PEMBUKA --}}
    <p class="surat-pembuka">
        Yang bertanda tangan di bawah ini Kami Kepala Desa Pelang Lor Kecamatan Kedunggalar Kabupaten Ngawi Jawa Timur menerangkan dengan sesungguhnya bahwa :
    </p>

    {{-- DATA FIELDS --}}
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

    {{-- MASA BERLAKU --}}
    <p class="surat-masa-berlaku">
        <em>Surat Keterangan ini berlaku tiga bulan setelah surat dikeluarkan.</em>
    </p>

    {{-- PENUTUP --}}
    <p class="surat-penutup">
        Demikian surat keterangan ini kami buat dengan sebenarnya agar dapatnya dipergunakan sebagaimana mestinya.
    </p>

    {{-- TTD dengan Gambar Digital --}}
    <table class="surat-ttd-table">
        <tr>
            <td class="surat-ttd-left"></td>
            <td class="surat-ttd-right" style="position: relative;">
                <p>Pelang Lor, {{ $data['tanggal_surat'] }}</p>
                <p>{{ $jabatan }}</p>
                {{-- Area TTD: stempel di kiri, TTD di kanan --}}
                <div style="position: relative; height: 80pt; margin: 4pt auto;">
                    @if(!empty($ttdImagePath))
                        <img src="{{ $ttdImagePath }}" alt="TTD"
                             style="position: absolute; top: 0; right: 20pt; height: 75pt; width: auto; opacity: 0.92;">
                    @else
                        <div style="height: 75pt;"></div>
                    @endif
                    @if(!empty($stempelImagePath))
                        <img src="{{ $stempelImagePath }}" alt="Stempel"
                             style="position: absolute; top: 5pt; left: 10pt; height: 70pt; width: auto; opacity: 0.55;">
                    @endif
                </div>
                <p class="surat-ttd-name">{{ $nama }}</p>
            </td>
        </tr>
    </table>

</body>
</html>
