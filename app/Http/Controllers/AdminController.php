<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Surat;
use App\Models\TtdSetting;
use App\Mail\SuratDisetujuiMail;

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

    public function dashboard()
    {
        $totalSurat  = Surat::count();
        $menunggu    = Surat::where('status', 'Menunggu')->count();
        $disetujui   = Surat::where('status', 'Disetujui')->count();
        $ditolak     = Surat::where('status', 'Ditolak')->count();
        $hariIni     = Surat::whereDate('created_at', today())->count();

        $suratPending = Surat::where('status', 'Menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        $suratTerbaru = Surat::where('status', 'Disetujui')
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        return view('pages.admin.dashboard', compact(
            'totalSurat', 'menunggu', 'disetujui', 'ditolak', 'hariIni',
            'suratPending', 'suratTerbaru'
        ));
    }

    public function suratList()
    {
        $surats = Surat::where('status', 'Disetujui')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('pages.admin.surat-list', compact('surats'));
    }

    public function suratPending()
    {
        $surats = Surat::where('status', 'Menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        $ttdSettings = TtdSetting::all()->keyBy('jabatan_key');

        return view('pages.admin.surat-pending', compact('surats', 'ttdSettings'));
    }

    /**
     * Approve surat: pilih penandatangan, generate PDF dengan TTD, kirim ke email warga.
     */
    public function approve(Request $request, string $id)
    {
        $request->validate([
            'penandatangan' => 'required|in:kades,sekdes',
        ]);

        $surat = Surat::with('warga')->findOrFail($id);

        $penandatanganKey = $request->penandatangan;
        $ttdSetting       = TtdSetting::where('jabatan_key', $penandatanganKey)->first();

        if (!$ttdSetting) {
            return back()->with('error', 'Pengaturan TTD tidak ditemukan. Silakan atur TTD terlebih dahulu.');
        }

        // Siapkan path gambar TTD & Stempel (sebagai path absolut untuk DomPDF)
        $ttdImagePath = null;
        if ($ttdSetting->path_ttd) {
            $ttdPath = storage_path('app/public/' . $ttdSetting->path_ttd);
            if (file_exists($ttdPath)) {
                $ttdData = base64_encode(file_get_contents($ttdPath));
                $ttdImagePath = 'data:image/png;base64,' . $ttdData;
            }
        }

        // Stempel: ambil dari pengaturan kades (shared) — atau dari penandatangan jika masing-masing berbeda
        $stempelImagePath = null;
        if ($ttdSetting->path_stempel) {
            $stempelPath = storage_path('app/public/' . $ttdSetting->path_stempel);
            if (file_exists($stempelPath)) {
                $stempelData = base64_encode(file_get_contents($stempelPath));
                $stempelImagePath = 'data:image/png;base64,' . $stempelData;
            }
        }

        // Logo
        $logoImagePath = null;
        $logoPath = public_path('images/Lambang_Kabupaten_Ngawi.png');
        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoImagePath = 'data:image/png;base64,' . $logoData;
        }

        $jabatan = $ttdSetting->jabatan_label;
        $nama    = $ttdSetting->nama_pejabat;

        // Siapkan data surat sebagai array untuk diteruskan ke view
        $data = [
            'jenis_surat'     => $surat->jenis_surat,
            'nomor_surat'     => $surat->nomor_surat,
            'tanggal_surat'   => $surat->tanggal_surat,
            'nama'            => $surat->nama,
            'nik'             => $surat->nik,
            'jenis_kelamin'   => $surat->jenis_kelamin,
            'tempat_lahir'    => $surat->tempat_lahir,
            'tanggal_lahir'   => $surat->tanggal_lahir,
            'kewarganegaraan' => $surat->kewarganegaraan,
            'agama'           => $surat->agama,
            'pekerjaan'       => $surat->pekerjaan,
            'alamat'          => $surat->alamat,
            'keperluan'       => $surat->keperluan,
        ];

        // Generate PDF dengan TTD & stempel
        $pdf = Pdf::loadView('pages.surat.pdf', compact(
            'data', 'jabatan', 'nama', 'ttdImagePath', 'stempelImagePath', 'logoImagePath'
        ))
            ->setPaper('a4', 'portrait')
            ->setOption('margin_top', 25.4)
            ->setOption('margin_right', 25.4)
            ->setOption('margin_bottom', 25.4)
            ->setOption('margin_left', 25.4)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true)
            ->setOption('defaultFont', 'times-roman')
            ->setOption('dpi', 150)
            ->setOption('enable_php', false)
            ->setOption('enable_javascript', false)
            ->setOption('enable_remote', true);

        // Simpan PDF sementara ke storage
        $filename    = 'Surat_' . preg_replace('/[^a-zA-Z0-9]/', '_', $surat->nomor_surat) . '_TTD.pdf';
        $tmpPath     = storage_path('app/surat/' . $filename);

        if (!is_dir(storage_path('app/surat'))) {
            mkdir(storage_path('app/surat'), 0775, true);
        }

        $pdf->save($tmpPath);

        // Update status surat
        $surat->update([
            'status'         => 'Disetujui',
            'penandatangan'  => $penandatanganKey,
        ]);

        // Kirim PDF ke email warga (jika warga memiliki email)
        $emailSent = false;
        if ($surat->warga && $surat->warga->email) {
            try {
                // Kirim menggunakan mailer "admin" (email resmi desa)
                Mail::mailer('admin')
                    ->to($surat->warga->email)
                    ->send(new SuratDisetujuiMail($surat, $tmpPath, $filename));
                $emailSent = true;
            } catch (\Exception $e) {
                // Log error tapi jangan gagalkan proses approval
                \Log::error('Gagal mengirim email ke warga: ' . $e->getMessage());
            }
        }

        // Hapus PDF sementara setelah dikirim
        if (file_exists($tmpPath)) {
            unlink($tmpPath);
        }

        $message = 'Surat berhasil disetujui dan masuk ke arsip.';
        if ($emailSent) {
            $message .= ' Email + PDF telah dikirim ke warga.';
        } elseif ($surat->warga && $surat->warga->email) {
            $message .= ' Namun pengiriman email gagal, cek log untuk detail.';
        } else {
            $message .= ' (Warga tidak memiliki email terdaftar — PDF tidak terkirim.)';
        }

        return back()->with('success', $message);
    }

    public function tolak(string $id)
    {
        $surat = Surat::findOrFail($id);
        $surat->update(['status' => 'Ditolak']);
        return back()->with('success', 'Surat telah ditolak.');
    }

    // ---------------------------------------------------------------
    // TTD SETTINGS — halaman pengaturan tanda tangan & stempel
    // ---------------------------------------------------------------
    public function ttdSettings()
    {
        $settings = TtdSetting::all()->keyBy('jabatan_key');
        return view('pages.admin.ttd-settings', compact('settings'));
    }

    public function ttdSettingsUpdate(Request $request)
    {
        $request->validate([
            'jabatan_key'     => 'required|in:kades,sekdes',
            'ttd_image'       => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'stempel_image'   => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $setting = TtdSetting::where('jabatan_key', $request->jabatan_key)->first();

        if (!$setting) {
            return back()->with('error', 'Pengaturan tidak ditemukan.');
        }

        $updateData = [];

        // Upload TTD
        if ($request->hasFile('ttd_image')) {
            // Hapus file lama
            if ($setting->path_ttd && Storage::disk('public')->exists($setting->path_ttd)) {
                Storage::disk('public')->delete($setting->path_ttd);
            }
            $path = $request->file('ttd_image')->store('ttd', 'public');
            $updateData['path_ttd'] = $path;
        }

        // Upload Stempel
        if ($request->hasFile('stempel_image')) {
            if ($setting->path_stempel && Storage::disk('public')->exists($setting->path_stempel)) {
                Storage::disk('public')->delete($setting->path_stempel);
            }
            $path = $request->file('stempel_image')->store('ttd', 'public');
            $updateData['path_stempel'] = $path;
        }

        if (!empty($updateData)) {
            $setting->update($updateData);
        }

        return back()->with('success', 'Pengaturan TTD & Stempel berhasil diperbarui.');
    }
}
