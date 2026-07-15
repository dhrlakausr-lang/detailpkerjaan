<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowongan Disimpan - LokerInAja</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-[#f8fafc] font-sans text-[#0f172a]">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-[1120px] items-center justify-between px-6 py-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3 text-[#0f172a] no-underline">
                <img src="{{ asset('images/logolokerinaja.png') }}" alt="LokerInAja" class="h-12 w-auto object-contain">
                <div>
                    <h1 class="text-lg font-extrabold">Lowongan Disimpan</h1>
                    <p class="text-xs text-slate-500">{{ session('email') }}</p>
                </div>
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('lowongan.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Cari Lowongan</a>
                <a href="{{ route('lamaran.status') }}" class="rounded-lg bg-[#2563eb] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#1d4ed8]">Status Lamaran</a>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-[1120px] px-6 py-8">
        <section class="mb-6 rounded-2xl bg-[linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb)] p-8 text-white shadow-xl">
            <h2 class="text-3xl font-extrabold">Lowongan yang kamu simpan</h2>
            <p class="mt-3 max-w-[720px] text-white/75">Semua lowongan yang kamu bookmark akan muncul di sini.</p>
        </section>

        <section class="grid gap-4">
            @forelse($savedJobs as $job)
                <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                        <div>
                            <h3 class="text-xl font-extrabold">{{ $job['title'] }}</h3>
                            <p class="mt-1 text-sm font-semibold text-[#2563eb]">{{ $job['company'] ?: 'LokerInAja' }}</p>
                            <p class="mt-2 text-sm text-slate-500">{{ $job['location'] }} · {{ $job['salary'] }}</p>
                        </div>
                        <a href="{{ $job['url'] }}" class="inline-flex rounded-lg bg-[#2563eb] px-5 py-3 text-sm font-extrabold text-white no-underline transition hover:bg-[#1d4ed8]">Lihat Detail</a>
                    </div>
                </article>
            @empty
                <div class="rounded-xl border border-dashed border-slate-300 bg-white p-10 text-center text-slate-500">
                    Belum ada lowongan yang disimpan.
                    <div class="mt-5">
                        <a href="{{ route('lowongan.index') }}" class="inline-flex rounded-lg bg-[#2563eb] px-5 py-3 font-semibold text-white transition hover:bg-[#1d4ed8]">Cari Lowongan</a>
                    </div>
                </div>
            @endforelse
        </section>
    </main>
</body>
</html>
