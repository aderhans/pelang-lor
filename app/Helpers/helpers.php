<?php

if (!function_exists('bulan_romawi')) {
    function bulan_romawi(string|int $bulan): string
    {
        $romawi = [
            '01' => 'I',   '1'  => 'I',
            '02' => 'II',  '2'  => 'II',
            '03' => 'III', '3'  => 'III',
            '04' => 'IV',  '4'  => 'IV',
            '05' => 'V',   '5'  => 'V',
            '06' => 'VI',  '6'  => 'VI',
            '07' => 'VII', '7'  => 'VII',
            '08' => 'VIII','8'  => 'VIII',
            '09' => 'IX',  '9'  => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII',
        ];

        return $romawi[(string) $bulan] ?? (string) $bulan;
    }
}

if (!function_exists('format_tanggal_indo')) {
    function format_tanggal_indo(string $tanggal): string
    {
        $bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        $ts = strtotime($tanggal);
        return date('d', $ts) . ' ' . $bulan[(int) date('n', $ts)] . ' ' . date('Y', $ts);
    }
}
