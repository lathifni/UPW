<!DOCTYPE html>
<html>
<head>
    <title>Wakaf Diterima</title>
</head>
<body>
    <h2>Assalamualaikum, {{ $donation->donor_name }}</h2>
    
    <p>Alhamdulillah, kami informasikan bahwa pembayaran wakaf Anda untuk program <strong>{{ $donation->program->title }}</strong> telah kami terima dan verifikasi.</p>

    <p>Sebagai bukti sah, kami melampirkan <strong>Akta Ikrar Wakaf</strong> dalam format PDF pada email ini. Silakan diunduh dan disimpan.</p>

    <p>Semoga wakaf ini menjadi amal jariyah yang pahalanya terus mengalir. Aamiin.</p>

    <p>Wassalamualaikum,<br>
    Tim Pengelola Wakaf</p>
</body>
</html>