<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi GoZay</title>
</head>
<body style="margin:0;padding:0;background:#f4f7fb;font-family:Arial,Helvetica,sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f4f7fb;padding:24px;">
        <tr>
            <td align="center">
                <table role="presentation" width="560" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 16px rgba(2,48,112,.08);">
                    <!-- Header -->
                    <tr>
                        <td style="background:#0d6efd;padding:28px 32px;text-align:center;">
                            <img src="{{ $message->embed(resource_path('images/logo-email.png')) }}" alt="GoZay" width="150" style="display:block;margin:0 auto;max-width:150px;height:auto;">
                            <p style="margin:10px 0 0;color:#e0ecff;font-size:13px;">Terbang mudah, perjalanan berkesan.</p>
                        </td>
                    </tr>
                    <!-- Body -->
                    <tr>
                        <td style="padding:32px;">
                            <h2 style="margin:0 0 12px;color:#0a2540;font-size:18px;">Kode Verifikasi Anda</h2>
                            <p style="margin:0 0 16px;color:#556b82;font-size:14px;line-height:1.6;">
                                Gunakan kode berikut untuk menyelesaikan verifikasi email akun GoZay Anda.
                                Kode hanya berlaku selama <strong>5 menit</strong>.
                            </p>
                            <div style="background:#eef4ff;border:1px dashed #0d6efd;border-radius:10px;padding:20px;text-align:center;font-size:32px;font-weight:bold;letter-spacing:8px;color:#0d6efd;">
                                {{ $otp }}
                            </div>
                            <p style="margin:20px 0 0;color:#8a97a8;font-size:12px;line-height:1.6;">
                                Jika Anda tidak meminta kode ini, abaikan email ini.<br>
                                Jangan pernah membagikan kode OTP kepada siapa pun.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#f8fafc;padding:16px 32px;text-align:center;color:#8a97a8;font-size:12px;">
                            © {{ date('Y') }} GoZay. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>