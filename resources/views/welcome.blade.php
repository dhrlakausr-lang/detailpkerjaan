<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - LokerInAja</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            overflow: hidden;
            font-family: "Plus Jakarta Sans", Arial, sans-serif;
            color: #ffffff;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, .92), rgba(30, 58, 138, .82), rgba(37, 99, 235, .74)),
                url("{{ asset('images/bg.png') }}") center / cover no-repeat;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle at 18% 18%, rgba(45, 212, 191, .28), transparent 28%),
                radial-gradient(circle at 82% 22%, rgba(96, 165, 250, .24), transparent 30%),
                radial-gradient(circle at 72% 86%, rgba(245, 158, 11, .20), transparent 24%);
            animation: glowShift 7s ease-in-out infinite alternate;
            pointer-events: none;
        }

        .welcome-page {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 32px;
        }

        .welcome-shell {
            width: min(1120px, 100%);
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            align-items: center;
            gap: 48px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 34px;
            opacity: 0;
            animation: slideIn .8s ease forwards;
        }

        .brand img {
            width: 76px;
            height: 76px;
            object-fit: contain;
            filter: drop-shadow(0 16px 28px rgba(0, 0, 0, .22));
        }

        .brand span {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: .02em;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            padding: 9px 14px;
            border: 1px solid rgba(255, 255, 255, .22);
            border-radius: 999px;
            background: rgba(255, 255, 255, .12);
            color: #dbeafe;
            font-size: 13px;
            font-weight: 700;
            backdrop-filter: blur(10px);
            opacity: 0;
            animation: slideIn .8s ease .12s forwards;
        }

        h1 {
            max-width: 680px;
            margin: 0;
            font-size: clamp(44px, 7vw, 84px);
            line-height: .98;
            font-weight: 800;
            letter-spacing: 0;
            opacity: 0;
            animation: slideIn .8s ease .22s forwards;
        }

        h1 span {
            color: #fbbf24;
        }

        .copy {
            max-width: 610px;
            margin: 24px 0 34px;
            color: rgba(255, 255, 255, .78);
            font-size: clamp(16px, 2vw, 19px);
            line-height: 1.8;
            opacity: 0;
            animation: slideIn .8s ease .34s forwards;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            opacity: 0;
            animation: slideIn .8s ease .46s forwards;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 54px;
            padding: 0 24px;
            border-radius: 14px;
            color: inherit;
            text-decoration: none;
            font-weight: 800;
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .btn-primary {
            background: #f59e0b;
            color: #111827;
            box-shadow: 0 18px 38px rgba(245, 158, 11, .28);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            background: #fbbf24;
            box-shadow: 0 22px 44px rgba(245, 158, 11, .38);
        }

        .btn-secondary {
            border: 1px solid rgba(255, 255, 255, .24);
            background: rgba(255, 255, 255, .10);
            backdrop-filter: blur(10px);
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, .18);
        }

        .showcase {
            position: relative;
            min-height: 560px;
            opacity: 0;
            animation: popIn .9s ease .35s forwards;
        }

        .orbit {
            position: absolute;
            inset: 54px 28px;
            border: 1px solid rgba(255, 255, 255, .20);
            border-radius: 36px;
            transform: rotate(-7deg);
            animation: floatSoft 5s ease-in-out infinite;
        }

        .main-card,
        .mini-card,
        .stat-card {
            position: absolute;
            border: 1px solid rgba(255, 255, 255, .20);
            background: rgba(255, 255, 255, .14);
            box-shadow: 0 28px 80px rgba(2, 6, 23, .28);
            backdrop-filter: blur(18px);
        }

        .main-card {
            right: 42px;
            top: 70px;
            width: min(370px, 84%);
            padding: 24px;
            border-radius: 28px;
            animation: cardFloat 4.8s ease-in-out infinite;
        }

        .main-card img {
            width: 100%;
            height: 190px;
            object-fit: cover;
            border-radius: 20px;
            margin-bottom: 18px;
        }

        .badge {
            display: inline-flex;
            margin-bottom: 12px;
            padding: 7px 11px;
            border-radius: 999px;
            background: rgba(34, 197, 94, .18);
            color: #bbf7d0;
            font-size: 12px;
            font-weight: 800;
        }

        .main-card h2 {
            margin: 0 0 8px;
            font-size: 25px;
            line-height: 1.2;
        }

        .main-card p {
            margin: 0;
            color: rgba(255, 255, 255, .68);
            line-height: 1.7;
        }

        .mini-card {
            left: 6px;
            top: 138px;
            width: 226px;
            padding: 18px;
            border-radius: 22px;
            animation: cardFloat 4.5s ease-in-out .55s infinite;
        }

        .mini-card strong,
        .stat-card strong {
            display: block;
            margin-bottom: 4px;
            font-size: 18px;
        }

        .mini-card span,
        .stat-card span {
            color: rgba(255, 255, 255, .70);
            font-size: 13px;
        }

        .stat-card {
            right: 18px;
            bottom: 68px;
            width: 210px;
            padding: 18px;
            border-radius: 22px;
            animation: cardFloat 4.4s ease-in-out .85s infinite;
        }

        .ticker {
            position: absolute;
            left: 34px;
            right: 34px;
            bottom: 6px;
            display: flex;
            gap: 12px;
            overflow: hidden;
            mask-image: linear-gradient(90deg, transparent, #000 14%, #000 86%, transparent);
        }

        .ticker-track {
            display: flex;
            gap: 12px;
            animation: tickerMove 16s linear infinite;
        }

        .chip {
            white-space: nowrap;
            border-radius: 999px;
            background: rgba(255, 255, 255, .14);
            border: 1px solid rgba(255, 255, 255, .18);
            padding: 10px 14px;
            color: #dbeafe;
            font-size: 13px;
            font-weight: 700;
        }

        .page-exit {
            animation: exitPage .5s ease forwards;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes popIn {
            from {
                opacity: 0;
                transform: translateX(34px) scale(.96);
            }
            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        @keyframes cardFloat {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-16px);
            }
        }

        @keyframes floatSoft {
            0%, 100% {
                transform: rotate(-7deg) translateY(0);
            }
            50% {
                transform: rotate(-4deg) translateY(-18px);
            }
        }

        @keyframes tickerMove {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-50%);
            }
        }

        @keyframes glowShift {
            from {
                opacity: .78;
                transform: scale(1);
            }
            to {
                opacity: 1;
                transform: scale(1.06);
            }
        }

        @keyframes exitPage {
            to {
                opacity: 0;
                transform: scale(.985) translateY(-18px);
                filter: blur(10px);
            }
        }

        @media (max-width: 900px) {
            body {
                overflow: auto;
            }

            .welcome-shell {
                grid-template-columns: 1fr;
                gap: 26px;
            }

            .showcase {
                min-height: 440px;
            }

            .main-card {
                right: 0;
                left: auto;
                width: min(360px, 92%);
            }

            .mini-card {
                left: 0;
            }
        }

        @media (max-width: 560px) {
            .welcome-page {
                padding: 22px;
            }

            .brand img {
                width: 58px;
                height: 58px;
            }

            .actions,
            .btn {
                width: 100%;
            }

            .showcase {
                min-height: 380px;
            }

            .main-card {
                top: 40px;
                width: 100%;
            }

            .mini-card,
            .stat-card,
            .orbit {
                display: none;
            }
        }
    </style>
