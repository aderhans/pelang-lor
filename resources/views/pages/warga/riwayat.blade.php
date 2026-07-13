@extends('layouts.app')
@section('title', 'Cek Riwayat Surat')
@section('meta_description', 'Cari dan cek riwayat pengajuan surat keterangan warga Desa Pelang Lor berdasarkan NIK.')
@section('content')

<div class="page-hero page-hero--primary">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('landing') }}">Beranda</a>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Cek Riwayat Surat</span>
        </nav>
        <h1 class="page-hero__title">Cek Riwayat Surat</h1>
        <p class="page-hero__desc">Silakan masukkan NIK Anda untuk melihat daftar surat keterangan yang pernah Anda buat.</p>
    </div>
</div>

<section class="how" style="background: #f8f9fa;">
    <div class="container">

        @if($errors->any())
            <div style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #ef4444; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('surat.riwayat.cari') }}" method="POST" style="background: #fff; padding: 24px; border-radius: 12px; margin-bottom: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
            @csrf
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; align-items: end;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color:#334155;">NIK Warga</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" required placeholder="Masukkan NIK 16 digit" pattern="\d{16}" maxlength="16" title="NIK harus 16 digit angka" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size:14px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color:#334155;">Tanggal Dikeluarkan (Opsional)</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal') }}" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size:14px;">
                </div>
                <div>
                    <button type="submit" class="btn-maroon-hero" style="width:100%; padding: 12px 24px;">Cari Surat</button>
                </div>
            </div>
        </form>

        @if(isset($riwayatSurat) && count($riwayatSurat) > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                    <thead>
                        <tr style="background: #f1f5f9; text-align: left;">
                            <th style="padding: 16px; color: #334155; font-weight: 600;">Data Pemohon</th>
                            <th style="padding: 16px; color: #334155; font-weight: 600;">Nomor Surat / Jenis</th>
                            <th style="padding: 16px; color: #334155; font-weight: 600;">Tanggal Pembuatan</th>
                            <th style="padding: 16px; color: #334155; font-weight: 600; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayatSurat as $surat)
                        <tr style="border-top: 1px solid #e2e8f0;">
                            <td style="padding: 16px;">
                                <div style="font-weight: 600; color: #0f172a;">{{ $surat->nama }}</div>
                                <div style="font-size: 12px; color: #64748b; margin-top: 2px;">NIK: {{ $surat->nik }}</div>
                            </td>
                            <td style="padding: 16px;">
                                <div style="font-weight: 600; color: #0f172a;">{{ $surat->jenis_surat }}</div>
                                <div style="font-size: 13px; color: #64748b;">{{ $surat->nomor_surat }}</div>
                            </td>
                            <td style="padding: 16px; color: #475569;">{{ $surat->created_at->format('d M Y, H:i') }}</td>
                            <td style="padding: 16px; text-align: center;">
                                <a href="{{ route('surat.preview', ['id' => $surat->id, 'from' => 'riwayat']) }}" style="display:inline-flex; align-items:center; gap:6px; padding:8px 16px; background:#10b981; color:#fff; border-radius:6px; text-decoration:none; font-size:13px; font-weight:600; transition:0.2s;" onmouseover="this.style.background='#059669'" onmouseout="this.style.background='#10b981'">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    Lihat Detail / Unduh
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif(request()->isMethod('post'))
            <div style="text-align: center; padding: 40px 20px; background: #fff; border-radius: 12px; border: 1px dashed #cbd5e1;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" style="margin: 0 auto 12px;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <h3 style="font-size: 16px; color: #334155; margin-bottom: 4px;">Tidak Ada Hasil</h3>
                <p style="color: #64748b; font-size: 14px;">Tidak ditemukan surat untuk NIK atau rentang tanggal tersebut.</p>
            </div>
        @endif
    </div>
</section>

@endsection
