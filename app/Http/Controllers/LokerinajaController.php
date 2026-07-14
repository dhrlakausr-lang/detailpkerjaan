<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class LokerinajaController extends Controller
{
    public function index()
    {
        $lowongan = Lowongan::latest()->get();

        $frontendLowongan = $lowongan->first(fn ($item) => str_contains(strtolower($item->posisi ?? ''), 'frontend'))
            ?? $lowongan->first(fn ($item) => str_contains(strtolower($item->posisi ?? ''), 'developer'));
        $uiuxLowongan = $lowongan->first(fn ($item) => str_contains(strtolower($item->posisi ?? ''), 'ui/ux'));
        $dataJob = JobPosting::query()
            ->where('title', 'like', '%Data%')
            ->orWhere('title', 'like', '%Database%')
            ->first();
        $fallbackLowongan = $lowongan->first();

        $featuredLinks = [
            'frontend' => $frontendLowongan ? route('lowongan.detail', $frontendLowongan) : route('lowongan.index'),
            'uiux' => $uiuxLowongan ? route('lowongan.detail', $uiuxLowongan) : route('lowongan.index'),
            'data' => $dataJob ? route('jobs.show', $dataJob) : ($fallbackLowongan ? route('lowongan.detail', $fallbackLowongan) : route('lowongan.index')),
        ];

        $lowonganJson = $lowongan->map(function ($l) {
            $gambar = $l->gambar ?? 'Job1.png';
            return [
                'posisi'   => $l->posisi,
                'lokasi'   => $l->lokasi,
                'kategori' => $l->kategori,
                'gambar'   => filter_var($gambar, FILTER_VALIDATE_URL)
                                ? $gambar
                                : asset('images/' . basename($gambar)),
            ];
        });

        return view('lokerinaja.index', compact('lowongan', 'lowonganJson', 'featuredLinks'));
    }

    public function apply(Request $request)
    {
        if (! session()->has('user_id')) {
            return response()->json([
                'status' => 'login_required',
                'redirect' => route('login'),
                'message' => 'Silakan login sebagai pelamar sebelum melamar',
            ], 401);
        }

        if (session('role') === 'hr') {
            return response()->json([
                'status' => 'forbidden',
                'redirect' => route('admin.lamaran.index'),
                'message' => 'Akun HR tidak bisa mengirim lamaran',
            ], 403);
        }

        $request->validate([
            'id_lowongan' => 'required|exists:lowongan,id',
        ]);

        $lowongan = Lowongan::findOrFail($request->id_lowongan);

        return response()->json([
            'status' => 'success',
            'redirect' => route('lamaran.index', [
                'posisi' => $lowongan->posisi,
                'perusahaan' => $lowongan->perusahaan,
            ]),
        ]);
    }
}