</head>
<body>
    <main class="welcome-page" id="welcomePage">
        <section class="welcome-shell">
            <div>
                <div class="brand">
                    <img src="{{ asset('images/logolokerinaja.png') }}" alt="LokerInAja">
                    <span>LokerInAja</span>
                </div>
                <div class="eyebrow">Platform karir untuk langkah berikutnya</div>
                <h1>Temukan kerja yang <span>pas</span>, mulai dari sini.</h1>
                <p class="copy">
                    Jelajahi lowongan terbaru, buka detail pekerjaan, lalu kirim lamaran dengan alur yang lebih rapi dan cepat.
                </p>
                <div class="actions">
                    <a class="btn btn-primary transition-link" href="{{ route('home') }}">Masuk ke Website</a>
                    <a class="btn btn-secondary transition-link" href="{{ route('lowongan.index') }}">Lihat Lowongan</a>
                </div>
            </div>

            <div class="showcase" aria-hidden="true">
                <div class="orbit"></div>
                <div class="mini-card">
                    <strong>12 Lowongan</strong>
                    <span>Aktif dari database LokerInAja</span>
                </div>
                <div class="main-card">
                    <img src="{{ asset('images/Job3.png') }}" alt="">
                    <span class="badge">Rekomendasi Hari Ini</span>
                    <h2>UI/UX Designer</h2>
                    <p>Creative Studio - Bandung<br>Detail pekerjaan siap dibuka dan dilamar.</p>
                </div>
                <div class="stat-card">
                    <strong>Login Terhubung</strong>
                    <span>Profil kanan atas mengikuti user aktif.</span>
                </div>
                <div class="ticker">
                    <div class="ticker-track">
                        <span class="chip">Frontend Developer</span>
                        <span class="chip">Staff Administrasi</span>
                        <span class="chip">Mobile Developer</span>
                        <span class="chip">HR Recruiter</span>
                        <span class="chip">Sales Executive</span>
                        <span class="chip">Frontend Developer</span>
                        <span class="chip">Staff Administrasi</span>
                        <span class="chip">Mobile Developer</span>
                        <span class="chip">HR Recruiter</span>
                        <span class="chip">Sales Executive</span>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.querySelectorAll('.transition-link').forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                document.getElementById('welcomePage').classList.add('page-exit');
                window.setTimeout(function () {
                    window.location.href = link.href;
                }, 430);
            });
        });
    </script>
</body>
</html>
