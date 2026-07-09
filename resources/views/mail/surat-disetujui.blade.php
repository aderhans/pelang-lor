<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Surat Keterangan Disetujui</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Segoe UI', Arial, sans-serif; background: #f1f5f9; color: #1e293b; }
  .wrap { max-width: 600px; margin: 32px auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
  .header { background: linear-gradient(135deg, #065f46 0%, #10b981 100%); padding: 32px 40px; text-align: center; }
  .header h1 { color: #fff; font-size: 22px; font-weight: 700; }
  .header p { color: rgba(255,255,255,0.8); font-size: 13px; margin-top: 6px; }
  .checkmark { width: 56px; height: 56px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 28px; }
  .body { padding: 36px 40px; }
  .body h2 { font-size: 18px; color: #1e293b; margin-bottom: 8px; }
  .body p { color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; }
  .info-box { background: #f0fdf4; border: 1px solid #a7f3d0; border-radius: 8px; padding: 20px; margin-bottom: 24px; }
  .info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #d1fae5; font-size: 14px; }
  .info-row:last-child { border-bottom: none; }
  .info-row .label { color: #64748b; }
  .info-row .value { color: #0f172a; font-weight: 600; text-align: right; }
  .attachment-box { background: #fff7ed; border: 1px solid #fed7aa; border-radius: 8px; padding: 16px 20px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; }
  .attachment-icon { font-size: 28px; }
  .attachment-text h3 { font-size: 14px; color: #c2410c; font-weight: 700; }
  .attachment-text p { font-size: 13px; color: #9a3412; margin-top: 2px; }
  .notice { background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 14px 18px; font-size: 13px; color: #1e40af; margin-bottom: 24px; }
  .notice strong { display: block; margin-bottom: 4px; }
  .footer { background: #f8fafc; padding: 24px 40px; text-align: center; font-size: 12px; color: #94a3b8; border-top: 1px solid #e2e8f0; }
  .divider { border: none; border-top: 1px solid #e2e8f0; margin: 24px 0; }
</style>
</head>
<body>
<div class="wrap">
  <div class="header">
    <div class="checkmark">✅</div>
    <h1>Surat Keterangan Disetujui!</h1>
    <p>Pemerintah Desa Pelang Lor, Kec. Kedunggalar, Kab. Ngawi</p>
  </div>
  <div class="body">
    <h2>Yth. {{ $surat->nama }},</h2>
    <p>
      Kami dengan senang hati menginformasikan bahwa permohonan <strong>{{ $surat->jenis_surat }}</strong> Anda
      telah <strong style="color: #059669;">disetujui</strong> oleh Pejabat Desa Pelang Lor.
    </p>

    <div class="info-box">
      <div class="info-row">
        <span class="label">Nomor Surat</span>
        <span class="value">{{ $surat->nomor_surat }}</span>
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
        <span class="label">Tanggal Surat</span>
        <span class="value">{{ $surat->tanggal_surat }}</span>
      </div>
    </div>

    <div class="attachment-box">
      <div class="attachment-icon">📎</div>
      <div class="attachment-text">
        <h3>Softfile Surat Terlampir di Email Ini</h3>
        <p>Buka lampiran PDF di bawah untuk melihat dan mencetak surat Anda.</p>
      </div>
    </div>

    <div class="notice">
      <strong>⚠️ Penting — Harap Diperhatikan:</strong>
      Softfile surat keterangan ini hanya dikirimkan melalui email resmi Desa Pelang Lor dan telah ditandatangani
      secara digital oleh pejabat yang berwenang. Surat ini <strong>tidak dapat diunduh</strong> dari portal warga
      untuk menjaga keaslian dokumen.
    </div>

    <hr class="divider">
    <p style="font-size: 12px; color: #94a3b8; text-align: center;">
      Email ini dikirim oleh sistem resmi Desa Pelang Lor. Jika Anda merasa menerima email ini secara tidak sengaja,
      mohon abaikan pesan ini.
    </p>
  </div>
  <div class="footer">
    <strong>Pemerintah Desa Pelang Lor</strong><br>
    Kecamatan Kedunggalar, Kabupaten Ngawi, Jawa Timur<br>
    Sistem Layanan Administrasi Digital
  </div>
</div>
</body>
</html>
