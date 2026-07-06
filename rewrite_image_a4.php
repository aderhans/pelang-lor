<?php

namespace App\Console;

use Illuminate\Support\Facades\File;

\ = base_path('app/Http/Controllers/SuratController.php');
\ = File::get(\);

// Kita ubah bagian buildSuratImage saja
\ = <<<'EOD'
    protected function buildSuratImage(array , string ): \Intervention\Image\Interfaces\ImageInterface
    {
         = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());

        // Ukuran A4 pada 96 DPI
           = 794;
           = 1123;
         = ->createImage(, )->fill('ffffff');

        // Margin normal (1 inch = 96px)
          = 96;           
          =  - 96;      
          = 96;           
          =  / 2;       

         = ->fontRegular();
         = file_exists('C:/Windows/Fonts/timesi.ttf') ? 'C:/Windows/Fonts/timesi.ttf' : ;
         = ->fontBold();
         = '000000';

        // ================================================================
        // HEADER — KOP SURAT (logo kiri, teks center)
        // ================================================================
         = public_path('images/Lambang_Kabupaten_Ngawi.png');
        if (file_exists()) {
             = ->decode()->scale(height: 80);
            ->insert(, ,  - 10);
        }

        // Teks kop: center dari seluruh lebar canvas
         = ;
        ->text('PEMERINTAH KABUPATEN NGAWI', , , function () use (, ) {
            ->file(); ->size(16); ->color();
            ->align('center', 'top');
        });
        ->text('KECAMATAN KEDUNGGALAR', ,  + 20, function () use (, ) {
            ->file(); ->size(16); ->color();
            ->align('center', 'top');
        });
        ->text('DESA PELANG LOR', ,  + 44, function () use (, ) {
            ->file(); ->size(24); ->color();
            ->align('center', 'top');
        });
        ->text('Jln. Raya Solo-Ngawi KM 18 Ngawi  Kode Pos 63254', ,  + 74, function () use (, ) {
            ->file(); ->size(12); ->color();
            ->align('center', 'top');
        });

        // Garis pemisah kop
         =  + 94;
        ->drawLine(function () use (, , , ) {
            ->from(, )->to(, )->color()->width(3);
        });
         =  + 4;
        ->drawLine(function () use (, , , ) {
            ->from(, )->to(, )->color()->width(1);
        });

        // ================================================================
        // JUDUL SURAT
        // ================================================================
         =  + 25;
         = ['jenis_surat'];
        ->text(, , , function () use (, ) {
            ->file(); ->size(15); ->color();
            ->align('center', 'top');
        });

        // Underline judul
            = strlen() * 8.5;
         = (int)( -  / 2);
         = (int)( +  / 2);
        ->drawLine(function () use (, , , ) {
             =  + 18;
            ->from(, )->to(, )->color()->width(1);
        });

        // Nomor surat (italic)
         =  + 25;
        ->text('Nomor  :  ' . ['nomor_surat'], , , function () use (, ) {
            ->file(); ->size(13); ->color();
            ->align('center', 'top');
        });

        // ================================================================
        // PARAGRAF PEMBUKA
        // ================================================================
            =  + 40;
         = 'Yang bertanda tangan di bawah ini Kami Kepala Desa Pelang Lor Kecamatan Kedunggalar Kabupaten Ngawi Jawa Timur menerangkan dengan sesungguhnya bahwa :';
         = ->wrapText(, 78);
        foreach ( as ) {
            ->text(,  + 30, , function () use (, ) {
                ->file(); ->size(13); ->color();
                ->align('left', 'top');
            });
             += 20;
        }

        // ================================================================
        // DATA FIELDS
        // ================================================================
          =  + 10;
           =  + 5;
         =  + 25;
         =  + 230;
         =  + 245;
          = 22;

         = [
            ['no' => '1.', 'label' => 'Nama',                       'value' => ['nama']],
            ['no' => '2.', 'label' => 'Nomor Induk Kependudukan',   'value' => ['nik']],
            ['no' => '3.', 'label' => 'Jenis Kelamin',              'value' => ['jenis_kelamin']],
            ['no' => '4.', 'label' => 'Tempat dan Tanggal Lahir',   'value' => ['tempat_lahir'] . ', ' . ['tanggal_lahir']],
            ['no' => '5.', 'label' => 'Kewarganegaraan',            'value' => ['kewarganegaraan']],
            ['no' => '6.', 'label' => 'Agama',                      'value' => ['agama']],
            ['no' => '7.', 'label' => 'Pekerjaan',                  'value' => ['pekerjaan']],
            ['no' => '8.', 'label' => 'Alamat',                     'value' => ['alamat']],
            ['no' => '10.','label' => 'Keperluan',                  'value' => ['keperluan']],
        ];

         = 50;
        foreach ( as ) {
            ->text(['no'], , , function () use (, ) {
                ->file(); ->size(13); ->color();
                ->align('left', 'top');
            });
            ->text(['label'], , , function () use (, ) {
                ->file(); ->size(13); ->color();
                ->align('left', 'top');
            });
            ->text(':', , , function () use (, ) {
                ->file(); ->size(13); ->color();
                ->align('left', 'top');
            });
             = ->wrapText(['value'], );
            foreach ( as ) {
                ->text(, , , function () use (, ) {
                    ->file(); ->size(13); ->color();
                    ->align('left', 'top');
                });
                 += ;
            }
        }

        // ================================================================
        // MASA BERLAKU
        // ================================================================
         =  + 15;
         = 'Surat Keterangan ini berlaku tiga bulan setelah surat dikeluarkan.';
        ->text(, , , function () use (, ) {
            ->file(); ->size(13); ->color();
            ->align('center', 'top');
        });

        // ================================================================
        // KALIMAT PENUTUP
        // ================================================================
         =  + 35;
         = 'Demikian surat keterangan ini kami buat dengan sebenarnya agar dapatnya dipergunakan sebagaimana mestinya.';
         = ->wrapText(, 78);
        foreach ( as ) {
            ->text(,  + 30, , function () use (, ) {
                ->file(); ->size(13); ->color();
                ->align('left', 'top');
            });
             += 20;
        }

        // ================================================================
        // BLOK TTD
        // ================================================================
         =  + 40;
         =  - 250; 

        // Tempat dan tanggal
        ->text('Pelang Lor, ' . ['tanggal_surat'], , , function () use (, ) {
            ->file(); ->size(13); ->color();
            ->align('center', 'top');
        });

        // Jabatan (normal, tidak bold)
         += 20;
        if ( === 'kades') {
             = 'Kepala Desa Pelang Lor';
                = 'HARIYANA';
        } else {
             = 'Sekretaris Desa Pelang Lor';
                = 'DIDIK SUPRIYANTO';
        }

        ->text(, , , function () use (, ) {
            ->file(); ->size(13); ->color();
            ->align('center', 'top');
        });

        // Ruang TTD
         =  + 80;

        // Nama penandatangan (bold + underline)
        ->text(, , , function () use (, ) {
            ->file(); ->size(13); ->color();
            ->align('center', 'top');
        });
         = strlen() * 7.5;
        ->drawLine(function () use (, , , ) {
            ->from((int)( -  / 2),  + 18)
              ->to((int)( +  / 2),  + 18)
              ->color()->width(1);
        });

        // Tidak di crop lagi, biarkan A4 penuh
        return ;
    }
EOD;

\ = preg_replace('/protected function buildSuratImage\(.*?\s\{.*?\n    \}/s', \, \);
File::put(\, \);

echo "Done\n";
