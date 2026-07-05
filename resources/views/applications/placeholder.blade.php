<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Lamaran - LokerinAja</title>
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
</head>

<body>
    <main style="max-width: 760px; padding: 56px 24px; margin: 0 auto;">
        <section class="job-hero" style="display: block;">
            <h1>Lengkapi Lamaran</h1>
            <p style="text-align: justify;">Halaman ini sudah disiapkan sebagai tujuan tombol Lengkapi Lamaran. Nanti form data lengkap user bisa dibuat di sini dengan membaca <strong>job_id</strong> dan <strong>lamaran_id</strong> dari URL.</p>
            <a class="btn primary" href="{{ route('jobs.show', request('job_id', 1)) }}">Kembali ke Detail</a>
        </section>
    </main>
</body>

</html>
