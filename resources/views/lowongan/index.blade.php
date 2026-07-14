<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Lowongan — LokerinAja</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body { background: #f8fafc; }
        .brand-text {
            color: #2563eb;
        }
        .hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 48%, #2563eb 100%);
            color: #fff;
        }
        .btn-loker-blue {
            background: #2563eb;
            border-color: #2563eb;
            color: #fff;
        }
        .btn-loker-blue:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
            color: #fff;
        }
        .job-logo {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; flex-shrink: 0;
        }
        .job-card { transition: box-shadow .2s, transform .2s; }
        .job-card:hover { box-shadow: 0 12px 34px rgba(15,23,42,.12); transform: translateY(-2px); }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

@php
    $req = request();
    $aktif = $req->filled('q') || $req->filled('lokasi') || $req->filled('kategori')
        || $req->filled('tipe') || $req->filled('pengaturan') || $req->filled('level');
@endphp

<!-- ================= HEADER ================= -->
<nav class="navbar bg-white border-bottom sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="{{ route('home') }}" class="navbar-brand fw-bold fs-5 brand-text d-inline-flex align-items-center gap-2">
            <img src="{{ asset('images/logolokerinaja.png') }}" alt="LokerInAja" style="height:44px;width:auto;object-fit:contain;">
            <span>LokerInAja</span>
        </a>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary">Home</a>
            @include('partials.profile-menu')
        </div>
    </div>
</nav>

