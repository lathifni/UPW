<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Akta Ikrar Wakaf Uang</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }

        .text-center {
            text-align: center;
        }

        h3,
        h4 {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
            padding: 1px 0;
        }

        .label {
            width: 160px;
        }

        .colon {
            width: 10px;
        }

        .signature-table {
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .signature-table td {
            width: 33.33%;
            text-align: center;
        }

        .signature-box {
            height: 110px;
            position: relative;
        }

        .signature-name {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .signature-img {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 150px;
            top: -10px;
            opacity: 0.9;
        }

        .signature-img-saksi1 {
            top: 10px;
            width: 80px;
        }

        .signature-img-saksi2 {
            top: 25px;
            width: 100px;
        }
    </style>
</head>

<body>
    <div class="text-center">
        <h3>AKTA IKRAR WAKAF UANG</h3>
        <h4>Nomor: {{ $donation->id }}/AIW-U/UPW-UNAND/{{ $donation->created_at->format('m/Y') }}</h4>
        <h4>Tanggal: {{ $donation->created_at->translatedFormat('d F Y') }}</h4>
    </div>

    <p>Yang bertanda tangan di bawah ini:</p>
    <table>
        <tr>
            <td class="label">Nama Wakif</td>
            <td class="colon">:</td>
            <td><strong>{{ $donation->user->nama }}</strong></td>
        </tr>
        <tr>
            <td class="label">NIK</td>
            <td class="colon">:</td>
            <td>{{ $donation->user->nik }}</td>
        </tr>
        <tr>
            <td class="label">Email</td>
            <td class="colon">:</td>
            <td>{{ $donation->user->email }}</td>
        </tr>
    </table>

    <p>Selanjutnya disebut <strong>WAKIF</strong>, bermaksud memberikan Wakaf Uang</p>
    <table>
        <tr>
            <td class="label">Jumlah Wakaf Uang</td>
            <td class="colon">:</td>
            <td><strong>Rp {{ number_format($donation->amount, 0, ',', '.') }},-</strong></td>
        </tr>
        <tr>
            <td class="label">Terbilang</td>
            <td class="colon">:</td>
            <td><i>{{ $terbilang }} Rupiah</i></td>
        </tr>
        <tr>
            <td class="label">Jenis Wakaf</td>
            <td class="colon">:</td>
            <td><strong>WAKAF UANG</strong></td>
        </tr>
        <tr>
            <td class="label">Peruntukan Wakaf</td>
            <td class="colon">:</td>
            {{-- Ini adalah teks 'fixed' sesuai template asli Anda --}}
            <td><strong>Program beasiswa bagi mahasiswa Universitas Andalas yang kurang mampu</strong></td>
        </tr>
    </table>

    <p>Kepada <strong>NAZHIR</strong></p>
    <table>
        <tr>
            <td class="label">Nama Nazhir</td>
            <td class="colon">:</td>
            <td>Universitas Andalas</td>
        </tr>
        <tr>
            <td class="label">Jenis Nazhir</td>
            <td class="colon">:</td>
            <td>Nazhir Organisasi</td>
        </tr>
        <tr>
            <td class="label">No. ID Nazhir</td>
            <td class="colon">:</td>
            <td>3.3.00474</td>
        </tr>
        <tr>
            <td class="label">No. Rekening</td>
            <td class="colon">:</td>
            <td>7321461837</td>
        </tr>
        <tr>
            <td class="label">Nama Bank</td>
            <td class="colon">:</td>
            <td>Bank Syariah Indonesia</td>
        </tr>
        <tr>
            <td class="label">Alamat</td>
            <td class="colon">:</td>
            <td>Gedung Rektorat Universitas Andalas, Limau Manis, Kec. Pauh, Kota Padang, Provinsi Sumatera Barat 25163.
                Telepon: 0751-71181</td>
        </tr>
    </table>

    <p>Dengan dihadiri saksi-saksi:</p>
    <table>
        <tr>
            <td class="label">Saksi I</td>
            <td class="colon">:</td>
            <td>Dr. Hefrizal Handra, M.Soc. Sc</td>
        </tr>
        <tr>
            <td class="label">Alamat</td>
            <td class="colon">:</td>
            <td>Universitas Andalas</td>
        </tr>
        <tr>
            <td class="label">Saksi II</td>
            <td class="colon">:</td>
            <td>Dr. Suhanda, SE., M.Si. Ak</td>
        </tr>
        <tr>
            <td class="label">Alamat</td>
            <td class="colon">:</td>
            <td>Universitas Andalas</td>
        </tr>
    </table>

    <table class="signature-table">
        <tr>
            <td>
                Wakif
                <div class="signature-box">
                    <div class="signature-name">(.....................................)</div>
                </div>
            </td>
            <td>
                Nazhir
                <div class="signature-box">
                    <img src="{{ public_path('images/signatures/ttd-nazhir.png') }}" class="signature-img">
                    <div class="signature-name">(Dr. Zulkifli N, SE., M.Si)</div>
                </div>
            </td>
            <td>
                Pejabat Bank
                <div class="signature-box">
                    <img src="{{ public_path('images/signatures/ttd-bank.png') }}" class="signature-img">
                    <div class="signature-name">Rina Safitri</div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="padding-top: 25px;">
                Saksi I
                <div class="signature-box">
                    <img src="{{ public_path('images/signatures/ttd-saksi1.png') }}"
                        class="signature-img signature-img-saksi1">
                    <div class="signature-name">(Dr. Hefrizal Handra, M.Soc. Sc)</div>
                </div>
            </td>
            <td style="padding-top: 25px;">
                Saksi II
                <div class="signature-box">
                    <img src="{{ public_path('images/signatures/ttd-saksi2.png') }}"
                        class="signature-img signature-img-saksi2">
                    <div class="signature-name">(Dr. Suhanda, SE., M.Si. Ak)</div>
                </div>
            </td>
            <td></td>
        </tr>
    </table>
</body>

</html>
