<?php

namespace App\Console;

use Illuminate\Support\Facades\File;

\ = base_path('app/Http/Controllers/SuratController.php');
\ = File::get(\);

\ = <<<'EOD'
    protected function buildSuratImage(array \, string \): \Intervention\Image\Interfaces\ImageInterface
    {
        \ = \Intervention\Image\ImageManager::gd();

        // Canvas A4 @ ~150 DPI: 1240 x 1754
        \ = 1240;
        \ = 1900; // sedikit lebih tinggi agar tidak terpotong
        \ = \->create(\, \)->fill('ffffff');

        \ = \->fontRegular();
        \ = \->fontBold();
        \ = file_exists('C:/Windows/Fonts/timesi.ttf') ? 'C:/Windows/Fonts/timesi.ttf' : \;
        \ = '000000';
        \    = 100; // margin kiri
        \    = \ - 100; // margin kanan
        \    = \ / 2; // center X

        // ================================================================
        // HEADER — KOP SURAT
        // ================================================================
        \ = public_path('images/Lambang_Kabupaten_Ngawi.png');
        if (file_exists(\)) {
            \ = \->read(\)->scale(height: 110);
            \->place(\, 'top-left', \, 30);
        }

        // Teks kop (centered)
        \->text('PEMERINTAH KABUPATEN NGAWI', \, 32, function (\) use (\, \) {
            \->file(\); \->size(24); \->color(\);
            \->align('center'); \->valign('top');
        });
        \->text('KECAMATAN KEDUNGGALAR', \, 64, function (\) use (\, \) {
            \->file(\); \->size(24); \->color(\);
            \->align('center'); \->valign('top');
        });
        \->text('DESA PELANG LOR', \, 96, function (\) use (\, \) {
            \->file(\); \->size(36); \->color(\);
            \->align('center'); \->valign('top');
        });
        \->text('Jln. Raya Solo-Ngawi KM 18 Ngawi  Kode Pos 63254', \, 142, function (\) use (\, \) {
            \->file(\); \->size(16); \->color(\);
            \->align('center'); \->valign('top');
        });

        // Garis pemisah header
        \ = 168;
        \->drawLine(function (\) use (\, \, \, \) {
            \->from(\, \)->to(\, \)->color(\)->width(5);
        });
        \ = 176;
        \->drawLine(function (\) use (\, \, \, \) {
            \->from(\, \)->to(\, \)->color(\)->width(2);
        });

        // ================================================================
        // JUDUL SURAT
        // ================================================================
        \ = 200;
        \ = \['jenis_surat'];
        \->text(\, \, \, function (\) use (\, \) {
            \->file(\); \->size(20); \->color(\);
            \->align('center'); \->valign('top');
        });

        // Underline judul
        \  = strlen(\) * 11;
        \ = \ - \ / 2;
        \ = \ + \ / 2;
        \->drawLine(function (\) use (\, \, \) {
            \ = 224;
            \->from((int)\, \)->to((int)\, \)->color(\)->width(1);
        });

        // Nomor surat (italic)
        \ = 234;
        \->text('Nomor  :  ' . \['nomor_surat'], \, \, function (\) use (\, \) {
            \->file(\); \->size(16); \->color(\);
            \->align('center'); \->valign('top');
        });

        // ================================================================
        // PARAGRAF PEMBUKA
        // ================================================================
        \ = 280;
        \ = 'Yang bertanda tangan di bawah ini Kami Kepala Desa Pelang Lor Kecamatan Kedunggalar Kabupaten Ngawi Jawa Timur menerangkan dengan sesungguhnya bahwa :';
        \ = \->wrapText(\, 82);
        foreach (\ as \) {
            \->text(\, \ + 28, \, function (\) use (\, \) {
                \->file(\); \->size(16); \->color(\);
                \->align('left'); \->valign('top');
            });
            \ += 24;
        }

        // ================================================================
        // DATA FIELDS — nomor 1-8 dan 10
        // ================================================================
        \  = \ + 16;
        \   = \ + 10;
        \ = \ + 35;
        \ = \ + 280;
        \ = \ + 298;
        \  = 28;

        \ = [
            ['no' => '1.', 'label' => 'Nama',                       'value' => \['nama']],
            ['no' => '2.', 'label' => 'Nomor Induk Kependudukan',   'value' => \['nik']],
            ['no' => '3.', 'label' => 'Jenis Kelamin',              'value' => \['jenis_kelamin']],
            ['no' => '4.', 'label' => 'Tempat dan Tanggal Lahir',   'value' => \['tempat_lahir'] . ', ' . \['tanggal_lahir']],
            ['no' => '5.', 'label' => 'Kewarganegaraan',            'value' => \['kewarganegaraan']],
            ['no' => '6.', 'label' => 'Agama',                      'value' => \['agama']],
            ['no' => '7.', 'label' => 'Pekerjaan',                  'value' => \['pekerjaan']],
            ['no' => '8.', 'label' => 'Alamat',                     'value' => \['alamat']],
            ['no' => '10.','label' => 'Keperluan',                   'value' => \['keperluan']],
        ];

        \ = 55;
        foreach (\ as \) {
            \->text(\['no'], \, \, function (\) use (\, \) {
                \->file(\); \->size(16); \->color(\);
                \->align('left'); \->valign('top');
            });
            \->text(\['label'], \, \, function (\) use (\, \) {
                \->file(\); \->size(16); \->color(\);
                \->align('left'); \->valign('top');
            });
            \->text(':', \, \, function (\) use (\, \) {
                \->file(\); \->size(16); \->color(\);
                \->align('left'); \->valign('top');
            });
            \ = \->wrapText(\['value'], \);
            foreach (\ as \) {
                \->text(\, \, \, function (\) use (\, \) {
                    \->file(\); \->size(16); \->color(\);
                    \->align('left'); \->valign('top');
                });
                \ += \;
            }
        }

        // ================================================================
        // MASA BERLAKU
        // ================================================================
        \ = \ + 20;
        \ = 'Surat Keterangan ini berlaku tiga bulan setelah surat dikeluarkan.';
        // Italic, no underline
        \->text(\, \, \, function (\) use (\, \) {
            \->file(\); \->size(16); \->color(\);
            \->align('center'); \->valign('top');
        });

        // ================================================================
        // KALIMAT PENUTUP
        // ================================================================
        \ = \ + 48;
        \ = 'Demikian surat keterangan ini kami buat dengan sebenarnya agar dapatnya dipergunakan sebagaimana mestinya.';
        \ = \->wrapText(\, 86);
        foreach (\ as \) {
            \->text(\, \ + 28, \, function (\) use (\, \) {
                \->file(\); \->size(16); \->color(\);
                \->align('left'); \->valign('top');
            });
            \ += 24;
        }

        // ================================================================
        // BLOK TTD
        // ================================================================
        \   = \ + 40;
        \   = \ - 320; 

        \->text('Pelang Lor, ' . \['tanggal_surat'], \, \, function (\) use (\, \) {
            \->file(\); \->size(16); \->color(\);
            \->align('center'); \->valign('top');
        });

        \ += 24;
        if (\ === 'kades') {
            \ = 'Kepala Desa Pelang Lor';
            \    = 'HARIYANA';
        } else {
            \ = 'Sekretaris Desa Pelang Lor';
            \    = 'DIDIK SUPRIYANTO';
        }

        \->text(\, \, \, function (\) use (\, \) {
            \->file(\); \->size(16); \->color(\);
            \->align('center'); \->valign('top');
        });

        \ = \ + 100;

        \->text(\, \, \, function (\) use (\, \) {
            \->file(\); \->size(16); \->color(\);
            \->align('center'); \->valign('top');
        });
        \ = strlen(\) * 9.5;
        \->drawLine(function (\) use (\, \, \, \) {
            \->from((int)(\ - \ / 2), \ + 22)
              ->to((int)(\ + \ / 2), \ + 22)
              ->color(\)->width(1);
        });

        // Trim canvas
        \ = \ + 100;
        \ = max(\, 1400);
        \->crop(\, \, 0, 0);

        return \;
    }
EOD;

\ = preg_replace('/protected function buildSuratImage\(.*?\s\{.*?\n    \}/s', \, \);
\ = str_replace('\Intervention\Image\ImageManager;', '', \);
\ = str_replace('\Intervention\Image\Drivers\Gd\Driver;', '', \);
\ = str_replace('use Intervention\Image\ImageManager;', 'use Intervention\Image\ImageManager;', \);

File::put(\, \);

echo "Done\n";
