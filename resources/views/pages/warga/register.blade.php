<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Akun Warga — Desa Pelang Lor</title>
    <meta name="description" content="Daftarkan akun warga Anda untuk mengakses layanan digital Desa Pelang Lor.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
    <style>
        body { background: var(--p900); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        body::before {
            content: '';
            position: fixed; inset: 0;
            background:
                radial-gradient(ellipse 70% 70% at 20% 20%, rgba(107,15,26,0.6) 0%, transparent 60%),
                radial-gradient(ellipse 50% 50% at 80% 80%, rgba(74,4,4,0.5) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 60% 10%, rgba(249,168,37,0.04) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }
        body::after {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }
        .switch-admin-btn {
            position: absolute;
            top: 24px;
            right: 24px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--r-full);
            color: var(--white);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            backdrop-filter: blur(8px);
            transition: var(--ease);
            z-index: 10;
        }
        .switch-admin-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <a href="{{ route('admin.login') }}" class="switch-admin-btn" title="Masuk sebagai Admin">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        Admin
    </a>
    <div class="admin-login-wrap">

        {{-- LEFT PANEL --}}
        <div class="admin-login-left">
            <div class="admin-login-left__content">
                <img src="{{ asset('images/Lambang_Kabupaten_Ngawi.png') }}" alt="Logo" class="admin-login-left__logo">
                <h1 class="admin-login-left__title">Desa<br><span>Pelang Lor</span></h1>
                <p class="admin-login-left__desc">Daftar akun warga untuk mengakses layanan administrasi digital Desa Pelang Lor dengan mudah dan cepat.</p>
                <div class="admin-login-left__features">
                    <div class="admin-login-feat">
                        <div class="admin-login-feat__icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
                        </div>
                        <span>Ajukan permohonan surat keterangan</span>
                    </div>
                    <div class="admin-login-feat">
                        <div class="admin-login-feat__icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <span>Pantau status permohonan Anda</span>
                    </div>
                    <div class="admin-login-feat">
                        <div class="admin-login-feat__icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        </div>
                        <span>Unduh surat yang telah disetujui</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT PANEL (FORM) --}}
        <div class="admin-login-right">
            <div class="admin-login-card">
                <div class="admin-login-card__header">
                    <div class="admin-login-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
                    </div>
                    <h2 class="admin-login-card__title">Daftar Akun Warga</h2>
                </div>

                {{-- Flash Success --}}
                @if(session('success'))
                <div class="admin-login-alert" style="background: rgba(16,185,129,0.12); border-color: rgba(16,185,129,0.4); color: #6ee7b7;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    {{ session('success') }}
                </div>
                @endif

                {{-- Error Alert --}}
                @if($errors->any())
                <div class="admin-login-alert">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    {{ $errors->first() }}
                </div>
                @endif

                <form action="{{ route('warga.register.post') }}" method="POST" class="admin-login-form">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div class="admin-login-field">
                        <label class="admin-login-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            Nama Lengkap
                        </label>
                        <input
                            type="text"
                            name="nama"
                            class="admin-login-input @error('nama') is-error @enderror"
                            value="{{ old('nama') }}"
                            placeholder="Sesuai KTP"
                            required
                            autofocus
                        >
                        @error('nama')
                            <p style="color:#fca5a5; font-size:12px; margin-top:4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="admin-login-field">
                        <label class="admin-login-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            Tanggal Lahir
                        </label>
                        <input
                            type="date"
                            name="tanggal_lahir"
                            class="admin-login-input @error('tanggal_lahir') is-error @enderror"
                            value="{{ old('tanggal_lahir') }}"
                            required
                            style="color: rgba(255,255,255,0.9); font-family: inherit;"
                        >
                        @error('tanggal_lahir')
                            <p style="color:#fca5a5; font-size:12px; margin-top:4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="admin-login-field">
                        <label class="admin-login-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            Alamat Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            class="admin-login-input @error('email') is-error @enderror"
                            value="{{ old('email') }}"
                            placeholder="contoh@email.com"
                            required
                            id="warga-email"
                        >
                        @error('email')
                            <p style="color:#fca5a5; font-size:12px; margin-top:4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- WhatsApp --}}
                    <div class="admin-login-field">
                        <label class="admin-login-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            Nomor WhatsApp
                        </label>
                        <input
                            type="tel"
                            name="whatsapp"
                            class="admin-login-input @error('whatsapp') is-error @enderror"
                            value="{{ old('whatsapp') }}"
                            placeholder="Contoh: 08123456789"
                            maxlength="20"
                            required
                            id="warga-whatsapp"
                        >
                        @error('whatsapp')
                            <p style="color:#fca5a5; font-size:12px; margin-top:4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="admin-login-field">
                        <label class="admin-login-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            Kata Sandi
                        </label>
                        <input
                            type="password"
                            name="password"
                            class="admin-login-input @error('password') is-error @enderror"
                            placeholder="Minimal 8 karakter"
                            required
                            id="warga-password"
                        >
                        @error('password')
                            <p style="color:#fca5a5; font-size:12px; margin-top:4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="admin-login-field">
                        <label class="admin-login-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/><polyline points="9 17 11 19 15 15"/></svg>
                            Konfirmasi Kata Sandi
                        </label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="admin-login-input"
                            placeholder="Ulangi kata sandi"
                            required
                            id="warga-password-confirm"
                        >
                    </div>

                    <button type="submit" class="admin-login-submit" id="warga-register-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
                        Buat Akun Warga
                    </button>
                </form>

                <div class="admin-login-back" style="text-align: center;">
                    <p style="color: rgba(255,255,255,0.5); font-size: 13px; margin-bottom: 8px;">Sudah punya akun?</p>
                    <a href="{{ route('warga.login') }}" style="color: rgba(255,255,255,0.75); font-size: 13px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                        Masuk ke Akun
                    </a>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
