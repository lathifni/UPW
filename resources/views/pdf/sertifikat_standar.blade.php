<!DOCTYPE html>
<html>

<head>
    <title>Sertifikat Donasi</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            padding: 40px;
        }

        .container {
            border: 10px solid #198754;
            padding: 50px;
            width: 700px;
            margin: auto;
        }

        h1 {
            color: #198754;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Sertifikat Apresiasi</h1>
        <p>Diberikan kepada:</p>
        <h2>{{ $donation->user->nama }}</h2>
        <p>Atas donasinya sebesar <strong>Rp {{ number_format($donation->amount, 0, ',', '.') }}</strong></p>
        <p>Untuk program:</p>
        <h3>{{ $donation->program->title }}</h3>
        <p>Pada tanggal {{ $donation->created_at->translatedFormat('d F Y') }}</p>
    </div>
</body>

</html>
