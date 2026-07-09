<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Surat;

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

    // ---------------------------------------------------------------
    // DOWNLOAD JPG — screenshot HTML via Browsershot (identik dengan preview)
    // ---------------------------------------------------------------
    public function download(string $id, Request $request)
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
        $jpgContent = Browsershot::html($html)
            ->setChromePath('C:\\Users\\ASUS\\.cache\\puppeteer\\chrome\\win64-150.0.7871.24\\chrome-win64\\chrome.exe')
            ->setNodeBinary('C:\\Program Files\\nodejs\\node.exe')
            ->setNpmBinary('C:\\Program Files\\nodejs\\npm.cmd')
            ->noSandbox()
            ->windowSize(794, 1123)
            ->waitUntilNetworkIdle()
            ->screenshot();

        $filename = 'Surat_' . preg_replace('/[^a-zA-Z0-9]/', '_', $data['nomor_surat']) . '.jpg';

        return response($jpgContent)
            ->header('Content-Type', 'image/jpeg')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    // ---------------------------------------------------------------
    // DOWNLOAD PDF — generate PDF menggunakan DomPDF
    // ---------------------------------------------------------------
    public function downloadPdf(string $id, Request $request)
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

        $pdf = Pdf::loadView('pages.surat.pdf', compact('data', 'jabatan', 'nama'))
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

        $filename = 'Surat_' . preg_replace('/[^a-zA-Z0-9]/', '_', $data['nomor_surat']) . '.pdf';

        return $pdf->download($filename);
    }
}
