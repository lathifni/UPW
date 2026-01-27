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

    public $donation;

    /**
     * Create a new message instance.
     */
    public function __construct(Donation $donation)
    {
        // Kita load relasi program & rekening biar datanya lengkap pas dikirim ke view
        $this->donation = $donation->load('program.rekening');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // Subject bisa dinamis juga, misal nyebutin ID Order
            subject: 'Menunggu Pembayaran Wakaf #' . $this->donation->order_id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // 1. Ambil Data Rekening dari Relasi Database
        // Logic: Donation -> Program -> Rekening
        $rekening = $this->donation->program->rekening;

        // 2. Tentukan Path Gambar QRIS
        // Default: kosong (kalau gak ada rekening/gambar)
        $qrisPath = null; 
        
        if ($rekening && $rekening->qris_image) {
            // Cek apakah file ada di folder public/frontend/img/ (Sesuai requestmu)
            // ATAU kalau nanti pakai storage, ganti jadi public_path('storage/rekenings/'...)
            $qrisPath = public_path('frontend/img/' . $rekening->qris_image);
            
            // Opsional: Cek apakah file fisik beneran ada biar gak error
            if (!file_exists($qrisPath)) {
                $qrisPath = null; 
            }
        }

        // 3. Tentukan Logo Bank (Optional)
        $logoPath = null;
        if ($rekening && $rekening->logo) {
            $fullPath = public_path('frontend/img/' . $rekening->logo);
            
            // 👇 Cek juga di sini, kalau gak ada ya udah biarin null
            if (file_exists($fullPath)) {
                $logoPath = $fullPath;
            }
        }

        return new Content(
            view: 'emails.wakaf_pending',
            with: [
                'donation'  => $this->donation,
                'rekening'  => $rekening,   // Kirim object rekening lengkap (nama bank, norek, an)
                'pathQris'  => $qrisPath,   // Path fisik QRIS untuk di-embed
                'pathLogo'  => $logoPath,   // Path fisik Logo Bank
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
