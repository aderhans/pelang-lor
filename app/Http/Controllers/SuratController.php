<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Drivers\Gd\Driver;

class SuratController extends Controller
{
    // ---------------------------------------------------------------
    // NOMOR SURAT: 470/[counter].404.617.12/[tahun]
    // Counter global, increment per surat, disimpan di file
    // ---------------------------------------------------------------
    protected function generateNomorSurat(): string
    {
        $year        = date('Y');
        $counterFile = storage_path('app/surat/counter.txt');

        if (!file_exists(storage_path('app/surat'))) {
            mkdir(storage_path('app/surat'), 0775, true);
        }

        $counter = file_exists($counterFile) ? (int) file_get_contents($counterFile) + 1 : 0;
        file_put_contents($counterFile, $counter);

        return "470/{$counter}/404.617.12/{$year}";
    }

    // ---------------------------------------------------------------
    // FONT PATHS — Windows system fonts
    // ---------------------------------------------------------------
    protected function fontRegular(): string
    {
        $paths = [
            'C:/Windows/Fonts/times.ttf',
            'C:/Windows/Fonts/Georgia.ttf',
        ];
        foreach ($paths as $p) {
            if (file_exists($p)) return $p;
        }
        return 5; // GD built-in fallback
    }

    protected function fontBold(): string
    {
        $paths = [
            'C:/Windows/Fonts/timesbd.ttf',
            'C:/Windows/Fonts/Georgiab.ttf',
        ];
        foreach ($paths as $p) {
            if (file_exists($p)) return $p;
        }
        return 5;
    }

    // ---------------------------------------------------------------
    // INDEX — tampilkan form
    // ---------------------------------------------------------------
    public function index()
    {
        return view('pages.surat.form');
    }

