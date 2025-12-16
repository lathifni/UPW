<?php

namespace App\Mail;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment; // <--- Penting untuk lampiran
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WakafSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $donation;
    protected $pdfData; // Variabel untuk menyimpan data biner PDF

    // Kita terima data donasi DAN data PDF di constructor
    public function __construct(Donation $donation, $pdfData)
    {
        $this->donation = $donation;
        $this->pdfData = $pdfData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Alhamdulillah, Wakaf Anda Telah Diterima (Akta Wakaf)',
        );
    }

    public function content(): Content
    {
        // Pastikan kamu membuat view ini nanti di Langkah 2
        return new Content(
            view: 'emails.wakaf_success', 
        );
    }

    /**
     * Di sinilah "Magic" lampirannya terjadi
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfData, 'Akta_Wakaf_'.$this->donation->order_id.'.pdf')
                ->withMime('application/pdf'),
        ];
    }
}