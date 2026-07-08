@extends('layouts.app')
@section('title', 'Arsip Surat')

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
            <a href="{{ route('admin.surat.list') }}" class="admin-sidebar__link admin-sidebar__link--active">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
                Arsip Surat
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
                <h1 class="admin-topbar__title">Arsip Surat Resmi</h1>
                <p class="admin-topbar__sub">Daftar surat yang telah disetujui dan diarsipkan — total <strong>{{ $surats->count() }}</strong> surat</p>
            </div>
            <a href="{{ route('admin.surat.pending') }}" class="admin-btn-outline-sm">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                Tinjau Pending
            </a>
        </div>

        <div class="admin-info-bar">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            Hanya surat dengan status <strong>Disetujui</strong> yang tampil di sini. Surat pending dapat ditinjau di halaman <a href="{{ route('admin.surat.pending') }}">Surat Pending</a>.
        </div>

        <div class="admin-section">
            @if($surats->count() > 0)
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Tanggal Disetujui</th>
                            <th>Nama Pemohon</th>
                            <th>Jenis Surat</th>
                            <th>Nomor Surat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($surats as $i => $surat)
                        <tr>
                            <td class="admin-table__num">{{ $i + 1 }}</td>
                            <td>
                                <div class="admin-table__date">{{ $surat->updated_at->format('d M Y') }}</div>
                                <div class="admin-table__time">{{ $surat->updated_at->format('H:i') }} WIB</div>
                            </td>
                            <td>
                                <div class="admin-table__name">{{ $surat->nama }}</div>
                                <div class="admin-table__nik">NIK: {{ $surat->nik }}</div>
                            </td>
                            <td><span class="admin-badge admin-badge--info">{{ $surat->jenis_surat }}</span></td>
                            <td class="admin-table__nomor">{{ $surat->nomor_surat }}</td>
                            <td>
                                <a href="{{ route('surat.preview', $surat->id) }}" target="_blank" class="admin-action-btn admin-action-btn--view">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    Lihat Arsip
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="admin-empty">
                <div class="admin-empty__icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
                </div>
                <p class="admin-empty__title">Arsip masih kosong</p>
                <p class="admin-empty__sub">Belum ada surat yang disetujui. Tinjau surat pending terlebih dahulu.</p>
                <a href="{{ route('admin.surat.pending') }}" class="admin-btn-cta" style="margin-top: 20px; display: inline-flex;">Tinjau Surat Pending</a>
            </div>
            @endif
        </div>

    </main>
</div>
@endsection
