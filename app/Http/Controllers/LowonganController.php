<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index(Request $request)
    {
        $query = Lowongan::query();

        // pencarian kata kunci (posisi / perusahaan)
        if ($request->filled('q')) {
            $kw = $request->q;
            $query->where(function ($q) use ($kw) {
                $q->where('posisi', 'like', "%{$kw}%")
                  ->orWhere('perusahaan', 'like', "%{$kw}%");
            });
        }

        // filter
        if ($request->filled('lokasi'))     $query->where('lokasi', $request->lokasi);
        if ($request->filled('kategori'))   $query->where('kategori', $request->kategori);
        if ($request->filled('tipe'))       $query->where('tipe_kerja', $request->tipe);
        if ($request->filled('pengaturan')) $query->where('pengaturan_kerja', $request->pengaturan);
        if ($request->filled('level'))      $query->where('level', $request->level);

        // urutan
        $sort = $request->get('sort', 'terbaru');
        match ($sort) {
            'gaji_tinggi' => $query->orderByDesc('gaji_max'),
            'gaji_rendah' => $query->orderBy('gaji_min'),
            default       => $query->latest(),
        };

        $lowongan = $query->paginate(6)->withQueryString();

        // opsi filter (diambil dari data yang ada)
        $opsi = [
            'lokasi'     => Lowongan::distinct()->orderBy('lokasi')->pluck('lokasi'),
            'kategori'   => Lowongan::distinct()->orderBy('kategori')->pluck('kategori'),
            'tipe'       => Lowongan::distinct()->orderBy('tipe_kerja')->pluck('tipe_kerja'),
            'pengaturan' => Lowongan::distinct()->orderBy('pengaturan_kerja')->pluck('pengaturan_kerja'),
            'level'      => Lowongan::distinct()->orderBy('level')->pluck('level'),
        ];

        $total = Lowongan::count();

        return view('lowongan.index', compact('lowongan', 'opsi', 'total'));
    }
}
