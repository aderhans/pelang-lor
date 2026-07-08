<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Surat;

class AdminController extends Controller
{
    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('pages.admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }

    public function dashboard()
    {
        $totalSurat  = Surat::count();
        $menunggu    = Surat::where('status', 'Menunggu')->count();
        $disetujui   = Surat::where('status', 'Disetujui')->count();
        $ditolak     = Surat::where('status', 'Ditolak')->count();
        $hariIni     = Surat::whereDate('created_at', today())->count();

        // Surat pending untuk ditampilkan di dashboard (belum disetujui)
        $suratPending = Surat::where('status', 'Menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        // 5 surat terbaru yang sudah diarsipkan (disetujui)
        $suratTerbaru = Surat::where('status', 'Disetujui')
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        return view('pages.admin.dashboard', compact(
            'totalSurat', 'menunggu', 'disetujui', 'ditolak', 'hariIni',
            'suratPending', 'suratTerbaru'
        ));
    }

    /**
     * Arsip: hanya surat yang sudah disetujui
     */
    public function suratList()
    {
        $surats = Surat::where('status', 'Disetujui')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('pages.admin.surat-list', compact('surats'));
    }

    /**
     * Daftar surat pending (menunggu persetujuan)
     * Tidak ada route baru — diakses dari dashboard
     */
    public function suratPending()
    {
        $surats = Surat::where('status', 'Menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.surat-pending', compact('surats'));
    }

    public function approve(string $id)
    {
        $surat = Surat::findOrFail($id);
        $surat->update(['status' => 'Disetujui']);
        return back()->with('success', 'Surat berhasil disetujui dan masuk ke arsip.');
    }

    public function tolak(string $id)
    {
        $surat = Surat::findOrFail($id);
        $surat->update(['status' => 'Ditolak']);
        return back()->with('success', 'Surat telah ditolak.');
    }
}
