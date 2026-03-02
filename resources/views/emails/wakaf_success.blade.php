<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wakaf Diterima - Dana Sosial UNAND</title>
</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600"
                    style="border-collapse: collapse; background-color: #ffffff; border: 1px solid #dddddd; border-radius: 8px; overflow: hidden;">

                    <tr>
                        <td align="center" style="background-color: #198754; padding: 30px 0;">
                            <img src="https://unand.ac.id/images/konten/Logo%20Unand%20PTNBH.png" alt="Logo UNAND"
                                width="60" style="display: block;">
                            <h1 style="color: #ffffff; margin: 10px 0 0 0; font-size: 24px; text-align: center;">Dana
                                Sosial UNAND</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="color: #333333; margin-top: 0; text-align: center;">
                                Assalamualaikum,<br>{{ $donation->donor_name }}</h2>

                            <p
                                style="color: #555555; line-height: 1.6; font-size: 16px; margin: 16px 0; text-align: justify;">
                                Alhamdulillah, kami informasikan bahwa pembayaran wakaf Anda telah kami terima dan
                                verifikasi. Jazakumullah khairan katsiran atas kepercayaan Anda kepada Badan Pengelola
                                Wakaf Universitas Andalas.
                            </p>

                            <table border="0" cellpadding="10" cellspacing="0" width="100%"
                                style="background-color: #f8f9fa; border-left: 4px solid #198754; margin: 25px 0; border-radius: 4px;">
                                <tr>
                                    <td
                                        style="color: #555555; font-size: 14px; width: 35%; border-bottom: 1px solid #eeeeee;">
                                        <strong>Order ID</strong></td>
                                    <td style="color: #333333; font-size: 14px; border-bottom: 1px solid #eeeeee;">:
                                        {{ $donation->order_id }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #555555; font-size: 14px; border-bottom: 1px solid #eeeeee;">
                                        <strong>Program</strong></td>
                                    <td style="color: #333333; font-size: 14px; border-bottom: 1px solid #eeeeee;">:
                                        {{ $donation->program->title ?? 'Wakaf Uang' }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #555555; font-size: 14px;"><strong>Nominal</strong></td>
                                    <td style="color: #198754; font-size: 14px; font-weight: bold;">: Rp
                                        {{ number_format($donation->amount, 0, ',', '.') }}</td>
                                </tr>
                            </table>

                            <p
                                style="color: #555555; line-height: 1.6; font-size: 16px; margin: 16px 0; text-align: justify;">
                                Sebagai bukti penerimaan yang sah, kami telah <strong>melampirkan dokumen Sertifikat /
                                    Akta Ikrar Wakaf dalam format PDF</strong> pada email ini. Silakan diunduh dan
                                disimpan.
                            </p>

                            <div
                                style="background-color: #e8f5bd; padding: 20px; border-radius: 8px; text-align: center; margin: 30px 0;">
                                <p
                                    style="color: #1a2e15; font-style: italic; margin: 0; font-size: 15px; line-height: 1.6;">
                                    "Semoga Allah SWT menerima amal ibadah Anda, melipatgandakan rezeki, dan
                                    menjadikannya pemberat timbangan kebaikan di akhirat kelak. Aamiin ya
                                    Rabbal'alamin."
                                </p>
                            </div>

                            <p
                                style="color: #555555; line-height: 1.6; font-size: 16px; margin: 16px 0; text-align: center;">
                                Wassalamualaikum,<br><strong>Tim Pengelola Wakaf UNAND</strong>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="background-color: #333333; color: #aaaaaa; padding: 20px 30px; text-align: center; font-size: 12px; line-height: 1.6;">
                            Pesan ini dikirim secara otomatis oleh sistem, mohon untuk tidak membalas email ini.<br>
                            &copy; {{ date('Y') }} Badan Pengelola Wakaf Universitas Andalas.<br>
                            Gedung Rektorat UNAND, Limau Manis, Padang.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
