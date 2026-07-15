<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lamaran Diterima</title>
</head>
<body style="margin:0;background:#f8fafc;color:#0f172a;font-family:Arial,Helvetica,sans-serif;line-height:1.6;">
    <div style="max-width:640px;margin:0 auto;padding:32px 18px;">
        <div style="background:#ffffff;border:1px solid #e2e8f0;border-radius:16px;overflow:hidden;">
            <div style="background:#16a34a;padding:24px;color:#ffffff;">
                <h1 style="margin:0;font-size:24px;">Selamat, lamaran kamu diterima!</h1>
            </div>

            <div style="padding:26px;">
                <p>Halo <strong>{{ $lamaran->nama }}</strong>,</p>
                <p>
                    Kabar baik dari LokerInAja. Lamaran kamu untuk posisi
                    <strong>{{ $lamaran->posisi }}</strong>
                    @if($lamaran->perusahaan)
                        di <strong>{{ $lamaran->perusahaan }}</strong>
                    @endif
                    telah <strong>diterima oleh HR</strong>.
                </p>

                <div style="margin-top:24px;padding:16px;border-radius:12px;background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;">
                    Status lamaran: <strong>Diterima</strong>
                </div>

                @if($interviewSchedule)
                    <div style="margin-top:18px;padding:16px;border-radius:12px;background:#eff6ff;border:1px solid #bfdbfe;color:#1e3a8a;">
                        <strong>Jadwal interview:</strong><br>
                        {{ $interviewSchedule }}
                    </div>
                @endif

                @if($contactName || $contactInfo)
                    <div style="margin-top:18px;padding:16px;border-radius:12px;background:#f8fafc;border:1px solid #e2e8f0;color:#334155;">
                        <strong>Kontak HR:</strong><br>
                        @if($contactName)
                            {{ $contactName }}<br>
                        @endif
                        @if($contactInfo)
                            {{ $contactInfo }}
                        @endif
                    </div>
                @endif

                @if($emailMessage)
                    <p style="margin-top:20px;white-space:pre-line;">{{ $emailMessage }}</p>
                @endif

                <p style="margin-top:26px;color:#64748b;font-size:14px;">
                    Email ini dikirim otomatis oleh sistem LokerInAja.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
