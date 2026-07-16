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
        $year        = date('Y');
        $counterFile = storage_path('app/surat/counter.txt');

        if (!file_exists(storage_path('app/surat'))) {
            mkdir(storage_path('app/surat'), 0775, true);
        }

        $counter = file_exists($counterFile) ? (int) file_get_contents($counterFile) + 1 : 0;
        file_put_contents($counterFile, $counter);

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
            'nik' => 'required|string|size:16',
            'tanggal' => 'nullable|date',
        ], [
            'nik.required' => 'NIK wajib diisi untuk melihat riwayat surat.',
            'nik.size' => 'NIK harus 16 digit angka.',
        ]);

        $query = Surat::where('nik', $request->nik);

        if ($request->filled('tanggal')) {
            // Karena tanggal di db disimpan sbg string (format_tanggal_indo / teks),
            // kita gunakan created_at untuk pencarian filter tanggal
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
            'jenis_surat'   => 'required|string|max:100',
            'nama'          => 'required|string|max:255',
            'nik'           => 'required|digits:16',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'kewarganegaraan' => 'required|string|max:50',
            'agama'         => 'required|string|max:50',
            'pekerjaan'     => 'required|string|max:100',
            'keperluan'     => 'required|string|max:300',
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

        $pdf = Pdf::loadView('pages.surat.pdf', compact('data', 'jabatan', 'nama', 'logoImagePath'))
            ->setPaper('a4', 'portrait')
            ->setOption('margin_top', 25.4)
            ->setOption('margin_right', 25.4)
            ->setOption('margin_bottom', 25.4)
            ->setOption('margin_left', 25.4)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);

        return $pdf->download('Surat_' . preg_replace('/[^a-zA-Z0-9]/', '_', $surat->nomor_surat) . '.pdf');
    }

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

        // Ubah logo menjadi Base64 string agar tidak menggunakan file:// (diblokir Browsershot)
        $logoData = base64_encode(file_get_contents(public_path('images/Lambang_Kabupaten_Ngawi.png')));
        $logoPath = 'data:image/png;base64,' . $logoData;

        // Render blade template ke HTML string
        $html = view('pages.surat.jpg', compact('data', 'jabatan', 'nama', 'logoPath'))->render();

        // Screenshot via Browsershot — langsung dari HTML string
        // Path Chrome/Node dibaca dari .env agar bisa pindah hosting kapan saja
        $browsershot = Browsershot::html($html)
            ->noSandbox()
            ->windowSize(794, 1123)
            ->waitUntilNetworkIdle();

        // Set Chrome path jika tersedia di environment (untuk semua OS & hosting)
        if (env('CHROME_PATH')) {
            $browsershot->setChromePath(env('CHROME_PATH'));
        }

        // Set Node & NPM path jika tersedia di environment
        if (env('NODE_BINARY')) {
            $browsershot->setNodeBinary(env('NODE_BINARY'));
        }
        if (env('NPM_BINARY')) {
            $browsershot->setNpmBinary(env('NPM_BINARY'));
        }

        $jpgContent = $browsershot->screenshot();

        $filename = 'Surat_' . preg_replace('/[^a-zA-Z0-9]/', '_', $data['nomor_surat']) . '.jpg';

        return response($jpgContent)
            ->header('Content-Type', 'image/jpeg')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}