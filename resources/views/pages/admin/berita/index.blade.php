@extends('layouts.app')
@section('title', 'Kelola Berita Desa')

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
                <h1 class="admin-topbar__title">Kelola Berita Desa</h1>
                <p class="admin-topbar__sub">Tambah, edit, dan atur publikasi berita yang tampil di halaman beranda.</p>
            </div>
            <div class="admin-topbar__actions">
                <a href="{{ route('admin.berita.create') }}" class="admin-btn-cta">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Tambah Berita
                </a>
            </div>
        </div>

        {{-- Flash --}}
        @if(session('success'))
        <div class="flash" style="background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:14px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;font-size:14px;font-weight:600;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- TABEL BERITA --}}
        <div class="admin-section">
            @if($beritas->isEmpty())
                <div style="text-align:center;padding:60px 20px;background:#fff;border-radius:16px;border:1px solid #e2e8f0;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" style="margin-bottom:16px;"><path d="M4 6h16M4 12h16M4 18h7"/></svg>
                    <p style="color:#64748b;font-size:15px;margin:0;">Belum ada berita. Mulai dengan menambah berita pertama!</p>
                    <a href="{{ route('admin.berita.create') }}" class="admin-btn-cta" style="display:inline-flex;margin-top:20px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Tambah Berita Pertama
                    </a>
                </div>
            @else
            <div class="admin-table-wrap">
                <table class="admin-table" style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th style="text-align:left;padding:12px 16px;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;background:#f8fafc;border-bottom:1px solid #e2e8f0;">Gambar</th>
                            <th style="text-align:left;padding:12px 16px;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;background:#f8fafc;border-bottom:1px solid #e2e8f0;">Judul / Ringkasan</th>
                            <th style="text-align:left;padding:12px 16px;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;background:#f8fafc;border-bottom:1px solid #e2e8f0;">Tanggal</th>
                            <th style="text-align:center;padding:12px 16px;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;background:#f8fafc;border-bottom:1px solid #e2e8f0;">Status</th>
                            <th style="text-align:center;padding:12px 16px;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;background:#f8fafc;border-bottom:1px solid #e2e8f0;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($beritas as $item)
                        <tr style="border-bottom:1px solid #f1f5f9;transition:background .15s;" onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background=''">
                            <td style="padding:14px 16px;width:70px;">
                                @if($item->gambar)
                                    <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}"
                                         style="width:60px;height:44px;object-fit:cover;border-radius:8px;display:block;">
                                @else
                                    <div style="width:60px;height:44px;background:linear-gradient(135deg,#e2e8f0,#cbd5e1);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                    </div>
                                @endif
                            </td>
                            <td style="padding:14px 16px;">
                                <p style="font-weight:600;color:#0f172a;margin:0 0 4px;font-size:14px;">{{ $item->judul }}</p>
                                <p style="color:#64748b;font-size:13px;margin:0;max-width:380px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $item->ringkasan }}</p>
                            </td>
                            <td style="padding:14px 16px;color:#475569;font-size:13px;white-space:nowrap;">
                                {{ $item->tanggal->locale('id')->isoFormat('D MMMM YYYY') }}
                            </td>
                            <td style="padding:14px 16px;text-align:center;">
                                <form action="{{ route('admin.berita.toggle', $item) }}" method="POST" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" style="border:none;cursor:pointer;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;transition:all .2s;
                                        {{ $item->is_published
                                            ? 'background:#d1fae5;color:#065f46;'
                                            : 'background:#fee2e2;color:#991b1b;' }}">
                                        {{ $item->is_published ? '✓ Dipublish' : '✗ Tersembunyi' }}
                                    </button>
                                </form>
                            </td>
                            <td style="padding:14px 16px;text-align:center;white-space:nowrap;">
                                <a href="{{ route('admin.berita.edit', $item) }}"
                                   style="display:inline-flex;align-items:center;gap:5px;padding:6px 14px;background:#f1f5f9;color:#475569;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;margin-right:6px;transition:all .2s;"
                                   onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.berita.destroy', $item) }}" method="POST" style="display:inline;"
                                      onsubmit="return confirm('Hapus berita ini? Tindakan tidak bisa dibatalkan.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="display:inline-flex;align-items:center;gap:5px;padding:6px 14px;background:#fee2e2;color:#991b1b;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;transition:all .2s;"
                                            onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fee2e2'">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>

    </main>
</div>

@endsection
