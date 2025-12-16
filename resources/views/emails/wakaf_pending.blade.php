<!DOCTYPE html>
<html>
<head>
    <title>Terima Kasih Wakaf</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; }
        .img-pembayaran { width: 100%; max-width: 400px; border: 1px solid #eee; margin-top: 10px; border-radius: 8px;}
    </style>
</head>
<body>
    <div class="container">
        <h2>Assalamualaikum, {{ $donation->donor_name }}</h2>
        
        <p>Terima kasih telah memberikan wakaf untuk program <strong>{{ $donation->program->title ?? 'Program Wakaf' }}</strong>.</p>

        <p>Untuk menyelesaikan wakaf, silakan lakukan pembayaran melalui informasi di bawah ini:</p>

        {{-- BAGIAN MENAMPILKAN GAMBAR --}}
        <div style="text-align: center; margin: 20px 0;">
            <p><strong>Scan QRIS / Transfer Bank:</strong></p>
            
            {{-- Fungsi $message->embed() akan mengubah path file menjadi gambar inline --}}
            <img src="{{ $message->embed($pathGambar) }}" alt="Info Pembayaran" class="img-pembayaran">
        </div>
        {{-- AKHIR BAGIAN GAMBAR --}}

        <p>
            Status wakaf: <strong>Menunggu Pembayaran / Verifikasi Admin</strong><br>
            Order ID: <strong>{{ $donation->order_id }}</strong>
        </p>
        
        <p>
            <a href="{{ url('/cek-wakaf?order_id=' . $donation->order_id) }}" class="btn">
                Cek Status Wakaf
            </a>
        </p>

        <p>Wassalamualaikum,<br>Tim Wakaf</p>
    </div>
</body>
</html>