<!-- ================= HERO + SEARCH ================= -->
<section class="hero py-5">
    <div class="container text-center">
        <h1 class="fw-bold mb-2">Temukan Lowongan Pekerjaan Impianmu</h1>
        <p class="lead mb-4">{{ $total }}+ lowongan dari perusahaan terpercaya menunggumu</p>

        <form method="GET" action="{{ route('lowongan.index') }}" id="filterForm"
              class="row g-2 justify-content-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                    <input type="text" name="q" value="{{ $req->q }}" class="form-control"
                           placeholder="Posisi atau perusahaan">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fa-solid fa-location-dot text-muted"></i></span>
                    <select name="lokasi" class="form-select js-submit">
                        <option value="">Semua Lokasi</option>
                        @foreach ($opsi['lokasi'] as $lok)
                            <option value="{{ $lok }}" @selected($req->lokasi === $lok)>{{ $lok }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-loker-blue">Cari Lowongan</button>
            </div>
        </form>
    </div>
</section>

<!-- ================= BOARD ================= -->
<div class="container my-4 flex-grow-1">
    <div class="row g-4">

        <!-- SIDEBAR FILTER -->
        <aside class="col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="fa-solid fa-sliders text-primary"></i> Filter</h5>
                        @if ($aktif)
                            <a href="{{ route('lowongan.index') }}" class="small text-decoration-none">Reset</a>
                        @endif
                    </div>

                    @php
                        $groups = [
                            'kategori'   => ['label' => 'Kategori',          'items' => $opsi['kategori']],
                            'tipe'       => ['label' => 'Tipe Pekerjaan',    'items' => $opsi['tipe']],
                            'pengaturan' => ['label' => 'Pengaturan Kerja',  'items' => $opsi['pengaturan']],
                            'level'      => ['label' => 'Level',             'items' => $opsi['level']],
                        ];
                    @endphp

                    @foreach ($groups as $name => $g)
                        <div class="mb-3">
                            <h6 class="text-uppercase text-muted small fw-bold">{{ $g['label'] }}</h6>
                            <div class="form-check">
                                <input type="radio" name="{{ $name }}" value="" form="filterForm"
                                    class="form-check-input js-submit" id="{{ $name }}-all"
                                    @checked(! $req->filled($name))>
                                <label class="form-check-label" for="{{ $name }}-all">Semua</label>
                            </div>
                            @foreach ($g['items'] as $i => $item)
                                <div class="form-check">
                                    <input type="radio" name="{{ $name }}" value="{{ $item }}" form="filterForm"
                                        class="form-check-input js-submit" id="{{ $name }}-{{ $i }}"
                                        @checked($req->get($name) === $item)>
                                    <label class="form-check-label" for="{{ $name }}-{{ $i }}">{{ $item }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </aside>

        <!-- HASIL -->
        <main class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <p class="mb-0"><strong>{{ $lowongan->total() }}</strong> lowongan ditemukan</p>
                <label class="d-flex align-items-center gap-2 mb-0">
                    <span class="text-muted small">Urutkan:</span>
                    <select name="sort" form="filterForm" class="form-select form-select-sm js-submit" style="width:auto">
                        <option value="terbaru"     @selected($req->get('sort') === 'terbaru' || ! $req->filled('sort'))>Terbaru</option>
                        <option value="gaji_tinggi" @selected($req->get('sort') === 'gaji_tinggi')>Gaji Tertinggi</option>
                        <option value="gaji_rendah" @selected($req->get('sort') === 'gaji_rendah')>Gaji Terendah</option>
                    </select>
                </label>
            </div>

            <div class="row g-3">
                @forelse ($lowongan as $row)
                    @php $hue = crc32($row->perusahaan ?? $row->posisi) % 360; @endphp
                    <div class="col-md-6">
                        <article class="card job-card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-start gap-3 mb-3">
                                    <div class="job-logo" style="background:hsl({{ $hue }} 70% 92%); color:hsl({{ $hue }} 65% 38%)">
                                        {{ $row->inisial }}
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 fw-bold">{{ $row->posisi }}</h6>
                                        <p class="text-muted small mb-0"><i class="fa-regular fa-building"></i> {{ $row->perusahaan }}</p>
                                    </div>
                                    <span class="badge text-bg-success-subtle text-success">{{ $row->diposting }}</span>
                                </div>

                                <div class="d-flex flex-wrap gap-3 text-muted small mb-2">
                                    <span><i class="fa-solid fa-location-dot"></i> {{ $row->lokasi }}</span>
                                    <span><i class="fa-solid fa-briefcase"></i> {{ $row->tipe_kerja }}</span>
                                    <span><i class="fa-solid fa-house-laptop"></i> {{ $row->pengaturan_kerja }}</span>
                                </div>

                                <p class="fw-semibold text-success mb-2"><i class="fa-solid fa-wallet"></i> {{ $row->gaji_format }}</p>

                                <div class="mb-3">
                                    <span class="badge text-bg-primary">{{ $row->kategori }}</span>
                                    <span class="badge text-bg-light border">{{ $row->level }}</span>
                                </div>

                                <a class="btn btn-outline-secondary btn-sm w-100" href="{{ route('lowongan.detail', $row) }}">Lihat Detail</a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center text-muted py-5">
                            <i class="fa-solid fa-folder-open fa-3x mb-3"></i>
                            <h5>Tidak ada lowongan yang cocok</h5>
                            <p>Coba ubah kata kunci atau reset filter.</p>
                            <a href="{{ route('lowongan.index') }}" class="btn btn-primary">Reset Filter</a>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($lowongan->hasPages())
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item {{ $lowongan->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $lowongan->previousPageUrl() }}"><i class="fa-solid fa-chevron-left"></i></a>
                        </li>

                        @foreach ($lowongan->getUrlRange(1, $lowongan->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $lowongan->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <li class="page-item {{ $lowongan->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $lowongan->nextPageUrl() }}"><i class="fa-solid fa-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            @endif
        </main>
    </div>
</div>

<footer class="bg-white border-top py-4 mt-auto">
    <div class="container text-center">
        <div class="d-flex justify-content-center flex-wrap gap-3 mb-2">
            <a href="#" class="text-muted text-decoration-none">Tentang Kami</a>
            <a href="#" class="text-muted text-decoration-none">Kontak</a>
            <a href="#" class="text-muted text-decoration-none">Kebijakan Privasi</a>
            <a href="#" class="text-muted text-decoration-none">Pusat Bantuan</a>
        </div>
        <p class="text-muted small mb-0">© 2026 LokerinAja. All rights reserved.</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/DaftarLowongan.js') }}"></script>
</body>
</html>
