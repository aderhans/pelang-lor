<?php
\ = 'app/Http/Controllers/SuratController.php';
\ = file_get_contents(\);

\ = str_replace('use Intervention\Image\Drivers\Gd\Driver;', 'use Intervention\Image\Encoders\JpegEncoder;', \);

\ = preg_replace(
    '/(public function download\(.*?\n    \{.*?)\n        return response\(\->toJpeg\(95\)\)\n            ->header\(\'Content-Type\', \'image\/jpeg\'\)\n            ->header\(\'Content-Disposition\', "attachment; filename=\\\\"\{\\}\\\\""\);/s',
    "\\n        return response((string) \->encode(new JpegEncoder(95)))\n            ->header('Content-Type', 'image/jpeg')\n            ->header('Content-Disposition', \"attachment; filename=\\\"{\}\\\"\");",
    \
);

// We need to change ImageManager::create to createImage
\ = str_replace('\->create(\, \)', '\->createImage(\, \)', \);
\ = str_replace('new ImageManager(new Driver())', '\Intervention\Image\ImageManager::gd()', \);
\ = str_replace('\->place(', '\->insert(', \);
\ = str_replace('->valign(', '->align(\'left\', ', \);
// Fix specific alignments
\ = preg_replace("/\\\->align\('center'\);\s+\\\->align\('left', 'top'\);/", "\\\->align('center', 'top');", \);
\ = preg_replace("/\\\->align\('left'\);\s+\\\->align\('left', 'top'\);/", "\\\->align('left', 'top');", \);

// Fix fonts
\ = str_replace('\->filename(', '\->file(', \);

// Add italic font logic
\ = "\ = \->fontRegular();\n        \ = file_exists('C:/Windows/Fonts/timesi.ttf') ? 'C:/Windows/Fonts/timesi.ttf' : \;";
\ = str_replace(' = ->fontRegular();', \, \);

// Change Nomor Surat to italic
\ = str_replace(
    "\->text('Nomor  :  ' . \['nomor_surat'], \, \, function (\) use (\, \) {",
    "\->text('Nomor  :  ' . \['nomor_surat'], \, \, function (\) use (\, \) {"
, \);

// Change Masa Berlaku to italic and remove underline
\ = preg_replace(
    "/\->text\(\, \\\, \\\, function \(\\\\) use \(\\\, \\\\) \{/",
    "\->text(\, \, \, function (\) use (\, \) {"
, \);
// Remove underline drawing for Masa Berlaku
\ = preg_replace("/\/\/ Underline kalimat masa berlaku.*?\}\);/s", "// Underline kalimat masa berlaku dihapus", \);

file_put_contents(\, \);
echo "Fix complete";
