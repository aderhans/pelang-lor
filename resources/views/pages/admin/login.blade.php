<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin — Desa Pelang Lor</title>
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
    </style>
</head>
<body>
    <div class="admin-login-wrap">
        {{-- LEFT PANEL --}}
        <div class="admin-login-left">
            <div class="admin-login-left__content">
                <img src="{{ asset('images/Lambang_Kabupaten_Ngawi.png') }}" alt="Logo" class="admin-login-left__logo">
                <h1 class="admin-login-left__title">Desa<br><span>Pelang Lor</span></h1>
                <p class="admin-login-left__desc">Panel administrasi digital untuk pengelolaan layanan surat keterangan warga Desa Pelang Lor, Kec. Kedunggalar, Kab. Ngawi.</p>
                <div class="admin-login-left__features">
                    <div class="admin-login-feat">
                        <div class="admin-login-feat__icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <span>Tinjau & setujui permohonan surat</span>
                    </div>
                    <div class="admin-login-feat">
                        <div class="admin-login-feat__icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
                        </div>
                        <span>Kelola arsip surat terdigitalisasi</span>
                    </div>
                    <div class="admin-login-feat">
                        <div class="admin-login-feat__icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                        </div>
                        <span>Monitor statistik layanan desa</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT PANEL (FORM) --}}
        <div class="admin-login-right">
            <div class="admin-login-card">
                <div class="admin-login-card__header">
                    <div class="admin-login-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <h2 class="admin-login-card__title">Masuk ke Panel Admin</h2>
                </div>

                @if($errors->any())
                <div class="admin-login-alert">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    {{ $errors->first('email') }}
                </div>
                @endif

                <form action="{{ route('admin.login.post') }}" method="POST" class="admin-login-form">
                    @csrf

                    <div class="admin-login-field">
                        <label class="admin-login-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            class="admin-login-input"
                            value="{{ old('email') }}"
                            placeholder="admin@example.com"
                            required
                            autofocus
                            id="admin-email"
                        >
                    </div>

                    <div class="admin-login-field">
                        <label class="admin-login-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            Password
                        </label>
                        <input
                            type="password"
                            name="password"
                            class="admin-login-input"
                            placeholder="••••••••"
                            required
                            id="admin-password"
                        >
                    </div>

                    <button type="submit" class="admin-login-submit" id="admin-submit-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                        Masuk ke Panel
                    </button>
                </form>

                <div class="admin-login-back">
                    <a href="{{ route('landing') }}">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
