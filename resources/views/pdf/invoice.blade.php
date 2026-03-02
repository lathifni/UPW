<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice Wakaf - {{ $donation->order_id }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            font-size: 14px;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #198754;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            color: #198754;
            font-size: 24px;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0 0 0;
            font-size: 12px;
            color: #777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 5px 0;
        }

        .info-table .label {
            font-weight: bold;
            width: 150px;
            color: #555;
        }

        .items-table {
            margin-top: 30px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .items-table th {
            background-color: #198754;
            color: white;
            text-transform: uppercase;
            font-size: 12px;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 12px;
            color: white;
            text-transform: uppercase;
        }

        .status-paid {
            background-color: #198754;
        }

        .status-pending {
            background-color: #f6c23e;
            color: #333;
        }

        .status-cancelled {
            background-color: #e74a3b;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #777;
            font-style: italic;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>INVOICE WAKAF</h2>
        <p>Dana Sosial Universitas Andalas</p>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Order ID</td>
            <td>: <strong>{{ $donation->order_id }}</strong></td>
        </tr>
        <tr>
            <td class="label">Tanggal</td>
            <td>: {{ $donation->created_at->format('d F Y, H:i') }} WIB</td>
        </tr>
        <tr>
            <td class="label">Nama Wakif</td>
            <td>: {{ $donation->donor_name }}</td>
        </tr>
        <tr>
            <td class="label">Status</td>
            <td>:
                @if ($donation->status == 'paid')
                    <span class="status-badge status-paid">Selesai / Terverifikasi</span>
                @elseif($donation->status == 'pending')
                    <span class="status-badge status-pending">Menunggu Pembayaran</span>
                @else
                    <span class="status-badge status-cancelled">Dibatalkan</span>
                @endif
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th>Deskripsi Program</th>
                <th style="text-align: right;">Nominal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>{{ $donation->program->title ?? 'Wakaf Uang (Dana Abadi)' }}</strong><br>
                    <span style="font-size: 12px; color: #555;">Kategori Wakif:
                        {{ str_replace('_', ' ', $donation->donor_category) }}</span>
                </td>
                <td style="text-align: right; font-weight: bold; font-size: 16px;">
                    Rp {{ number_format($donation->amount, 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Terima kasih atas kontribusi Anda. Semoga amal ibadah wakaf ini diterima oleh Allah SWT dan menjadi amal
            jariyah yang pahalanya mengalir tiada henti.</p>
        <p>Dokumen ini diterbitkan secara otomatis oleh sistem dan sah tanpa tanda tangan.</p>
    </div>

</body>

</html>
