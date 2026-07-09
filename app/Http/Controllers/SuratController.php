<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Browsershot\Browsershot;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Surat;
use App\Mail\NotifikasiAdminMail;

class SuratController extends Controller
{
    // ---------------------------------------------------------------
    // NOMOR SURAT: 470/[counter].404.617.12/[tahun]
    // Counter global, increment per surat, disimpan di file
    // ---------------------------------------------------------------
    protected function generateNomorSurat(): string
    {
        $year        = date('Y');
        $counterFile = storage_path('app/surat/counter.txt');

        if (!file_exists(storage_path('app/surat'))) {
            mkdir(storage_path('app/surat'), 0775, true);
        }

        $counter = file_exists($counterFile) ? (int) file_get_contents($counterFile) + 1 : 0;
        file_put_contents($counterFile, $counter);

        return "470/{$counter}/404.617.12/{$year}";
    }

    // ---------------------------------------------------------------
    // INDEX — tampilkan form
    // ---------------------------------------------------------------
    public function index()
    {
        return view('pages.surat.form');
    }

    // ---------------------------------------------------------------
    // RIWAYAT — tampilkan riwayat surat warga
    // ---------------------------------------------------------------
    public function riwayat()
    {
        $riwayatSurat = [];
        if (auth('warga')->check()) {
            $riwayatSurat = Surat::where('warga_id', auth('warga')->id())
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('pages.warga.riwayat', compact('riwayatSurat'));
    }

    // ---------------------------------------------------------------
    // STORE — simpan ke session → redirect ke preview
    // ---------------------------------------------------------------
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat'   => 'required|string|max:100',
            'nama'          => 'required|string|max:255',
            'nik'           => 'required|digits:16',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'kewarganegaraan' => 'required|string|max:50',
            'agama'         => 'required|string|max:50',
            'pekerjaan'     => 'required|string|max:100',
            'alamat'        => 'required|string|max:500',
            'keperluan'     => 'required|string|max:300',
        ]);

        $nomorSurat = $this->generateNomorSurat();
        $tanggal    = now()->locale('id')->isoFormat('D MMMM YYYY');

        $data = [
            'warga_id'        => auth('warga')->check() ? auth('warga')->id() : null,
            'jenis_surat'     => strtoupper(trim($request->jenis_surat)),
            'nomor_surat'     => $nomorSurat,
            'tanggal_surat'   => $tanggal,
            'nama'            => strtoupper($request->nama),
            'nik'             => $request->nik,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'tempat_lahir'    => $request->tempat_lahir,
            'tanggal_lahir'   => format_tanggal_indo($request->tanggal_lahir),
            'kewarganegaraan' => $request->kewarganegaraan ?? 'Indonesia',
            'agama'           => $request->agama,
            'pekerjaan'       => $request->pekerjaan,
            'alamat'          => $request->alamat,
            'keperluan'       => $request->keperluan,
            'status'          => 'Menunggu',
        ];

        $surat = Surat::create($data);

        // Kirim notifikasi email ke Admin
        try {
            Mail::to(config('mail.admin_notify_address'))
                ->send(new NotifikasiAdminMail($surat));
        } catch (\Exception $e) {
            \Log::error('Gagal kirim notifikasi ke admin: ' . $e->getMessage());
        }

        return redirect()->route('surat.preview', $surat->id);
    }

    // ---------------------------------------------------------------
    // EDIT — form edit surat warga (jika status Menunggu)
    // ---------------------------------------------------------------
    public function edit(string $id)
    {
        $surat = Surat::findOrFail($id);

        // Pastikan hanya pemilik yang bisa edit & status Menunggu
        if ($surat->warga_id !== auth('warga')->id() || $surat->status !== 'Menunggu') {
            return redirect()->route('landing')->with('error', 'Anda tidak memiliki akses atau surat sudah diproses.');
        }

        return view('pages.surat.edit', compact('surat'));
    }

    // ---------------------------------------------------------------
    // UPDATE — proses edit surat warga
    // ---------------------------------------------------------------
    public function update(Request $request, string $id)
    {
        $surat = Surat::findOrFail($id);

        if ($surat->warga_id !== auth('warga')->id() || $surat->status !== 'Menunggu') {
            return redirect()->route('landing')->with('error', 'Anda tidak memiliki akses atau surat sudah diproses.');
        }

        $request->validate([
            'jenis_surat'   => 'required|string|max:100',
            'nama'          => 'required|string|max:255',
            'nik'           => 'required|digits:16',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'kewarganegaraan' => 'required|string|max:50',
            'agama'         => 'required|string|max:50',
            'pekerjaan'     => 'required|string|max:100',
            'alamat'        => 'required|string|max:500',
            'keperluan'     => 'required|string|max:300',
        ]);

        // Perbarui data. (Nomor surat, tanggal surat dibiarkan tetap)
        $surat->update([
            'jenis_surat'     => strtoupper(trim($request->jenis_surat)),
            'nama'            => strtoupper($request->nama),
            'nik'             => $request->nik,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'tempat_lahir'    => $request->tempat_lahir,
            'tanggal_lahir'   => format_tanggal_indo($request->tanggal_lahir),
            'kewarganegaraan' => $request->kewarganegaraan ?? 'Indonesia',
            'agama'           => $request->agama,
            'pekerjaan'       => $request->pekerjaan,
            'alamat'          => $request->alamat,
            'keperluan'       => $request->keperluan,
        ]);

        return redirect()->route('landing')->with('success', 'Surat keterangan berhasil diperbarui.');
    }

    // ---------------------------------------------------------------
    // PREVIEW — tampilkan surat digital + toggle TTD
    // ---------------------------------------------------------------
    public function preview(string $id)
    {
        $data = Surat::find($id);

        if (!$data) {
            return redirect()->route('surat.index')
                ->with('error', 'Data surat tidak ditemukan. Silakan isi form kembali.');
        }

        return view('pages.surat.preview', compact('data', 'id'));
    }


}