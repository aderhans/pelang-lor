@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')

{{-- Overlay for mobile sidebar --}}
<div class="admin-sidebar-overlay" id="adminSidebarOverlay"></div>

<div class="admin-layout">

    {{-- MOBILE TOPBAR (visible on mobile only) --}}
    <div class="admin-mobile-toggle" id="adminSidebarToggle">
        <div class="admin-mobile-toggle__brand">
            <img src="{{ asset('images/Lambang_Kabupaten_Ngawi.png') }}" alt="Logo" style="width:30px;height:auto;opacity:0.9;">
            <div>
                <div class="admin-mobile-toggle__name">Desa Pelang Lor</div>
                <div class="admin-mobile-toggle__sub">Panel Admin</div>
            </div>
        </div>
        <div class="admin-mobile-hamburger" id="adminSidebarHamburger">
            <span></span>
            <span></span>
            <span></span>
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
            <a href="{{ route('admin.dashboard') }}" class="admin-sidebar__link admin-sidebar__link--active">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                Arsip Surat
            </a>
            <a href="{{ route('admin.berita.index') }}" class="admin-sidebar__link">
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

    {{-- MAIN CONTENT --}}
    <main class="admin-main">

        {{-- HEADER --}}
        <div class="admin-topbar">
            <div>
                <h1 class="admin-topbar__title">Arsip Surat Keterangan</h1>
                <p class="admin-topbar__sub">Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong> — {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
            </div>
        </div>

        {{-- STAT CARDS --}}
        <div class="admin-stats-grid" style="grid-template-columns: 1fr 1fr; margin-bottom: 24px;">
            <div class="admin-stat-card admin-stat-card--total">
                <div class="admin-stat-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
                </div>
                <div class="admin-stat-card__content">
                    <span class="admin-stat-card__label">Total Arsip Surat</span>
                    <span class="admin-stat-card__value">{{ $totalSurat }}</span>
                </div>
                <div class="admin-stat-card__trend">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>
                    {{ $hariIni }} surat masuk hari ini
                </div>
            </div>
        </div>

        {{-- FILTER & TABLE --}}
        <div class="admin-section">
            <div class="admin-section__head" style="margin-bottom: 20px;">
                <div>
                    <h2 class="admin-section__title">
                        <span class="admin-section__title-dot admin-section__title-dot--green"></span>
                        Daftar Arsip Surat
                    </h2>
                    <p class="admin-section__sub">Semua surat yang telah diarsipkan</p>
                </div>
            </div>

            <form action="{{ route('admin.dashboard') }}" method="GET" style="display: flex; gap: 16px; margin-bottom: 24px; align-items: flex-end;">
                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 500; font-size: 13px; color: #475569;">Filter Tanggal Keluar</label>
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}" onchange="this.form.submit()" style="padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                </div>
            </form>

            @if($surats->count() > 0)
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Tanggal Masuk</th>
                            <th>Nama & NIK</th>
                            <th>Jenis Surat</th>
                            <th>Nomor Surat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($surats as $sp)
                        <tr>
                            <td>
                                <div class="admin-table__date">{{ $sp->created_at->format('d M Y') }}</div>
                                <div class="admin-table__time">{{ $sp->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td>
                                <div class="admin-table__name">{{ $sp->nama }}</div>
                                <div class="admin-table__nik">NIK: {{ $sp->nik }}</div>
                            </td>
                            <td><span class="admin-badge admin-badge--info">{{ $sp->jenis_surat }}</span></td>
                            <td class="admin-table__nomor">{{ $sp->nomor_surat }}</td>
                            <td>
                                <div class="admin-table__actions">
                                    <a href="{{ route('surat.preview', $sp->id) }}" target="_blank" class="admin-action-btn admin-action-btn--view" title="Lihat Preview">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="admin-empty">
                <div class="admin-empty__icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <p class="admin-empty__title">Tidak ada arsip surat</p>
                <p class="admin-empty__sub">Data tidak ditemukan atau filter tidak cocok.</p>
            </div>
            @endif
        </div>

    </main>
</div>
@endsection
