<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Surat;
use Spatie\Browsershot\Browsershot;

class SuratController extends Controller
{
    // ---------------------------------------------------------------
    // NOMOR SURAT
    // ---------------------------------------------------------------
    protected function generateNomorSurat(): string
    {
        $year    = date('Y');
        
        // Menggunakan max ID dari database agar selalu sinkron
        $lastId  = \App\Models\Surat::max('id') ?? 0;
        $counter = $lastId + 1;

        return "470/{$counter}/404.617.12/{$year}";
    }

    public function index()
    {
        return view('pages.surat.form');
    }

    // ---------------------------------------------------------------
    // RIWAYAT — form pencarian berdasarkan NIK
    // ---------------------------------------------------------------
    public function riwayat()
    {
        return view('pages.warga.riwayat', ['riwayatSurat' => []]);
    }

    public function cariRiwayat(Request $request)
    {
        $request->validate([
            'nik'     => 'required|string|size:16',
            'tanggal' => 'nullable|date',
        ], [
            'nik.required' => 'NIK wajib diisi untuk melihat riwayat surat.',
            'nik.size'     => 'NIK harus 16 digit angka.',
        ]);

        $query = Surat::where('nik', $request->nik);

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', '=', $request->tanggal);
        }

        $riwayatSurat = $query->orderBy('created_at', 'desc')->get();

