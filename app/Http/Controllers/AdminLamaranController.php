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
        ]);

        $lamaran->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status lamaran berhasil diperbarui');
    }
}
