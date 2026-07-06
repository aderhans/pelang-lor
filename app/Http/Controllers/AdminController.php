<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('pages.admin.dashboard');
    }

    public function suratList()
    {
        return view('pages.admin.surat-list');
    }

    public function approve(string $id)
    {
        // Implementasi approval akan ditambahkan setelah DB setup
        return back()->with('success', 'Surat berhasil disetujui.');
    }

    public function tolak(string $id)
    {
        // Implementasi tolak akan ditambahkan setelah DB setup
        return back()->with('success', 'Surat telah ditolak.');
    }
}
