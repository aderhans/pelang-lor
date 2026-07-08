@extends('layouts.app')
@section('title', 'Dashboard Admin')

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
            <a href="{{ route('admin.dashboard') }}" class="admin-sidebar__link admin-sidebar__link--active">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.surat.pending') }}" class="admin-sidebar__link">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                Surat Pending
                @if($menunggu > 0)
                    <span class="admin-sidebar__badge">{{ $menunggu }}</span>
                @endif
            </a>
            <a href="{{ route('admin.surat.list') }}" class="admin-sidebar__link">
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

        {{-- HEADER --}}
        <div class="admin-topbar">
            <div>
                <h1 class="admin-topbar__title">Dashboard Admin</h1>
                <p class="admin-topbar__sub">Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong> — {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
            </div>
            <div class="admin-topbar__actions">
                <a href="{{ route('admin.surat.pending') }}" class="admin-btn-cta">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Tinjau Pending ({{ $menunggu }})
                </a>
            </div>
        </div>

        {{-- STAT CARDS --}}
        <div class="admin-stats-grid">
            <div class="admin-stat-card admin-stat-card--total">
                <div class="admin-stat-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
                </div>
                <div class="admin-stat-card__content">
                    <span class="admin-stat-card__label">Total Surat Masuk</span>
                    <span class="admin-stat-card__value">{{ $totalSurat }}</span>
                </div>
                <div class="admin-stat-card__trend">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>
                    {{ $hariIni }} hari ini
                </div>
            </div>

            <div class="admin-stat-card admin-stat-card--pending">
                <div class="admin-stat-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div class="admin-stat-card__content">
                    <span class="admin-stat-card__label">Menunggu Persetujuan</span>
                    <span class="admin-stat-card__value">{{ $menunggu }}</span>
                </div>
                @if($menunggu > 0)
                <div class="admin-stat-card__trend admin-stat-card__trend--warn">
                    <span class="admin-stat-card__pulse"></span> Perlu ditinjau
                </div>
                @endif
            </div>

            <div class="admin-stat-card admin-stat-card--approved">
                <div class="admin-stat-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <div class="admin-stat-card__content">
                    <span class="admin-stat-card__label">Disetujui & Diarsipkan</span>
                    <span class="admin-stat-card__value">{{ $disetujui }}</span>
                </div>
                <div class="admin-stat-card__trend admin-stat-card__trend--green">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    Sudah diarsipkan
                </div>
            </div>

            <div class="admin-stat-card admin-stat-card--rejected">
                <div class="admin-stat-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                </div>
                <div class="admin-stat-card__content">
                    <span class="admin-stat-card__label">Ditolak</span>
                    <span class="admin-stat-card__value">{{ $ditolak }}</span>
                </div>
                <div class="admin-stat-card__trend">
                    Tidak diarsipkan
                </div>
            </div>
        </div>

        {{-- PENDING SURAT TABLE --}}
        <div class="admin-section">
            <div class="admin-section__head">
                <div>
                    <h2 class="admin-section__title">
                        <span class="admin-section__title-dot admin-section__title-dot--warn"></span>
                        Surat Menunggu Persetujuan
                    </h2>
                    <p class="admin-section__sub">Surat yang dikirim warga dan belum masuk arsip</p>
                </div>
                <a href="{{ route('admin.surat.pending') }}" class="admin-link-all">Lihat Semua →</a>
            </div>

            @if($suratPending->count() > 0)
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Tanggal Ajuan</th>
                            <th>Nama Pemohon</th>
                            <th>Jenis Surat</th>
                            <th>Nomor Surat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suratPending as $sp)
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
                                        Preview
                                    </a>
                                    <form action="{{ route('admin.surat.approve', $sp->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="admin-action-btn admin-action-btn--approve" title="Setujui & Arsipkan">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                            Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.surat.tolak', $sp->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="admin-action-btn admin-action-btn--reject" title="Tolak">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                            Tolak
                                        </button>
                                    </form>
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
                <p class="admin-empty__title">Tidak ada surat pending</p>
                <p class="admin-empty__sub">Semua surat sudah ditinjau</p>
            </div>
            @endif
        </div>

        {{-- ARSIP TERBARU --}}
        @if($suratTerbaru->count() > 0)
        <div class="admin-section">
            <div class="admin-section__head">
                <div>
                    <h2 class="admin-section__title">
                        <span class="admin-section__title-dot admin-section__title-dot--green"></span>
                        Arsip Surat Terbaru
                    </h2>
                    <p class="admin-section__sub">5 surat terakhir yang sudah disetujui</p>
                </div>
                <a href="{{ route('admin.surat.list') }}" class="admin-link-all">Lihat Semua Arsip →</a>
            </div>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Disetujui</th>
                            <th>Nama Pemohon</th>
                            <th>Jenis Surat</th>
                            <th>Nomor Surat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suratTerbaru as $st)
                        <tr>
                            <td>
                                <div class="admin-table__date">{{ $st->updated_at->format('d M Y') }}</div>
                            </td>
                            <td>
                                <div class="admin-table__name">{{ $st->nama }}</div>
                                <div class="admin-table__nik">NIK: {{ $st->nik }}</div>
                            </td>
                            <td><span class="admin-badge admin-badge--info">{{ $st->jenis_surat }}</span></td>
                            <td class="admin-table__nomor">{{ $st->nomor_surat }}</td>
                            <td>
                                <a href="{{ route('surat.preview', $st->id) }}" target="_blank" class="admin-action-btn admin-action-btn--view">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    Lihat Arsip
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

    </main>
</div>
@endsection
