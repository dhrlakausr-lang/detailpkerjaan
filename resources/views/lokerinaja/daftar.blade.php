<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Lowongan — LokerInAja</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css'])
</head>
<body class="scroll-smooth bg-[#f8fafc] font-sans text-[15px] leading-[1.6] text-[#334155]">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-[100] flex h-[68px] items-center justify-between border-b border-[#e2e8f0] bg-white px-10 shadow-nav">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logolokerinaja.png') }}" alt="LokerInAja" class="h-10 w-auto object-contain">
        </div>
        <ul class="flex list-none gap-1">
            <li><a href="{{ route('home') }}" class="rounded-lg px-3.5 py-1.5 text-sm font-medium text-[#64748b] no-underline transition-all duration-200 hover:bg-[#eff6ff] hover:text-[#2563eb]">Beranda</a></li>
            <li><a href="{{ route('daftar.lowongan') }}" class="rounded-lg bg-[#eff6ff] px-3.5 py-1.5 text-sm font-medium text-[#2563eb] no-underline transition-all duration-200 hover:bg-[#eff6ff] hover:text-[#2563eb]">Daftar Lowongan</a></li>
        </ul>
        <div class="flex items-center gap-2.5">
            @include('partials.profile-menu')
        </div>
    </nav>

    {{-- PAGE HEADER --}}
    <section class="bg-gradient-to-br from-[#0f172a] to-[#1e3a8a] pb-10 pt-12 text-white">
        <div class="mx-auto max-w-[1200px] px-6">
            <div class="mb-3.5 flex items-center gap-2 text-[13px] text-white/60">
                <a class="text-white/60 no-underline transition-colors duration-200 hover:text-white" href="{{ route('home') }}">Beranda</a>
                <i class="fas fa-chevron-right text-[10px]"></i>
                <span>Daftar Lowongan</span>
            </div>
            <h1 class="mb-1.5 text-[34px] font-extrabold">Daftar Lowongan Kerja</h1>
            <p class="text-[15px] text-white/70">{{ $lowongan->total() }} lowongan tersedia untuk kamu</p>
        </div>
    </section>

    {{-- CONTENT --}}
    <div class="mx-auto max-w-[1200px] px-6 pb-[60px] pt-10">
        <div class="grid grid-cols-[280px_1fr] items-start gap-7">

            {{-- SIDEBAR FILTER --}}
            <aside class="sticky top-[84px] flex flex-col gap-4">
                <form method="GET" action="{{ route('daftar.lowongan') }}" id="filterForm">
                    <div class="rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white p-5">
                        <h3 class="mb-4 flex items-center gap-2 text-[15px] font-bold text-[#0f172a]"><i class="fas fa-sliders-h text-[#2563eb]"></i> Filter</h3>

                        <div class="mb-4">
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-[.5px] text-[#64748b]">Cari Posisi</label>
                            <div class="relative flex items-center">
                                <i class="fas fa-search absolute left-2.5 text-[13px] text-[#64748b]"></i>
                                <input class="w-full rounded-lg border-[1.5px] border-[#e2e8f0] py-[9px] pl-8 pr-2.5 font-[inherit] text-[13px] text-[#0f172a] outline-none transition-colors duration-200 focus:border-[#2563eb]" type="text" name="search" value="{{ request('search') }}" placeholder="Nama posisi...">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-[.5px] text-[#64748b]">Kategori</label>
                            <select class="w-full cursor-pointer rounded-lg border-[1.5px] border-[#e2e8f0] bg-white px-3 py-[9px] font-[inherit] text-[13px] text-[#0f172a] outline-none transition-colors duration-200 focus:border-[#2563eb]" name="kategori">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoris as $kat)
                                    <option value="{{ $kat }}" @selected(request('kategori') == $kat)>
                                        {{ ucfirst($kat) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-[.5px] text-[#64748b]">Lokasi</label>
                            <select class="w-full cursor-pointer rounded-lg border-[1.5px] border-[#e2e8f0] bg-white px-3 py-[9px] font-[inherit] text-[13px] text-[#0f172a] outline-none transition-colors duration-200 focus:border-[#2563eb]" name="lokasi">
                                <option value="">Semua Lokasi</option>
                                @foreach($lokasis as $lok)
                                    <option value="{{ $lok }}" @selected(request('lokasi') == $lok)>
                                        {{ $lok }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="flex w-full cursor-pointer items-center justify-center gap-2 rounded-[9px] border-0 bg-[#2563eb] p-[11px] font-[inherit] text-sm font-bold text-white no-underline transition-colors duration-200 hover:bg-[#1d4ed8]">
                            <i class="fas fa-search"></i> Terapkan Filter
                        </button>

                        @if(request()->anyFilled(['search','kategori','lokasi']))
                            <a href="{{ route('daftar.lowongan') }}" class="mt-2 flex cursor-pointer items-center justify-center gap-1.5 rounded-[9px] border-[1.5px] border-[#e2e8f0] p-[9px] font-[inherit] text-[13px] font-semibold text-[#64748b] no-underline transition-all duration-200 hover:border-[#dc2626] hover:text-[#dc2626]">
                                <i class="fas fa-times"></i> Reset Filter
                            </a>
                        @endif
                    </div>

                    {{-- KATEGORI QUICK FILTER --}}
                    <div class="mt-4 rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white p-5">
                        <h3 class="mb-4 flex items-center gap-2 text-[15px] font-bold text-[#0f172a]"><i class="fas fa-th-large text-[#2563eb]"></i> Kategori</h3>
                        <div class="flex flex-col gap-1">
                            @php
                                $katIcons = [
                                    'it'                   => ['icon' => 'fa-laptop-code', 'color' => '#2563eb'],
                                    'marketing'            => ['icon' => 'fa-bullhorn',    'color' => '#ea580c'],
                                    'admin'                => ['icon' => 'fa-folder-open', 'color' => '#9333ea'],
                                    'retail'               => ['icon' => 'fa-store',       'color' => '#e11d48'],
                                    'human resource'       => ['icon' => 'fa-users',       'color' => '#0284c7'],
                                    'teknisi'              => ['icon' => 'fa-tools',       'color' => '#ca8a04'],
                                    'akutansi & keuangan'  => ['icon' => 'fa-chart-line',  'color' => '#0d9488'],
                                ];
                            @endphp
                            @foreach($kategoris as $kat)
                                @php $info = $katIcons[strtolower($kat)] ?? ['icon' => 'fa-briefcase', 'color' => '#64748b']; @endphp
                                <a href="{{ route('daftar.lowongan', ['kategori' => $kat]) }}"
                                @class([
                                    'kat-quick-item flex items-center gap-2.5 rounded-lg px-3 py-[9px] text-[13px] font-medium text-[#334155] no-underline transition-all duration-200 hover:bg-[#f8fafc] hover:text-[#2563eb]',
                                    'active bg-[#eff6ff] font-bold text-[#2563eb]' => request('kategori') == $kat,
                                ])>
                                    <i @class(['fas', $info['icon'], 'w-[18px] text-center text-sm']) style="color:{{ $info['color'] }}"></i>
                                    <span>{{ ucfirst($kat) }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </form>
            </aside>

            {{-- JOB LIST --}}
            <main class="flex flex-col gap-4">

                {{-- SORT BAR --}}
                <div class="flex flex-wrap items-center justify-between gap-2.5 rounded-xl border-[1.5px] border-[#e2e8f0] bg-white px-[18px] py-3.5">
                    <span class="text-sm text-[#64748b]">
                        Menampilkan <strong class="text-[#0f172a]">{{ $lowongan->firstItem() }}–{{ $lowongan->lastItem() }}</strong>
                        dari <strong class="text-[#0f172a]">{{ $lowongan->total() }}</strong> lowongan
                    </span>
                    @if(request()->anyFilled(['search','kategori','lokasi']))
                        <div class="flex flex-wrap gap-2">
                            @if(request('search'))
                                <span class="inline-flex items-center gap-1.5 rounded-full border border-[#bfdbfe] bg-[#eff6ff] px-2.5 py-1 text-xs font-semibold text-[#2563eb]">
                                    "{{ request('search') }}"
                                    <a class="text-inherit no-underline opacity-70 hover:opacity-100" href="{{ route('daftar.lowongan', array_merge(request()->except('search'))) }}"><i class="fas fa-times"></i></a>
                                </span>
                            @endif
                            @if(request('kategori'))
                                <span class="inline-flex items-center gap-1.5 rounded-full border border-[#bfdbfe] bg-[#eff6ff] px-2.5 py-1 text-xs font-semibold text-[#2563eb]">
                                    {{ ucfirst(request('kategori')) }}
                                    <a class="text-inherit no-underline opacity-70 hover:opacity-100" href="{{ route('daftar.lowongan', array_merge(request()->except('kategori'))) }}"><i class="fas fa-times"></i></a>
                                </span>
                            @endif
                            @if(request('lokasi'))
                                <span class="inline-flex items-center gap-1.5 rounded-full border border-[#bfdbfe] bg-[#eff6ff] px-2.5 py-1 text-xs font-semibold text-[#2563eb]">
                                    {{ request('lokasi') }}
                                    <a class="text-inherit no-underline opacity-70 hover:opacity-100" href="{{ route('daftar.lowongan', array_merge(request()->except('lokasi'))) }}"><i class="fas fa-times"></i></a>
                                </span>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- CARDS --}}
                <div class="flex flex-col gap-3.5">
                    @forelse($lowongan as $item)
                        @php
                            $gambar = $item->gambar ?? 'Job1.png';
                            $gambarUrl = filter_var($gambar, FILTER_VALIDATE_URL)
                                ? $gambar
                                : asset('images/' . basename($gambar));
                            $katInfo = $katIcons[strtolower($item->kategori ?? '')] ?? ['icon' => 'fa-briefcase', 'color' => '#64748b'];
                        @endphp
                        <div class="flex items-center gap-[18px] rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white p-5 transition-all duration-[250ms] hover:translate-x-1 hover:border-[#2563eb] hover:shadow-list-card">
                            <div>
                                <img class="h-[72px] w-[72px] shrink-0 rounded-xl border-[1.5px] border-[#e2e8f0] object-cover" src="{{ $gambarUrl }}" alt="{{ $item->posisi }}">
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="mb-2 flex items-start justify-between gap-3">
                                    <div>
                                        <h3 class="mb-1.5 overflow-hidden text-ellipsis whitespace-nowrap text-base font-bold text-[#0f172a]">{{ $item->posisi }}</h3>
                                        <div class="flex flex-wrap gap-3.5">
                                            <span class="flex items-center gap-[5px] text-[13px] text-[#64748b]"><i class="fas fa-map-marker-alt text-xs text-[#2563eb]"></i> {{ $item->lokasi }}</span>
                                            @if($item->kategori)
                                            <span class="flex items-center gap-[5px] text-[13px] text-[#64748b]">
                                                <i @class(['fas', $katInfo['icon']]) style="color:{{ $katInfo['color'] }}"></i>
                                                {{ ucfirst($item->kategori) }}
                                            </span>
                                            @endif
                                            <span class="flex items-center gap-[5px] text-[13px] text-[#64748b]"><i class="fas fa-clock text-xs text-[#2563eb]"></i> Full Time</span>
                                        </div>
                                    </div>
                                    <span class="shrink-0 whitespace-nowrap rounded-full bg-[#dcfce7] px-3 py-1 text-[11px] font-bold text-[#15803d]">Dibuka</span>
                                </div>
                                <div class="mt-1.5 line-clamp-2 overflow-hidden text-[13px] leading-[1.6] text-[#64748b]">
                                    Bergabunglah bersama tim kami sebagai <strong>{{ $item->posisi }}</strong>.
                                    Posisi ini berlokasi di <strong>{{ $item->lokasi }}</strong> dan terbuka untuk kandidat terbaik.
                                </div>
                            </div>
                            <div class="shrink-0">
                                <button
                                    class="btn-apply flex w-auto cursor-pointer items-center justify-center gap-2 whitespace-nowrap rounded-[10px] border-0 bg-[#2563eb] px-5 py-2.5 font-[inherit] text-[13px] font-bold text-white transition-all duration-200 hover:-translate-y-px hover:bg-[#1d4ed8] hover:shadow-apply"
                                    data-id="{{ $item->id }}"
                                    data-posisi="{{ $item->posisi }}"
                                    data-lokasi="{{ $item->lokasi }}">
                                    <i class="fas fa-paper-plane"></i> Lamar
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white px-5 py-[60px] text-center">
                            <i class="fas fa-search mb-4 block text-5xl text-[#e2e8f0]"></i>
                            <h3 class="mb-2 text-lg text-[#0f172a]">Lowongan tidak ditemukan</h3>
                            <p class="mb-5 text-[#64748b]">Coba ubah filter atau kata kunci pencarian kamu.</p>
                            <a href="{{ route('daftar.lowongan') }}" class="inline-flex cursor-pointer items-center justify-center gap-2 rounded-[9px] border-0 bg-[#2563eb] p-[11px] font-[inherit] text-sm font-bold text-white no-underline transition-colors duration-200 hover:bg-[#1d4ed8]">
                                Lihat Semua Lowongan
                            </a>
                        </div>
                    @endforelse
                </div>

                {{-- PAGINATION --}}
                @if($lowongan->hasPages())
                    <div class="mt-2 flex justify-center">
                        {{ $lowongan->appends(request()->query())->links('lokerinaja.pagination') }}
                    </div>
                @endif
            </main>
        </div>
    </div>

    {{-- FOOTER --}}
    <footer class="mt-[60px] bg-[#0f172a] pt-16 text-white/70">
        <div class="mx-auto max-w-[1200px] px-6">
            <div class="flex items-center justify-between py-6 text-[13px] text-white/35">
                <span>&copy; 2026 LokerInAja. All rights reserved.</span>
                <div class="flex gap-6">
                    <a class="text-white/35 no-underline transition-colors duration-200 hover:text-white/70" href="{{ route('home') }}">Beranda</a>
                    <a class="text-white/35 no-underline transition-colors duration-200 hover:text-white/70" href="{{ route('daftar.lowongan') }}">Daftar Lowongan</a>
                </div>
            </div>
        </div>
    </footer>

    <a href="https://wa.me/6281234567890?text=Halo%20LokerInAja!%20Saya%20ingin%20bertanya%20tentang%20lowongan%20kerja."
    target="_blank" class="fixed bottom-6 right-6 z-[999] flex h-[52px] w-[52px] items-center justify-center rounded-full bg-[#25d366] text-2xl text-white no-underline shadow-wa transition-all duration-[250ms] hover:scale-110 hover:text-white hover:shadow-wa-hover" title="Chat kami di WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script>
        window.lokerinajaApplyUrl = "{{ route('apply') }}";
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
