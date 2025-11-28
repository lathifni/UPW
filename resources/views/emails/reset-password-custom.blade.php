<!DOCTYPE html>
<html lang="id">

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
                            <h1 style="color: #ffffff; margin: 10px 0 0 20px; font-size: 24px; ">Dana Sosial UNAND</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="color: #333333; margin-top: 0; text-align: center;">Halo, {{ $user->nama }}!
                            </h2>
                            <p
                                style="color: #555555; line-height: 1.6; font-size: 16px; margin: 16px 0; text-align: center;">
                                Kami menerima permintaan untuk mereset password akun Anda. Silakan klik tombol di bawah
                                ini untuk melanjutkan. Link ini hanya valid selama 60 menit.
                            </p>
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                                style="margin: 30px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $resetUrl }}"
                                            style="background-color: #198754; color: #ffffff; padding: 15px 25px; text-decoration: none; border-radius: 5px; display: inline-block; font-weight: bold;">
                                            Reset Password
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            <p
                                style="color: #555555; line-height: 1.6; font-size: 16px; margin: 16px 0; text-align: center;">
                                Jika Anda tidak merasa meminta reset password, Anda bisa mengabaikan email ini.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="background-color: #333333; color: #aaaaaa; padding: 20px 30px; text-align: center; font-size: 12px;">
                            &copy; {{ date('Y') }} Dana Sosial UNAND. Semua hak dilindungi undang-undang.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
