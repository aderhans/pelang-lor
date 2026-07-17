@extends('layouts.app')
@section('title', isset($berita) ? 'Edit Berita' : 'Tambah Berita Baru')

@section('content')

{{-- Overlay for mobile sidebar --}}
<div class="admin-sidebar-overlay" id="adminSidebarOverlay"></div>

<div class="admin-layout">

    {{-- MOBILE TOPBAR --}}
    <div class="admin-mobile-toggle" id="adminSidebarToggle">
        <div class="admin-mobile-toggle__brand">
            <img src="{{ asset('images/Lambang_Kabupaten_Ngawi.png') }}" alt="Logo" style="width:30px;height:auto;opacity:0.9;">
            <div>
                <div class="admin-mobile-toggle__name">Desa Pelang Lor</div>
                <div class="admin-mobile-toggle__sub">Panel Admin</div>
            </div>
        </div>
        <div class="admin-mobile-hamburger" id="adminSidebarHamburger">
            <span></span><span></span><span></span>
        </div>
    </div>

    {{-- SIDEBAR --}}
    <aside class="admin-sidebar">
        <div class="admin-sidebar__brand">
            <div class="admin-sidebar__logo">
                <img src="{{ asset('images/Lambang_Kabupaten_Ngawi.png') }}" alt="Logo" style="width:36px;height:auto;">
            </div>
            <div>
                <p class="admin-sidebar__desa">Pelang Lor</p>
                <p class="admin-sidebar__sub">Panel Admin</p>
            </div>
        </div>

        <nav class="admin-sidebar__nav">
            <a href="{{ route('admin.dashboard') }}" class="admin-sidebar__link">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                Arsip Surat
            </a>
            <a href="{{ route('admin.berita.index') }}" class="admin-sidebar__link admin-sidebar__link--active">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h7"/><circle cx="18" cy="18" r="4"/><path d="M18 16v2l1 1"/></svg>
                Kelola Berita
            </a>
        </nav>

        <div class="admin-sidebar__footer">
            <div class="admin-sidebar__user">
                <div class="admin-sidebar__avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <p class="admin-sidebar__user-name">{{ auth()->user()->name }}</p>
                    <p class="admin-sidebar__user-role">Administrator</p>
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="admin-sidebar__logout" title="Logout">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <main class="admin-main">

        <div class="admin-topbar">
            <div>
                <h1 class="admin-topbar__title">{{ isset($berita) ? 'Edit Berita' : 'Tambah Berita Baru' }}</h1>
                <p class="admin-topbar__sub">{{ isset($berita) ? 'Perbarui informasi berita yang sudah ada.' : 'Tulis dan publikasikan berita desa terbaru.' }}</p>
            </div>
            <div class="admin-topbar__actions">
                <a href="{{ route('admin.berita.index') }}" class="admin-btn-outline-sm">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ isset($berita) ? route('admin.berita.update', $berita) : route('admin.berita.store') }}"
              method="POST" enctype="multipart/form-data"
              style="display:grid;grid-template-columns:1fr 340px;gap:24px;align-items:start;">
            @csrf
            @if(isset($berita)) @method('PUT') @endif

            {{-- LEFT: Konten Utama --}}
            <div style="display:flex;flex-direction:column;gap:20px;">

                {{-- Judul --}}
                <div style="background:#fff;border-radius:16px;padding:28px;border:1px solid #e2e8f0;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <label style="display:block;font-size:13px;font-weight:700;color:#374151;margin-bottom:8px;" for="judul">
                        Judul Berita <span style="color:#dc2626;">*</span>
                    </label>
                    <input type="text" id="judul" name="judul"
                           value="{{ old('judul', $berita->judul ?? '') }}"
                           placeholder="Contoh: Gotong Royong Pembersihan Desa"
                           required
                           style="width:100%;padding:12px 16px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:15px;font-family:inherit;box-sizing:border-box;outline:none;transition:border-color .2s;"
                           onfocus="this.style.borderColor='#800000'" onblur="this.style.borderColor='#e2e8f0'">
                    @error('judul') <p style="color:#dc2626;font-size:13px;margin:6px 0 0;">{{ $message }}</p> @enderror
                </div>

                {{-- Ringkasan --}}
                <div style="background:#fff;border-radius:16px;padding:28px;border:1px solid #e2e8f0;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <label style="display:block;font-size:13px;font-weight:700;color:#374151;margin-bottom:8px;" for="ringkasan">
                        Ringkasan <span style="color:#dc2626;">*</span>
                        <span style="font-weight:400;color:#64748b;font-size:12px;"> — Tampil di halaman beranda (maks. 500 karakter)</span>
                    </label>
                    <textarea id="ringkasan" name="ringkasan" rows="3" maxlength="500" required
                              placeholder="Deskripsi singkat yang menarik perhatian pembaca..."
                              style="width:100%;padding:12px 16px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:14px;font-family:inherit;box-sizing:border-box;outline:none;resize:vertical;transition:border-color .2s;"
                              onfocus="this.style.borderColor='#800000'" onblur="this.style.borderColor='#e2e8f0'">{{ old('ringkasan', $berita->ringkasan ?? '') }}</textarea>
                    @error('ringkasan') <p style="color:#dc2626;font-size:13px;margin:6px 0 0;">{{ $message }}</p> @enderror
                </div>

                {{-- Isi Lengkap --}}
                <div style="background:#fff;border-radius:16px;padding:28px;border:1px solid #e2e8f0;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <label style="display:block;font-size:13px;font-weight:700;color:#374151;margin-bottom:8px;" for="isi">
                        Isi Berita Lengkap <span style="color:#dc2626;">*</span>
                    </label>
                    <textarea id="isi" name="isi" rows="14" required
                              placeholder="Tulis isi berita selengkapnya di sini..."
                              style="width:100%;padding:12px 16px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:14px;font-family:inherit;box-sizing:border-box;outline:none;resize:vertical;line-height:1.7;transition:border-color .2s;"
                              onfocus="this.style.borderColor='#800000'" onblur="this.style.borderColor='#e2e8f0'">{{ old('isi', $berita->isi ?? '') }}</textarea>
                    @error('isi') <p style="color:#dc2626;font-size:13px;margin:6px 0 0;">{{ $message }}</p> @enderror
                </div>

            </div>

            {{-- RIGHT: Pengaturan --}}
            <div style="display:flex;flex-direction:column;gap:20px;">

                {{-- Publish & Simpan --}}
                <div style="background:#fff;border-radius:16px;padding:24px;border:1px solid #e2e8f0;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <p style="font-size:13px;font-weight:700;color:#374151;margin:0 0 16px;">Publikasi</p>

                    <label style="display:flex;align-items:center;gap:12px;cursor:pointer;padding:12px;background:#f8fafc;border-radius:10px;border:1.5px solid #e2e8f0;margin-bottom:16px;">
                        <input type="checkbox" name="is_published" value="1" id="is_published"
                               {{ old('is_published', $berita->is_published ?? false) ? 'checked' : '' }}
                               style="width:18px;height:18px;accent-color:#800000;cursor:pointer;">
                        <div>
                            <span style="font-size:14px;font-weight:600;color:#0f172a;">Publikasikan Sekarang</span>
                            <p style="font-size:12px;color:#64748b;margin:2px 0 0;">Berita akan langsung tampil di beranda</p>
                        </div>
                    </label>

                    <button type="submit" class="admin-btn-cta" style="width:100%;justify-content:center;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ isset($berita) ? 'Simpan Perubahan' : 'Tambah Berita' }}
                    </button>
                </div>

                {{-- Tanggal --}}
                <div style="background:#fff;border-radius:16px;padding:24px;border:1px solid #e2e8f0;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <label style="display:block;font-size:13px;font-weight:700;color:#374151;margin-bottom:8px;" for="tanggal">
                        Tanggal Terbit <span style="color:#dc2626;">*</span>
                    </label>
                    <input type="date" id="tanggal" name="tanggal"
                           value="{{ old('tanggal', isset($berita) ? $berita->tanggal->format('Y-m-d') : date('Y-m-d')) }}"
                           required
                           style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:14px;font-family:inherit;box-sizing:border-box;outline:none;transition:border-color .2s;"
                           onfocus="this.style.borderColor='#800000'" onblur="this.style.borderColor='#e2e8f0'">
                    @error('tanggal') <p style="color:#dc2626;font-size:13px;margin:6px 0 0;">{{ $message }}</p> @enderror
                </div>

                {{-- Gambar --}}
                <div style="background:#fff;border-radius:16px;padding:24px;border:1px solid #e2e8f0;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <label style="display:block;font-size:13px;font-weight:700;color:#374151;margin-bottom:8px;" for="gambar">
                        Foto/Gambar Berita
                        <span style="font-weight:400;color:#64748b;font-size:12px;"> — Maks 3 MB</span>
                    </label>

                    {{-- Preview gambar saat ini --}}
                    @if(isset($berita) && $berita->gambar)
                    <div style="margin-bottom:12px;">
                        <img src="{{ Storage::url($berita->gambar) }}" alt="Gambar saat ini"
                             id="imgPreviewCurrent"
                             style="width:100%;height:140px;object-fit:cover;border-radius:10px;display:block;">
                        <p style="font-size:12px;color:#64748b;margin:6px 0 0;">Gambar saat ini. Upload baru untuk mengganti.</p>
                    </div>
                    @endif

                    {{-- Drop area --}}
                    <label id="dropZone" for="gambar" style="display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;padding:24px 16px;border:2px dashed #e2e8f0;border-radius:10px;cursor:pointer;transition:all .2s;"
                           onmouseover="this.style.borderColor='#800000';this.style.background='#fff5f5'"
                           onmouseout="this.style.borderColor='#e2e8f0';this.style.background=''">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        <span style="font-size:13px;color:#64748b;text-align:center;">Klik untuk pilih gambar<br><span style="font-size:11px;">JPG, PNG, WebP</span></span>
                        <img id="imgPreviewNew" src="" alt="" style="display:none;width:100%;height:140px;object-fit:cover;border-radius:10px;margin-top:8px;">
                    </label>
                    <input type="file" id="gambar" name="gambar" accept="image/*" style="display:none;"
                           onchange="previewImage(this)">
                    @error('gambar') <p style="color:#dc2626;font-size:13px;margin:6px 0 0;">{{ $message }}</p> @enderror
                </div>

            </div>
        </form>

    </main>
</div>

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('imgPreviewNew');
            preview.src = e.target.result;
            preview.style.display = 'block';
            // Sembunyikan gambar saat ini jika ada
            const curr = document.getElementById('imgPreviewCurrent');
            if (curr) curr.style.opacity = '0.4';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush

@endsection
