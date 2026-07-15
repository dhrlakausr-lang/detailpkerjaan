<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOKERIN AJA - Apply Job</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css'])
</head>
<body class="bg-[#f8fafc] font-sans">
<header class="bg-[#0f172a] px-6 md:px-10 py-4 flex flex-wrap items-center justify-between gap-4">
  <div class="flex items-center gap-3">
    <img src="{{ asset('images/logolokerinaja.png') }}" alt="Logo Lokerin Aja" class="h-[58px] w-auto object-contain block">
    <span class="text-xl font-bold text-white">LokerInAja</span>
  </div>
  <nav class="flex flex-wrap justify-center gap-5 text-white text-sm">
    <a href="{{ route('home') }}" class="transition hover:text-[#93c5fd]">Home</a>
    <a href="{{ route('lowongan.index') }}" class="transition hover:text-[#93c5fd]">Find Jobs</a>
  </nav>
  @include('partials.profile-menu')
</header>
<div class="max-w-[1100px] mx-auto my-12 flex flex-col lg:flex-row bg-white rounded-[20px] overflow-hidden shadow-[0_10px_35px_rgba(0,0,0,0.1)]">
  <div class="w-full lg:w-[35%] bg-[linear-gradient(180deg,#0f172a,#1e3a8a)] text-white p-12">
    <h2 class="text-4xl font-semibold text-[#bfdbfe] mb-4">Join Our Team</h2>
    <p class="leading-8">Kami mencari talenta terbaik untuk berkembang bersama kami.</p>
  </div>
  <div class="w-full lg:w-[65%] p-12">
    <h2 class="text-2xl font-semibold text-[#0f172a] mb-3">Apply for This Job</h2>
    <p class="text-slate-600 mb-8">Isi data Anda dengan lengkap</p>
    @if($errors->any())
      <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
        {{ $errors->first() }}
      </div>
    @endif
    <form id="jobForm" action="{{ route('lamaran.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="perusahaan" value="{{ old('perusahaan', request('perusahaan', $perusahaan ?? '')) }}">
      <div class="mb-5">
        <label class="block mb-2 font-medium text-slate-700">Nama Lengkap</label>
        <input type="text" name="nama" value="{{ old('nama', $authProfile['name']) }}" required class="w-full rounded-[10px] border border-slate-300 px-4 py-3 outline-none transition duration-200 focus:border-[#2563eb] focus:ring-2 focus:ring-[#2563eb]/30">
      </div>
      <div class="mb-5">
        <label class="block mb-2 font-medium text-slate-700">Email</label>
        <input type="email" name="email" value="{{ old('email', $authProfile['email']) }}" required class="w-full rounded-[10px] border border-slate-300 px-4 py-3 outline-none transition duration-200 focus:border-[#2563eb] focus:ring-2 focus:ring-[#2563eb]/30">
      </div>
      <div class="mb-5">
        <label class="block mb-2 font-medium text-slate-700">Nomor HP</label>
        <input type="text" name="hp" required class="w-full rounded-[10px] border border-slate-300 px-4 py-3 outline-none transition duration-200 focus:border-[#2563eb] focus:ring-2 focus:ring-[#2563eb]/30">
      </div>
      <div class="mb-5">
        <label class="block mb-2 font-medium text-slate-700">Posisi Dilamar</label>
        <select name="posisi" required class="w-full rounded-[10px] border border-slate-300 bg-white px-4 py-3 outline-none transition duration-200 focus:border-[#2563eb] focus:ring-2 focus:ring-[#2563eb]/30">
          @if(request('posisi') && ! in_array(request('posisi'), ['Frontend Developer', 'Backend Developer', 'UI/UX Designer']))
          <option value="{{ request('posisi') }}" selected>{{ request('posisi') }}</option>
          @endif
          <option value="">Pilih posisi</option>
          <option value="Frontend Developer" @selected(old('posisi', request('posisi')) === 'Frontend Developer')>Frontend Developer</option>
          <option value="Backend Developer" @selected(old('posisi', request('posisi')) === 'Backend Developer')>Backend Developer</option>
          <option value="UI/UX Designer" @selected(old('posisi', request('posisi')) === 'UI/UX Designer')>UI/UX Designer</option>
        </select>
      </div>
      @if(old('perusahaan', request('perusahaan', $perusahaan ?? '')))
      <div class="mb-5">
        <label class="block mb-2 font-medium text-slate-700">Perusahaan</label>
        <input type="text" value="{{ old('perusahaan', request('perusahaan', $perusahaan ?? '')) }}" readonly class="w-full rounded-[10px] border border-slate-300 bg-slate-100 px-4 py-3 text-slate-700 outline-none">
      </div>
      @endif
      <div class="mb-5">
        <label class="block mb-2 font-medium text-slate-700">Upload CV</label>
        <input type="file" name="cv" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required class="w-full rounded-[10px] border border-slate-300 px-4 py-3 outline-none transition duration-200 focus:border-[#2563eb] focus:ring-2 focus:ring-[#2563eb]/30">
        <p class="mt-2 text-xs text-slate-500">Format PDF/DOC/DOCX, maksimal 20 MB.</p>
      </div>
      <div class="mb-5">
        <label class="block mb-2 font-medium text-slate-700">Portfolio / LinkedIn</label>
        <input type="text" name="portfolio" class="w-full rounded-[10px] border border-slate-300 px-4 py-3 outline-none transition duration-200 focus:border-[#2563eb] focus:ring-2 focus:ring-[#2563eb]/30">
      </div>
      <div class="mb-6">
        <label class="block mb-2 font-medium text-slate-700">Cover Letter</label>
        <textarea name="cover" class="w-full rounded-[10px] border border-slate-300 px-4 py-3 h-28 resize-none outline-none transition duration-200 focus:border-[#2563eb] focus:ring-2 focus:ring-[#2563eb]/30"></textarea>
      </div>
      <button type="submit" class="w-full rounded-[10px] bg-[linear-gradient(90deg,#2563eb_0%,#1d4ed8_100%)] px-5 py-4 text-base font-semibold text-white transition duration-200 hover:opacity-90">Submit Application</button>
    </form>
  </div>
