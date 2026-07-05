<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job->title }} - LokerinAja</title>
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <header class="topbar">
        <a class="brand" href="{{ route('jobs.show', 1) }}" aria-label="LokerinAja">
            <img src="{{ asset('images/LOGO.png') }}" alt="LokerinAja">
            <span>LokerinAja</span>
        </a>

        <nav class="nav-links" aria-label="Navigasi utama">
            <a href="{{ route('jobs.show', 1) }}">Lowongan Kerja</a>
            <a href="#company">Perusahaan</a>
            <a href="#description">Detail</a>
        </nav>

        @if ($isLoggedIn)
            <div class="profile-wrap">
                <button class="profile profile-trigger" type="button" aria-expanded="false" aria-controls="profileMenu">
                    <div class="avatar">{{ $userInitial }}</div>
                    <span>Hi, {{ $displayName }}</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="profile-menu" id="profileMenu">
                    <strong>{{ $displayName }}</strong>
                    @if ($userEmail !== '')
                        <small>{{ $userEmail }}</small>
                    @endif
                    <a href="{{ url('/lamaran-user') }}">Lamaran Saya</a>
                    <a href="{{ url('/login') }}">Ganti Akun</a>
                </div>
            </div>
        @else
            <a class="profile login-link" href="{{ url('/login') }}">
                <div class="avatar">U</div>
                <span>Masuk</span>
            </a>
        @endif
    </header>

    <main>
        <section class="breadcrumb">
            <button class="back-link js-back" type="button">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </button>
            <span>/</span>
            <a href="#">{{ $job->location }}</a>
            <span>/</span>
            <strong>{{ $job->title }}</strong>
        </section>

        @if ($status === 'success')
            <div class="notice success" role="alert">
                <div class="notice-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <span>Lamaran awal berhasil dikirim.</span>
                    <p>Lengkapi data lamaran kamu supaya proses seleksi bisa lanjut.</p>
                </div>
                <a class="complete-application" href="{{ $completionUrl }}">
                    Lengkapi Lamaran
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        @elseif ($errors->any())
            <div class="notice error" role="alert">
                <div class="notice-icon">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div>
                    <span>Lengkapi nama dan email yang valid sebelum melamar.</span>
                </div>
            </div>
        @endif

        <div class="page-grid">
            <section class="content">
                <article class="job-hero">
                    <div class="company-logo">
                        <img src="{{ asset('images/perusahaan.jpeg') }}" alt="{{ $job->company }}">
                    </div>

                    <div class="job-summary">
                        <h1>{{ $job->title }}</h1>
                        <p class="company-name">
                            <i class="fa-solid fa-shield-halved"></i>
                            {{ $job->company }}
                        </p>

                        <ul class="job-meta">
                            <li><i class="fa-solid fa-dollar-sign"></i>{{ $job->salary }}</li>
                            <li><i class="fa-solid fa-building"></i>{{ $profile['division'] }}</li>
                            <li><i class="fa-regular fa-clock"></i>{{ $profile['workType'] }}</li>
                            <li><i class="fa-solid fa-graduation-cap"></i>{{ $profile['education'] }}</li>
                            <li><i class="fa-solid fa-briefcase"></i>{{ $profile['experience'] }}</li>
                        </ul>

                        <div class="freshness">
                            <span><i class="fa-regular fa-clock"></i> Tayang 7 menit yang lalu</span>
                            <span>Diperbarui 7 menit yang lalu</span>
                        </div>

                        <div class="hero-actions">
                            <button class="btn primary open-apply" type="button">
                                <i class="fa-solid fa-paper-plane"></i>
                                Apply Now
                            </button>
                            <button class="icon-btn js-save" type="button" aria-label="Simpan lowongan">
                                <i class="fa-regular fa-bookmark"></i>
                            </button>
                            <button class="icon-btn js-share" type="button" aria-label="Bagikan lowongan">
                                <i class="fa-solid fa-share-nodes"></i>
                            </button>
                        </div>
                    </div>
                </article>

                <section class="section-block">
                    <h2>Persyaratan</h2>
                    <div class="chips">
                        @foreach ($requirements as $item)
                            <span>{{ $item }}</span>
                        @endforeach
                    </div>
                </section>

                <section class="section-block">
                    <h2>Skills</h2>
                    <div class="chips">
                        @foreach ($profile['skills'] as $skill)
                            <span>{{ $skill }}</span>
                        @endforeach
                    </div>
                </section>

                <section class="section-block">
                    <h2>Benefit Kerja</h2>
                    <div class="chips">
                        @foreach ($profile['benefits'] as $benefit)
                            <span>{{ $benefit }}</span>
                        @endforeach
                    </div>
                </section>

                <section class="section-block recruiter">
                    <h2>Loker ini dikelola oleh</h2>
                    <div class="recruiter-row">
                        <img src="{{ asset('images/perusahaan.jpeg') }}" alt="{{ $job->company }}">
                        <div>
                            <strong>{{ $job->company }}</strong>
                            <span><i></i> Online</span>
                        </div>
                        <em>Perusahaan Premium</em>
                    </div>
                </section>

                <section class="section-block description" id="description">
                    <h2>Deskripsi pekerjaan {{ $job->title }} {{ $job->company }}</h2>
                    <p>{{ $job->description }}</p>

                    <h3>Tanggung Jawab</h3>
                    <ul>
                        @foreach ($profile['responsibilities'] as $responsibility)
                            <li>{{ $responsibility }}</li>
                        @endforeach
                    </ul>

                    <h3>Kualifikasi</h3>
                    <ul>
                        @foreach ($profile['qualifications'] as $qualification)
                            <li>{{ $qualification }}</li>
                        @endforeach
                        <li>Bersedia bekerja di {{ $job->location }}.</li>
                    </ul>
                </section>

                <section class="company-card" id="company">
                    <h2>Tentang Perusahaan</h2>
                    <div class="company-row">
                        <img src="{{ asset('images/perusahaan.jpeg') }}" alt="{{ $job->company }}">
                        <div>
                            <h3><i class="fa-solid fa-shield-halved"></i>{{ $job->company }}</h3>
                            <p>{{ $profile['industry'] }} - {{ $profile['employees'] }}</p>
                        </div>
                    </div>

                    <h3>Alamat kantor</h3>
                    <p>{{ $job->location }}, Indonesia</p>
                </section>

                <section class="safety">
                    <h2><i class="fa-solid fa-shield-halved"></i> Tips Aman Cari Kerja</h2>
                    <p>Pemberi kerja yang benar tidak akan meminta akun pribadi, top-up, atau pembayaran dalam bentuk apapun. Jangan berikan informasi bank maupun kartu kredit kamu.</p>
                    <a href="#">Pelajari Selengkapnya</a>
                </section>

                <button class="report-btn" type="button">
                    <i class="fa-regular fa-flag"></i>
                    Laporkan Lowongan Ini
                </button>
            </section>

            <aside class="sidebar">
                <div class="qr-card">
                    <div class="qr-code" aria-hidden="true"></div>
                    <div>
                        <strong>Dapatkan notifikasi lokermu secara langsung</strong>
                        <span>Scan kode QR untuk download</span>
                    </div>
                </div>

                <h2>Lowongan Lainnya Untukmu</h2>

                @foreach ($otherJobs as $other)
                    <a class="job-card" href="{{ route('jobs.show', $other) }}">
                        <div class="job-card-head">
                            <h3>{{ $other->title }}</h3>
                            <strong>{{ $other->salary }}</strong>
                        </div>
                        <div class="mini-chips">
                            <span>Perusahaan Premium</span>
                            <span>Penuh Waktu</span>
                        </div>
                        <p><i class="fa-solid fa-shield-halved"></i>{{ $other->company }}</p>
                        <p><i class="fa-solid fa-location-dot"></i>{{ $other->location }}</p>
                        <div class="job-card-foot">
                            <span>5 hari yang lalu</span>
                            <i class="fa-regular fa-bookmark"></i>
                        </div>
                    </a>
                @endforeach
            </aside>
        </div>
    </main>

    <div class="sticky-apply">
        <div>
            <strong>{{ $job->title }}</strong>
            <span><i class="fa-solid fa-shield-halved"></i>{{ $job->company }}</span>
        </div>
        <button class="btn primary open-apply" type="button">
            <i class="fa-solid fa-paper-plane"></i>
            Apply Now
        </button>
    </div>

    <button class="wa-float" type="button" aria-label="Hubungi lewat WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </button>

    <div class="modal-backdrop" id="applyModal" aria-hidden="true">
        <div class="apply-modal" role="dialog" aria-modal="true" aria-labelledby="applyTitle">
            <button class="close-modal" type="button" aria-label="Tutup form lamaran">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <h2 id="applyTitle">Apply Now</h2>
            <p>Kirim data awal untuk posisi <strong>{{ $job->title }}</strong> di {{ $job->company }}. Setelah terkirim, kamu bisa lanjut ke halaman Lengkapi Lamaran.</p>

            <form method="POST" action="{{ route('applications.store') }}" class="apply-form">
                @csrf
                <input type="hidden" name="job_id" value="{{ $job->id }}">

                <label>
                    Nama lengkap
                    <input type="text" name="username" placeholder="Masukkan nama kamu" value="{{ old('username', $displayName) }}" required>
                </label>

                <label>
                    Email
                    <input type="email" name="email" placeholder="nama@email.com" value="{{ old('email', $userEmail) }}" required>
                </label>

                <button type="submit" class="btn primary">
                    <i class="fa-solid fa-paper-plane"></i>
                    Kirim Lamaran
                </button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/detail.js') }}"></script>
</body>

</html>
