<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lamaran Berhasil - LokerInAja</title>
  @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-[#f8fafc] font-sans text-[#0f172a]">
  <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur">
    <div class="mx-auto flex max-w-[1100px] items-center justify-between gap-4 px-6 py-4">
      <a href="{{ route('home') }}" class="flex items-center gap-3 text-[#0f172a] no-underline">
        <img src="{{ asset('images/logolokerinaja.png') }}" alt="LokerInAja" class="h-12 w-auto object-contain">
        <span class="text-lg font-extrabold">LokerInAja</span>
      </a>
      <div class="flex items-center gap-3">
        <a href="{{ route('lowongan.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 no-underline transition hover:bg-slate-50">Lowongan</a>
        <a href="{{ route('lamaran.status') }}" class="rounded-lg bg-[#2563eb] px-4 py-2 text-sm font-semibold text-white no-underline transition hover:bg-[#1d4ed8]">Status Lamaran</a>
      </div>
    </div>
  </header>

  <main class="mx-auto max-w-[760px] px-6 py-12">
    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_18px_50px_rgba(15,23,42,.08)]">
      <div class="bg-[linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb)] px-8 py-10 text-white">
        <div class="mb-5 grid h-16 w-16 place-items-center rounded-full bg-white/15 text-3xl font-extrabold">✓</div>
        <h1 class="text-3xl font-extrabold">Lamaran Berhasil Dikirim!</h1>
        <p class="mt-3 max-w-[560px] text-white/75">Data lamaran kamu sudah masuk ke sistem dan akan muncul di dashboard HR perusahaan terkait.</p>
      </div>

      <div class="grid gap-4 p-8">
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-bold text-green-700">
          Status awal: Menunggu review HR
        </div>

        @isset($lamaran)
          <div class="grid gap-3 rounded-xl border border-slate-200 bg-slate-50 p-5 text-sm">
            <div class="flex justify-between gap-4">
              <span class="text-slate-500">Posisi</span>
              <strong class="text-right">{{ $lamaran->posisi }}</strong>
            </div>
            <div class="flex justify-between gap-4">
              <span class="text-slate-500">Perusahaan</span>
              <strong class="text-right">{{ $lamaran->perusahaan ?: '-' }}</strong>
            </div>
            <div class="flex justify-between gap-4">
              <span class="text-slate-500">Email</span>
              <strong class="text-right">{{ $lamaran->email }}</strong>
            </div>
            <div class="flex justify-between gap-4">
              <span class="text-slate-500">Referensi</span>
              <strong class="text-right">LAM-{{ str_pad($lamaran->id, 5, '0', STR_PAD_LEFT) }}</strong>
            </div>
          </div>
        @endisset

        <p class="text-sm leading-6 text-slate-600">
          Kalau HR menerima lamaran kamu, jadwal interview akan muncul di halaman status. Kamu bisa konfirmasi hadir atau mengajukan reschedule dari sana.
        </p>

        <div class="mt-2 grid gap-3 sm:grid-cols-2">
          <a href="{{ route('lamaran.status') }}" class="inline-flex min-h-12 items-center justify-center rounded-xl bg-[#2563eb] px-5 text-sm font-extrabold text-white no-underline transition hover:bg-[#1d4ed8]">Lihat Status Lamaran</a>
          <a href="{{ route('lowongan.index') }}" class="inline-flex min-h-12 items-center justify-center rounded-xl border border-slate-300 bg-white px-5 text-sm font-extrabold text-slate-700 no-underline transition hover:bg-slate-50">Cari Lowongan Lain</a>
        </div>
      </div>
    </section>
  </main>
</body>
</html>