</div>
<footer class="bg-[#0f172a] text-white px-6 py-10">
  <div class="max-w-[1100px] mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    <div>
      <h4 class="text-[#93c5fd] font-semibold mb-4">LOKERIN AJA</h4>
      <p class="text-slate-300 leading-7">Connecting talent with opportunity.</p>
    </div>
    <div>
      <h4 class="text-[#93c5fd] font-semibold mb-4">Pencari Kerja</h4>
      <a href="#" class="block text-slate-300 mb-2 transition hover:text-[#93c5fd]">Cari Lowongan</a>
      <a href="#" class="block text-slate-300 mb-2 transition hover:text-[#93c5fd]">Tips Karier</a>
      <a href="#" class="block text-slate-300 transition hover:text-[#93c5fd]">Buat CV</a>
    </div>
    <div>
      <h4 class="text-[#93c5fd] font-semibold mb-4">Perusahaan</h4>
      <a href="#" class="block text-slate-300 mb-2 transition hover:text-[#93c5fd]">Pasang Lowongan</a>
      <a href="#" class="block text-slate-300 transition hover:text-[#93c5fd]">Cari Talenta</a>
    </div>
    <div>
      <h4 class="text-[#93c5fd] font-semibold mb-4">Newsletter</h4>
      <p class="text-slate-400 text-xs mb-3">Dapatkan info lowongan terbaru.</p>
      <div class="flex gap-2">
        <input type="email" placeholder="Email Anda" class="flex-1 rounded-[8px] border border-slate-700 bg-[#1e293b] px-4 py-3 text-slate-200 outline-none focus:border-[#2563eb] focus:ring-2 focus:ring-[#2563eb]/30">
        <button class="rounded-[8px] bg-[#2563eb] px-4 py-3 text-white font-semibold">&#9658;</button>
      </div>
    </div>
  </div>
  <div class="max-w-[1100px] mx-auto mt-8 border-t border-[#1a2e4a] pt-4 text-slate-400 text-xs text-center">© 2026 LOKERIN AJA. All rights reserved.</div>
</footer>
<script src="{{ asset('js/Lamaran_Pengguna_P6.js') }}"></script>
</body>
</html>
