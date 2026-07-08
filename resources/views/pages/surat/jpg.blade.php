<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $data['jenis_surat'] }}</title>
    <style>
        /* ── Reset ───────────────────────────────── */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        /* ── Body: ukuran A4 @96DPI = 794px, margin 2.54cm = ~96px ── */
        html, body {
            width: 794px;
            background: #ffffff;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            color: #000000;
            padding: 96px;               /* 2.54cm @96DPI */
            width: 794px;
            min-height: 1123px;          /* A4 height @96DPI */
        }

        /* ── KOP SURAT ─────────────────────────── */
        .surat-kop {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 6px;
        }
        .surat-kop__logo {
            flex-shrink: 0;
            width: 90px;
            text-align: center;
        }
        .surat-kop__logo img {
            width: 80px;
            height: auto;
        }
        .surat-kop__text {
            flex: 1;
            text-align: center;
        }
        .surat-kop__text p {
            font-size: 13pt;
            font-weight: bold;
            line-height: 1.5;
            margin: 0;
        }
        .surat-kop__desa {
            font-size: 22pt;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.3;
            margin: 2px 0;
        }
        .surat-kop__alamat {
            font-size: 10pt;
            font-weight: normal;
            margin: 0;
        }
        .surat-kop__garis-tebal {
            border-top: 4px solid #000000;
            margin-top: 6px;
        }
        .surat-kop__garis-tipis {
            border-top: 1px solid #000000;
            margin-top: 2px;
            margin-bottom: 0;
        }

        /* ── JUDUL SURAT ─────────────────────────── */
        .surat-judul {
            text-align: center;
            margin-top: 18pt;
            margin-bottom: 12pt;
        }
        .surat-judul-text {
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            margin: 0;
        }
        .surat-judul-no {
            font-size: 12pt;
            font-style: italic;
            margin-top: 4pt;
            margin-bottom: 0;
        }

        /* ── ISI SURAT ───────────────────────────── */
        .surat-pembuka {
            font-size: 12pt;
            text-align: justify;
            text-indent: 2.5em;
            line-height: 1.7;
            margin-bottom: 10pt;
        }

        .surat-data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12pt;
            margin-bottom: 10pt;
        }
        .surat-data-table td {
            padding: 2.5pt 0;
            vertical-align: top;
        }
        .surat-no  { width: 6%; }
        .surat-key { width: 36%; }
        .surat-sep { width: 4%; text-align: center; }
        .surat-val { width: 54%; }

        .surat-masa-berlaku {
            font-size: 12pt;
            font-style: italic;
            text-align: center;
            margin-top: 12pt;
            margin-bottom: 12pt;
        }

        .surat-penutup {
            font-size: 12pt;
            text-align: justify;
            text-indent: 2.5em;
            line-height: 1.7;
            margin-bottom: 20pt;
        }

        /* ── TTD ─────────────────────────────────── */
        .surat-ttd {
            display: flex;
            justify-content: flex-end;
        }
        .surat-ttd-box {
            width: 45%;
            text-align: center;
            font-size: 12pt;
            line-height: 1.8;
        }
        .surat-ttd-box p {
            margin: 0;
        }
        .surat-ttd-space {
            height: 80px;
        }
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
            <img src="{{ $logoPath }}" alt="Logo Ngawi">
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

    {{-- TTD --}}
    <div class="surat-ttd">
        <div class="surat-ttd-box">
            <p>Pelang Lor, {{ $data['tanggal_surat'] }}</p>
            <p>{{ $jabatan }}</p>
            <div class="surat-ttd-space"></div>
            <p class="surat-ttd-name"><u>{{ $nama }}</u></p>
        </div>
    </div>

</body>
</html>