        return view('pages.warga.riwayat', compact('riwayatSurat'))->withInput($request->all());
    }

    // ---------------------------------------------------------------
    // STORE — simpan & auto-approve
    // ---------------------------------------------------------------
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat'     => 'required|string|max:100',
            'nama'            => 'required|string|max:255',
            'nik'             => 'required|digits:16',
            'jenis_kelamin'   => 'required|in:Laki-Laki,Perempuan',
            'tempat_lahir'    => 'required|string|max:100',
            'tanggal_lahir'   => 'required|date',
            'kewarganegaraan' => 'required|string|max:50',
            'agama'           => 'required|string|max:50',
            'pekerjaan'       => 'required|string|max:100',
            'alamat'          => 'required|string|max:500',
            'keperluan'       => 'required|string|max:300',
        ]);

        $nomorSurat = $this->generateNomorSurat();
        $tanggal    = now()->locale('id')->isoFormat('D MMMM YYYY');

        $data = [
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
        ];

        $surat = Surat::create($data);

        return redirect()->route('surat.preview', $surat->id)->with('success', 'Surat berhasil dibuat!');
    }

    // ---------------------------------------------------------------
    // EDIT
    // ---------------------------------------------------------------
    public function edit(string $id)
    {
        $surat = Surat::findOrFail($id);
        return view('pages.surat.edit', compact('surat'));
    }

    public function update(Request $request, string $id)
    {
        $surat = Surat::findOrFail($id);

        $request->validate([
            'jenis_surat'     => 'required|string|max:100',
            'nama'            => 'required|string|max:255',
            'nik'             => 'required|digits:16',
            'jenis_kelamin'   => 'required|in:Laki-Laki,Perempuan',
            'tempat_lahir'    => 'required|string|max:100',
            'tanggal_lahir'   => 'required|date',
            'kewarganegaraan' => 'required|string|max:50',
            'agama'           => 'required|string|max:50',
            'pekerjaan'       => 'required|string|max:100',
            'keperluan'       => 'required|string|max:300',
        ]);

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

        return redirect()->route('surat.preview', $surat->id)->with('success', 'Surat keterangan berhasil diperbarui.');
    }

    // ---------------------------------------------------------------
    // PREVIEW
    // ---------------------------------------------------------------
    public function preview(Request $request, string $id)
    {
        $data = Surat::find($id);

        if (!$data) {
            return redirect()->route('surat.index')->with('error', 'Data surat tidak ditemukan.');
        }

        $ttd = $request->query('ttd', 'kades');

        return view('pages.surat.preview', compact('data', 'id', 'ttd'));
    }

    // ---------------------------------------------------------------
    // PDF
    // ---------------------------------------------------------------
    public function pdf(Request $request, string $id)
    {
        $surat = Surat::findOrFail($id);

        $penandatanganKey = $request->query('ttd', 'kades');

        if ($penandatanganKey === 'kades') {
            $jabatan = 'Kepala Desa Pelang Lor';
            $nama    = 'HARIYANA';
        } else {
            $jabatan = 'Sekretaris Desa Pelang Lor';
            $nama    = 'DIDIK SUPRIYANTO';
        }

        $logoImagePath = null;
        $logoPath = public_path('images/Lambang_Kabupaten_Ngawi.png');
        if (file_exists($logoPath)) {
            $logoImagePath = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
        }

        $data = $surat->toArray();

        try {
            $pdf = Pdf::loadView('pages.surat.pdf', compact('data', 'jabatan', 'nama', 'logoImagePath'))
                ->setPaper('a4', 'portrait')
                ->setOption('margin_top', 25.4)
                ->setOption('margin_right', 25.4)
                ->setOption('margin_bottom', 25.4)
                ->setOption('margin_left', 25.4)
                ->setOption('isHtml5ParserEnabled', true)
                ->setOption('isRemoteEnabled', false);

            $filename = 'Surat_' . preg_replace('/[^a-zA-Z0-9]/', '_', $surat->nomor_surat) . '.pdf';

            return $pdf->download($filename);
        } catch (\Exception $e) {
            \Log::error('PDF Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memproses PDF: ' . $e->getMessage());
        }
    }

    // ---------------------------------------------------------------
    // HTML FOR JPG CAPTURE
    // ---------------------------------------------------------------
    public function html(Request $request, string $id)
    {
        $surat = Surat::findOrFail($id);

        $penandatanganKey = $request->query('ttd', 'kades');

        if ($penandatanganKey === 'kades') {
            $jabatan = 'Kepala Desa Pelang Lor';
            $nama    = 'HARIYANA';
        } else {
            $jabatan = 'Sekretaris Desa Pelang Lor';
            $nama    = 'DIDIK SUPRIYANTO';
        }

        $logoImagePath = null;
        $logoPath = public_path('images/Lambang_Kabupaten_Ngawi.png');
        if (file_exists($logoPath)) {
            $logoImagePath = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
        }

        $data = $surat->toArray();

        // Return the exact same view as PDF, but as HTML
        return view('pages.surat.pdf', compact('data', 'jabatan', 'nama', 'logoImagePath'));
    }

    // ---------------------------------------------------------------
    // JPG (Browsershot)
    // ---------------------------------------------------------------
    public function jpg(Request $request, string $id)
    {
        $data = Surat::find($id);

        if (!$data) {
            return redirect()->route('surat.index')
                ->with('error', 'Data surat tidak ditemukan.');
        }

        $ttd = $request->query('ttd', 'kades');

        if ($ttd === 'kades') {
            $jabatan = 'Kepala Desa Pelang Lor';
            $nama    = 'HARIYANA';
        } else {
            $jabatan = 'Sekretaris Desa Pelang Lor';
            $nama    = 'DIDIK SUPRIYANTO';
        }

        try {
            // Ubah logo menjadi Base64 string agar tidak menggunakan file:// (diblokir Browsershot)
            $logoData = base64_encode(file_get_contents(public_path('images/Lambang_Kabupaten_Ngawi.png')));
            $logoPath = 'data:image/png;base64,' . $logoData;

            // Render blade template ke HTML string
            $html = view('pages.surat.jpg', compact('data', 'jabatan', 'nama', 'logoPath'))->render();

            // Screenshot via Browsershot — langsung dari HTML string
            $browsershot = Browsershot::html($html)
                ->noSandbox()
                ->windowSize(794, 1123)
                ->waitUntilNetworkIdle()
                ->setDelay(500);

            // Set Chrome path dari .env atau auto-detect
            $chromePath = env('CHROME_PATH');
            if (!$chromePath) {
                // Auto-detect di Linux/Railway (nixpacks symlink + fallback paths)
                foreach ([
                    '/usr/local/bin/chromium',
                    '/usr/bin/chromium',
                    '/usr/bin/chromium-browser',
                    '/usr/bin/google-chrome',
                    '/run/current-system/sw/bin/chromium',
                ] as $path) {
                    if (file_exists($path)) {
                        $chromePath = $path;
                        break;
                    }
                }
            }
            if ($chromePath && file_exists($chromePath)) {
                $browsershot->setChromePath($chromePath);
            }

            // Set Node binary
            $nodePath = env('NODE_BINARY');
            if (!$nodePath) {
                // Cek /usr/local/bin dulu (symlink dari nixpacks), lalu which
                foreach (['/usr/local/bin/node', '/usr/bin/node'] as $p) {
                    if (file_exists($p)) { $nodePath = $p; break; }
                }
                if (!$nodePath) {
                    $nodePath = trim(shell_exec('which node 2>/dev/null') ?? '');
                }
            }
            if ($nodePath && file_exists($nodePath)) {
                $browsershot->setNodeBinary($nodePath);
            }

            // Set NPM binary
            $npmPath = env('NPM_BINARY');
            if (!$npmPath) {
                foreach (['/usr/local/bin/npm', '/usr/bin/npm'] as $p) {
                    if (file_exists($p)) { $npmPath = $p; break; }
                }
                if (!$npmPath) {
                    $npmPath = trim(shell_exec('which npm 2>/dev/null') ?? '');
                }
            }
            if ($npmPath && file_exists($npmPath)) {
                $browsershot->setNpmBinary($npmPath);
            }

            $jpgContent = $browsershot->screenshot();

            $filename = 'Surat_' . preg_replace('/[^a-zA-Z0-9]/', '_', $data['nomor_surat']) . '.jpg';

            return response($jpgContent)
                ->header('Content-Type', 'image/jpeg')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');

        } catch (\Exception $e) {
            \Log::error('JPG generation error: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuat JPG: ' . $e->getMessage());
        }
    }
}