<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // ---------------------------------------------------------------
    // PUBLIC — Halaman detail berita
    // ---------------------------------------------------------------
    public function show(string $slug)
    {
        $berita   = Berita::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $lainnya  = Berita::published()
            ->where('id', '!=', $berita->id)
            ->limit(3)
            ->get();

        return view('pages.berita.show', compact('berita', 'lainnya'));
    }

    // ---------------------------------------------------------------
    // ADMIN — Index
    // ---------------------------------------------------------------
    public function index()
    {
        $beritas = Berita::orderBy('tanggal', 'desc')->get();
        return view('pages.admin.berita.index', compact('beritas'));
    }

    // ---------------------------------------------------------------
    // ADMIN — Form Tambah
    // ---------------------------------------------------------------
    public function create()
    {
        return view('pages.admin.berita.form', ['berita' => null]);
    }

    // ---------------------------------------------------------------
    // ADMIN — Simpan Berita Baru
    // ---------------------------------------------------------------
    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'ringkasan'    => 'required|string|max:500',
            'isi'          => 'required|string',
            'tanggal'      => 'required|date',
            'gambar'       => 'nullable|image|max:3072', // maks 3 MB
            'is_published' => 'nullable|boolean',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create([
            'judul'        => $request->judul,
            'slug'         => Berita::generateSlug($request->judul),
            'ringkasan'    => $request->ringkasan,
            'isi'          => $request->isi,
            'gambar'       => $gambarPath,
            'tanggal'      => $request->tanggal,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    // ---------------------------------------------------------------
    // ADMIN — Form Edit
    // ---------------------------------------------------------------
    public function edit(Berita $berita)
    {
        return view('pages.admin.berita.form', compact('berita'));
    }

    // ---------------------------------------------------------------
    // ADMIN — Update Berita
    // ---------------------------------------------------------------
    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'ringkasan'    => 'required|string|max:500',
            'isi'          => 'required|string',
            'tanggal'      => 'required|date',
            'gambar'       => 'nullable|image|max:3072',
            'is_published' => 'nullable|boolean',
        ]);

        $gambarPath = $berita->gambar;
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($gambarPath) {
                Storage::disk('public')->delete($gambarPath);
            }
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update([
            'judul'        => $request->judul,
            'slug'         => Berita::generateSlug($request->judul, $berita->id),
            'ringkasan'    => $request->ringkasan,
            'isi'          => $request->isi,
            'gambar'       => $gambarPath,
            'tanggal'      => $request->tanggal,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    // ---------------------------------------------------------------
    // ADMIN — Toggle Published
    // ---------------------------------------------------------------
    public function togglePublish(Berita $berita)
    {
        $berita->update(['is_published' => !$berita->is_published]);

        return back()->with('success', $berita->is_published
            ? "Berita \"{$berita->judul}\" berhasil dipublikasikan."
            : "Berita \"{$berita->judul}\" disembunyikan dari publik."
        );
    }

    // ---------------------------------------------------------------
    // ADMIN — Hapus Berita
    // ---------------------------------------------------------------
    public function destroy(Berita $berita)
    {
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }
}
