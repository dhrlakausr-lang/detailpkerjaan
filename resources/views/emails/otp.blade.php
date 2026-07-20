<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Reset Password</title>
</head>
<body style="margin:0;padding:0;background-color:#f2f4f7;font-family:Arial,Helvetica,sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f2f4f7;padding:32px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="460" cellpadding="0" cellspacing="0" style="max-width:460px;width:100%;background-color:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.06);">
                    <tr>
                        <td style="background-color:#2cc2d6;padding:24px 32px;">
                            <h1 style="margin:0;font-size:22px;color:#ffffff;">LokerinAja</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px;">
                            <h2 style="margin:0 0 12px;font-size:20px;color:#1f2937;">Reset Password</h2>
                            <p style="margin:0 0 20px;font-size:14px;color:#4b5563;line-height:1.6;">
                                Anda meminta reset password untuk akun <strong>{{ $email }}</strong>.
                                Gunakan kode OTP di bawah ini untuk membuat password baru.
                            </p>
                            <div style="text-align:center;margin:24px 0;">
                                <span style="display:inline-block;background-color:#f0fbfc;color:#0f7f8c;font-size:34px;font-weight:bold;letter-spacing:10px;padding:16px 28px;border-radius:12px;border:1px dashed #2cc2d6;">
                                    {{ $otp }}
                                </span>
                            </div>
                            <p style="margin:0 0 8px;font-size:13px;color:#6b7280;line-height:1.6;">
                                Kode ini berlaku selama <strong>10 menit</strong> dan hanya bisa digunakan satu kali.
                            </p>
                            <p style="margin:0;font-size:13px;color:#6b7280;line-height:1.6;">
                                Jika Anda tidak meminta reset password, abaikan email ini.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 32px;background-color:#f9fafb;border-top:1px solid #eef0f2;">
                            <p style="margin:0;font-size:12px;color:#9ca3af;">&copy; {{ date('Y') }} LokerinAja. Email otomatis, mohon tidak dibalas.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
