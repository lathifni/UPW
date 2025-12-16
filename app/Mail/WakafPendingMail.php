<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Donation;

class WakafPendingMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $donation;
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Terima Kasih atas Wakaf Anda - Menunggu Verifikasi',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if ($this->donation->program_id == 1) {
            $namaFile = 'up-wakaf-unand.jpeg';
        } else {
            $namaFile = 'wakaf-unand(bank-nagari).jpeg';
        }
        // 2. Ambil Lokasi File Fisik (Gunakan public_path, BUKAN asset)
        // Pastikan file gambar benar-benar ada di folder public/frontend/img/
        $fullPath = public_path('frontend/img/' . $namaFile);
        return new Content(
            view: 'emails.wakaf_pending',
            // 3. Kita kirim variabel $pathGambar ke View
            with: [
                'pathGambar' => $fullPath, 
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
