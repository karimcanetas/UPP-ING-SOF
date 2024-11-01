<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReporteMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected $filePath;
    protected $formatoNombre;

    public function __construct(string $filePath, string $formatoNombre)
    {
        $this->filePath = $filePath;
        $this->formatoNombre = $formatoNombre;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('danieliuit75@gmail.com', 'Daniel Iuit'),
            subject: mb_encode_mimeheader('Reporte Vigilancia PRT' . $this->formatoNombre, 'UTF-8'),
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'mensaje.index',
            with: [
                'formatoNombre' => $this->formatoNombre,
            ],
        );
    }

    public function attachments(): array
    {
        return [
            \Illuminate\Mail\Mailables\Attachment::fromPath($this->filePath),
        ];
    }
}
