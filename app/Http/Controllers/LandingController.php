<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Surat;

class LandingController extends Controller
{
    public function index()
    {
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

        return view('pages.landing', compact('berita'));
    }
}
