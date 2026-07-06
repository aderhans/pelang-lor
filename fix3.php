<?php
$file = 'app/Http/Controllers/SuratController.php';
$content = file_get_contents($file);

// Replace JpegEncoder
$content = str_replace('use Intervention\Image\Drivers\Gd\Driver;', "use Intervention\Image\Encoders\JpegEncoder;", $content);

// Replace download method
$content = preg_replace(
    '/(public function download\(.*?\n    \{.*?)\n        return response\(\$image->toJpeg\(95\)\)\n            ->header\(\'Content-Type\', \'image\/jpeg\'\)\n            ->header\(\'Content-Disposition\', "attachment; filename=\\\\"\{\$filename\}\\\\""\);/s',
    "$1\n        return response((string) \$image->encode(new JpegEncoder(95)))\n            ->header('Content-Type', 'image/jpeg')\n            ->header('Content-Disposition', \"attachment; filename=\\\"{\$filename}\\\"\");",
    $content
);

// Replace Image method calls
$content = str_replace('$manager->create($W, $H)', '$manager->createImage($W, $H)', $content);
$content = str_replace('new ImageManager(new Driver())', '\Intervention\Image\ImageManager::gd()', $content);
$content = str_replace('$img->place(', '$img->insert(', $content);

// Replace align and valign
$content = str_replace('; $f->valign(\'top\');', ", 'top');", $content);
$content = str_replace("->align('center')", "->align('center'", $content);
$content = str_replace("->align('left')", "->align('left'", $content);

// Fix fonts
$content = str_replace('$f->filename(', '$f->file(', $content);

// Add font italic
$addFontI = "\$fontR = \$this->fontRegular();\n        \$fontI = file_exists('C:/Windows/Fonts/timesi.ttf') ? 'C:/Windows/Fonts/timesi.ttf' : \$fontR;";
$content = str_replace('$fontR = $this->fontRegular();', $addFontI, $content);

// Change Nomor Surat to italic
$content = str_replace(
    "\$img->text('Nomor  :  ' . \$data['nomor_surat'], \$cX, \$yNomor, function (\$f) use (\$fontR, \$black) {",
    "\$img->text('Nomor  :  ' . \$data['nomor_surat'], \$cX, \$yNomor, function (\$f) use (\$fontI, \$black) {"
, $content);

// Change Masa Berlaku to italic and remove underline
$content = str_replace(
    "\$img->text(\$masaText, \$cX, \$yMasa, function (\$f) use (\$fontB, \$black) {",
    "\$img->text(\$masaText, \$cX, \$yMasa, function (\$f) use (\$fontI, \$black) {"
, $content);
$content = preg_replace("/\/\/ Underline kalimat masa berlaku.*?\}\);/s", "// Underline kalimat masa berlaku dihapus", $content);

file_put_contents($file, $content);
echo "Fix complete";
