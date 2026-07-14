<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Lamaran - LokerInAja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; }</style>
</head>
<body class="min-h-screen bg-[#f8fafc] text-[#0f172a]">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-[1120px] items-center justify-between px-6 py-4">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logolokerinaja.png') }}" alt="LokerInAja" class="h-12 w-auto">
                <div>
                    <h1 class="text-lg font-extrabold">Status Lamaran</h1>
                    <p class="text-xs text-slate-500">{{ session('email') }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Home</a>
                <a href="{{ route('lowongan.index') }}" class="rounded-lg bg-[#2563eb] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#1d4ed8]">Find Jobs</a>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-[1120px] px-6 py-8">
        <section class="mb-6 rounded-2xl bg-[linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb)] p-8 text-white shadow-xl">
            <h2 class="text-3xl font-extrabold">Pantau lamaran kamu</h2>
            <p class="mt-3 max-w-[720px] text-white/75">Setiap lamaran yang kamu kirim menggunakan email akun ini akan muncul di sini, lengkap dengan status dari HR.</p>
        </section>

        <section class="grid gap-4">
            @forelse($lamarans as $lamaran)
                @php
                    $status = $lamaran->status ?? 'menunggu';
                    $statusClass = [
                        'menunggu' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                        'diterima' => 'bg-green-100 text-green-800 border-green-200',
                        'ditolak' => 'bg-red-100 text-red-800 border-red-200',
                    ][$status] ?? 'bg-slate-100 text-slate-700 border-slate-200';
                @endphp
                <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                        <div>
                            <h3 class="text-xl font-extrabold">{{ $lamaran->posisi }}</h3>
                            <p class="mt-1 text-sm text-slate-500">Dikirim pada {{ optional($lamaran->created_at)->format('d M Y H:i') }}</p>
                            @if($lamaran->cover_letter)
                                <p class="mt-3 max-w-[760px] text-sm leading-6 text-slate-600">{{ $lamaran->cover_letter }}</p>
                            @endif
                        </div>
                        <span class="inline-flex rounded-full border px-4 py-2 text-sm font-extrabold uppercase {{ $statusClass }}">{{ $status }}</span>
                    </div>
                    <div class="mt-5 flex flex-wrap gap-3">
                        <a href="{{ asset('upload/' . $lamaran->cv) }}" target="_blank" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Lihat CV</a>
                        @if($lamaran->portfolio)
                            <a href="{{ $lamaran->portfolio }}" target="_blank" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Portfolio</a>
                        @endif
                    </div>
                </article>
            @empty
                <div class="rounded-xl border border-dashed border-slate-300 bg-white p-10 text-center text-slate-500">
                    Belum ada lamaran untuk email akun ini.
                    <div class="mt-5">
                        <a href="{{ route('lowongan.index') }}" class="inline-flex rounded-lg bg-[#2563eb] px-5 py-3 font-semibold text-white transition hover:bg-[#1d4ed8]">Cari Lowongan</a>
                    </div>
                </div>
            @endforelse
        </section>

        <div class="mt-6">
            {{ $lamarans->links() }}
        </div>
    </main>
</body>
</html>
