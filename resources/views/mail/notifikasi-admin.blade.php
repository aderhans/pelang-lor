<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pengajuan Surat Baru</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Segoe UI', Arial, sans-serif; background: #f1f5f9; color: #1e293b; }
  .wrap { max-width: 600px; margin: 32px auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
  .header { background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 100%); padding: 32px 40px; text-align: center; }
  .header img { width: 56px; height: 56px; margin-bottom: 12px; }
  .header h1 { color: #fff; font-size: 20px; font-weight: 700; }
  .header p { color: rgba(255,255,255,0.75); font-size: 13px; margin-top: 4px; }
  .badge { display: inline-block; background: #fef3c7; color: #d97706; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; margin-top: 12px; }
  .body { padding: 36px 40px; }
  .body h2 { font-size: 18px; color: #1e293b; margin-bottom: 8px; }
  .body p { color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; }
  .info-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin-bottom: 24px; }
  .info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
  .info-row:last-child { border-bottom: none; }
  .info-row .label { color: #64748b; }
  .info-row .value { color: #0f172a; font-weight: 600; text-align: right; }
  .cta-btn { display: block; background: #2563eb; color: #fff; text-decoration: none; text-align: center; padding: 14px 28px; border-radius: 8px; font-size: 15px; font-weight: 600; margin: 0 auto 24px; }
  .footer { background: #f8fafc; padding: 24px 40px; text-align: center; font-size: 12px; color: #94a3b8; border-top: 1px solid #e2e8f0; }
</style>
</head>
<body>
<div class="wrap">
  <div class="header">
    <h1>🔔 Ada Pengajuan Surat Baru</h1>
    <p>Sistem Layanan Digital Desa Pelang Lor</p>
    <span class="badge">⏳ Menunggu Persetujuan</span>
  </div>
  <div class="body">
    <h2>Terdapat permohonan surat keterangan baru.</h2>
    <p>
      Seorang warga telah mengajukan permohonan surat keterangan melalui portal digital Desa Pelang Lor.
      Silakan tinjau dan berikan keputusan secepatnya.
    </p>

    <div class="info-box">
      <div class="info-row">
        <span class="label">Nama Pemohon</span>
        <span class="value">{{ $surat->nama }}</span>
      </div>
      <div class="info-row">
        <span class="label">NIK</span>
        <span class="value">{{ $surat->nik }}</span>
      </div>
      <div class="info-row">
        <span class="label">Jenis Surat</span>
        <span class="value">{{ $surat->jenis_surat }}</span>
      </div>
      <div class="info-row">
        <span class="label">Keperluan</span>
        <span class="value">{{ $surat->keperluan }}</span>
      </div>
      <div class="info-row">
        <span class="label">Nomor Surat</span>
        <span class="value">{{ $surat->nomor_surat }}</span>
      </div>
      <div class="info-row">
        <span class="label">Tanggal Pengajuan</span>
        <span class="value">{{ $surat->created_at->format('d M Y, H:i') }} WIB</span>
      </div>
    </div>

    <a href="{{ url('/admin/surat/pending') }}" class="cta-btn">
      🔍 Tinjau di Panel Admin
    </a>

    <p style="font-size: 12px; color: #94a3b8; text-align: center;">
      Email ini dikirim otomatis oleh sistem. Jangan membalas email ini.
    </p>
  </div>
  <div class="footer">
    <strong>Desa Pelang Lor</strong> · Kec. Kedunggalar, Kab. Ngawi<br>
    Sistem Layanan Administrasi Digital
  </div>
</div>
</body>
</html>
