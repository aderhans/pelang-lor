<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Surat;
use App\Models\Berita;

class LandingController extends Controller
{
    public function index()
    {
        // Ambil 3 berita terbaru yang sudah dipublish dari database
        $berita = Berita::published()->limit(3)->get();

        return view('pages.landing', compact('berita'));
    }
}
