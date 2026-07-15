<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Dashboard - Lamaran Masuk</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-[#f8fafc] font-sans text-[#0f172a]">
    <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-[1280px] items-center justify-between px-6 py-4">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logolokerinaja.png') }}" alt="LokerInAja" class="h-12 w-auto">
                <div>
                    <h1 class="text-lg font-extrabold">HR Dashboard</h1>
                    <p class="text-xs text-slate-500">Kelola lamaran {{ $perusahaanHr ? 'perusahaan ' . $perusahaanHr : 'semua perusahaan' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Home</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="rounded-lg bg-[#2563eb] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#1d4ed8]">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-[1280px] px-6 py-8">
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

        <section class="mb-6 grid gap-4 md:grid-cols-4">
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">Total Lamaran</p>
                <strong class="mt-2 block text-3xl">{{ $counts['total'] }}</strong>
            </div>
            <div class="rounded-xl border border-yellow-200 bg-yellow-50 p-5 shadow-sm">
                <p class="text-sm text-yellow-700">Menunggu</p>
                <strong class="mt-2 block text-3xl text-yellow-800">{{ $counts['menunggu'] }}</strong>
            </div>
            <div class="rounded-xl border border-green-200 bg-green-50 p-5 shadow-sm">
                <p class="text-sm text-green-700">Diterima</p>
                <strong class="mt-2 block text-3xl text-green-800">{{ $counts['diterima'] }}</strong>
            </div>
            <div class="rounded-xl border border-red-200 bg-red-50 p-5 shadow-sm">
                <p class="text-sm text-red-700">Ditolak</p>
                <strong class="mt-2 block text-3xl text-red-800">{{ $counts['ditolak'] }}</strong>
            </div>
        </section>

        <section class="mb-6 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <form method="GET" action="{{ route('admin.lamaran.index') }}" class="grid gap-3 md:grid-cols-[1fr_220px_auto]">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, email, atau posisi" class="rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-[#2563eb] focus:ring-2 focus:ring-[#2563eb]/20">
                <select name="status" onchange="this.form.submit()" class="rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-[#2563eb] focus:ring-2 focus:ring-[#2563eb]/20">
                    <option value="">Semua Status</option>
                    <option value="menunggu" @selected(request('status') === 'menunggu')>Menunggu</option>
                    <option value="diterima" @selected(request('status') === 'diterima')>Diterima</option>
                    <option value="ditolak" @selected(request('status') === 'ditolak')>Ditolak</option>
                </select>
                <button class="rounded-lg bg-[#0f172a] px-5 py-3 font-semibold text-white transition hover:bg-[#1e293b]">Filter</button>
            </form>
        </section>

        <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-5 py-4">Pelamar</th>
                            <th class="px-5 py-4">Kontak</th>
                            <th class="px-5 py-4">Posisi</th>
                            <th class="px-5 py-4">Perusahaan</th>
                            <th class="px-5 py-4">Dokumen</th>
                            <th class="px-5 py-4">Status</th>
                            <th class="px-5 py-4">Tanggal</th>
                            <th class="px-5 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($lamarans as $lamaran)
                            <tr class="align-top">
                                <td class="px-5 py-4">
                                    <strong class="block text-slate-900">{{ $lamaran->nama }}</strong>
                                    @if($lamaran->cover_letter)
                                        <p class="mt-2 max-w-[280px] text-xs leading-5 text-slate-500">{{ $lamaran->cover_letter }}</p>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-slate-600">
                                    <span class="block">{{ $lamaran->email }}</span>
                                    <span class="mt-1 block">{{ $lamaran->hp }}</span>
                                </td>
                                <td class="px-5 py-4 font-semibold text-slate-800">{{ $lamaran->posisi }}</td>
                                <td class="px-5 py-4 font-semibold text-slate-700">{{ $lamaran->perusahaan ?: '-' }}</td>
                                <td class="px-5 py-4">
                                    <div class="flex flex-col gap-2">
                                        <a href="{{ asset('upload/' . $lamaran->cv) }}" target="_blank" class="font-semibold text-[#2563eb] hover:underline">Lihat CV</a>
                                        @if($lamaran->portfolio)
                                            <a href="{{ $lamaran->portfolio }}" target="_blank" class="font-semibold text-[#2563eb] hover:underline">Portfolio</a>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    @php
                                        $statusClass = [
                                            'menunggu' => 'bg-yellow-100 text-yellow-800',
                                            'diterima' => 'bg-green-100 text-green-800',
                                            'ditolak' => 'bg-red-100 text-red-800',
                                        ][$lamaran->status ?? 'menunggu'] ?? 'bg-slate-100 text-slate-700';
                                    @endphp
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold uppercase {{ $statusClass }}">{{ $lamaran->status ?? 'menunggu' }}</span>
                                    @if($lamaran->interview_schedule)
                                        <p class="mt-2 text-xs font-semibold text-slate-600">
                                            Interview: {{ $lamaran->interview_schedule->format('d M Y H:i') }}
                                        </p>
                                    @endif
                                    @if($lamaran->applicant_response)
                                        <p class="mt-1 text-xs text-slate-500">
                                            Respons: {{ str_replace('_', ' ', $lamaran->applicant_response) }}
                                        </p>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-slate-500">{{ optional($lamaran->created_at)->format('d M Y H:i') }}</td>
                                <td class="px-5 py-4">
                                    @if(($lamaran->status ?? 'menunggu') === 'menunggu')
                                        <div class="flex min-w-[260px] flex-col gap-2">
                                            <details class="rounded-lg border border-green-200 bg-green-50">
                                                <summary class="cursor-pointer px-3 py-2 text-xs font-extrabold text-green-700">Terima & Atur Interview</summary>
                                                <form action="{{ route('admin.lamaran.status', $lamaran) }}" method="POST" class="grid gap-2 p-3 pt-1">
                                                    @csrf
                                                    <input type="hidden" name="status" value="diterima">
                                                    <input type="datetime-local" name="interview_schedule" value="{{ old('interview_schedule') }}" class="rounded-md border border-green-200 bg-white px-3 py-2 text-xs outline-none focus:border-green-500" required>
                                                    <input name="interview_contact_name" value="{{ old('interview_contact_name', 'HR ' . ($lamaran->perusahaan ?: 'LokerInAja')) }}" class="rounded-md border border-green-200 bg-white px-3 py-2 text-xs outline-none focus:border-green-500" placeholder="Nama kontak HR" required>
                                                    <input name="interview_contact_info" value="{{ old('interview_contact_info') }}" class="rounded-md border border-green-200 bg-white px-3 py-2 text-xs outline-none focus:border-green-500" placeholder="WhatsApp / email yang bisa dihubungi" required>
                                                    <textarea name="interview_note" rows="3" class="rounded-md border border-green-200 bg-white px-3 py-2 text-xs outline-none focus:border-green-500" placeholder="Catatan interview untuk pelamar">{{ old('interview_note') }}</textarea>
                                                    <button class="w-full rounded-lg bg-green-600 px-4 py-2 text-xs font-bold text-white transition hover:bg-green-700">Simpan Jadwal</button>
                                                </form>
                                            </details>
                                            <form action="{{ route('admin.lamaran.status', $lamaran) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="ditolak">
                                                <button class="w-full rounded-lg bg-red-600 px-4 py-2 text-xs font-bold text-white transition hover:bg-red-700">Tolak</button>
                                            </form>
                                        </div>
                                    @elseif($lamaran->status === 'diterima')
                                        <div class="min-w-[280px]">
                                            <div class="inline-flex items-center gap-2 rounded-lg border border-green-200 bg-green-50 px-3 py-2 text-xs font-extrabold text-green-700">
                                                <span class="grid h-5 w-5 place-items-center rounded-full bg-green-600 text-white">✓</span>
                                                Diterima
                                            </div>

                                            <details class="mt-3 rounded-lg border border-green-200 bg-green-50">
                                                <summary class="cursor-pointer px-3 py-2 text-xs font-extrabold text-green-700">Atur/Ubah Jadwal</summary>
                                                <form action="{{ route('admin.lamaran.status', $lamaran) }}" method="POST" class="grid gap-2 p-3 pt-1">
                                                    @csrf
                                                    <input type="hidden" name="status" value="diterima">
                                                    <input type="datetime-local" name="interview_schedule" value="{{ old('interview_schedule', optional($lamaran->interview_schedule)->format('Y-m-d\TH:i')) }}" class="rounded-md border border-green-200 bg-white px-3 py-2 text-xs outline-none focus:border-green-500" required>
                                                    <input name="interview_contact_name" value="{{ old('interview_contact_name', $lamaran->interview_contact_name ?: 'HR ' . ($lamaran->perusahaan ?: 'LokerInAja')) }}" class="rounded-md border border-green-200 bg-white px-3 py-2 text-xs outline-none focus:border-green-500" placeholder="Nama kontak HR" required>
                                                    <input name="interview_contact_info" value="{{ old('interview_contact_info', $lamaran->interview_contact_info) }}" class="rounded-md border border-green-200 bg-white px-3 py-2 text-xs outline-none focus:border-green-500" placeholder="WhatsApp / email yang bisa dihubungi" required>
                                                    <textarea name="interview_note" rows="3" class="rounded-md border border-green-200 bg-white px-3 py-2 text-xs outline-none focus:border-green-500" placeholder="Catatan interview untuk pelamar">{{ old('interview_note', $lamaran->interview_note) }}</textarea>
                                                    <button class="w-full rounded-lg bg-green-600 px-4 py-2 text-xs font-bold text-white transition hover:bg-green-700">Simpan Jadwal</button>
                                                </form>
                                            </details>

                                            @if($lamaran->reschedule_status === 'menunggu')
                                                <div class="mt-3 rounded-xl border-2 border-blue-300 bg-blue-50 p-4 text-xs text-blue-950 shadow-sm">
                                                    <p class="text-sm font-extrabold">Pengajuan Reschedule Masuk</p>
                                                    <p class="mt-2">Jadwal baru: <strong>{{ optional($lamaran->reschedule_schedule)->format('d M Y H:i') }}</strong></p>
                                                    <p class="mt-2 leading-5">Alasan: {{ $lamaran->reschedule_reason }}</p>
                                                    <form action="{{ route('admin.lamaran.reschedule', $lamaran) }}" method="POST" class="mt-3 grid gap-2">
                                                        @csrf
                                                        <input type="datetime-local" name="interview_schedule" value="{{ optional($lamaran->reschedule_schedule)->format('Y-m-d\TH:i') }}" class="rounded-md border border-blue-200 bg-white px-3 py-3 outline-none focus:border-blue-500">
                                                        <textarea name="reschedule_admin_note" rows="2" class="rounded-md border border-blue-200 bg-white px-3 py-3 outline-none focus:border-blue-500" placeholder="Catatan untuk pelamar (opsional)"></textarea>
                                                        <div class="grid grid-cols-2 gap-2">
                                                            <button type="submit" name="reschedule_action" value="disetujui" class="rounded-lg px-3 py-3 font-extrabold transition" style="background:#1d4ed8;color:#ffffff;border:2px solid #1e40af;">Setujui Reschedule</button>
                                                            <button type="submit" name="reschedule_action" value="ditolak" class="rounded-lg px-3 py-3 font-extrabold transition" style="background:#dc2626;color:#ffffff;border:2px solid #991b1b;">Tolak Reschedule</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @elseif($lamaran->reschedule_status)
                                                <div class="mt-3 rounded-lg border border-slate-200 bg-slate-50 p-3 text-xs font-semibold text-slate-600">
                                                    Reschedule sudah {{ $lamaran->reschedule_status }}.
                                                </div>
                                            @else
                                                <div class="mt-3 rounded-lg border border-slate-200 bg-slate-50 p-3 text-xs font-semibold text-slate-500">
                                                    Belum ada pengajuan reschedule.
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="inline-flex items-center gap-2 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-extrabold text-red-700">
                                            <span class="grid h-5 w-5 place-items-center rounded-full bg-red-600 text-white">✓</span>
                                            Ditolak
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-5 py-14 text-center text-slate-500">Belum ada lamaran yang masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-100 px-5 py-4">
                {{ $lamarans->links() }}
            </div>
        </section>
    </main>
</body>
</html>
