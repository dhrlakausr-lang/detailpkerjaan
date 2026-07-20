<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $job->title }} - LokerinAja</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="m-0 pb-[118px] text-[#151515] bg-[linear-gradient(rgba(247,251,255,0.9),rgba(247,251,255,0.92)),url('/images/BACKGROUND.jpeg')] bg-cover bg-center bg-fixed font-[Arial,Helvetica,sans-serif] text-[15px] leading-[1.55] max-[820px]:pb-[170px] max-[820px]:bg-scroll">
    <header class="sticky top-0 z-20 flex min-h-[86px] items-center gap-[34px] border-b border-[rgba(215,215,215,0.78)] bg-white/90 px-[clamp(20px,5vw,86px)] py-[14px] backdrop-blur-[14px] max-[820px]:flex-wrap max-[820px]:gap-4 max-[520px]:px-4">
        <a class="flex items-center gap-2.5 text-[23px] font-extrabold text-[#2f80c5] no-underline" href="{{ route('jobs.show', 1) }}" aria-label="LokerinAja">
            <img class="h-[52px] w-[68px] object-contain" src="{{ asset('images/logolokerinaja.png') }}" alt="LokerinAja">
            <span class="max-[820px]:hidden">LokerinAja</span>
        </a>

        <nav class="flex items-center gap-[34px] text-[15px] font-bold uppercase text-[#151515] max-[820px]:order-3 max-[820px]:w-full max-[820px]:gap-[18px] max-[820px]:overflow-x-auto max-[820px]:pb-1 max-[820px]:text-[13px]" aria-label="Navigasi utama">
            <a class="p-0 text-[#151515] no-underline hover:text-[#2f80c5]" href="{{ route('lowongan.index') }}">Lowongan Kerja</a>
            <a class="p-0 text-[#151515] no-underline hover:text-[#2f80c5]" href="#company">Perusahaan</a>
            <a class="p-0 text-[#151515] no-underline hover:text-[#2f80c5]" href="#description">Detail</a>
        </nav>

        <div class="ml-auto">
            @include('partials.profile-menu')
        </div>
    </header>

    <main class="mx-auto max-w-[1560px]">
        <section class="flex flex-wrap items-center gap-4 bg-[rgba(243,248,252,0.86)] px-[clamp(20px,5vw,86px)] py-6 text-base text-[#777777] max-[820px]:text-[15px] max-[520px]:px-4">
            <button class="js-back inline-flex cursor-pointer items-center gap-2 border-0 bg-transparent p-0 font-extrabold text-[#2f80c5] hover:text-[#256fae]" type="button">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </button>
            <span>/</span>
            <a class="text-[#2f80c5] no-underline hover:text-[#2f80c5]" href="#">{{ $job->location }}</a>
            <span>/</span>
            <strong>{{ $job->title }}</strong>
        </section>

        @if ($status === 'success')
            <div class="mx-[clamp(20px,5vw,86px)] mt-6 flex items-center gap-2.5 rounded-lg border border-[#b9def7] bg-[#edf8ff] px-[18px] py-4 font-bold text-[#145f91] shadow-[0_8px_24px_rgba(20,35,55,0.08)] max-[520px]:mx-4 max-[520px]:px-4" role="alert">
                <div class="grid h-[38px] w-[38px] shrink-0 place-items-center rounded-full bg-[#2f80c5] text-white">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <span>Lamaran awal berhasil dikirim.</span>
                    <p class="m-0 mt-0.5 font-medium text-[#4c6b80]">Lengkapi data lamaran kamu supaya proses seleksi bisa lanjut.</p>
                </div>
                <a class="ml-auto inline-flex items-center gap-[9px] rounded-[5px] bg-[#2f80c5] px-[15px] py-[11px] text-[15px] font-extrabold text-white no-underline hover:bg-[#256fae]" href="{{ $completionUrl }}">
                    Lengkapi Lamaran
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        @elseif ($errors->any())
            <div class="mx-[clamp(20px,5vw,86px)] mt-6 flex items-center gap-2.5 rounded-lg bg-[#fff0ee] px-[18px] py-4 font-bold text-[#a83a33] shadow-[0_8px_24px_rgba(20,35,55,0.08)] max-[520px]:mx-4 max-[520px]:px-4" role="alert">
                <div class="grid h-[38px] w-[38px] shrink-0 place-items-center rounded-full bg-[#2f80c5] text-white">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div>
                    <span>Lengkapi nama dan email yang valid sebelum melamar.</span>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-[minmax(0,1fr)_420px] gap-[58px] px-[clamp(20px,5vw,86px)] py-10 max-[1100px]:grid-cols-1 max-[520px]:px-4">
            <section class="min-w-0">
                <article class="mb-2.5 grid grid-cols-[116px_minmax(0,1fr)] gap-7 rounded-lg border border-[#e6eff7] border-b-[#dedede] bg-[linear-gradient(180deg,#f8fcff_0%,#ffffff_72%)] p-7 shadow-[0_8px_24px_rgba(20,35,55,0.08)] max-[820px]:grid-cols-1">
                    <div class="grid h-[92px] w-[92px] place-items-center overflow-hidden bg-white">
                        <img class="h-full w-full object-cover" src="{{ asset('images/perusahaan.jpeg') }}" alt="{{ $job->company }}">
                    </div>

                    <div>
                        <h1 class="mb-2 mt-0 text-[clamp(25px,2.4vw,34px)] leading-[1.18]">{{ $job->title }}</h1>
                        <p class="mb-5 mt-0 flex items-center gap-3 text-[19px] text-[#2f80c5] max-[820px]:text-[17px]">
                            <i class="fa-solid fa-shield-halved text-[#388f73]"></i>
                            {{ $job->company }}
                        </p>

                        <ul class="m-0 grid list-none gap-3 p-0 text-[17px] max-[820px]:text-[15px]">
                            <li class="flex items-center gap-[14px]"><i class="fa-solid fa-dollar-sign w-[22px] text-center text-[#808080]"></i>{{ $job->salary }}</li>
                            <li class="flex items-center gap-[14px]"><i class="fa-solid fa-building w-[22px] text-center text-[#808080]"></i>{{ $profile['division'] }}</li>
                            <li class="flex items-center gap-[14px]"><i class="fa-regular fa-clock w-[22px] text-center text-[#808080]"></i>{{ $profile['workType'] }}</li>
                            <li class="flex items-center gap-[14px]"><i class="fa-solid fa-graduation-cap w-[22px] text-center text-[#808080]"></i>{{ $profile['education'] }}</li>
                            <li class="flex items-center gap-[14px]"><i class="fa-solid fa-briefcase w-[22px] text-center text-[#808080]"></i>{{ $profile['experience'] }}</li>
                        </ul>

                        <div class="my-7 mb-[22px] flex flex-wrap gap-[14px] text-[15px] font-bold text-[#388f73]">
                            <span><i class="fa-regular fa-clock"></i> Tayang 7 menit yang lalu</span>
                            <span class="before:mr-[14px] before:inline-block before:h-[5px] before:w-[5px] before:rounded-full before:bg-[#c9c9c9] before:align-middle before:content-['']">Diperbarui 7 menit yang lalu</span>
                        </div>

                        <div class="flex flex-wrap items-center gap-[18px]">
                            <a class="inline-flex min-h-[50px] cursor-pointer items-center justify-center gap-2.5 rounded bg-[linear-gradient(135deg,#2f80e7,#245fd2)] px-6 py-0 text-[15px] font-extrabold uppercase tracking-normal text-white no-underline shadow-[0_10px_24px_rgba(47,128,231,0.24)] transition hover:-translate-y-0.5 hover:bg-[linear-gradient(135deg,#2875d8,#1f56c2)] max-[820px]:w-full" href="{{ route('lamaran.index', ['posisi' => $job->title, 'perusahaan' => $job->company]) }}">
                                <i class="fa-solid fa-paper-plane"></i>
                                Apply Now
                            </a>
                            <button class="js-save {{ $isSaved ? 'is-saved' : '' }} grid h-[50px] w-[50px] cursor-pointer place-items-center rounded border-0 bg-transparent text-[27px] text-[#2f80c5] transition hover:-translate-y-0.5 max-[820px]:w-[46px] [&.is-saved_i]:before:content-['\f02e'] [&.is-saved_i]:before:font-black" type="button" aria-label="{{ $isSaved ? 'Lowongan tersimpan' : 'Simpan lowongan' }}" data-source-type="{{ $sourceType }}" data-source-id="{{ $job->id }}" data-toggle-url="{{ route('saved-jobs.toggle') }}">
                                <i class="{{ $isSaved ? 'fa-solid' : 'fa-regular' }} fa-bookmark"></i>
                            </button>
                            <div class="relative">
                                <button class="js-share grid h-[50px] w-[50px] cursor-pointer place-items-center rounded border-0 bg-transparent text-[27px] text-[#2f80c5] transition hover:-translate-y-0.5 max-[820px]:w-[46px]" type="button" aria-label="Bagikan lowongan" aria-expanded="false">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </button>
                                @php
                                    $encodedShareUrl = rawurlencode($shareUrl);
                                    $encodedShareText = rawurlencode('Cek lowongan ' . $job->title . ' di ' . $job->company . ' - ' . $shareUrl);
                                @endphp
                                <div class="js-share-menu absolute left-1/2 top-[calc(100%+10px)] z-40 hidden w-[230px] -translate-x-1/2 rounded-xl border border-[#dbe7f3] bg-white p-3 text-sm shadow-[0_18px_44px_rgba(20,35,55,0.18)]">
                                    <a class="flex items-center gap-2 rounded-lg px-3 py-2 font-bold text-[#128c7e] no-underline hover:bg-[#ecfdf5]" href="https://wa.me/?text={{ $encodedShareText }}" target="_blank" rel="noopener">
                                        <i class="fa-brands fa-whatsapp w-5 text-center"></i>
                                        WhatsApp
                                    </a>
                                    <a class="flex items-center gap-2 rounded-lg px-3 py-2 font-bold text-[#229ed9] no-underline hover:bg-[#eff6ff]" href="https://t.me/share/url?url={{ $encodedShareUrl }}&text={{ $encodedShareText }}" target="_blank" rel="noopener">
                                        <i class="fa-brands fa-telegram w-5 text-center"></i>
                                        Telegram
                                    </a>
                                    <a class="flex items-center gap-2 rounded-lg px-3 py-2 font-bold text-[#1877f2] no-underline hover:bg-[#eff6ff]" href="https://www.facebook.com/sharer/sharer.php?u={{ $encodedShareUrl }}" target="_blank" rel="noopener">
                                        <i class="fa-brands fa-facebook w-5 text-center"></i>
                                        Facebook
                                    </a>
                                    <a class="flex items-center gap-2 rounded-lg px-3 py-2 font-bold text-[#111827] no-underline hover:bg-[#f8fafc]" href="https://twitter.com/intent/tweet?url={{ $encodedShareUrl }}&text={{ $encodedShareText }}" target="_blank" rel="noopener">
                                        <i class="fa-brands fa-x-twitter w-5 text-center"></i>
                                        X
                                    </a>
                                    <button class="js-copy-link mt-1 flex w-full cursor-pointer items-center gap-2 rounded-lg border-0 bg-[#f8fafc] px-3 py-2 text-left font-bold text-[#2563eb] hover:bg-[#eff6ff]" type="button" data-url="{{ $shareUrl }}">
                                        <i class="fa-solid fa-link w-5 text-center"></i>
                                        Copy Link
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <section class="px-0 pb-3 pt-[34px]">
                    <h2 class="mb-4 mt-0 text-[21px] leading-[1.2]">Persyaratan</h2>
                    <div class="flex flex-wrap gap-2.5">
                        @foreach ($requirements as $item)
                            <span class="inline-flex min-h-8 items-center rounded bg-[#f1f1f1] px-[13px] py-[5px] text-[15px] text-[#222222] max-[520px]:text-base">{{ $item }}</span>
                        @endforeach
                    </div>
                </section>

                <section class="px-0 pb-3 pt-[34px]">
                    <h2 class="mb-4 mt-0 text-[21px] leading-[1.2]">Skills</h2>
                    <div class="flex flex-wrap gap-2.5">
                        @foreach ($profile['skills'] as $skill)
                            <span class="inline-flex min-h-8 items-center rounded bg-[#f1f1f1] px-[13px] py-[5px] text-[15px] text-[#222222] max-[520px]:text-base">{{ $skill }}</span>
                        @endforeach
                    </div>
                </section>

                <section class="px-0 pb-3 pt-[34px]">
                    <h2 class="mb-4 mt-0 text-[21px] leading-[1.2]">Benefit Kerja</h2>
                    <div class="flex flex-wrap gap-2.5">
                        @foreach ($profile['benefits'] as $benefit)
                            <span class="inline-flex min-h-8 items-center rounded bg-[#f1f1f1] px-[13px] py-[5px] text-[15px] text-[#222222] max-[520px]:text-base">{{ $benefit }}</span>
                        @endforeach
                    </div>
                </section>

                <section class="px-0 pb-3 pt-[34px]">
                    <h2 class="mb-4 mt-0 text-[21px] leading-[1.2]">Loker ini dikelola oleh</h2>
                    <div class="flex flex-wrap items-center gap-[14px]">
                        <img class="h-[58px] w-[58px] object-cover" src="{{ asset('images/perusahaan.jpeg') }}" alt="{{ $job->company }}">
                        <div>
                            <strong class="block text-[19px]">{{ $job->company }}</strong>
                            <span class="flex items-center gap-[7px] text-[15px] text-[#6f6f6f]"><i class="h-2.5 w-2.5 rounded-full bg-[#88b95d]"></i> Online</span>
                        </div>
                        <em class="rounded-[5px] bg-[#fff0d9] px-3 py-2 text-[15px] not-italic text-[#e9822f]">Perusahaan Premium</em>
                    </div>
                </section>

                <section class="px-0 pb-3 pt-[34px]" id="description">
                    <h2 class="mb-4 mt-0 text-[21px] leading-[1.2]">Deskripsi pekerjaan {{ $job->title }} {{ $job->company }}</h2>
                    <p class="mt-0 text-justify text-base leading-[1.75] max-[820px]:text-[15px]">{{ $job->description }}</p>

                    <h3 class="mb-2.5 mt-0 text-[17px]">Tanggung Jawab</h3>
                    <ul class="mb-[26px] grid gap-2.5 pl-[22px] text-justify text-base leading-[1.75] max-[820px]:text-[15px]">
                        @foreach ($profile['responsibilities'] as $responsibility)
                            <li>{{ $responsibility }}</li>
                        @endforeach
                    </ul>

                    <h3 class="mb-2.5 mt-0 text-[17px]">Kualifikasi</h3>
                    <ul class="mb-[26px] grid gap-2.5 pl-[22px] text-justify text-base leading-[1.75] max-[820px]:text-[15px]">
                        @foreach ($profile['qualifications'] as $qualification)
                            <li>{{ $qualification }}</li>
                        @endforeach
                        <li>Bersedia bekerja di {{ $job->location }}.</li>
                    </ul>
                </section>

                <section class="mt-7 rounded-[5px] border border-[#cacaca] bg-white/85 p-[34px] backdrop-blur max-[520px]:p-[22px]" id="company">
                    <h2 class="mb-4 mt-0 text-[21px] leading-[1.2]">Tentang Perusahaan</h2>
                    <div class="mb-[34px] flex items-center gap-[22px]">
                        <img class="h-[72px] w-[72px] object-cover" src="{{ asset('images/perusahaan.jpeg') }}" alt="{{ $job->company }}">
                        <div>
                            <h3 class="m-0 flex items-center gap-[14px] text-[19px] text-[#2f80c5]"><i class="fa-solid fa-shield-halved text-[#388f73]"></i>{{ $job->company }}</h3>
                            <p class="m-0 mt-1 text-justify text-base leading-[1.75] text-[#6f6f6f] max-[820px]:text-[15px]">{{ $profile['industry'] }} - {{ $profile['employees'] }}</p>
                        </div>
                    </div>

                    <h3 class="mb-2.5 mt-0 text-[17px]">Alamat kantor</h3>
                    <p class="mt-0 text-justify text-base leading-[1.75] max-[820px]:text-[15px]">{{ $job->location }}, Indonesia</p>
                </section>

                <section class="mt-[26px] rounded-lg border border-[rgba(214,226,236,0.78)] bg-white/80 px-6 py-[22px] backdrop-blur">
                    <h2 class="mb-2 mt-0 flex items-center gap-2.5 text-[19px]"><i class="fa-solid fa-shield-halved text-[#388f73]"></i> Tips Aman Cari Kerja</h2>
                    <p class="mt-0 text-justify text-base leading-[1.75] max-[820px]:text-[15px]">Pemberi kerja yang benar tidak akan meminta akun pribadi, top-up, atau pembayaran dalam bentuk apapun. Jangan berikan informasi bank maupun kartu kredit kamu.</p>
                    <a class="text-base font-extrabold text-[#2f80c5] no-underline" href="#">Pelajari Selengkapnya</a>
                </section>

                <button class="report-btn mt-6 cursor-pointer border-0 bg-transparent p-0 text-base text-[#e33d3b]" type="button">
                    <i class="fa-regular fa-flag"></i>
                    Laporkan Lowongan Ini
                </button>
            </section>

            <aside class="grid content-start gap-[22px] max-[1100px]:grid-cols-2 max-[820px]:grid-cols-1">
                <h2 class="mb-0 mt-0 text-[21px] leading-[1.2] max-[1100px]:col-span-full">Lowongan Lainnya Untukmu</h2>

                @foreach ($otherJobs as $other)
                    @php
                        $otherSourceType = $other->source_type ?? 'job';
                        $otherSaved = $savedLookup[$otherSourceType . ':' . $other->id] ?? false;
                        $otherUrl = $otherSourceType === 'lowongan' ? route('lowongan.detail', $other->id) : route('jobs.show', $other);
                    @endphp
                    <div class="rounded-lg border border-[#eeeeee] bg-white px-5 pb-[18px] pt-6 text-[#1c1c1c] shadow-[0_8px_24px_rgba(20,35,55,0.08)] hover:border-[#c8def1]">
                        <div class="flex items-center justify-between gap-[14px]">
                            <a class="m-0 text-lg font-bold text-[#1c1c1c] no-underline hover:text-[#2f80c5]" href="{{ $otherUrl }}">{{ $other->title }}</a>
                            <strong class="shrink-0 text-[15px] text-[#2f80c5]">{{ $other->salary }}</strong>
                        </div>
                        <div class="mt-4 flex flex-wrap gap-2.5">
                            <span class="inline-flex min-h-[34px] items-center rounded bg-[#fff0d9] px-[13px] py-[5px] text-base text-[#e9822f]">Perusahaan Premium</span>
                            <span class="inline-flex min-h-[34px] items-center rounded bg-[#f1f1f1] px-[13px] py-[5px] text-base text-[#222222]">Penuh Waktu</span>
                        </div>
                        <p class="m-0 mt-4 flex items-center gap-2.5 text-[15px] text-[#2f80c5]"><i class="fa-solid fa-shield-halved text-[#388f73]"></i>{{ $other->company }}</p>
                        <p class="m-0 mt-4 flex items-center gap-2.5 text-[15px] text-[#2f2f2f]"><i class="fa-solid fa-location-dot"></i>{{ $other->location }}</p>
                        <div class="mt-6 flex items-center justify-between border-t border-[#e5e5e5] pt-[18px] text-[13px] font-extrabold tracking-[2px] text-[#777777]">
                            <a class="text-[#2f80c5] no-underline hover:underline" href="{{ $otherUrl }}">Lihat Detail</a>
                            <button class="js-save {{ $otherSaved ? 'is-saved' : '' }} grid h-10 w-10 cursor-pointer place-items-center rounded-full border border-[#dbe7f3] bg-white text-2xl tracking-normal text-[#2f80c5] transition hover:bg-[#eff6ff]" type="button" aria-label="{{ $otherSaved ? 'Lowongan tersimpan' : 'Simpan lowongan' }}" data-source-type="{{ $otherSourceType }}" data-source-id="{{ $other->id }}" data-toggle-url="{{ route('saved-jobs.toggle') }}">
                                <i class="{{ $otherSaved ? 'fa-solid' : 'fa-regular' }} fa-bookmark"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </aside>
        </div>
    </main>

    <div class="fixed inset-x-0 bottom-0 z-30 flex items-center gap-[22px] border-t border-[#e3e3e3] bg-white/95 px-[clamp(20px,5vw,86px)] py-[18px] shadow-[0_-5px_20px_rgba(0,0,0,0.08)] max-[820px]:grid max-[820px]:grid-cols-1 max-[520px]:px-4">
        <div class="mr-auto min-w-[220px] max-[820px]:col-auto">
            <strong class="block text-[19px]">{{ $job->title }}</strong>
            <span class="flex items-center gap-2.5 text-base text-[#2f80c5]"><i class="fa-solid fa-shield-halved text-[#388f73]"></i>{{ $job->company }}</span>
        </div>
        <a class="inline-flex min-h-[50px] cursor-pointer items-center justify-center gap-2.5 rounded bg-[linear-gradient(135deg,#2f80e7,#245fd2)] px-6 py-0 text-[15px] font-extrabold uppercase tracking-normal text-white no-underline shadow-[0_10px_24px_rgba(47,128,231,0.24)] transition hover:-translate-y-0.5 hover:bg-[linear-gradient(135deg,#2875d8,#1f56c2)] max-[820px]:min-h-[52px] max-[820px]:px-3 max-[820px]:text-sm" href="{{ route('lamaran.index', ['posisi' => $job->title, 'perusahaan' => $job->company]) }}">
            <i class="fa-solid fa-paper-plane"></i>
            Apply Now
        </a>
    </div>

    <div class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center bg-black/55 p-6 [&.is-open]:!flex" id="applyModal" aria-hidden="true">
        <div class="relative w-[min(520px,100%)] rounded-lg border border-[#d7e8f7] bg-[linear-gradient(180deg,#f2f9ff_0%,#ffffff_34%)] p-[30px] shadow-[0_25px_80px_rgba(0,0,0,0.22)]" role="dialog" aria-modal="true" aria-labelledby="applyTitle">
            <button class="close-modal absolute right-[14px] top-[14px] grid h-[38px] w-[38px] cursor-pointer place-items-center rounded-full border-0 bg-transparent text-xl text-[#777777] hover:bg-[#f0f0f0]" type="button" aria-label="Tutup form lamaran">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <h2 class="mb-2 mt-0 text-[22px]" id="applyTitle">Apply Now</h2>
            <p class="mb-[22px] mt-0 text-justify text-[15px] leading-[1.65] text-[#6f6f6f]">Kirim data awal untuk posisi <strong>{{ $job->title }}</strong> di {{ $job->company }}. Setelah terkirim, kamu bisa lanjut ke halaman Lengkapi Lamaran.</p>

            <form method="POST" action="{{ route('applications.store') }}" class="grid gap-4">
                @csrf
                <input type="hidden" name="job_id" value="{{ $job->id }}">

                <label class="grid gap-2 text-sm font-extrabold text-[#2d2d2d]">
                    Nama lengkap
                    <input class="min-h-[50px] w-full rounded-[5px] border border-[#d5d5d5] bg-white px-[14px] py-3 text-[#1f1f1f] outline-none focus:border-[#2f80c5] focus:shadow-[0_0_0_3px_rgba(47,128,197,0.15)]" type="text" name="username" placeholder="Masukkan nama kamu" value="{{ old('username', $displayName) }}" required>
                </label>

                <label class="grid gap-2 text-sm font-extrabold text-[#2d2d2d]">
                    Email
                    <input class="min-h-[50px] w-full rounded-[5px] border border-[#d5d5d5] bg-white px-[14px] py-3 text-[#1f1f1f] outline-none focus:border-[#2f80c5] focus:shadow-[0_0_0_3px_rgba(47,128,197,0.15)]" type="email" name="email" placeholder="nama@email.com" value="{{ old('email', $userEmail) }}" required>
                </label>

                <button type="submit" class="inline-flex min-h-[50px] cursor-pointer items-center justify-center gap-2.5 rounded bg-[linear-gradient(135deg,#2f80e7,#245fd2)] px-6 py-0 text-[15px] font-extrabold uppercase tracking-normal text-white shadow-[0_10px_24px_rgba(47,128,231,0.24)] transition hover:-translate-y-0.5 hover:bg-[linear-gradient(135deg,#2875d8,#1f56c2)]">
                    <i class="fa-solid fa-paper-plane"></i>
                    Kirim Lamaran
                </button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/detail.js') }}"></script>
</body>

</html>
