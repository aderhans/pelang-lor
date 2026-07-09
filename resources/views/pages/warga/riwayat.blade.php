@extends('layouts.app')
@section('title', 'Riwayat Surat')
@section('meta_description', 'Riwayat pengajuan surat keterangan warga Desa Pelang Lor.')
@section('content')

<div class="page-hero page-hero--primary">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('landing') }}">Beranda</a>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Riwayat Surat</span>
        </nav>
        <h1 class="page-hero__title">Riwayat Pengajuan Surat</h1>
        <p class="page-hero__desc">Daftar surat keterangan yang pernah Anda ajukan beserta statusnya.</p>
    </div>
</div>

<section class="how" style="background: #f8f9fa;">
    <div class="container">

        @if(session('success'))
            <div style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.2); color: #10b981; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px; display:flex; align-items:center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #ef4444; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px; display:flex; align-items:center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ session('error') }}
            </div>
        @endif

        @if(count($riwayatSurat) > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                    <thead>
                        <tr style="background: #f1f5f9; text-align: left;">
                            <th style="padding: 16px; color: #334155; font-weight: 600;">Nomor Surat / Jenis</th>
                            <th style="padding: 16px; color: #334155; font-weight: 600;">Tanggal Pengajuan</th>
                            <th style="padding: 16px; color: #334155; font-weight: 600;">Status</th>
                            <th style="padding: 16px; color: #334155; font-weight: 600; text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayatSurat as $surat)
                        <tr style="border-top: 1px solid #e2e8f0;">
                            <td style="padding: 16px;">
                                <div style="font-weight: 600; color: #0f172a;">{{ $surat->jenis_surat }}</div>
                                <div style="font-size: 13px; color: #64748b;">{{ $surat->nomor_surat }}</div>
                            </td>
                            <td style="padding: 16px; color: #475569;">{{ $surat->created_at->format('d M Y, H:i') }}</td>
                            <td style="padding: 16px;">
                                @if($surat->status === 'Menunggu')
                                    <span style="display:inline-flex; align-items:center; gap:6px; background:#fef3c7; color:#d97706; padding:4px 10px; border-radius:20px; font-size:13px; font-weight:600;"><span style="width:6px;height:6px;border-radius:50%;background:#d97706;"></span>Menunggu</span>
                                @elseif($surat->status === 'Disetujui')
                                    <span style="display:inline-flex; align-items:center; gap:6px; background:#d1fae5; color:#059669; padding:4px 10px; border-radius:20px; font-size:13px; font-weight:600;"><span style="width:6px;height:6px;border-radius:50%;background:#059669;"></span>Disetujui</span>
                                @else
                                    <span style="display:inline-flex; align-items:center; gap:6px; background:#fee2e2; color:#dc2626; padding:4px 10px; border-radius:20px; font-size:13px; font-weight:600;"><span style="width:6px;height:6px;border-radius:50%;background:#dc2626;"></span>Ditolak</span>
                                @endif
                            </td>
                            <td style="padding: 16px; text-align: right;">
                                @if($surat->status === 'Menunggu')
                                    <a href="{{ route('surat.edit', $surat->id) }}" style="display:inline-flex; align-items:center; gap:6px; padding:8px 16px; background:#f1f5f9; color:#475569; border-radius:6px; text-decoration:none; font-size:13px; font-weight:600; transition:0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                        Edit Surat
                                    </a>
                                @elseif($surat->status === 'Disetujui')
                                    <a href="{{ route('surat.preview', $surat->id) }}" style="display:inline-flex; align-items:center; gap:6px; padding:8px 16px; background:#10b981; color:#fff; border-radius:6px; text-decoration:none; font-size:13px; font-weight:600; transition:0.2s;" onmouseover="this.style.background='#059669'" onmouseout="this.style.background='#10b981'">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                        Lihat Detail
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align: center; padding: 40px 20px; background: #fff; border-radius: 12px; border: 1px dashed #cbd5e1;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" style="margin: 0 auto 12px;"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                <h3 style="font-size: 16px; color: #334155; margin-bottom: 4px;">Belum Ada Riwayat Surat</h3>
                <p style="color: #64748b; font-size: 14px; margin-bottom: 16px;">Anda belum pernah mengajukan surat keterangan. Ajukan sekarang untuk kebutuhan Anda.</p>
                <a href="{{ route('surat.index') }}" class="btn-primary-hero" style="display: inline-flex; font-size: 14px; padding: 10px 20px;">Buat Surat Keterangan</a>
            </div>
        @endif
    </div>
</section>

@endsection
