@extends('layouts.app')

@section('title', 'Edit Surat Keterangan')
@section('meta_description', 'Edit permohonan surat keterangan resmi Desa Pelang Lor.')

@section('content')

<div class="page-hero page-hero--primary">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('landing') }}">Beranda</a>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Edit Surat</span>
        </nav>
        <h1 class="page-hero__title">Edit Surat Keterangan</h1>
        <p class="page-hero__desc">Perbarui data surat Anda di bawah ini.</p>
    </div>
</div>

<section class="surat-form-section">
    <div class="container container--narrow">

        {{-- Langkah --}}
        <div class="info-steps">
            <div class="info-step">
                <div class="info-step__num">1</div>
                <div class="info-step__text">
                    <strong>Isi Jenis Surat</strong>
                    <p>Ketik jenis surat yang Anda butuhkan</p>
                </div>
            </div>
            <div class="info-step__arrow">→</div>
            <div class="info-step">
                <div class="info-step__num">2</div>
                <div class="info-step__text">
                    <strong>Isi Data Diri</strong>
                    <p>Lengkapi sesuai KTP / Kartu Keluarga</p>
                </div>
            </div>
            <div class="info-step__arrow">→</div>
            <div class="info-step">
                <div class="info-step__num">3</div>
                <div class="info-step__text">
                    <strong>Tunggu Persetujuan Admin</strong>
                    <p>Surat dapat diunduh setelah disetujui</p>
                </div>
            </div>
        </div>

        {{-- Form Utama --}}
        <form action="{{ route('surat.update', $surat->id) }}" method="POST" id="suratForm">
            @csrf
            <input type="hidden" name="nomor_surat" value="{{ $surat->nomor_surat }}">
            
            {{-- Jenis Surat --}}
            <div class="form-card">
                <div class="form-card__header">
                    <span class="form-card__num">1</span>
                    <div>
                        <h2 class="form-card__title">Jenis Surat</h2>
                    </div>
                </div>
                <div class="form-card__body">
                    <div class="form-group">
                        <label class="form-label" for="jenis_surat">Jenis Surat <span class="required">*</span></label>
                        <input type="text" id="jenis_surat" name="jenis_surat"
                               class="form-input @error('jenis_surat') is-error @enderror"
                               value="{{ old('jenis_surat', $surat->jenis_surat) }}"
                               placeholder="Contoh: Surat Keterangan Domisili"
                               required autocomplete="off">
                        @error('jenis_surat')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Contoh cepat --}}
                    <div class="quick-pick">
                        <span class="quick-pick__label">Contoh cepat:</span>
                        <button type="button" class="quick-pick__btn" onclick="setJenis(this)">Surat Keterangan Domisili</button>
                        <button type="button" class="quick-pick__btn" onclick="setJenis(this)">Surat Keterangan Tidak Mampu</button>
                        <button type="button" class="quick-pick__btn" onclick="setJenis(this)">Surat Keterangan Usaha</button>
                        <button type="button" class="quick-pick__btn" onclick="setJenis(this)">Surat Keterangan Bepergian</button>
                        <button type="button" class="quick-pick__btn" onclick="setJenis(this)">Surat Pengantar</button>
                    </div>
                </div>
            </div>

            {{-- Data Diri --}}
            <div class="form-card">
                <div class="form-card__header">
                    <span class="form-card__num">2</span>
                    <div>
                        <h2 class="form-card__title">Data Diri Pemohon</h2>
                        <p class="form-card__desc">Isi sesuai data yang tertera di KTP.</p>
                    </div>
                </div>
                <div class="form-card__body">
                    <div class="form-grid">

                        {{-- 1. Nama --}}
                        <div class="form-group form-group--full">
                            <label class="form-label" for="nama">
                                <span class="field-num">1</span> Nama Lengkap <span class="required">*</span>
                            </label>
                            <input type="text" id="nama" name="nama"
                                   class="form-input @error('nama') is-error @enderror"
                                   value="{{ old('nama', $surat->nama) }}"
                                   placeholder="Nama sesuai KTP (huruf kapital otomatis di surat)"
                                   required>
                            @error('nama') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        {{-- 2. NIK --}}
                        <div class="form-group">
                            <label class="form-label" for="nik">
                                <span class="field-num">2</span> Nomor Induk Kependudukan (NIK) <span class="required">*</span>
                            </label>
                            <input type="text" id="nik" name="nik"
                                   class="form-input @error('nik') is-error @enderror"
                                   value="{{ old('nik', $surat->nik) }}"
                                   placeholder="16 digit NIK" maxlength="16"
                                   pattern="\d{16}" title="NIK harus 16 digit angka"
                                   required>
                            @error('nik') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        {{-- 3. Jenis Kelamin --}}
                        <div class="form-group">
                            <label class="form-label" for="jenis_kelamin">
                                <span class="field-num">3</span> Jenis Kelamin <span class="required">*</span>
                            </label>
                            <select id="jenis_kelamin" name="jenis_kelamin"
                                    class="form-input form-input--select @error('jenis_kelamin') is-error @enderror"
                                    required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-Laki"  {{ old('jenis_kelamin', $surat->jenis_kelamin) === 'Laki-Laki'  ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="Perempuan"  {{ old('jenis_kelamin', $surat->jenis_kelamin) === 'Perempuan'  ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        {{-- 4. Tempat Lahir --}}
                        <div class="form-group">
                            <label class="form-label" for="tempat_lahir">
                                <span class="field-num">4</span> Tempat Lahir <span class="required">*</span>
                            </label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir"
                                   class="form-input @error('tempat_lahir') is-error @enderror"
                                   value="{{ old('tempat_lahir', $surat->tempat_lahir) }}"
                                   placeholder="Kota/Kabupaten tempat lahir"
                                   required>
                            @error('tempat_lahir') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        {{-- 5. Tanggal Lahir --}}
                        <div class="form-group">
                            <label class="form-label" for="tanggal_lahir">
                                <span class="field-num">5</span> Tanggal Lahir <span class="required">*</span>
                            </label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                   class="form-input @error('tanggal_lahir') is-error @enderror"
                                   required>
                            <small style="color: #64748b; font-size: 13px; display: block; margin-top: 4px;">Pilih ulang tanggal lahir Anda. Tanggal sebelumnya: {{ $surat->tanggal_lahir }}</small>
                            @error('tanggal_lahir') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        {{-- 6. Kewarganegaraan --}}
                        <div class="form-group">
                            <label class="form-label" for="kewarganegaraan">
                                <span class="field-num">6</span> Kewarganegaraan <span class="required">*</span>
                            </label>
                            <input type="text" id="kewarganegaraan" name="kewarganegaraan"
                                   class="form-input"
                                   value="{{ old('kewarganegaraan', $surat->kewarganegaraan) }}"
                                   required>
                        </div>

                        {{-- 7. Agama --}}
                        <div class="form-group">
                            <label class="form-label" for="agama">
                                <span class="field-num">7</span> Agama <span class="required">*</span>
                            </label>
                            <select id="agama" name="agama"
                                    class="form-input form-input--select @error('agama') is-error @enderror"
                                    required>
                                <option value="">-- Pilih Agama --</option>
                                @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $ag)
                                    <option value="{{ $ag }}" {{ old('agama', $surat->agama) === $ag ? 'selected' : '' }}>{{ $ag }}</option>
                                @endforeach
                            </select>
                            @error('agama') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        {{-- 8. Pekerjaan --}}
                        <div class="form-group">
                            <label class="form-label" for="pekerjaan">
                                <span class="field-num">8</span> Pekerjaan <span class="required">*</span>
                            </label>
                            <input type="text" id="pekerjaan" name="pekerjaan"
                                   class="form-input @error('pekerjaan') is-error @enderror"
                                   value="{{ old('pekerjaan', $surat->pekerjaan) }}"
                                   placeholder="Contoh: Karyawan Swasta, Petani, Pelajar"
                                   required>
                            @error('pekerjaan') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        {{-- 9. Alamat --}}
                        <div class="form-group form-group--full">
                            <label class="form-label" for="alamat">
                                <span class="field-num">9</span> Alamat Lengkap <span class="required">*</span>
                            </label>
                            <textarea id="alamat" name="alamat" rows="3"
                                      class="form-input form-input--textarea @error('alamat') is-error @enderror"
                                      placeholder="Dsn. [Dusun] RT [xxx] RW [xxx] Desa Pelang Lor Kec. Kedunggalar Kab. Ngawi"
                                      required>{{ old('alamat', $surat->alamat) }}</textarea>
                            @error('alamat') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        {{-- 10. Keperluan --}}
                        <div class="form-group form-group--full">
                            <label class="form-label" for="keperluan">
                                <span class="field-num">10</span> Keperluan <span class="required">*</span>
                            </label>
                            <input type="text" id="keperluan" name="keperluan"
                                   class="form-input @error('keperluan') is-error @enderror"
                                   value="{{ old('keperluan', $surat->keperluan) }}"
                                   placeholder="Contoh: Melamar Pekerjaan, Mengurus BPJS, Keperluan Sekolah"
                                   required>
                            @error('keperluan') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div style="margin-top: 12px;">
                <p class="preview-alert" style="margin-bottom: 20px; font-size: 14px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Dengan mengajukan permohonan ini, saya menyatakan bahwa data yang saya isi adalah benar dan dapat dipertanggungjawabkan.
                </p>
                <button type="submit" class="btn-submit" id="submitBtn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</section>

@endsection

@push('scripts')
<script>
function setJenis(btn) {
    document.getElementById('jenis_surat').value = btn.textContent.trim();
    document.getElementById('jenis_surat').focus();
    // Highlight active
    document.querySelectorAll('.quick-pick__btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}

// NIK: hanya angka
document.getElementById('nik').addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, '').substring(0, 16);
});
</script>
@endpush
