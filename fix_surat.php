<?php
$file = 'C:/Users/ASUS/pelang-lor/app/Http/Controllers/SuratController.php';
$content = file_get_contents($file);

// Fix strtoupper
$content = str_replace(
    "'jenis_kelamin'   => strtoupper(\->jenis_kelamin),",
    "'jenis_kelamin'   => \->jenis_kelamin,",
    $content
);
$content = str_replace(
    "'kewarganegaraan' => strtoupper(\->kewarganegaraan ?? 'Indonesia'),",
    "'kewarganegaraan' => \->kewarganegaraan ?? 'Indonesia',",
    $content
);
$content = str_replace(
    "'agama'           => strtoupper(\->agama),",
    "'agama'           => \->agama,",
    $content
);
$content = str_replace(
    "'pekerjaan'       => strtoupper(\->pekerjaan),",
    "'pekerjaan'       => \->pekerjaan,",
    $content
);
$content = str_replace(
    "'tempat_lahir'    => strtoupper(\->tempat_lahir),",
    "'tempat_lahir'    => \->tempat_lahir,",
    $content
);
$content = str_replace(
    "'alamat'          => strtoupper(\->alamat),",
    "'alamat'          => \->alamat,",
    $content
);
$content = str_replace(
    "'keperluan'       => strtoupper(\->keperluan),",
    "'keperluan'       => \->keperluan,",
    $content
);

// Actually, in the controller it might not use strtoupper on everything, let's check
