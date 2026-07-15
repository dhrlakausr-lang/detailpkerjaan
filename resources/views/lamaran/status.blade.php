<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Lamaran - LokerInAja</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-[#f8fafc] font-sans text-[#0f172a]">
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
        @if(session('success'))
            <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <section class="mb-6 rounded-2xl bg-[linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb)] p-8 text-white shadow-xl">
            <h2 class="text-3xl font-extrabold">Pantau lamaran kamu</h2>
            <p class="mt-3 max-w-[720px] text-white/75">Setiap lamaran yang kamu kirim menggunakan email akun ini akan muncul di sini, lengkap dengan status dan jadwal interview dari HR.</p>
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

                    @if($status === 'diterima' && $lamaran->interview_schedule)
                        <div class="mt-5 rounded-xl border border-green-200 bg-green-50 p-4">
                            <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                                <div>
                                    <p class="text-xs font-extrabold uppercase tracking-wide text-green-700">Jadwal Interview</p>
                                    <h4 class="mt-1 text-lg font-extrabold text-green-950">{{ $lamaran->interview_schedule->format('d M Y H:i') }}</h4>
                                    <p class="mt-2 text-sm text-green-900">
                                        Kontak: <strong>{{ $lamaran->interview_contact_name }}</strong>
                                        @if($lamaran->interview_contact_info)
                                            <span class="block">{{ $lamaran->interview_contact_info }}</span>
                                        @endif
                                    </p>
                                    @if($lamaran->interview_note)
                                        <p class="mt-3 max-w-[760px] text-sm leading-6 text-green-900">{{ $lamaran->interview_note }}</p>
                                    @endif
                                </div>
                                @if($lamaran->applicant_response === 'akan_datang')
                                    <span class="inline-flex rounded-full bg-green-600 px-4 py-2 text-sm font-extrabold text-white">Akan datang</span>
                                @elseif($lamaran->reschedule_status === 'menunggu')
                                    <span class="inline-flex rounded-full bg-blue-600 px-4 py-2 text-sm font-extrabold text-white">Reschedule diajukan</span>
                                @elseif($lamaran->reschedule_status === 'disetujui')
                                    <span class="inline-flex rounded-full bg-blue-600 px-4 py-2 text-sm font-extrabold text-white">Reschedule disetujui</span>
                                @elseif($lamaran->reschedule_status === 'ditolak')
                                    <span class="inline-flex rounded-full bg-slate-700 px-4 py-2 text-sm font-extrabold text-white">Reschedule ditolak</span>
                                @endif
                            </div>

                            @if($lamaran->reschedule_status)
                                <div class="mt-4 rounded-lg border border-white/70 bg-white/70 p-3 text-sm text-slate-700">
                                    @if($lamaran->reschedule_schedule)
                                        <p>Jadwal yang diajukan: <strong>{{ $lamaran->reschedule_schedule->format('d M Y H:i') }}</strong></p>
                                    @endif
                                    @if($lamaran->reschedule_reason)
                                        <p class="mt-1">Alasan: {{ $lamaran->reschedule_reason }}</p>
                                    @endif
                                    @if($lamaran->reschedule_admin_note)
                                        <p class="mt-1">Catatan HR: {{ $lamaran->reschedule_admin_note }}</p>
                                    @endif
                                </div>
                            @endif

                            <div class="mt-4 grid gap-4 lg:grid-cols-[220px_1fr]">
                                @if($lamaran->applicant_response === 'akan_datang')
                                    <div class="rounded-lg border border-green-200 bg-white p-4 text-sm font-extrabold text-green-700">
                                        Kamu sudah konfirmasi akan datang.
                                    </div>
                                @elseif($lamaran->reschedule_status === 'menunggu')
                                    <div class="rounded-lg border border-blue-200 bg-white p-4 text-sm font-extrabold text-blue-700">
                                        Pengajuan reschedule sedang menunggu keputusan HR.
                                    </div>
                                @else
                                    <form action="{{ route('lamaran.interview.confirm', $lamaran) }}" method="POST" class="self-start">
                                        @csrf
                                        <button type="submit" class="w-full rounded-lg bg-green-600 px-5 py-4 text-sm font-extrabold text-white shadow-sm transition hover:bg-green-700">Akan Datang</button>
                                    </form>
                                @endif

                                @if(! $lamaran->reschedule_requested_at)
                                    <form action="{{ route('lamaran.interview.reschedule', $lamaran) }}" method="POST" class="grid gap-3 rounded-xl border-2 border-blue-300 bg-blue-50 p-4">
                                        @csrf
                                        <div>
                                            <label class="mb-2 block text-sm font-extrabold text-blue-800">Ajukan Reschedule Interview</label>
                                            <input type="datetime-local" name="reschedule_schedule" value="{{ old('reschedule_schedule') }}" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
                                        </div>
                                        <textarea name="reschedule_reason" rows="3" class="rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Alasan mengajukan reschedule" required>{{ old('reschedule_reason') }}</textarea>
                                        <button type="submit" class="rounded-lg px-5 py-4 text-sm font-extrabold shadow-sm transition" style="background:#1d4ed8;color:#ffffff;border:2px solid #1e40af;">Submit Reschedule</button>
                                    </form>
                                @else
                                    <div class="rounded-xl border border-slate-200 bg-white p-4 text-sm font-extrabold text-slate-600">
                                        Kesempatan reschedule sudah digunakan.
                                    </div>
                                @endif
                            </div>
                        </div>
                    @elseif($status === 'ditolak' && $lamaran->reschedule_status === 'ditolak')
                        <div class="mt-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                            <p class="font-extrabold">Reschedule ditolak oleh HR.</p>
                            <p class="mt-1">Status lamaran kamu berubah menjadi ditolak.</p>
                            @if($lamaran->reschedule_admin_note)
                                <p class="mt-2">Catatan HR: {{ $lamaran->reschedule_admin_note }}</p>
                            @endif
                        </div>
                    @endif
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
