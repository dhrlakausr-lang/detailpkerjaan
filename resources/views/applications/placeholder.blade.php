<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Lamaran - LokerinAja</title>
    @vite(['resources/css/app.css'])
</head>

<body class="m-0 text-[#151515] bg-[linear-gradient(rgba(247,251,255,0.9),rgba(247,251,255,0.92)),url('/images/BACKGROUND.jpeg')] bg-cover bg-center font-[Arial,Helvetica,sans-serif] text-[15px] leading-[1.55]">
    <main class="mx-auto max-w-[760px] px-6 py-14">
        <section class="block rounded-lg border border-[#e6eff7] bg-[linear-gradient(180deg,#f8fcff_0%,#ffffff_72%)] p-7 shadow-[0_8px_24px_rgba(20,35,55,0.08)]">
            <h1 class="mb-2 mt-0 text-[clamp(25px,2.4vw,34px)] leading-[1.18]">Lengkapi Lamaran</h1>
            <p class="text-justify text-base leading-[1.75]">Halaman ini sudah disiapkan sebagai tujuan tombol Lengkapi Lamaran. Nanti form data lengkap user bisa dibuat di sini dengan membaca <strong>job_id</strong> dan <strong>lamaran_id</strong> dari URL.</p>
            <a class="inline-flex min-h-[50px] items-center justify-center gap-2.5 rounded bg-[linear-gradient(135deg,#2f80e7,#245fd2)] px-6 py-0 text-[15px] font-extrabold uppercase tracking-normal text-white no-underline shadow-[0_10px_24px_rgba(47,128,231,0.24)] transition hover:-translate-y-0.5 hover:bg-[linear-gradient(135deg,#2875d8,#1f56c2)]" href="{{ route('jobs.show', request('job_id', 1)) }}">Kembali ke Detail</a>
        </section>
    </main>
</body>

</html>
