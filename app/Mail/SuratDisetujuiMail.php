<?php

namespace App\Mail;

use App\Models\Surat;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Email ke Warga berisi PDF surat yang sudah disetujui & ber-TTD.
 * Dikirim dari email Admin (MAIL_ADMIN_FROM_ADDRESS di .env).
 */
class SuratDisetujuiMail extends Mailable
{
    use Queueable, SerializesModels;

    public Surat $surat;
    public string $pdfPath;
    public string $pdfFilename;

    public function __construct(Surat $surat, string $pdfPath, string $pdfFilename)
    {
        $this->surat       = $surat;
        $this->pdfPath     = $pdfPath;
        $this->pdfFilename = $pdfFilename;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✅ Surat Keterangan Anda Telah Disetujui — Desa Pelang Lor',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.surat-disetujui',
            with: [
                'surat' => $this->surat,
            ],
        );
    }

    /**
     * Lampirkan PDF surat yang sudah ber-TTD & stempel.
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->pdfPath)
                ->as($this->pdfFilename)
                ->withMime('application/pdf'),
        ];
    }
}
