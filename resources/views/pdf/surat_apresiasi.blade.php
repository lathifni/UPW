<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Template Surat Ucapan Terima Kasih</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 25mm 20mm 25mm 20mm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.4;
            color: #000;
        }

        .letterhead {
            text-align: center;
            margin-bottom: 2mm;
            position: relative;
        }

        .letterhead img {
            position: absolute;
            left: 0;
            top: 0;
            height: 100px;
        }

        .letterhead .text {
            margin-left: 90px;
        }

        .letterhead .text .line {
            display: block;
            line-height: 1.2;
        }

        .letterhead .text .univ {
            font-weight: bold;
            font-size: 13.92pt;
            letter-spacing: 0.2px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
            text-decoration: underline;
            margin: 10mm 0 8mm;
        }

        p {
            margin: 0 0 5mm 0;
            text-align: justify;
            text-justify: inter-word;
        }

        .info-table {
            margin: 6mm 0;
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 0.5mm 0;
        }

        .signature {
            width: 90mm;
            text-align: left;
            margin-left: auto;
            margin-top: 15mm;
            position: relative;
        }

        .signature .place-date {
            margin-bottom: 5mm;
        }

        .signature .signature-image {
            position: absolute;
            top: 0mm;
            left: -10mm;
            width: 270px;
        }

        .signature .rector-name {
            margin-top: 15mm;
        }

        .header-line-1 {
            border-bottom: 1px solid black;
        }

        .header-line-2 {
            border-bottom: 3px solid black;
            margin-top: 1mm;
        }
    </style>
</head>

<body>
    <div class="page">
        {{-- KOP SURAT (Pastikan path gambar ini ada di folder /public) --}}
        <div class="letterhead">
            <img src="{{ public_path('frontend/img/logo_unand.png') }}" alt="Logo Universitas Andalas">
            <div class="text">
                <span class="line">KEMENTERIAN PENDIDIKAN TINGGI, SAINS</span>
                <span class="line">DAN TEKNOLOGI</span>
                <span class="line univ">UNIVERSITAS ANDALAS</span>
                <span class="line">Gedung Rektorat, Limau Manis Padang - 25163</span>
                <span class="line">Telp. 0751-71181/71389 Fax. 0751-71085 Laman: www.unand.ac.id</span>
            </div>
        </div>
        <div class="header-line-1"></div>
        <div class="header-line-2"></div>

        <div class="title">UCAPAN TERIMA KASIH</div>
        <p>Rektor Universitas Andalas mengucapkan terima kasih kepada:</p>

        <table class="info-table">
            <tr>
                <td style="width: 150px;">Nama</td>
                <td>:</td>
                <td><strong>{{ $donation->user->nama }}</strong></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td><strong>{{ $donation->user->nik }}</strong></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><strong>{{ $donation->user->email }}</strong></td>
            </tr>
            <tr>
                <td>Jumlah Sumbangan</td>
                <td>:</td>
                <td><strong>Rp {{ number_format($donation->amount, 0, ',', '.') }},-</strong></td>
            </tr>
        </table>

        {{-- Ini adalah teks 'fixed' sesuai permintaan Anda --}}
        <p>Atas sumbangannya untuk <strong>DANA ABADI UNIVERSITAS ANDALAS</strong>.</p>
        <p style="margin-top: 5mm;">Dana akan dikelola dengan baik dan hasilnya akan dipergunakan untuk Bantuan Beasiswa
            bagi mahasiswa yang berasal dari keluarga kurang mampu serta untuk mendukung kemajuan Pendidikan di
            Universitas Andalas.</p>

        <div class="signature">
            <div class="place-date">Padang, {{ $donation->created_at->translatedFormat('d F Y') }}</div>

            {{-- Pastikan path gambar ini ada di folder /public --}}
            <img src="{{ public_path('images/signatures/ttd-rektor-stempel.png') }}" alt="Tanda Tangan Rektor"
                class="signature-image">

            <div class="rector-name">
                <strong>Dr. Efa Yonnedi, SE. MPPM, Akt, CA, CRGP</strong>
                <br>
                <strong>NIP.</strong> 197205021996021001
            </div>
        </div>
    </div>
</body>

</html>
