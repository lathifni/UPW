<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fc;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #e3e6f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background-color: #198754;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 25px;
        }

        .table th,
        .table td {
            padding: 12px;
            border-bottom: 1px solid #e3e6f0;
            text-align: left;
            font-size: 15px;
        }

        .table th {
            color: #6e707e;
            width: 35%;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #198754;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }

        .footer {
            margin-top: 20px;
            padding: 20px;
            font-size: 12px;
            text-align: center;
            color: #858796;
            background-color: #f8f9fc;
            border-top: 1px solid #e3e6f0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Ada Wakaf Masuk! 🎉</h2>
        </div>
        <div class="content">
            <p>Halo Admin Dana Sosial UNAND,</p>
            <p>Terdapat transaksi wakaf baru yang masuk dan berstatus <strong>Pending</strong>. Mohon segera dicek dan
                diverifikasi jika dana sudah masuk ke rekening.</p>

            <table class="table">
                <tr>
                    <th>Order ID</th>
                    <td><strong>{{ $donation->order_id }}</strong></td>
                </tr>
                <tr>
                    <th>Nama Wakif</th>
                    <td>{{ $donation->donor_name }}</td>
                </tr>
                <tr>
                    <th>Program</th>
                    <td>{{ $donation->program->title ?? 'Wakaf Uang (Dana Abadi)' }}</td>
                </tr>
                <tr>
                    <th>Kategori Wakif</th>
                    <td style="text-transform: capitalize;">{{ str_replace('_', ' ', $donation->donor_category) }}</td>
                </tr>
                <tr>
                    <th>Nominal</th>
                    <td style="font-weight: bold; color: #198754; font-size: 18px;">Rp
                        {{ number_format($donation->amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Waktu Transaksi</th>
                    <td>{{ $donation->created_at->format('d M Y, H:i') }} WIB</td>
                </tr>
            </table>

            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('admin.donations.show', $donation->id) }}" class="btn">Cek & Verifikasi
                    Pembayaran</a>
            </div>
        </div>
        <div class="footer">
            <p>Email ini dikirim secara otomatis oleh Sistem Dana Sosial Universitas Andalas.</p>
        </div>
    </div>
</body>

</html>