    // ---------------------------------------------------------------
    // STORE — simpan ke session → redirect ke preview
    // ---------------------------------------------------------------
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat'   => 'required|string|max:100',
            'nama'          => 'required|string|max:255',
            'nik'           => 'required|digits:16',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'kewarganegaraan' => 'required|string|max:50',
            'agama'         => 'required|string|max:50',
            'pekerjaan'     => 'required|string|max:100',
            'alamat'        => 'required|string|max:500',
            'keperluan'     => 'required|string|max:300',
        ]);

        $nomorSurat = $this->generateNomorSurat();
        $tanggal    = now()->locale('id')->isoFormat('D MMMM YYYY');

        $data = [
            'jenis_surat'     => strtoupper(trim($request->jenis_surat)),
            'nomor_surat'     => $nomorSurat,
            'tanggal_surat'   => $tanggal,
            'nama'            => strtoupper($request->nama),
            'nik'             => $request->nik,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'tempat_lahir'    => $request->tempat_lahir,
            'tanggal_lahir'   => format_tanggal_indo($request->tanggal_lahir),
            'kewarganegaraan' => $request->kewarganegaraan ?? 'Indonesia',
            'agama'           => $request->agama,
            'pekerjaan'       => $request->pekerjaan,
            'alamat'          => $request->alamat,
            'keperluan'       => $request->keperluan,
        ];

        $id = uniqid('srt_', true);
        session(["surat_{$id}" => $data]);

        return redirect()->route('surat.preview', $id);
    }

    // ---------------------------------------------------------------
    // PREVIEW — tampilkan surat digital + toggle TTD
    // ---------------------------------------------------------------
    public function preview(string $id)
    {
        $data = session("surat_{$id}");

        if (!$data) {
            return redirect()->route('surat.index')
                ->with('error', 'Data surat tidak ditemukan atau sudah kadaluarsa. Silakan isi form kembali.');
        }

        return view('pages.surat.preview', compact('data', 'id'));
    }

    // ---------------------------------------------------------------
    // DOWNLOAD — generate PDF dan return sebagai download
    // ---------------------------------------------------------------
    // DOWNLOAD — generate JPG dan return sebagai download
    // ---------------------------------------------------------------
    public function download(string $id, Request $request)
    {
        $data = session("surat_{$id}");

        if (!$data) {
            return redirect()->route('surat.index')
                ->with('error', 'Data surat tidak ditemukan. Silakan isi form kembali.');
        }

        $ttd = $request->query('ttd', 'kades'); // 'kades' | 'sekdes'

        // Generate gambar JPG
        $image = $this->buildSuratImage($data, $ttd);

        $filename = 'Surat_' . preg_replace('/[^a-zA-Z0-9]/', '_', $data['nomor_surat']) . '.jpg';

        return response((string) $image->encode(new JpegEncoder(95)))
            ->header('Content-Type', 'image/jpeg')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }

    // ---------------------------------------------------------------
    // BUILD SURAT IMAGE — A4 @150 DPI (1240x1754), margin 2.54cm=150px
    // Semua koordinat disesuaikan agar semirip mungkin dengan preview CSS
    // ---------------------------------------------------------------
    protected function buildSuratImage(array $data, string $ttd): \Intervention\Image\Interfaces\ImageInterface
    {
        $manager = new ImageManager(new Driver());

        // A4 @150 DPI: 1240 x 1754px
        $W   = 1240;
        $H   = 1754;
        $img = $manager->createImage($W, $H)->fill('ffffff');

        // Margin 2.54cm = 1 inch = 150px @150DPI (sama dengan padding: 2.54cm di CSS)
        $mL  = 150;           // margin kiri
        $mR  = $W - 150;      // margin kanan
        $mT  = 150;           // margin atas
        $cX  = $W / 2;        // center X

        $fontR = $this->fontRegular();
        $fontI = file_exists('C:/Windows/Fonts/timesi.ttf') ? 'C:/Windows/Fonts/timesi.ttf' : $fontR;
        $fontB = $this->fontBold();
        $black = '000000';

        // ================================================================
        // HEADER — KOP SURAT
        // Logo: sama tinggi proporsi dengan preview (kop ~120px tinggi di CSS)
        // ================================================================
        $logoPath = public_path('images/Lambang_Kabupaten_Ngawi.png');
        if (file_exists($logoPath)) {
            $logo = $manager->decode($logoPath)->scale(height: 118);
            $img->insert($logo, $mL, $mT);
        }

        // Teks kop centered (font size dalam pt × 2 karena 150 DPI vs 96 DPI)
        // Preview CSS: 14pt bold → di 150DPI ≈ size 22
        $yKop = $mT;
        $img->text('PEMERINTAH KABUPATEN NGAWI', $cX, $yKop, function ($f) use ($fontB, $black) {
            $f->file($fontB); $f->size(22); $f->color($black);
            $f->align('center', 'top');
        });
        $img->text('KECAMATAN KEDUNGGALAR', $cX, $yKop + 30, function ($f) use ($fontB, $black) {
            $f->file($fontB); $f->size(22); $f->color($black);
            $f->align('center', 'top');
        });
        // Preview: "DESA PELANG LOR" pakai h2 ~24pt → size 36
        $img->text('DESA PELANG LOR', $cX, $yKop + 62, function ($f) use ($fontB, $black) {
            $f->file($fontB); $f->size(36); $f->color($black);
            $f->align('center', 'top');
        });
        // Preview: alamat ~10pt → size 16
        $img->text('Jln. Raya Solo-Ngawi KM 18 Ngawi  Kode Pos 63254', $cX, $yKop + 106, function ($f) use ($fontR, $black) {
            $f->file($fontR); $f->size(16); $f->color($black);
            $f->align('center', 'top');
        });

        // Garis: tebal 5px + tipis 1px (sama dengan CSS border-top + border-bottom)
        $y1 = $mT + 132;
        $img->drawLine(function ($d) use ($mL, $mR, $y1, $black) {
            $d->from($mL, $y1)->to($mR, $y1)->color($black)->width(5);
        });
        $y2 = $mT + 140;
        $img->drawLine(function ($d) use ($mL, $mR, $y2, $black) {
            $d->from($mL, $y2)->to($mR, $y2)->color($black)->width(2);
        });

        // ================================================================
        // JUDUL SURAT (~14pt bold = size 22 @150DPI)
        // ================================================================
        $yJudul = $mT + 165;
        $judulText = $data['jenis_surat'];
        $img->text($judulText, $cX, $yJudul, function ($f) use ($fontB, $black) {
            $f->file($fontB); $f->size(22); $f->color($black);
            $f->align('center', 'top');
        });

        // Underline judul (estimasi ~12px per char @150DPI)
        $judulLen    = (int)(strlen($judulText) * 13);
        $underlineX1 = (int)($cX - $judulLen / 2);
        $underlineX2 = (int)($cX + $judulLen / 2);
        $img->drawLine(function ($d) use ($underlineX1, $underlineX2, $yJudul, $black) {
            $d->from($underlineX1, $yJudul + 26)->to($underlineX2, $yJudul + 26)->color($black)->width(1);
        });

        // Nomor surat italic (~11pt = size 17 @150DPI)
        $yNomor = $yJudul + 35;
        $img->text('Nomor  :  ' . $data['nomor_surat'], $cX, $yNomor, function ($f) use ($fontI, $black) {
            $f->file($fontI); $f->size(18); $f->color($black);
            $f->align('center', 'top');
        });

        // ================================================================
        // PARAGRAF PEMBUKA (~12pt = size 18 @150DPI)
        // Indent 30px (preview: text-indent via padding data-table)
        // ================================================================
        $yBody    = $yNomor + 55;
        $bodyText = 'Yang bertanda tangan di bawah ini Kami Kepala Desa Pelang Lor Kecamatan Kedunggalar Kabupaten Ngawi Jawa Timur menerangkan dengan sesungguhnya bahwa :';
        $bodyLines = $this->wrapText($bodyText, 74);
        foreach ($bodyLines as $line) {
            $img->text($line, $mL + 38, $yBody, function ($f) use ($fontR, $black) {
                $f->file($fontR); $f->size(18); $f->color($black);
                $f->align('left', 'top');
            });
            $yBody += 26;
        }

        // ================================================================
        // DATA FIELDS — indent sesuai preview table layout
        // ================================================================
        $yData  = $yBody + 16;
        $xNum   = $mL + 8;    // nomor urut
        $xLabel = $mL + 32;   // label kolom
        $xColon = $mL + 310;  // titik dua
        $xValue = $mL + 325;  // nilai
        $lineH  = 28;

        $fields = [
            ['no' => '1.', 'label' => 'Nama',                       'value' => $data['nama']],
            ['no' => '2.', 'label' => 'Nomor Induk Kependudukan',   'value' => $data['nik']],
            ['no' => '3.', 'label' => 'Jenis Kelamin',              'value' => $data['jenis_kelamin']],
            ['no' => '4.', 'label' => 'Tempat dan Tanggal Lahir',   'value' => $data['tempat_lahir'] . ', ' . $data['tanggal_lahir']],
            ['no' => '5.', 'label' => 'Kewarganegaraan',            'value' => $data['kewarganegaraan']],
            ['no' => '6.', 'label' => 'Agama',                      'value' => $data['agama']],
            ['no' => '7.', 'label' => 'Pekerjaan',                  'value' => $data['pekerjaan']],
            ['no' => '8.', 'label' => 'Alamat',                     'value' => $data['alamat']],
            ['no' => '10.','label' => 'Keperluan',                  'value' => $data['keperluan']],
        ];

        $maxValueWidth = 55;
        foreach ($fields as $field) {
            $img->text($field['no'], $xNum, $yData, function ($f) use ($fontR, $black) {
                $f->file($fontR); $f->size(18); $f->color($black);
                $f->align('left', 'top');
            });
            $img->text($field['label'], $xLabel, $yData, function ($f) use ($fontR, $black) {
                $f->file($fontR); $f->size(18); $f->color($black);
                $f->align('left', 'top');
            });
            $img->text(':', $xColon, $yData, function ($f) use ($fontR, $black) {
                $f->file($fontR); $f->size(18); $f->color($black);
                $f->align('left', 'top');
            });
            $valueLines = $this->wrapText($field['value'], $maxValueWidth);
            foreach ($valueLines as $vLine) {
                $img->text($vLine, $xValue, $yData, function ($f) use ($fontR, $black) {
                    $f->file($fontR); $f->size(18); $f->color($black);
                    $f->align('left', 'top');
                });
                $yData += $lineH;
            }
        }

        // ================================================================
        // MASA BERLAKU (italic, centered)
        // ================================================================
        $yMasa = $yData + 18;
        $masaText = 'Surat Keterangan ini berlaku tiga bulan setelah surat dikeluarkan.';
        $img->text($masaText, $cX, $yMasa, function ($f) use ($fontI, $black) {
            $f->file($fontI); $f->size(18); $f->color($black);
            $f->align('center', 'top');
        });

        // ================================================================
        // KALIMAT PENUTUP
        // ================================================================
        $yPenutup = $yMasa + 44;
        $penutupText = 'Demikian surat keterangan ini kami buat dengan sebenarnya agar dapatnya dipergunakan sebagaimana mestinya.';
        $penutupLines = $this->wrapText($penutupText, 74);
        foreach ($penutupLines as $pLine) {
            $img->text($pLine, $mL + 38, $yPenutup, function ($f) use ($fontR, $black) {
                $f->file($fontR); $f->size(18); $f->color($black);
                $f->align('left', 'top');
            });
            $yPenutup += 26;
        }

        // ================================================================
        // BLOK TTD — posisi kanan, mirroring preview `.surat-ttd-box`
        // ================================================================
        $yTtd = $yPenutup + 45;
        $xTtd = (int)($W * 0.72); // ~72% dari kiri = posisi kanan seperti preview

        $img->text('Pelang Lor, ' . $data['tanggal_surat'], $xTtd, $yTtd, function ($f) use ($fontR, $black) {
            $f->file($fontR); $f->size(18); $f->color($black);
            $f->align('center', 'top');
        });

        $yTtd += 26;
        if ($ttd === 'kades') {
            $jabatan = 'Kepala Desa Pelang Lor';
            $nama    = 'HARIYANA';
        } else {
            $jabatan = 'Sekretaris Desa Pelang Lor';
            $nama    = 'DIDIK SUPRIYANTO';
        }

        $img->text($jabatan, $xTtd, $yTtd, function ($f) use ($fontR, $black) {
            $f->file($fontR); $f->size(18); $f->color($black);
            $f->align('center', 'top');
        });

        // Ruang tanda tangan (~80px = 1.3cm di 150DPI)
        $yTtdNama = $yTtd + 110;

        $img->text($nama, $xTtd, $yTtdNama, function ($f) use ($fontB, $black) {
            $f->file($fontB); $f->size(18); $f->color($black);
            $f->align('center', 'top');
        });
        $namaLen = (int)(strlen($nama) * 11);
        $img->drawLine(function ($d) use ($xTtd, $namaLen, $yTtdNama, $black) {
            $d->from((int)($xTtd - $namaLen / 2), $yTtdNama + 23)
              ->to((int)($xTtd + $namaLen / 2), $yTtdNama + 23)
              ->color($black)->width(1);
        });

        // Crop rapi ke ukuran A4 persis (tidak ada ruang putih berlebih)
        $img->crop($W, $H, 0, 0);

        return $img;
    }

    // ---------------------------------------------------------------
    // HELPER: wrap text ke array baris
    // ---------------------------------------------------------------
    protected function wrapText(string $text, int $maxChars): array
    {
        $wrapped = wordwrap($text, $maxChars, "\n", false);
        return explode("\n", $wrapped);
    }
}
