<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminLamaranController extends Controller
{
    private function ensureHr()
    {
        if (! session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login sebagai HR');
        }

        if (session('role') !== 'hr') {
            abort(403, 'Halaman ini hanya untuk HR');
        }

        return null;
    }

    private function hrPerusahaan(): ?string
    {
        $user = DB::table('users')->where('id', session('user_id'))->first();
        $perusahaan = trim((string) ($user->perusahaan_hr ?? ''));

        if ($perusahaan === '' || strtolower($perusahaan) === 'semua') {
            return null;
        }

        return $perusahaan;
    }

    private function applyHrScope($query, ?string $perusahaanHr)
    {
        if ($perusahaanHr) {
            $query->where('perusahaan', $perusahaanHr);
        }

        return $query;
    }

    public function index(Request $request)
    {
        if ($response = $this->ensureHr()) {
            return $response;
        }

        $perusahaanHr = $this->hrPerusahaan();
        $query = $this->applyHrScope(Lamaran::query(), $perusahaanHr);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhere('posisi', 'like', "%{$keyword}%");
            });
        }

        $lamarans = $query->latest()->paginate(10)->withQueryString();
        $counts = [
            'total' => $this->applyHrScope(Lamaran::query(), $perusahaanHr)->count(),
            'menunggu' => $this->applyHrScope(Lamaran::where('status', 'menunggu'), $perusahaanHr)->count(),
            'diterima' => $this->applyHrScope(Lamaran::where('status', 'diterima'), $perusahaanHr)->count(),
            'ditolak' => $this->applyHrScope(Lamaran::where('status', 'ditolak'), $perusahaanHr)->count(),
        ];

        return view('admin.lamaran.index', compact('lamarans', 'counts', 'perusahaanHr'));
    }

    public function updateStatus(Request $request, Lamaran $lamaran)
    {
        if ($response = $this->ensureHr()) {
            return $response;
        }

        $perusahaanHr = $this->hrPerusahaan();
        if ($perusahaanHr && $lamaran->perusahaan !== $perusahaanHr) {
            abort(403, 'HR ini hanya bisa mengelola lamaran sesuai perusahaan akunnya');
        }

        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak',
            'interview_schedule' => 'required_if:status,diterima|nullable|date',
            'interview_contact_name' => 'required_if:status,diterima|nullable|string|max:100',
            'interview_contact_info' => 'required_if:status,diterima|nullable|string|max:150',
            'interview_note' => 'nullable|string|max:1000',
        ]);

        $statusBaru = $request->status;

        $data = [
            'status' => $statusBaru,
        ];

        if ($statusBaru === 'diterima') {
            $data += [
                'interview_schedule' => $request->interview_schedule,
                'interview_contact_name' => $request->interview_contact_name,
                'interview_contact_info' => $request->interview_contact_info,
                'interview_note' => $request->interview_note,
            ];
        }

        if ($statusBaru !== 'diterima') {
            $data += [
                'interview_schedule' => null,
                'interview_contact_name' => null,
                'interview_contact_info' => null,
                'interview_note' => null,
                'applicant_response' => null,
                'reschedule_requested_at' => null,
                'reschedule_schedule' => null,
                'reschedule_reason' => null,
                'reschedule_status' => null,
                'reschedule_admin_note' => null,
            ];
        }

        $lamaran->update($data);

        return back()->with('success', $statusBaru === 'diterima'
            ? 'Lamaran diterima dan jadwal interview sudah muncul di halaman pelamar.'
            : 'Status lamaran berhasil diperbarui');
    }

    public function updateReschedule(Request $request, Lamaran $lamaran)
    {
        if ($response = $this->ensureHr()) {
            return $response;
        }

        $perusahaanHr = $this->hrPerusahaan();
        if ($perusahaanHr && $lamaran->perusahaan !== $perusahaanHr) {
            abort(403, 'HR ini hanya bisa mengelola lamaran sesuai perusahaan akunnya');
        }

        $request->validate([
            'reschedule_action' => 'required|in:disetujui,ditolak',
            'interview_schedule' => 'required_if:reschedule_action,disetujui|nullable|date',
            'reschedule_admin_note' => 'nullable|string|max:1000',
        ]);

        if ($lamaran->reschedule_status !== 'menunggu') {
            return back()->with('error', 'Pengajuan reschedule ini sudah diproses.');
        }

        $data = [
            'reschedule_status' => $request->reschedule_action,
            'reschedule_admin_note' => $request->reschedule_admin_note,
        ];

        if ($request->reschedule_action === 'disetujui') {
            $data['interview_schedule'] = $request->interview_schedule ?: $lamaran->reschedule_schedule;
            $data['applicant_response'] = 'reschedule_disetujui';
        } else {
            $data['status'] = 'ditolak';
            $data['applicant_response'] = 'reschedule_ditolak';
        }

        $lamaran->update($data);

        return back()->with('success', $request->reschedule_action === 'disetujui'
            ? 'Reschedule disetujui dan jadwal interview pelamar sudah diperbarui.'
            : 'Reschedule ditolak dan status lamaran pelamar berubah menjadi ditolak.');
    }
}
