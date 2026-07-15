<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LokerInAja — Temukan Karir Impianmu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css'])
</head>
<body class="scroll-smooth bg-[#f8fafc] font-sans text-[15px] leading-[1.6] text-[#334155]">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-[100] flex h-[68px] items-center justify-between border-b border-[#e2e8f0] bg-white px-10 shadow-[0_1px_3px_rgba(0,0,0,.08),0_1px_2px_rgba(0,0,0,.06)]">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logolokerinaja.png') }}" alt="LokerInAja" class="h-10 w-auto object-contain">
        </div>

        <ul class="flex list-none gap-1">
            <li><a href="{{ route('home') }}" class="rounded-lg bg-[#eff6ff] px-3.5 py-1.5 text-sm font-medium text-[#2563eb] no-underline transition-all duration-200 hover:bg-[#eff6ff] hover:text-[#2563eb]">Beranda</a></li>
            <li><a href="{{ route('lowongan.index') }}" class="rounded-lg px-3.5 py-1.5 text-sm font-medium text-[#64748b] no-underline transition-all duration-200 hover:bg-[#eff6ff] hover:text-[#2563eb]">Daftar Lowongan</a></li>
            <li><a href="#kategori" class="rounded-lg px-3.5 py-1.5 text-sm font-medium text-[#64748b] no-underline transition-all duration-200 hover:bg-[#eff6ff] hover:text-[#2563eb]">Kategori</a></li>
            <li><a href="#testimoni" class="rounded-lg px-3.5 py-1.5 text-sm font-medium text-[#64748b] no-underline transition-all duration-200 hover:bg-[#eff6ff] hover:text-[#2563eb]">Testimoni</a></li>
        </ul>

        <div class="flex items-center gap-2.5">
            <select class="cursor-pointer rounded-lg border border-[#e2e8f0] bg-white px-3 py-[7px] font-[inherit] text-[13px] text-[#334155] outline-none" id="navLokasi">
                <option value=""><i class="fas fa-map-marker-alt"></i> Semua Lokasi</option>
                <option value="jakarta">Jakarta</option>
                <option value="bandung">Bandung</option>
                <option value="surabaya">Surabaya</option>
                <option value="medan">Medan</option>
            </select>
            @include('partials.profile-menu')
        </div>
    </nav>

    {{-- HERO --}}
    <section class="relative flex min-h-[580px] items-center overflow-hidden">
        <div class="absolute inset-0 z-0 bg-[linear-gradient(135deg,rgba(15,23,42,.85)_0%,rgba(30,58,138,.75)_50%,rgba(29,78,216,.65)_100%),url('/images/bg.png')] bg-cover bg-center bg-no-repeat"></div>
        <div class="relative z-[1] mx-auto max-w-[800px] px-6 py-20 text-center text-white">
            <div class="mb-6 inline-flex items-center gap-1.5 rounded-full border border-[rgba(245,158,11,.3)] bg-[rgba(245,158,11,.15)] px-4 py-1.5 text-[13px] font-semibold text-[#fbbf24]"><i class="fas fa-fire"></i> 500+ Lowongan Baru Minggu Ini</div>
            <h1 class="mb-[18px] text-[56px] font-extrabold leading-[1.1] tracking-[-1px]">Temukan Karir<br><span class="bg-gradient-to-r from-[#f59e0b] to-[#fbbf24] bg-clip-text text-transparent">Impian Kamu</span></h1>
            <p class="mx-auto mb-9 max-w-[560px] text-[17px] text-[rgba(255,255,255,.75)]">Platform pencarian kerja terpercaya dengan ribuan lowongan dari perusahaan terbaik Indonesia</p>

            <div class="mx-auto mb-9 flex max-w-[700px] items-center gap-0 rounded-2xl bg-white p-2 shadow-[0_20px_60px_rgba(0,0,0,.3)]">
                <div class="relative flex flex-1 items-center gap-2.5 px-4 py-2 text-[#64748b]">
                    <i class="fas fa-search shrink-0 text-[15px] text-[#2563eb]"></i>
                    <input class="w-full border-0 bg-transparent font-[inherit] text-sm text-[#0f172a] outline-none placeholder:text-[#64748b]" type="text" id="searchKeyword" placeholder="Posisi, keahlian, atau kategori..." autocomplete="off">
                    <div id="autocompleteDropdown" class="autocomplete-dropdown hidden absolute top-[calc(100%+8px)] -left-4 -right-4 z-[999] max-h-[340px] overflow-x-hidden overflow-y-auto rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white shadow-[0_12px_40px_rgba(0,0,0,.18)] [&.show]:block"></div>
                </div>
                <div class="h-9 w-px shrink-0 bg-[#e2e8f0]"></div>
                <div class="flex flex-1 items-center gap-2.5 px-4 py-2 text-[#64748b]">
                    <i class="fas fa-map-marker-alt shrink-0 text-[15px] text-[#2563eb]"></i>
                    <input class="w-full border-0 bg-transparent font-[inherit] text-sm text-[#0f172a] outline-none placeholder:text-[#64748b]" type="text" id="searchLokasi" placeholder="Kota atau lokasi...">
                </div>
                <button class="btn-search flex shrink-0 cursor-pointer items-center justify-center gap-2 whitespace-nowrap rounded-xl border-0 bg-[#2563eb] px-7 py-[13px] font-[inherit] text-sm font-bold text-white transition-colors duration-200 hover:bg-[#1d4ed8] disabled:cursor-not-allowed disabled:bg-[#93c5fd]" onclick="doSearch()">Cari Kerja</button>
            </div>

            {{-- Data lowongan untuk autocomplete --}}
            <script>
                window.allLowongan = @json($lowonganJson);
            </script>

            <div class="flex items-center justify-center gap-0">
                <div class="flex flex-col items-center px-8"><strong class="text-2xl font-extrabold text-white">12.000+</strong> <span class="mt-0.5 text-xs text-[rgba(255,255,255,.6)]">Lowongan Aktif</span></div>
                <div class="h-10 w-px bg-[rgba(255,255,255,.2)]"></div>
                <div class="flex flex-col items-center px-8"><strong class="text-2xl font-extrabold text-white">3.500+</strong> <span class="mt-0.5 text-xs text-[rgba(255,255,255,.6)]">Perusahaan</span></div>
                <div class="h-10 w-px bg-[rgba(255,255,255,.2)]"></div>
                <div class="flex flex-col items-center px-8"><strong class="text-2xl font-extrabold text-white">98%</strong> <span class="mt-0.5 text-xs text-[rgba(255,255,255,.6)]">Berhasil Diterima</span></div>
            </div>
        </div>
    </section>

    {{-- KATEGORI --}}
    <section class="section bg-white py-20" id="kategori">
        <div class="mx-auto max-w-[1200px] px-6">
            <div class="mb-12 text-center">
                <h2 class="mb-2.5 text-[34px] font-extrabold tracking-[-.5px] text-[#0f172a]">Jelajahi Berdasarkan Kategori</h2>
                <p class="text-base text-[#64748b]">Temukan pekerjaan sesuai bidang keahlianmu</p>
            </div>

            <div class="flex flex-wrap justify-center gap-3.5">
                <div class="kategori-card group flex min-w-[110px] cursor-pointer flex-col items-center gap-2.5 rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white px-6 py-5 text-[13px] font-semibold text-[#334155] transition-all duration-[250ms] hover:-translate-y-[3px] hover:border-[#2563eb] hover:bg-[#eff6ff] hover:text-[#2563eb] hover:shadow-[0_4px_16px_rgba(0,0,0,.10)] [&.active]:-translate-y-[3px] [&.active]:border-[#2563eb] [&.active]:bg-[#eff6ff] [&.active]:text-[#2563eb] [&.active]:shadow-[0_4px_16px_rgba(0,0,0,.10)]" data-kategori="">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#eff6ff] text-xl text-[#2563eb] transition-transform duration-[250ms] group-hover:scale-110"><i class="fas fa-layer-group"></i></div>
                    <span>Semua</span>
                </div>
                <div class="kategori-card group flex min-w-[110px] cursor-pointer flex-col items-center gap-2.5 rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white px-6 py-5 text-[13px] font-semibold text-[#334155] transition-all duration-[250ms] hover:-translate-y-[3px] hover:border-[#2563eb] hover:bg-[#eff6ff] hover:text-[#2563eb] hover:shadow-[0_4px_16px_rgba(0,0,0,.10)] [&.active]:-translate-y-[3px] [&.active]:border-[#2563eb] [&.active]:bg-[#eff6ff] [&.active]:text-[#2563eb] [&.active]:shadow-[0_4px_16px_rgba(0,0,0,.10)]" data-kategori="it">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#f0fdf4] text-xl text-[#16a34a] transition-transform duration-[250ms] group-hover:scale-110"><i class="fas fa-laptop-code"></i></div>
                    <span>IT & Tech</span>
                </div>
                <div class="kategori-card group flex min-w-[110px] cursor-pointer flex-col items-center gap-2.5 rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white px-6 py-5 text-[13px] font-semibold text-[#334155] transition-all duration-[250ms] hover:-translate-y-[3px] hover:border-[#2563eb] hover:bg-[#eff6ff] hover:text-[#2563eb] hover:shadow-[0_4px_16px_rgba(0,0,0,.10)] [&.active]:-translate-y-[3px] [&.active]:border-[#2563eb] [&.active]:bg-[#eff6ff] [&.active]:text-[#2563eb] [&.active]:shadow-[0_4px_16px_rgba(0,0,0,.10)]" data-kategori="marketing">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#fff7ed] text-xl text-[#ea580c] transition-transform duration-[250ms] group-hover:scale-110"><i class="fas fa-bullhorn"></i></div>
                    <span>Marketing</span>
                </div>
                <div class="kategori-card group flex min-w-[110px] cursor-pointer flex-col items-center gap-2.5 rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white px-6 py-5 text-[13px] font-semibold text-[#334155] transition-all duration-[250ms] hover:-translate-y-[3px] hover:border-[#2563eb] hover:bg-[#eff6ff] hover:text-[#2563eb] hover:shadow-[0_4px_16px_rgba(0,0,0,.10)] [&.active]:-translate-y-[3px] [&.active]:border-[#2563eb] [&.active]:bg-[#eff6ff] [&.active]:text-[#2563eb] [&.active]:shadow-[0_4px_16px_rgba(0,0,0,.10)]" data-kategori="administrasi">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#fdf4ff] text-xl text-[#9333ea] transition-transform duration-[250ms] group-hover:scale-110"><i class="fas fa-folder-open"></i></div>
                    <span>Admin</span>
                </div>
                <div class="kategori-card group flex min-w-[110px] cursor-pointer flex-col items-center gap-2.5 rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white px-6 py-5 text-[13px] font-semibold text-[#334155] transition-all duration-[250ms] hover:-translate-y-[3px] hover:border-[#2563eb] hover:bg-[#eff6ff] hover:text-[#2563eb] hover:shadow-[0_4px_16px_rgba(0,0,0,.10)] [&.active]:-translate-y-[3px] [&.active]:border-[#2563eb] [&.active]:bg-[#eff6ff] [&.active]:text-[#2563eb] [&.active]:shadow-[0_4px_16px_rgba(0,0,0,.10)]" data-kategori="retail">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#fff1f2] text-xl text-[#e11d48] transition-transform duration-[250ms] group-hover:scale-110"><i class="fas fa-store"></i></div>
                    <span>Retail</span>
                </div>
                <div class="kategori-card group flex min-w-[110px] cursor-pointer flex-col items-center gap-2.5 rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white px-6 py-5 text-[13px] font-semibold text-[#334155] transition-all duration-[250ms] hover:-translate-y-[3px] hover:border-[#2563eb] hover:bg-[#eff6ff] hover:text-[#2563eb] hover:shadow-[0_4px_16px_rgba(0,0,0,.10)] [&.active]:-translate-y-[3px] [&.active]:border-[#2563eb] [&.active]:bg-[#eff6ff] [&.active]:text-[#2563eb] [&.active]:shadow-[0_4px_16px_rgba(0,0,0,.10)]" data-kategori="human resource">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#f0f9ff] text-xl text-[#0284c7] transition-transform duration-[250ms] group-hover:scale-110"><i class="fas fa-users"></i></div>
                    <span>Human Resource</span>
                </div>
                <div class="kategori-card group flex min-w-[110px] cursor-pointer flex-col items-center gap-2.5 rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white px-6 py-5 text-[13px] font-semibold text-[#334155] transition-all duration-[250ms] hover:-translate-y-[3px] hover:border-[#2563eb] hover:bg-[#eff6ff] hover:text-[#2563eb] hover:shadow-[0_4px_16px_rgba(0,0,0,.10)] [&.active]:-translate-y-[3px] [&.active]:border-[#2563eb] [&.active]:bg-[#eff6ff] [&.active]:text-[#2563eb] [&.active]:shadow-[0_4px_16px_rgba(0,0,0,.10)]" data-kategori="teknik">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#fefce8] text-xl text-[#ca8a04] transition-transform duration-[250ms] group-hover:scale-110"><i class="fas fa-tools"></i></div>
                    <span>Teknisi</span>
                </div>
                <div class="kategori-card group flex min-w-[110px] cursor-pointer flex-col items-center gap-2.5 rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white px-6 py-5 text-[13px] font-semibold text-[#334155] transition-all duration-[250ms] hover:-translate-y-[3px] hover:border-[#2563eb] hover:bg-[#eff6ff] hover:text-[#2563eb] hover:shadow-[0_4px_16px_rgba(0,0,0,.10)] [&.active]:-translate-y-[3px] [&.active]:border-[#2563eb] [&.active]:bg-[#eff6ff] [&.active]:text-[#2563eb] [&.active]:shadow-[0_4px_16px_rgba(0,0,0,.10)]" data-kategori="keuangan">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#f0fdfa] text-xl text-[#0d9488] transition-transform duration-[250ms] group-hover:scale-110"><i class="fas fa-chart-line"></i></div>
                    <span>Akuntansi</span>
                </div>
            </div>
        </div>
    </section>

    {{-- LOWONGAN --}}
    <section class="section bg-[#f8fafc] py-20" id="lowongan">
        <div class="mx-auto max-w-[1200px] px-6">
            <div class="mb-12 text-center">
                <h2 class="mb-2.5 text-[34px] font-extrabold tracking-[-.5px] text-[#0f172a]">Lowongan Terbaru</h2>
                <p class="text-base text-[#64748b]">Peluang karir terkini dari perusahaan ternama</p>
            </div>

            <div class="grid grid-cols-[repeat(auto-fill,minmax(280px,1fr))] gap-5" id="jobGrid">
                @forelse ($lowongan as $item)
                    @php
                        $gambar = $item->gambar ?? 'Job1.png';
                        $gambarUrl = filter_var($gambar, FILTER_VALIDATE_URL)
                            ? $gambar
                            : asset('images/' . basename($gambar));
                    @endphp
                    <div class="job-card flex flex-col overflow-hidden rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white transition-all duration-[250ms] hover:-translate-y-1 hover:border-[#2563eb] hover:shadow-[0_10px_40px_rgba(0,0,0,.14)]" data-kategori="{{ strtolower($item->kategori ?? '') }}">
                        <div class="relative flex items-center justify-between bg-gradient-to-br from-[#eff6ff] to-[#dbeafe] p-6">
                            <img src="{{ $gambarUrl }}" alt="{{ $item->posisi ?? 'Lowongan' }}" class="h-14 w-14 rounded-xl border border-[#e2e8f0] bg-white object-cover">
                            <span class="rounded-full bg-[#dcfce7] px-2.5 py-1 text-[11px] font-bold text-[#15803d]">{{ $item->tipe_kerja ?? 'Full-time' }}</span>
                        </div>
                        <div class="flex-1 px-5 pb-3 pt-[18px]">
                            <h3 class="job-title mb-2.5 text-base font-bold leading-[1.3] text-[#0f172a]">{{ $item->posisi ?? '-' }}</h3>
                            <div class="job-meta flex flex-col gap-[5px]">
                                <span class="flex items-center gap-1.5 text-[13px] text-[#64748b]"><i class="fas fa-building w-3.5 text-xs text-[#2563eb]"></i> {{ $item->perusahaan ?? '-' }}</span>
                                <span class="flex items-center gap-1.5 text-[13px] text-[#64748b]"><i class="fas fa-map-marker-alt w-3.5 text-xs text-[#2563eb]"></i> {{ $item->lokasi ?? '-' }} · {{ $item->pengaturan_kerja ?? '-' }}</span>
                                @if($item->kategori)
                                <span class="flex items-center gap-1.5 text-[13px] text-[#64748b]"><i class="fas fa-tag w-3.5 text-xs text-[#2563eb]"></i> {{ $item->kategori }}</span>
                                @endif
                                <span class="mt-1 flex items-center gap-1.5 text-sm font-extrabold text-[#15803d]"><i class="fas fa-wallet w-3.5 text-xs"></i> {{ $item->gaji_format }}</span>
                            </div>
                        </div>
                        <div class="px-5 pb-5 pt-3.5">
                            <a
                                class="flex w-full cursor-pointer items-center justify-center gap-2 rounded-[10px] border-0 bg-[#2563eb] p-[11px] font-[inherit] text-sm font-bold text-white no-underline transition-all duration-200 hover:-translate-y-px hover:bg-[#1d4ed8] hover:text-white hover:shadow-[0_4px_12px_rgba(37,99,235,.35)]"
                                href="{{ route('lowongan.detail', $item) }}">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-[1/-1] p-[60px] text-center text-[#64748b]">
                        <i class="fas fa-inbox mb-4 block text-5xl opacity-40"></i>
                        <p>Belum ada lowongan tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- FEATURED --}}
    <section class="py-20 bg-white">
        <div class="mx-auto max-w-[1200px] px-6">
            <div class="mb-12 text-center">
                <h2 class="mb-2.5 text-[34px] font-extrabold tracking-[-.5px] text-[#0f172a]">Lowongan Unggulan</h2>
                <p class="text-base text-[#64748b]">Dipilih khusus untuk kamu</p>
            </div>

            <div class="grid grid-cols-3 gap-6">
                <div class="featured-card cursor-pointer overflow-hidden rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white transition-all duration-[250ms] hover:-translate-y-1 hover:border-[#2563eb] hover:shadow-[0_10px_40px_rgba(0,0,0,.14)]">
                    <img class="h-[180px] w-full object-cover" src="{{ asset('images/Job1.png') }}" alt="Senior Frontend Developer">
                    <div class="p-5">
                        <span class="mb-2.5 inline-block rounded-full bg-[#fff7ed] px-2.5 py-[3px] text-[11px] font-bold uppercase tracking-[.5px] text-[#ea580c]">Unggulan</span>
                        <h3 class="mb-2 text-[17px] font-bold text-[#0f172a]">Senior Frontend Developer</h3>
                        <p class="mb-1 flex items-center gap-1.5 text-[13px] text-[#64748b]"><i class="fas fa-building w-3.5 text-[#2563eb]"></i> PT Digital Tech</p>
                        <p class="mb-1 flex items-center gap-1.5 text-[13px] text-[#64748b]"><i class="fas fa-map-marker-alt w-3.5 text-[#2563eb]"></i> Jakarta</p>
                        <a href="{{ $featuredLinks['frontend'] }}" class="mt-3.5 inline-flex cursor-pointer items-center gap-1.5 rounded-lg border-[1.5px] border-[#2563eb] bg-transparent px-[18px] py-[9px] font-[inherit] text-[13px] font-semibold text-[#2563eb] no-underline transition-all duration-200 hover:bg-[#2563eb] hover:text-white">Lihat Detail <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="featured-card cursor-pointer overflow-hidden rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white transition-all duration-[250ms] hover:-translate-y-1 hover:border-[#2563eb] hover:shadow-[0_10px_40px_rgba(0,0,0,.14)]">
                    <img class="h-[180px] w-full object-cover" src="{{ asset('images/Job2.png') }}" alt="UI/UX Designer">
                    <div class="p-5">
                        <span class="mb-2.5 inline-block rounded-full bg-[#fff7ed] px-2.5 py-[3px] text-[11px] font-bold uppercase tracking-[.5px] text-[#ea580c]">Unggulan</span>
                        <h3 class="mb-2 text-[17px] font-bold text-[#0f172a]">UI/UX Designer</h3>
                        <p class="mb-1 flex items-center gap-1.5 text-[13px] text-[#64748b]"><i class="fas fa-building w-3.5 text-[#2563eb]"></i> Creative Studio</p>
                        <p class="mb-1 flex items-center gap-1.5 text-[13px] text-[#64748b]"><i class="fas fa-map-marker-alt w-3.5 text-[#2563eb]"></i> Bandung</p>
                        <a href="{{ $featuredLinks['uiux'] }}" class="mt-3.5 inline-flex cursor-pointer items-center gap-1.5 rounded-lg border-[1.5px] border-[#2563eb] bg-transparent px-[18px] py-[9px] font-[inherit] text-[13px] font-semibold text-[#2563eb] no-underline transition-all duration-200 hover:bg-[#2563eb] hover:text-white">Lihat Detail <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="featured-card cursor-pointer overflow-hidden rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white transition-all duration-[250ms] hover:-translate-y-1 hover:border-[#2563eb] hover:shadow-[0_10px_40px_rgba(0,0,0,.14)]">
                    <img class="h-[180px] w-full object-cover" src="{{ asset('images/Job3.png') }}" alt="Data Analyst">
                    <div class="p-5">
                        <span class="mb-2.5 inline-block rounded-full bg-[#fff7ed] px-2.5 py-[3px] text-[11px] font-bold uppercase tracking-[.5px] text-[#ea580c]">Unggulan</span>
                        <h3 class="mb-2 text-[17px] font-bold text-[#0f172a]">Data Analyst</h3>
                        <p class="mb-1 flex items-center gap-1.5 text-[13px] text-[#64748b]"><i class="fas fa-building w-3.5 text-[#2563eb]"></i> PT Inovasi Data</p>
                        <p class="mb-1 flex items-center gap-1.5 text-[13px] text-[#64748b]"><i class="fas fa-map-marker-alt w-3.5 text-[#2563eb]"></i> Surabaya</p>
                        <a href="{{ $featuredLinks['data'] }}" class="mt-3.5 inline-flex cursor-pointer items-center gap-1.5 rounded-lg border-[1.5px] border-[#2563eb] bg-transparent px-[18px] py-[9px] font-[inherit] text-[13px] font-semibold text-[#2563eb] no-underline transition-all duration-200 hover:bg-[#2563eb] hover:text-white">Lihat Detail <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TESTIMONI --}}
    <section class="py-20 bg-[#f8fafc]" id="testimoni">
        <div class="mx-auto max-w-[1200px] px-6">
            <div class="mb-12 text-center">
                <h2 class="mb-2.5 text-[34px] font-extrabold tracking-[-.5px] text-[#0f172a]">Kata Mereka</h2>
                <p class="text-base text-[#64748b]">Ribuan pencari kerja sudah membuktikannya</p>
            </div>

            <div class="grid grid-cols-3 items-start gap-6">
                <div class="rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white p-7 transition-all duration-[250ms] hover:-translate-y-[3px] hover:shadow-[0_4px_16px_rgba(0,0,0,.10)]">
                    <div class="mb-3.5 flex gap-[3px] text-[13px] text-[#f59e0b]">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="mb-5 text-[15px] italic leading-[1.7] text-[#334155]">"Aku dapet kerja dalam 2 minggu lewat LokerInAja! Prosesnya cepat dan mudah banget."</p>
                    <div class="flex items-center gap-3">
                        <div class="flex h-[42px] w-[42px] shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-[#2563eb] to-[#7c3aed] text-base font-extrabold text-white">A</div>
                        <div>
                            <strong class="block text-sm font-bold text-[#0f172a]">Andi Pratama</strong>
                            <span class="text-xs text-[#64748b]">Frontend Developer</span>
                        </div>
                    </div>
                </div>

                <div class="-translate-y-2 rounded-[14px] border-[1.5px] border-transparent bg-gradient-to-br from-[#1e3a8a] to-[#2563eb] p-7 text-white shadow-[0_10px_40px_rgba(0,0,0,.14)] transition-all duration-[250ms] hover:-translate-y-[11px]">
                    <div class="mb-3.5 flex gap-[3px] text-[13px] text-[#f59e0b]">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="mb-5 text-[15px] italic leading-[1.7] text-[rgba(255,255,255,.9)]">"Web-nya gampang banget dipakai. Tampilan bersih dan lowongannya lengkap dari berbagai bidang!"</p>
                    <div class="flex items-center gap-3">
                        <div class="flex h-[42px] w-[42px] shrink-0 items-center justify-center rounded-full bg-[rgba(255,255,255,.2)] text-base font-extrabold text-white">S</div>
                        <div>
                            <strong class="block text-sm font-bold text-white">Sinta Dewi</strong>
                            <span class="text-xs text-[rgba(255,255,255,.65)]">UI/UX Designer</span>
                        </div>
                    </div>
                </div>

                <div class="rounded-[14px] border-[1.5px] border-[#e2e8f0] bg-white p-7 transition-all duration-[250ms] hover:-translate-y-[3px] hover:shadow-[0_4px_16px_rgba(0,0,0,.10)]">
                    <div class="mb-3.5 flex gap-[3px] text-[13px] text-[#f59e0b]">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="mb-5 text-[15px] italic leading-[1.7] text-[#334155]">"Sangat membantu! Dalam 3 hari lamar, langsung dipanggil interview. Recommended banget!"</p>
                    <div class="flex items-center gap-3">
                        <div class="flex h-[42px] w-[42px] shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-[#2563eb] to-[#7c3aed] text-base font-extrabold text-white">R</div>
                        <div>
                            <strong class="block text-sm font-bold text-[#0f172a]">Rizky Maulana</strong>
                            <span class="text-xs text-[#64748b]">Data Analyst</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA BANNER --}}
    <section class="bg-white py-20">
        <div class="mx-auto max-w-[1200px] px-6">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#0f172a] via-[#1e3a8a] to-[#2563eb] px-10 py-16 text-center text-white before:absolute before:-right-20 before:-top-20 before:h-[280px] before:w-[280px] before:rounded-full before:bg-[rgba(255,255,255,.05)] after:absolute after:-bottom-[60px] after:-left-[60px] after:h-[200px] after:w-[200px] after:rounded-full after:bg-[rgba(255,255,255,.04)]">
                <h2 class="relative z-[1] mb-3.5 text-[38px] font-extrabold">Siap Memulai Karir Baru?</h2>
                <p class="relative z-[1] mb-8 text-base text-[rgba(255,255,255,.75)]">Bergabung dengan 50.000+ pencari kerja yang sudah menemukan pekerjaan impian mereka</p>
                <a href="{{ route('login') }}" class="relative z-[1] inline-flex cursor-pointer items-center gap-2 rounded-xl border-0 bg-[#f59e0b] px-9 py-[15px] font-[inherit] text-[15px] font-extrabold text-[#1a1a1a] no-underline transition-all duration-200 hover:-translate-y-0.5 hover:bg-[#fbbf24] hover:text-[#1a1a1a] hover:shadow-[0_8px_24px_rgba(245,158,11,.4)]">Daftar Gratis Sekarang <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-[#0f172a] pt-16 text-[rgba(255,255,255,.7)]">
        <div class="mx-auto max-w-[1200px] px-6">
            <div class="grid grid-cols-[2fr_1fr_1fr_1.5fr] gap-12 border-b border-[rgba(255,255,255,.08)] pb-12">
                <div>
                    <img src="{{ asset('images/logolokerinaja.png') }}" alt="LokerInAja" class="mb-3.5 block h-10 w-auto object-contain">
                    <p class="mb-5 text-sm leading-[1.7] text-[rgba(255,255,255,.55)]">Platform pencarian kerja terpercaya untuk menghubungkan talenta terbaik dengan perusahaan impian.</p>
                    <form class="mb-5 flex overflow-hidden rounded-[10px] border border-[rgba(255,255,255,.1)] bg-[rgba(255,255,255,.07)]" onsubmit="subscribeEmail(event)">
                        <input class="flex-1 border-0 bg-transparent px-3.5 py-2.5 font-[inherit] text-[13px] text-white shadow-none outline-none placeholder:text-[rgba(255,255,255,.35)]" type="email" id="subscribeInput" placeholder="Email kamu..." required>
                        <button class="cursor-pointer border-0 bg-[#2563eb] px-4 py-2.5 text-sm text-white transition-colors duration-200 hover:bg-[#1d4ed8]" type="submit"><i class="fas fa-paper-plane"></i></button>
                    </form>
                    <div class="flex gap-2.5">
                        <a class="flex h-9 w-9 items-center justify-center rounded-lg bg-[rgba(255,255,255,.07)] text-sm text-[rgba(255,255,255,.6)] no-underline transition-all duration-200 hover:bg-[#2563eb] hover:text-white" href="https://facebook.com" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="flex h-9 w-9 items-center justify-center rounded-lg bg-[rgba(255,255,255,.07)] text-sm text-[rgba(255,255,255,.6)] no-underline transition-all duration-200 hover:bg-[#2563eb] hover:text-white" href="https://instagram.com" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a class="flex h-9 w-9 items-center justify-center rounded-lg bg-[rgba(255,255,255,.07)] text-sm text-[rgba(255,255,255,.6)] no-underline transition-all duration-200 hover:bg-[#2563eb] hover:text-white" href="https://linkedin.com" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a class="flex h-9 w-9 items-center justify-center rounded-lg bg-[rgba(255,255,255,.07)] text-sm text-[rgba(255,255,255,.6)] no-underline transition-all duration-200 hover:bg-[#2563eb] hover:text-white" href="https://twitter.com" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="mb-[18px] text-sm font-bold uppercase tracking-[.5px] text-white">Perusahaan</h4>
                    <ul class="list-none">
                        <li class="mb-2.5 flex items-center gap-2 text-sm text-[rgba(255,255,255,.55)]"><a class="text-[rgba(255,255,255,.55)] no-underline transition-colors duration-200 hover:text-white" href="#" onclick="showInfo('Halaman Tentang Kami sedang dalam pengembangan.')">Tentang Kami</a></li>
                        <li class="mb-2.5 flex items-center gap-2 text-sm text-[rgba(255,255,255,.55)]"><a class="text-[rgba(255,255,255,.55)] no-underline transition-colors duration-200 hover:text-white" href="#lowongan" onclick="scrollToSection('lowongan')">Karir</a></li>
                        <li class="mb-2.5 flex items-center gap-2 text-sm text-[rgba(255,255,255,.55)]"><a class="text-[rgba(255,255,255,.55)] no-underline transition-colors duration-200 hover:text-white" href="#" onclick="showInfo('Blog akan segera hadir!')">Blog</a></li>
                        <li class="mb-2.5 flex items-center gap-2 text-sm text-[rgba(255,255,255,.55)]"><a class="text-[rgba(255,255,255,.55)] no-underline transition-colors duration-200 hover:text-white" href="#" onclick="showInfo('Press Kit dapat dikirim melalui email lokerinaja@gmail.com')">Press Kit</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-[18px] text-sm font-bold uppercase tracking-[.5px] text-white">Layanan</h4>
                    <ul class="list-none">
                        <li class="mb-2.5 flex items-center gap-2 text-sm text-[rgba(255,255,255,.55)]"><a class="text-[rgba(255,255,255,.55)] no-underline transition-colors duration-200 hover:text-white" href="#lowongan" onclick="scrollToSection('lowongan')">Cari Kerja</a></li>
                        <li class="mb-2.5 flex items-center gap-2 text-sm text-[rgba(255,255,255,.55)]"><a class="text-[rgba(255,255,255,.55)] no-underline transition-colors duration-200 hover:text-white" href="#" onclick="showInfo('Fitur Pasang Lowongan segera hadir untuk perusahaan!')">Pasang Lowongan</a></li>
                        <li class="mb-2.5 flex items-center gap-2 text-sm text-[rgba(255,255,255,.55)]"><a class="text-[rgba(255,255,255,.55)] no-underline transition-colors duration-200 hover:text-white" href="#" onclick="showInfo('Resume Builder sedang dalam pengembangan.')">Resume Builder</a></li>
                        <li class="mb-2.5 flex items-center gap-2 text-sm text-[rgba(255,255,255,.55)]"><a class="text-[rgba(255,255,255,.55)] no-underline transition-colors duration-200 hover:text-white" href="https://wa.me/6281234567890?text=Halo%20LokerInAja,%20saya%20ingin%20konsultasi%20karir" target="_blank">Konsultasi Karir</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-[18px] text-sm font-bold uppercase tracking-[.5px] text-white">Kontak</h4>
                    <ul class="list-none">
                        <li class="mb-2.5 flex items-center gap-2 text-sm text-[rgba(255,255,255,.55)]">
                            <a class="text-[rgba(255,255,255,.55)] no-underline transition-colors duration-200 hover:text-white" href="https://maps.google.com/?q=Jl+Sudirman+Jakarta" target="_blank">
                                <i class="fas fa-map-marker-alt w-4 text-[13px] text-[#2563eb]"></i> Jl. Sudirman No.123, Jakarta
                            </a>
                        </li>
                        <li class="mb-2.5 flex items-center gap-2 text-sm text-[rgba(255,255,255,.55)]">
                            <a class="text-[rgba(255,255,255,.55)] no-underline transition-colors duration-200 hover:text-white" href="mailto:lokerinaja@gmail.com">
                                <i class="fas fa-envelope w-4 text-[13px] text-[#2563eb]"></i> lokerinaja@gmail.com
                            </a>
                        </li>
                        <li class="mb-2.5 flex items-center gap-2 text-sm text-[rgba(255,255,255,.55)]">
                            <a class="text-[rgba(255,255,255,.55)] no-underline transition-colors duration-200 hover:text-white" href="tel:+6281234567890">
                                <i class="fas fa-phone w-4 text-[13px] text-[#2563eb]"></i> +62 812-3456-7890
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="flex items-center justify-between py-5 text-[13px] text-[rgba(255,255,255,.35)]">
                <span>&copy; 2026 LokerInAja. All rights reserved.</span>
                <div class="flex gap-6">
                    <a class="text-[rgba(255,255,255,.35)] no-underline transition-colors duration-200 hover:text-[rgba(255,255,255,.7)]" href="#" onclick="showInfo('Privacy Policy sedang disiapkan.')">Privacy Policy</a>
                    <a class="text-[rgba(255,255,255,.35)] no-underline transition-colors duration-200 hover:text-[rgba(255,255,255,.7)]" href="#" onclick="showInfo('Terms of Use sedang disiapkan.')">Terms of Use</a>
                    <a class="text-[rgba(255,255,255,.35)] no-underline transition-colors duration-200 hover:text-[rgba(255,255,255,.7)]" href="#" onclick="showInfo('FAQ sedang dalam pengembangan.')">FAQ</a>
                </div>
            </div>
        </div>
    </footer>

    <a href="https://wa.me/6281234567890?text=Halo%20LokerInAja!%20Saya%20ingin%20bertanya%20tentang%20lowongan%20kerja."
       target="_blank"
       class="fixed bottom-6 right-6 z-[999] flex h-[52px] w-[52px] items-center justify-center rounded-full bg-[#25d366] text-2xl text-white no-underline shadow-[0_4px_20px_rgba(37,211,102,.4)] transition-all duration-[250ms] hover:scale-110 hover:text-white hover:shadow-[0_8px_28px_rgba(37,211,102,.5)]"
       title="Chat kami di WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script>
        window.lokerinajaApplyUrl = "{{ route('apply') }}";
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
