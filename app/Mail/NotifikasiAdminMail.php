<?php

namespace App\Mail;

use App\Models\Surat;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Email notifikasi ke Admin ketika warga mengajukan surat baru.
 * Dikirim dari email Bot (MAIL_FROM_ADDRESS di .env).
 */
class NotifikasiAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public Surat $surat;

    public function __construct(Surat $surat)
    {
        $this->surat = $surat;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📬 Pengajuan Surat Baru: ' . $this->surat->jenis_surat,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.notifikasi-admin',
            with: [
                'surat' => $this->surat,
            ],
        );
    }
}
