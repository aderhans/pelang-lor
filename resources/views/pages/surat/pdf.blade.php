<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $data['jenis_surat'] }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            color: #000000;
            background: #ffffff;
        }

        /* ================================================================
           KOP SURAT
           ================================================================ */
        .kop-wrapper {
            width: 100%;
            padding-bottom: 6pt;
        }
        .kop-table {
            width: 100%;
            border-collapse: collapse;
        }
        .kop-logo-cell {
            width: 90pt;
            vertical-align: middle;
            text-align: center;
            padding-right: 8pt;
        }
        .kop-logo-cell img {
            width: 80pt;
            height: auto;
        }
        .kop-text-cell {
            vertical-align: middle;
            text-align: center;
        }
        .kop-prov {
            font-size: 13pt;
            font-weight: bold;
            margin-bottom: 1pt;
        }
        .kop-kec {
            font-size: 13pt;
            font-weight: bold;
            margin-bottom: 1pt;
        }
        .kop-desa {
            font-size: 18pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 2pt;
        }
        .kop-alamat {
            font-size: 10pt;
            font-weight: normal;
        }
        .kop-garis {
            margin-top: 4pt;
            border-top: 4pt solid #000000;
            border-bottom: 1.5pt solid #000000;
            padding-top: 2pt;
        }

        /* ================================================================
           JUDUL SURAT
           ================================================================ */
        .judul-wrapper {
            text-align: center;
            margin-top: 18pt;
            margin-bottom: 8pt;
        }
        .judul-text {
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 0.5pt;
        }
        .judul-nomor {
            font-size: 12pt;
            font-style: italic;
            margin-top: 4pt;
        }

        /* ================================================================
           ISI SURAT
           ================================================================ */
        .pembuka {
            font-size: 12pt;
            text-align: justify;
            margin-top: 14pt;
            margin-bottom: 10pt;
            line-height: 1.6;
            text-indent: 30pt;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12pt;
            margin-bottom: 12pt;
        }
        .data-table td {
            padding: 2.5pt 0;
            vertical-align: top;
        }
        .col-no {
            width: 6%;
        }
        .col-key {
            width: 34%;
        }
        .col-sep {
            width: 3%;
            text-align: center;
        }
        .col-val {
            width: 57%;
        }

        .masa-berlaku {
            font-size: 12pt;
            font-style: italic;
            text-align: center;
            margin-top: 10pt;
            margin-bottom: 10pt;
        }

        .penutup {
            font-size: 12pt;
            text-align: justify;
            line-height: 1.6;
            margin-top: 10pt;
            margin-bottom: 18pt;
            text-indent: 30pt;
        }

        /* ================================================================
           TTD
           ================================================================ */
        .ttd-wrapper {
            width: 100%;
        }
        .ttd-table {
            width: 100%;
            border-collapse: collapse;
        }
        .ttd-left {
            width: 55%;
        }
        .ttd-right {
            width: 45%;
            text-align: center;
            vertical-align: top;
            font-size: 12pt;
        }
        .ttd-right p {
            margin-bottom: 2pt;
        }
        .ttd-space {
            height: 70pt;
        }
        .ttd-nama {
            font-weight: bold;
            text-decoration: underline;
            font-size: 12pt;
        }
    </style>
</head>
<body>

    {{-- KOP SURAT --}}
    <div class="kop-wrapper">
        <table class="kop-table">
            <tr>
                <td class="kop-logo-cell">
                    <img src="{{ public_path('images/Lambang_Kabupaten_Ngawi.png') }}" alt="Logo Ngawi">
                </td>
                <td class="kop-text-cell">
                    <div class="kop-prov">PEMERINTAH KABUPATEN NGAWI</div>
                    <div class="kop-kec">KECAMATAN KEDUNGGALAR</div>
                    <div class="kop-desa">DESA PELANG LOR</div>
                    <div class="kop-alamat">Jln. Raya Solo-Ngawi KM 18 Ngawi &nbsp; Kode Pos 63254</div>
                </td>
            </tr>
        </table>
        <div class="kop-garis"></div>
    </div>

    {{-- JUDUL --}}
    <div class="judul-wrapper">
        <div class="judul-text">{{ $data['jenis_surat'] }}</div>
        <div class="judul-nomor">Nomor &nbsp;: &nbsp; {{ $data['nomor_surat'] }}</div>
    </div>

    {{-- PEMBUKA --}}
    <p class="pembuka">
        Yang bertanda tangan di bawah ini Kami Kepala Desa Pelang Lor Kecamatan Kedunggalar Kabupaten Ngawi Jawa Timur menerangkan dengan sesungguhnya bahwa :
    </p>

    {{-- DATA FIELDS --}}
    <table class="data-table">
        <tr>
            <td class="col-no">1.</td>
            <td class="col-key">Nama</td>
            <td class="col-sep">:</td>
            <td class="col-val">{{ $data['nama'] }}</td>
        </tr>
        <tr>
            <td class="col-no">2.</td>
            <td class="col-key">Nomor Induk Kependudukan</td>
            <td class="col-sep">:</td>
            <td class="col-val">{{ $data['nik'] }}</td>
        </tr>
        <tr>
            <td class="col-no">3.</td>
            <td class="col-key">Jenis Kelamin</td>
            <td class="col-sep">:</td>
            <td class="col-val">{{ $data['jenis_kelamin'] }}</td>
        </tr>
        <tr>
            <td class="col-no">4.</td>
            <td class="col-key">Tempat dan Tanggal Lahir</td>
            <td class="col-sep">:</td>
            <td class="col-val">{{ $data['tempat_lahir'] }}, {{ $data['tanggal_lahir'] }}</td>
        </tr>
        <tr>
            <td class="col-no">5.</td>
            <td class="col-key">Kewarganegaraan</td>
            <td class="col-sep">:</td>
            <td class="col-val">{{ $data['kewarganegaraan'] }}</td>
        </tr>
        <tr>
            <td class="col-no">6.</td>
            <td class="col-key">Agama</td>
            <td class="col-sep">:</td>
            <td class="col-val">{{ $data['agama'] }}</td>
        </tr>
        <tr>
            <td class="col-no">7.</td>
            <td class="col-key">Pekerjaan</td>
            <td class="col-sep">:</td>
            <td class="col-val">{{ $data['pekerjaan'] }}</td>
        </tr>
        <tr>
            <td class="col-no">8.</td>
            <td class="col-key">Alamat</td>
            <td class="col-sep">:</td>
            <td class="col-val">{{ $data['alamat'] }}</td>
        </tr>
        <tr>
            <td class="col-no">10.</td>
            <td class="col-key">Keperluan</td>
            <td class="col-sep">:</td>
            <td class="col-val">{{ $data['keperluan'] }}</td>
        </tr>
    </table>

    {{-- MASA BERLAKU --}}
    <p class="masa-berlaku">
        <em>Surat Keterangan ini berlaku tiga bulan setelah surat dikeluarkan.</em>
    </p>

    {{-- PENUTUP --}}
    <p class="penutup">
        Demikian surat keterangan ini kami buat dengan sebenarnya agar dapatnya dipergunakan sebagaimana mestinya.
    </p>

    {{-- TTD --}}
    <div class="ttd-wrapper">
        <table class="ttd-table">
            <tr>
                <td class="ttd-left"></td>
                <td class="ttd-right">
                    <p>Pelang Lor, {{ $data['tanggal_surat'] }}</p>
                    <p>{{ $jabatan }}</p>
                    <div class="ttd-space"></div>
                    <p class="ttd-nama">{{ $nama }}</p>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
