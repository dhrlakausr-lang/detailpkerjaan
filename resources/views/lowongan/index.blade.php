<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Lowongan - LokerInAja</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="flex min-h-screen flex-col bg-[#f8fafc] font-sans text-[#0f172a]">

@php
    $req = request();
    $aktif = $req->filled('q') || $req->filled('lokasi') || $req->filled('kategori')
        || $req->filled('tipe') || $req->filled('pengaturan') || $req->filled('level');
@endphp

<nav class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur">
    <div class="mx-auto flex max-w-[1200px] items-center justify-between gap-4 px-6 py-3">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xl font-extrabold text-[#2563eb] no-underline">
            <img src="{{ asset('images/logolokerinaja.png') }}" alt="LokerInAja" class="h-11 w-auto object-contain">
            <span>LokerInAja</span>
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="rounded-lg border border-[#2563eb] px-3 py-1.5 text-sm font-semibold text-[#2563eb] no-underline transition hover:bg-[#eff6ff]">Home</a>
            @include('partials.profile-menu')
        </div>
    </div>
</nav>

<section class="bg-[linear-gradient(135deg,#0f172a_0%,#1e3a8a_48%,#2563eb_100%)] py-12 text-white">
    <div class="mx-auto max-w-[1200px] px-6 text-center">
        <h1 class="mb-2 text-3xl font-extrabold md:text-4xl">Temukan Lowongan Pekerjaan Impianmu</h1>
        <p class="mb-6 text-lg text-white/80">{{ $total }}+ lowongan dari perusahaan terpercaya menunggumu</p>

        <form method="GET" action="{{ route('lowongan.index') }}" id="filterForm" class="mx-auto grid max-w-[900px] gap-2 md:grid-cols-[1fr_260px_auto]">
            <div class="relative">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="q" value="{{ $req->q }}" class="min-h-12 w-full rounded-xl border border-transparent bg-white py-3 pl-11 pr-4 text-[#0f172a] outline-none focus:border-[#93c5fd] focus:ring-4 focus:ring-white/20" placeholder="Posisi atau perusahaan">
            </div>
            <div class="relative">
                <i class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <select name="lokasi" class="js-submit min-h-12 w-full cursor-pointer rounded-xl border border-transparent bg-white py-3 pl-11 pr-4 text-[#0f172a] outline-none focus:border-[#93c5fd] focus:ring-4 focus:ring-white/20">
                    <option value="">Semua Lokasi</option>
                    @foreach ($opsi['lokasi'] as $lok)
                        <option value="{{ $lok }}" @selected($req->lokasi === $lok)>{{ $lok }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="min-h-12 rounded-xl bg-[#2563eb] px-6 font-bold text-white transition hover:bg-[#1d4ed8]">Cari Lowongan</button>
        </form>
    </div>
</section>

<div class="mx-auto w-full max-w-[1200px] flex-1 px-6 py-8">
    <div class="grid gap-6 lg:grid-cols-[280px_1fr]">
        <aside>
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4 flex items-center justify-between gap-3">
                    <h2 class="text-lg font-extrabold"><i class="fa-solid fa-sliders text-[#2563eb]"></i> Filter</h2>
                    @if ($aktif)
                        <a href="{{ route('lowongan.index') }}" class="text-sm font-semibold text-[#2563eb] no-underline hover:underline">Reset</a>
                    @endif
                </div>

                @php
                    $groups = [
                        'kategori'   => ['label' => 'Kategori',         'items' => $opsi['kategori']],
                        'tipe'       => ['label' => 'Tipe Pekerjaan',   'items' => $opsi['tipe']],
                        'pengaturan' => ['label' => 'Pengaturan Kerja', 'items' => $opsi['pengaturan']],
                        'level'      => ['label' => 'Level',            'items' => $opsi['level']],
                    ];
                @endphp

                @foreach ($groups as $name => $g)
                    <div class="border-t border-slate-100 py-4">
                        <h3 class="mb-2 text-xs font-extrabold uppercase tracking-wide text-slate-500">{{ $g['label'] }}</h3>
                        <div class="flex items-center gap-2 rounded-lg px-1 py-1.5 text-sm text-slate-700">
                            <input type="radio" name="{{ $name }}" value="" form="filterForm" class="js-submit h-4 w-4 accent-[#2563eb]" id="{{ $name }}-all" @checked(! $req->filled($name))>
                            <label class="cursor-pointer" for="{{ $name }}-all">Semua</label>
                        </div>
                        @foreach ($g['items'] as $i => $item)
                            <div class="flex items-center gap-2 rounded-lg px-1 py-1.5 text-sm text-slate-700 transition hover:bg-blue-50 hover:text-[#2563eb]">
                                <input type="radio" name="{{ $name }}" value="{{ $item }}" form="filterForm" class="js-submit h-4 w-4 accent-[#2563eb]" id="{{ $name }}-{{ $i }}" @checked($req->get($name) === $item)>
                                <label class="cursor-pointer" for="{{ $name }}-{{ $i }}">{{ $item }}</label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </aside>

        <main>
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <p class="text-sm text-slate-600"><strong class="text-[#0f172a]">{{ $lowongan->total() }}</strong> lowongan ditemukan</p>
                <label class="flex items-center gap-2 text-sm">
                    <span class="text-slate-500">Urutkan:</span>
                    <select name="sort" form="filterForm" class="js-submit rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none focus:border-[#2563eb]">
                        <option value="terbaru" @selected($req->get('sort') === 'terbaru' || ! $req->filled('sort'))>Terbaru</option>
                        <option value="gaji_tinggi" @selected($req->get('sort') === 'gaji_tinggi')>Gaji Tertinggi</option>
                        <option value="gaji_rendah" @selected($req->get('sort') === 'gaji_rendah')>Gaji Terendah</option>
                    </select>
                </label>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                @forelse ($lowongan as $row)
                    @php $hue = crc32($row->perusahaan ?? $row->posisi) % 360; @endphp
                    <article class="h-full rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-[0_12px_34px_rgba(15,23,42,.12)]">
                        <div class="mb-4 flex items-start gap-3">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl font-bold" style="background:hsl({{ $hue }} 70% 92%); color:hsl({{ $hue }} 65% 38%)">
                                {{ $row->inisial }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="mb-1 font-extrabold text-slate-900">{{ $row->posisi }}</h3>
                                <p class="text-sm text-slate-500"><i class="fa-regular fa-building"></i> {{ $row->perusahaan }}</p>
                            </div>
                            <span class="shrink-0 rounded-full bg-green-50 px-2.5 py-1 text-xs font-bold text-green-700">{{ $row->diposting }}</span>
                        </div>

                        <div class="mb-3 flex flex-wrap gap-3 text-sm text-slate-500">
                            <span><i class="fa-solid fa-location-dot"></i> {{ $row->lokasi }}</span>
                            <span><i class="fa-solid fa-briefcase"></i> {{ $row->tipe_kerja }}</span>
                            <span><i class="fa-solid fa-house-laptop"></i> {{ $row->pengaturan_kerja }}</span>
                        </div>

                        <p class="mb-3 font-semibold text-green-700"><i class="fa-solid fa-wallet"></i> {{ $row->gaji_format }}</p>

                        <div class="mb-4 flex flex-wrap gap-2">
                            <span class="rounded-full bg-[#2563eb] px-2.5 py-1 text-xs font-bold text-white">{{ $row->kategori }}</span>
                            <span class="rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs font-bold text-slate-700">{{ $row->level }}</span>
                        </div>

                        <a class="flex w-full items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 no-underline transition hover:border-[#2563eb] hover:bg-blue-50 hover:text-[#2563eb]" href="{{ route('lowongan.detail', $row) }}">Lihat Detail</a>
                    </article>
                @empty
                    <div class="md:col-span-2">
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-5 py-14 text-center text-slate-500">
                            <i class="fa-solid fa-folder-open mb-4 text-5xl"></i>
                            <h3 class="mb-2 text-lg font-extrabold text-slate-800">Tidak ada lowongan yang cocok</h3>
                            <p class="mb-5">Coba ubah kata kunci atau reset filter.</p>
                            <a href="{{ route('lowongan.index') }}" class="inline-flex rounded-lg bg-[#2563eb] px-5 py-3 font-semibold text-white no-underline transition hover:bg-[#1d4ed8]">Reset Filter</a>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($lowongan->hasPages())
                <nav class="mt-6">
                    <ul class="flex flex-wrap justify-center gap-2">
                        <li>
                            <a class="{{ $lowongan->onFirstPage() ? 'pointer-events-none opacity-40' : '' }} inline-flex h-10 min-w-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-3 text-sm font-semibold text-slate-700 no-underline hover:bg-slate-50" href="{{ $lowongan->previousPageUrl() }}"><i class="fa-solid fa-chevron-left"></i></a>
                        </li>

                        @foreach ($lowongan->getUrlRange(1, $lowongan->lastPage()) as $page => $url)
                            <li>
                                <a class="inline-flex h-10 min-w-10 items-center justify-center rounded-lg border px-3 text-sm font-semibold no-underline {{ $page == $lowongan->currentPage() ? 'border-[#2563eb] bg-[#2563eb] text-white' : 'border-slate-300 bg-white text-slate-700 hover:bg-slate-50' }}" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <li>
                            <a class="{{ $lowongan->hasMorePages() ? '' : 'pointer-events-none opacity-40' }} inline-flex h-10 min-w-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-3 text-sm font-semibold text-slate-700 no-underline hover:bg-slate-50" href="{{ $lowongan->nextPageUrl() }}"><i class="fa-solid fa-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            @endif
        </main>
    </div>
</div>

<footer class="mt-auto border-t border-slate-200 bg-white py-6">
    <div class="mx-auto max-w-[1200px] px-6 text-center">
        <div class="mb-2 flex flex-wrap justify-center gap-4">
            <a href="#" class="text-sm text-slate-500 no-underline hover:text-slate-800">Tentang Kami</a>
            <a href="#" class="text-sm text-slate-500 no-underline hover:text-slate-800">Kontak</a>
            <a href="#" class="text-sm text-slate-500 no-underline hover:text-slate-800">Kebijakan Privasi</a>
            <a href="#" class="text-sm text-slate-500 no-underline hover:text-slate-800">Pusat Bantuan</a>
        </div>
        <p class="text-sm text-slate-500">© 2026 LokerinAja. All rights reserved.</p>
    </div>
</footer>

<script src="{{ asset('js/DaftarLowongan.js') }}"></script>
</body>
</html>
