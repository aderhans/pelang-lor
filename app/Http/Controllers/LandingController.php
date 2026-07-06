<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    public function index()
    {
        $stats = [
            ['label' => 'Jumlah Penduduk', 'value' => '3.247', 'icon' => 'people'],
            ['label' => 'Kepala Keluarga', 'value' => '982', 'icon' => 'house'],
            ['label' => 'RT/RW', 'value' => '12/4', 'icon' => 'map'],
            ['label' => 'Dusun', 'value' => '4', 'icon' => 'geo'],
        ];

        $berita = [
            [
                'judul' => 'Gotong Royong Pembersihan Desa',
                'tanggal' => '1 Juli 2026',
                'ringkasan' => 'Warga Desa Pelang Lor bersama-sama melakukan gotong royong membersihkan lingkungan desa menjelang musim penghujan.',
            ],
            [
                'judul' => 'Posyandu Rutin Bulan Juli',
                'tanggal' => '5 Juli 2026',
                'ringkasan' => 'Kegiatan Posyandu rutin bulanan dilaksanakan di Balai Desa Pelang Lor untuk pemantauan kesehatan balita dan ibu hamil.',
            ],
            [
                'judul' => 'Penerimaan Mahasiswa KKN',
                'tanggal' => '6 Juli 2026',
                'ringkasan' => 'Desa Pelang Lor menyambut mahasiswa KKN yang akan membantu pengembangan program desa dan digitalisasi layanan publik.',
            ],
        ];

        return view('pages.landing', compact('stats', 'berita'));
    }
}
