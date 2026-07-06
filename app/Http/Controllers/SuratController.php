<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
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

        $counter = file_exists($counterFile) ? (int) file_get_contents($counterFile) + 1 : 1;
        file_put_contents($counterFile, $counter);

        return "470/{$counter}.404.617.12/{$year}";
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

        return response($image->toJpeg(95))
            ->header('Content-Type', 'image/jpeg')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }

    // ---------------------------------------------------------------
    // BUILD SURAT IMAGE — generate canvas A4 persis seperti template
    // ---------------------------------------------------------------
    protected function buildSuratImage(array $data, string $ttd): \Intervention\Image\Image
    {
        $manager = new ImageManager(new Driver());

        // Canvas A4 @ ~150 DPI: 1240 x 1754
        $W = 1240;
        $H = 1900; // sedikit lebih tinggi agar tidak terpotong
        $img = $manager->create($W, $H)->fill('ffffff');

        $fontR = $this->fontRegular();
        $fontB = $this->fontBold();
        $black = '000000';
        $mL    = 100; // margin kiri
        $mR    = $W - 100; // margin kanan
        $cX    = $W / 2; // center X

        // ================================================================
        // HEADER — KOP SURAT
        // ================================================================
        $logoPath = public_path('images/logo-ngawi.png');
        if (file_exists($logoPath)) {
            $logo = $manager->read($logoPath)->scale(height: 110);
            $img->place($logo, 'top-left', $mL, 30);
        }

        // Teks kop (centered)
        $img->text('PEMERINTAH KABUPATEN NGAWI', $cX, 32, function ($f) use ($fontB, $black) {
            $f->filename($fontB); $f->size(20); $f->color($black);
            $f->align('center'); $f->valign('top');
        });
        $img->text('KECAMATAN KEDUNGGALAR', $cX, 58, function ($f) use ($fontB, $black) {
            $f->filename($fontB); $f->size(20); $f->color($black);
            $f->align('center'); $f->valign('top');
        });
        $img->text('DESA PELANG LOR', $cX, 86, function ($f) use ($fontB, $black) {
            $f->filename($fontB); $f->size(34); $f->color($black);
            $f->align('center'); $f->valign('top');
        });
        $img->text('Jln. Raya Solo-Ngawi KM 18 Ngawi  Kode Pos 63254', $cX, 128, function ($f) use ($fontR, $black) {
            $f->filename($fontR); $f->size(14); $f->color($black);
            $f->align('center'); $f->valign('top');
        });

        // Garis pemisah header
        $y1 = 152;
        $img->drawLine(function ($d) use ($mL, $mR, $y1, $black) {
            $d->from($mL, $y1)->to($mR, $y1)->color($black)->width(5);
        });
        $y2 = 160;
        $img->drawLine(function ($d) use ($mL, $mR, $y2, $black) {
            $d->from($mL, $y2)->to($mR, $y2)->color($black)->width(2);
        });

        // ================================================================
        // JUDUL SURAT
        // ================================================================
        $yJudul = 185;
        $judulText = $data['jenis_surat'];
        $img->text($judulText, $cX, $yJudul, function ($f) use ($fontB, $black) {
            $f->filename($fontB); $f->size(20); $f->color($black);
            $f->align('center'); $f->valign('top');
        });

        // Underline judul (estimasi lebar teks ~16px per karakter)
        $judulLen  = strlen($judulText) * 11;
        $underlineX1 = $cX - $judulLen / 2;
        $underlineX2 = $cX + $judulLen / 2;
        $img->drawLine(function ($d) use ($underlineX1, $underlineX2, $black) {
            $yU = 208;
            $d->from($underlineX1, $yU)->to($underlineX2, $yU)->color($black)->width(1);
        });

        // Nomor surat
        $yNomor = 218;
        $img->text('Nomor  :  ' . $data['nomor_surat'], $cX, $yNomor, function ($f) use ($fontR, $black) {
            $f->filename($fontR); $f->size(15); $f->color($black);
            $f->align('center'); $f->valign('top');
        });

        // ================================================================
        // PARAGRAF PEMBUKA
        // ================================================================
        $yBody = 262;
        $bodyText = 'Yang bertanda tangan di bawah ini Kami Kepala Desa Pelang Lor Kecamatan Kedunggalar Kabupaten Ngawi Jawa Timur menerangkan dengan sesungguhnya bahwa :';
        $bodyLines = $this->wrapText($bodyText, 82);
        foreach ($bodyLines as $line) {
            $img->text($line, $mL + 28, $yBody, function ($f) use ($fontR, $black) {
                $f->filename($fontR); $f->size(15); $f->color($black);
                $f->align('left'); $f->valign('top');
            });
            $yBody += 22;
        }

        // ================================================================
        // DATA FIELDS — nomor 1-8 dan 10
        // ================================================================
        $yData  = $yBody + 14;
        $xNum   = $mL + 10;  // angka nomor
        $xLabel = $mL + 30;  // label
        $xColon = $mL + 260; // titik dua
        $xValue = $mL + 278; // nilai
        $lineH  = 26;

        $fields = [
            ['no' => '1.', 'label' => 'Nama',                       'value' => $data['nama']],
            ['no' => '2.', 'label' => 'Nomor Induk Kependudukan',   'value' => $data['nik']],
            ['no' => '3.', 'label' => 'Jenis Kelamin',              'value' => $data['jenis_kelamin']],
            ['no' => '4.', 'label' => 'Tempat dan Tanggal Lahir',   'value' => $data['tempat_lahir'] . ', ' . $data['tanggal_lahir']],
            ['no' => '5.', 'label' => 'Kewarganegaraan',            'value' => $data['kewarganegaraan']],
            ['no' => '6.', 'label' => 'Agama',                      'value' => $data['agama']],
            ['no' => '7.', 'label' => 'Pekerjaan',                  'value' => $data['pekerjaan']],
            ['no' => '8.', 'label' => 'Alamat',                     'value' => $data['alamat']],
            ['no' => '10.','label' => 'Keperluan',                   'value' => $data['keperluan']],
        ];

        $maxValueWidth = 55; // karakter max per baris untuk kolom value
        foreach ($fields as $field) {
            // Nomor
            $img->text($field['no'], $xNum, $yData, function ($f) use ($fontR, $black) {
                $f->filename($fontR); $f->size(15); $f->color($black);
                $f->align('left'); $f->valign('top');
            });
            // Label
            $img->text($field['label'], $xLabel, $yData, function ($f) use ($fontR, $black) {
                $f->filename($fontR); $f->size(15); $f->color($black);
                $f->align('left'); $f->valign('top');
            });
            // Titik dua
            $img->text(':', $xColon, $yData, function ($f) use ($fontR, $black) {
                $f->filename($fontR); $f->size(15); $f->color($black);
                $f->align('left'); $f->valign('top');
            });
            // Value (dengan wrapping)
            $valueLines = $this->wrapText($field['value'], $maxValueWidth);
            foreach ($valueLines as $vLine) {
                $img->text($vLine, $xValue, $yData, function ($f) use ($fontR, $black) {
                    $f->filename($fontR); $f->size(15); $f->color($black);
                    $f->align('left'); $f->valign('top');
                });
                $yData += $lineH;
            }
            // Jika hanya 1 baris, tetap tambah lineH
            if (count($valueLines) === 1) {
                // sudah ditambah di loop atas
            } else {
                // sudah ditambah multi-line di atas
            }
        }

        // ================================================================
        // MASA BERLAKU
        // ================================================================
        $yMasa = $yData + 16;
        $masaText = 'Surat Keterangan ini berlaku tiga bulan setelah dikeluarkan.';
        $img->text($masaText, $cX, $yMasa, function ($f) use ($fontB, $black) {
            $f->filename($fontB); $f->size(15); $f->color($black);
            $f->align('center'); $f->valign('top');
        });

        // Underline kalimat masa berlaku
        $masaLen = strlen($masaText) * 8.5;
        $img->drawLine(function ($d) use ($cX, $masaLen, $yMasa, $black) {
            $d->from($cX - $masaLen / 2, $yMasa + 18)
              ->to($cX + $masaLen / 2, $yMasa + 18)
              ->color($black)->width(1);
        });

        // ================================================================
        // KALIMAT PENUTUP
        // ================================================================
        $yPenutup = $yMasa + 42;
        $penutupText = 'Demikian surat keterangan ini kami buat dengan sebenarnya agar dapatnya dipergunakan sebagaimana mestinya.';
        $penutupLines = $this->wrapText($penutupText, 86);
        foreach ($penutupLines as $pLine) {
            $img->text($pLine, $mL + 28, $yPenutup, function ($f) use ($fontR, $black) {
                $f->filename($fontR); $f->size(15); $f->color($black);
                $f->align('left'); $f->valign('top');
            });
            $yPenutup += 22;
        }

        // ================================================================
        // BLOK TTD
        // ================================================================
        $yTtd   = $yPenutup + 36;
        $xTtd   = $W - 340; // posisi TTD di kanan

        // Tempat dan tanggal
        $img->text('Pelang Lor, ' . $data['tanggal_surat'], $xTtd, $yTtd, function ($f) use ($fontR, $black) {
            $f->filename($fontR); $f->size(15); $f->color($black);
            $f->align('center'); $f->valign('top');
        });

        // Jabatan
        $yTtd += 22;
        if ($ttd === 'kades') {
            $jabatan = 'Kepala Desa Pelang Lor';
            $nama    = 'HARIYANA';
        } else {
            $jabatan = 'Sekretaris Desa Pelang Lor';
            $nama    = 'DIDIK SUPRIYANTO';
        }

        $img->text($jabatan, $xTtd, $yTtd, function ($f) use ($fontR, $black) {
            $f->filename($fontR); $f->size(15); $f->color($black);
            $f->align('center'); $f->valign('top');
        });

        // Ruang TTD (kosong, untuk tanda tangan)
        $yTtdNama = $yTtd + 90;

        // Nama penandatangan (underlined)
        $img->text($nama, $xTtd, $yTtdNama, function ($f) use ($fontB, $black) {
            $f->filename($fontB); $f->size(15); $f->color($black);
            $f->align('center'); $f->valign('top');
        });
        $namaLen = strlen($nama) * 9;
        $img->drawLine(function ($d) use ($xTtd, $namaLen, $yTtdNama, $black) {
            $d->from($xTtd - $namaLen / 2, $yTtdNama + 20)
              ->to($xTtd + $namaLen / 2, $yTtdNama + 20)
              ->color($black)->width(1);
        });

        // ================================================================
        // Trim canvas ke konten aktual (tambah padding bawah)
        // ================================================================
        $finalHeight = $yTtdNama + 80;
        $finalHeight = max($finalHeight, 1400); // minimal tinggi
        $img->crop($W, $finalHeight, 0, 0);

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
