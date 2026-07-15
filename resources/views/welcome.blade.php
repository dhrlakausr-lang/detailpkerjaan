<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - LokerInAja</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen overflow-x-hidden bg-[linear-gradient(135deg,rgba(15,23,42,.92),rgba(30,58,138,.82),rgba(37,99,235,.74)),url('/images/bg.png')] bg-cover bg-center font-sans text-white">
    <main class="relative grid min-h-screen place-items-center px-6 py-10 transition duration-500 [&.page-exit]:scale-[.98] [&.page-exit]:opacity-0" id="welcomePage">
        <div class="absolute inset-0 pointer-events-none bg-[radial-gradient(circle_at_18%_18%,rgba(45,212,191,.24),transparent_28%),radial-gradient(circle_at_82%_22%,rgba(96,165,250,.22),transparent_30%),radial-gradient(circle_at_72%_86%,rgba(245,158,11,.18),transparent_24%)]"></div>

        <section class="relative z-[1] grid w-full max-w-[1120px] items-center gap-10 lg:grid-cols-[1.05fr_.95fr]">
            <div>
                <div class="mb-8 inline-flex items-center gap-3">
                    <img src="{{ asset('images/logolokerinaja.png') }}" alt="LokerInAja" class="h-16 w-16 object-contain drop-shadow-[0_16px_28px_rgba(0,0,0,.22)]">
                    <span class="text-lg font-extrabold tracking-wide">LokerInAja</span>
                </div>

                <div class="mb-5 inline-flex rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-bold text-blue-100 backdrop-blur">Platform karir untuk langkah berikutnya</div>
                <h1 class="max-w-[640px] text-[clamp(42px,7vw,76px)] font-extrabold leading-[.98] tracking-normal">
                    Temukan kerja yang <span class="text-[#fbbf24]">pas</span>, mulai dari sini.
                </h1>
                <p class="mt-6 max-w-[560px] text-lg leading-8 text-white/75">
                    Jelajahi lowongan terbaru, buka detail pekerjaan, lalu kirim lamaran dengan alur yang lebih rapi dan cepat.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a class="transition-link inline-flex min-h-12 items-center justify-center rounded-xl bg-[#f59e0b] px-6 font-extrabold text-[#111827] no-underline shadow-[0_18px_36px_rgba(245,158,11,.28)] transition hover:-translate-y-0.5 hover:bg-[#fbbf24]" href="{{ route('home') }}">Masuk ke Website</a>
                    <a class="transition-link inline-flex min-h-12 items-center justify-center rounded-xl border border-white/30 bg-white/10 px-6 font-extrabold text-white no-underline backdrop-blur transition hover:-translate-y-0.5 hover:bg-white/16" href="{{ route('lowongan.index') }}">Lihat Lowongan</a>
                </div>
            </div>

            <div class="relative min-h-[440px] lg:min-h-[560px]" aria-hidden="true">
                <div class="absolute left-[8%] top-[8%] h-[280px] w-[280px] rounded-full border border-white/20 bg-white/5 shadow-[0_0_80px_rgba(96,165,250,.24)]"></div>
                <div class="absolute left-0 top-[20%] rounded-2xl border border-white/15 bg-white/12 p-5 shadow-[0_18px_46px_rgba(0,0,0,.24)] backdrop-blur-md">
                    <strong class="block text-2xl">12 Lowongan</strong>
                    <span class="text-sm text-white/70">Aktif dari database LokerInAja</span>
                </div>

                <div class="absolute right-0 top-12 w-[min(390px,100%)] overflow-hidden rounded-3xl border border-white/20 bg-white/95 p-5 text-[#0f172a] shadow-[0_28px_80px_rgba(0,0,0,.30)]">
                    <img src="{{ asset('images/Job3.png') }}" alt="" class="mb-4 h-44 w-full rounded-2xl object-cover">
                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-extrabold text-[#2563eb]">Rekomendasi Hari Ini</span>
                    <h2 class="mt-4 text-2xl font-extrabold">UI/UX Designer</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Creative Studio - Bandung<br>Detail pekerjaan siap dibuka dan dilamar.</p>
                </div>

                <div class="absolute bottom-20 right-8 rounded-2xl border border-white/15 bg-[#0f172a]/75 p-5 shadow-[0_18px_46px_rgba(0,0,0,.22)] backdrop-blur-md max-sm:hidden">
                    <strong class="block">Login Terhubung</strong>
                    <span class="text-sm text-white/65">Profil kanan atas mengikuti user aktif.</span>
                </div>

                <div class="absolute bottom-0 left-0 right-0 overflow-hidden rounded-full border border-white/15 bg-white/10 p-2 backdrop-blur">
                    <div class="flex w-max gap-2">
                        @foreach(['Frontend Developer','Staff Administrasi','Mobile Developer','HR Recruiter','Sales Executive','Frontend Developer','Staff Administrasi','Mobile Developer'] as $chip)
                            <span class="rounded-full bg-white px-4 py-2 text-xs font-extrabold text-[#1e3a8a]">{{ $chip }}</span>
                        @endforeach
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
