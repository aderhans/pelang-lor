<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Warga;

class WargaController extends Controller
{
    // ---------------------------------------------------------------
    // REGISTER FORM
    // ---------------------------------------------------------------
    public function registerForm()
    {
        if (Auth::guard('warga')->check()) {
            return redirect()->route('landing');
        }
        return view('pages.warga.register');
    }

    // ---------------------------------------------------------------
    // REGISTER — validasi + simpan akun warga
    // ---------------------------------------------------------------
    public function register(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'email'         => 'required|email|unique:wargas,email|max:255',
            'whatsapp'      => 'required|string|max:20|regex:/^[0-9+\-\s]+$/',
            'password'      => 'required|string|min:8|confirmed',
        ], [
            'email.unique'      => 'Email sudah terdaftar. Silakan gunakan email lain atau login.',
            'whatsapp.regex'    => 'Nomor WhatsApp hanya boleh berisi angka, +, -, atau spasi.',
            'password.min'      => 'Kata sandi minimal 8 karakter.',
            'password.confirmed'=> 'Konfirmasi kata sandi tidak cocok.',
        ]);

        Warga::create([
            'nama'          => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email'         => $request->email,
            'whatsapp'      => $request->whatsapp,
            'password'      => Hash::make($request->password),
        ]);

        return redirect()->route('warga.login')
            ->with('success', 'Akun berhasil dibuat! Silakan masuk dengan email dan kata sandi Anda.');
    }

    // ---------------------------------------------------------------
    // LOGIN FORM
    // ---------------------------------------------------------------
    public function loginForm()
    {
        if (Auth::guard('warga')->check()) {
            return redirect()->route('landing');
        }
        return view('pages.warga.login');
    }

    // ---------------------------------------------------------------
    // LOGIN — autentikasi warga
    // ---------------------------------------------------------------
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('warga')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('landing'))
                ->with('success', 'Selamat datang kembali!');
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->withInput($request->only('email'));
    }

    // ---------------------------------------------------------------
    // LOGOUT
    // ---------------------------------------------------------------
    public function logout(Request $request)
    {
        Auth::guard('warga')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing')
            ->with('info', 'Anda telah berhasil keluar.');
    }
}
