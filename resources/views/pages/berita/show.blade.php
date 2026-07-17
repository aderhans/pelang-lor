@extends('layouts.app')
@section('title', $berita->judul . ' — Berita Desa Pelang Lor')
@section('meta_description', $berita->ringkasan)

@section('content')

<div class="page-hero page-hero--primary">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('landing') }}">Beranda</a>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <a href="{{ route('landing') }}#berita">Berita Desa</a>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <span>{{ Str::limit($berita->judul, 40) }}</span>
        </nav>
        <h1 class="page-hero__title">{{ $berita->judul }}</h1>
        <p class="page-hero__desc">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:-2px;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            {{ $berita->tanggal->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
        </p>
    </div>
</div>

<section style="padding: 60px 0; background: #f8fafc;">
    <div class="container" style="display:grid;grid-template-columns:1fr 320px;gap:40px;align-items:start;max-width:1060px;">

        {{-- Konten Berita --}}
        <article style="background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.07);border:1px solid #e2e8f0;">

            {{-- Gambar Header --}}
            @if($berita->gambar)
            <div style="width:100%;height:320px;overflow:hidden;">
                <img src="{{ Storage::url($berita->gambar) }}" alt="{{ $berita->judul }}"
                     style="width:100%;height:100%;object-fit:cover;display:block;">
            </div>
            @else
            <div style="width:100%;height:200px;background:linear-gradient(135deg,#7f1d1d,#b91c1c,#991b1b);display:flex;align-items:center;justify-content:center;">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
            </div>
            @endif

            <div style="padding:36px;">
                <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;padding-bottom:20px;border-bottom:1px solid #f1f5f9;">
                    <span style="background:#fee2e2;color:#991b1b;font-size:12px;font-weight:700;padding:4px 12px;border-radius:20px;">Berita Desa</span>
                    <span style="color:#64748b;font-size:13px;">
                        {{ $berita->tanggal->locale('id')->isoFormat('D MMMM YYYY') }}
                    </span>
                </div>

                {{-- Ringkasan --}}
                <p style="font-size:17px;color:#374151;font-weight:500;line-height:1.7;margin-bottom:24px;padding:16px 20px;background:#f8fafc;border-left:3px solid #800000;border-radius:0 10px 10px 0;">
                    {{ $berita->ringkasan }}
                </p>

                {{-- Isi Lengkap --}}
                <div style="font-size:15px;color:#374151;line-height:1.8;white-space:pre-line;">
                    {!! nl2br(e($berita->isi)) !!}
                </div>

                {{-- Footer --}}
                <div style="margin-top:36px;padding-top:24px;border-top:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
                    <a href="{{ route('landing') }}#berita" style="display:inline-flex;align-items:center;gap:8px;color:#800000;font-weight:600;font-size:14px;text-decoration:none;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Kembali ke Berita
                    </a>
                    <span style="font-size:13px;color:#94a3b8;">Desa Pelang Lor, Kedunggalar — Ngawi</span>
                </div>
            </div>
        </article>

        {{-- Sidebar: Berita Lainnya --}}
        <aside>
            <div style="background:#fff;border-radius:16px;padding:24px;border:1px solid #e2e8f0;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                <h3 style="font-size:15px;font-weight:700;color:#0f172a;margin:0 0 20px;padding-bottom:14px;border-bottom:1px solid #f1f5f9;">
                    Berita Lainnya
                </h3>

                @forelse($lainnya as $item)
                <a href="{{ route('berita.show', $item->slug) }}"
                   style="display:flex;gap:12px;padding:12px 0;border-bottom:1px solid #f8fafc;text-decoration:none;transition:all .2s;align-items:flex-start;"
                   onmouseover="this.style.paddingLeft='4px'" onmouseout="this.style.paddingLeft='0'">
                    @if($item->gambar)
                    <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}"
                         style="width:64px;height:48px;object-fit:cover;border-radius:8px;flex-shrink:0;display:block;">
                    @else
                    <div style="width:64px;height:48px;background:linear-gradient(135deg,#e2e8f0,#cbd5e1);border-radius:8px;flex-shrink:0;display:flex;align-items:center;justify-content:center;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
                    </div>
                    @endif
                    <div style="flex:1;min-width:0;">
                        <p style="font-size:13px;font-weight:600;color:#0f172a;margin:0 0 4px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $item->judul }}</p>
                        <p style="font-size:12px;color:#94a3b8;margin:0;">{{ $item->tanggal->locale('id')->isoFormat('D MMM YYYY') }}</p>
                    </div>
                </a>
                @empty
                <p style="color:#94a3b8;font-size:13px;text-align:center;padding:20px 0;">Belum ada berita lainnya.</p>
                @endforelse
            </div>
        </aside>

    </div>
</section>

@endsection
