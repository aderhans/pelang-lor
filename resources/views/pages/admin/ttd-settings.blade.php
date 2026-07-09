@extends('layouts.app')
@section('title', 'Pengaturan TTD & Stempel')

@section('content')
<div class="admin-layout">

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
                Dashboard
            </a>
            <a href="{{ route('admin.surat.pending') }}" class="admin-sidebar__link">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                Surat Pending
            </a>
            <a href="{{ route('admin.surat.list') }}" class="admin-sidebar__link">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
                Arsip Surat
            </a>
            <a href="{{ route('admin.ttd.settings') }}" class="admin-sidebar__link admin-sidebar__link--active">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                Pengaturan TTD
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

    {{-- MAIN CONTENT --}}
    <main class="admin-main">

        <div class="admin-topbar">
            <div>
                <h1 class="admin-topbar__title">Pengaturan Tanda Tangan & Stempel</h1>
                <p class="admin-topbar__sub">Upload gambar TTD dan stempel desa yang akan dicetak otomatis pada surat yang disetujui.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="admin-info-bar admin-info-bar--success" style="background: rgba(16,185,129,0.1); border-color: rgba(16,185,129,0.2); color: #059669; margin: 0 32px 20px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="admin-info-bar admin-info-bar--warn" style="margin: 0 32px 20px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ session('error') }}
            </div>
        @endif

        <div class="admin-info-bar admin-info-bar--warn" style="margin-bottom: 24px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Gunakan gambar <strong>PNG dengan background transparan</strong> untuk hasil terbaik. Gambar TTD sebaiknya berukuran ±300×150px dan stempel ±300×300px.
        </div>

        <div class="admin-section">
            {{-- KEPALA DESA --}}
            @php $kades = $settings->get('kades'); @endphp
            <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 28px; margin-bottom: 24px;">
                <h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">Kepala Desa</h2>
                <p style="font-size: 14px; color: #64748b; margin-bottom: 20px;">{{ $kades ? $kades->nama_pejabat : 'HARIYANA' }} — {{ $kades ? $kades->jabatan_label : 'Kepala Desa Pelang Lor' }}</p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 20px;">
                    {{-- Preview TTD --}}
                    <div>
                        <p style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 8px;">Gambar Tanda Tangan (TTD)</p>
                        <div style="border: 2px dashed #cbd5e1; border-radius: 8px; padding: 16px; text-align: center; background: #f8fafc; min-height: 100px; display: flex; align-items: center; justify-content: center;">
                            @if($kades && $kades->path_ttd)
                                <img src="{{ asset('storage/' . $kades->path_ttd) }}" alt="TTD Kades" style="max-height: 80px; max-width: 100%; object-fit: contain;">
                            @else
                                <p style="color: #94a3b8; font-size: 13px;">Belum ada gambar TTD</p>
                            @endif
                        </div>
                    </div>
                    {{-- Preview Stempel --}}
                    <div>
                        <p style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 8px;">Gambar Stempel Desa</p>
                        <div style="border: 2px dashed #cbd5e1; border-radius: 8px; padding: 16px; text-align: center; background: #f8fafc; min-height: 100px; display: flex; align-items: center; justify-content: center;">
                            @if($kades && $kades->path_stempel)
                                <img src="{{ asset('storage/' . $kades->path_stempel) }}" alt="Stempel" style="max-height: 80px; max-width: 100%; object-fit: contain;">
                            @else
                                <p style="color: #94a3b8; font-size: 13px;">Belum ada gambar stempel</p>
                            @endif
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.ttd.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="jabatan_key" value="kades">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">Upload TTD Baru (PNG/JPG)</label>
                            <input type="file" name="ttd_image" accept="image/png,image/jpeg" style="width: 100%; font-size: 13px; padding: 8px; border: 1px solid #e2e8f0; border-radius: 6px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">Upload Stempel Baru (PNG/JPG)</label>
                            <input type="file" name="stempel_image" accept="image/png,image/jpeg" style="width: 100%; font-size: 13px; padding: 8px; border: 1px solid #e2e8f0; border-radius: 6px; background: #fff;">
                        </div>
                    </div>
                    <button type="submit" class="admin-btn-cta" style="padding: 10px 24px; font-size: 14px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        Simpan Pengaturan Kepala Desa
                    </button>
                </form>
            </div>

            {{-- SEKRETARIS DESA --}}
            @php $sekdes = $settings->get('sekdes'); @endphp
            <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 28px;">
                <h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">Sekretaris Desa</h2>
                <p style="font-size: 14px; color: #64748b; margin-bottom: 20px;">{{ $sekdes ? $sekdes->nama_pejabat : 'DIDIK SUPRIYANTO' }} — {{ $sekdes ? $sekdes->jabatan_label : 'Sekretaris Desa Pelang Lor' }}</p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 20px;">
                    <div>
                        <p style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 8px;">Gambar Tanda Tangan (TTD)</p>
                        <div style="border: 2px dashed #cbd5e1; border-radius: 8px; padding: 16px; text-align: center; background: #f8fafc; min-height: 100px; display: flex; align-items: center; justify-content: center;">
                            @if($sekdes && $sekdes->path_ttd)
                                <img src="{{ asset('storage/' . $sekdes->path_ttd) }}" alt="TTD Sekdes" style="max-height: 80px; max-width: 100%; object-fit: contain;">
                            @else
                                <p style="color: #94a3b8; font-size: 13px;">Belum ada gambar TTD</p>
                            @endif
                        </div>
                    </div>
                    <div>
                        <p style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 8px;">Gambar Stempel Desa</p>
                        <div style="border: 2px dashed #cbd5e1; border-radius: 8px; padding: 16px; text-align: center; background: #f8fafc; min-height: 100px; display: flex; align-items: center; justify-content: center;">
                            @if($sekdes && $sekdes->path_stempel)
                                <img src="{{ asset('storage/' . $sekdes->path_stempel) }}" alt="Stempel" style="max-height: 80px; max-width: 100%; object-fit: contain;">
                            @else
                                <p style="color: #94a3b8; font-size: 13px;">Belum ada gambar stempel</p>
                            @endif
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.ttd.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="jabatan_key" value="sekdes">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">Upload TTD Baru (PNG/JPG)</label>
                            <input type="file" name="ttd_image" accept="image/png,image/jpeg" style="width: 100%; font-size: 13px; padding: 8px; border: 1px solid #e2e8f0; border-radius: 6px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">Upload Stempel Baru (PNG/JPG)</label>
                            <input type="file" name="stempel_image" accept="image/png,image/jpeg" style="width: 100%; font-size: 13px; padding: 8px; border: 1px solid #e2e8f0; border-radius: 6px; background: #fff;">
                        </div>
                    </div>
                    <button type="submit" class="admin-btn-cta" style="padding: 10px 24px; font-size: 14px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        Simpan Pengaturan Sekretaris Desa
                    </button>
                </form>
            </div>
        </div>

    </main>
</div>
@endsection
