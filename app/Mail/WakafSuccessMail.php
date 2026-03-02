<?php

namespace App\Mail;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WakafSuccessMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $donation;

    /**
     * Create a new message instance.
     * CUMA BUTUH 1 ARGUMEN SEKARANG: $donation
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Panggil view email yang udah kita desain tadi
        // Pastikan nama file view-nya bener (emails.wakaf_success atau emails.wakaf-success)
        $email = $this->subject('Alhamdulillah, Wakaf Anda Telah Diterima - Dana Sosial UNAND')
                      ->view('emails.wakaf_success');

        // Ngambil lampiran langsung dari folder storage (Lebih aman & gak bikin error Queue)
        if ($this->donation->certificate_path) {
            $email->attachFromStorage('public/' . $this->donation->certificate_path,
                'Sertifikat_Wakaf_' . $this->donation->order_id . '.pdf',
                ['mime' => 'application/pdf']
            );
        }

        return $email;
    }
}
