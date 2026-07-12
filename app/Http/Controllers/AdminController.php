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
            return redirect()->route('admin.dashboard');
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
        return redirect()->route('admin.login');
    }

    public function dashboard(Request $request)
    {
        $query = Surat::query();
        
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', '=', $request->tanggal);
        }

        $surats = $query->orderBy('created_at', 'desc')->get();
        $totalSurat = Surat::count();
        $hariIni = Surat::whereDate('created_at', today())->count();

        return view('pages.admin.dashboard', compact('surats', 'totalSurat', 'hariIni'));
    }
}
