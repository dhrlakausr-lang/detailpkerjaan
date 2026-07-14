<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lamaran;
use App\Models\Lowongan;

class LamaranController extends Controller
{
    private function ensurePelamar()
    {
        if (! session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login sebagai pelamar sebelum melamar');
        }

        if (session('role') === 'hr') {
            return redirect()->route('admin.lamaran.index')->with('error', 'Akun HR tidak bisa mengirim lamaran');
        }

        return null;
    }

    public function index()
    {
        if ($response = $this->ensurePelamar()) {
            return $response;
        }

        $perusahaan = request('perusahaan');

        if (! $perusahaan && request('posisi')) {
            $perusahaan = Lowongan::where('posisi', request('posisi'))->value('perusahaan');
        }

        return view('lamaran.index', compact('perusahaan'));
    }

    public function status()
    {
        if (! session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat status lamaran');
        }

        if (session('role') === 'hr') {
            return redirect()->route('admin.lamaran.index');
        }

        $lamarans = Lamaran::where('email', session('email'))
            ->latest()
            ->paginate(10);

        return view('lamaran.status', compact('lamarans'));
    }

    public function store(Request $request)
    {
        if ($response = $this->ensurePelamar()) {
            return $response;
        }

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'hp' => 'required',
            'posisi' => 'required',
            'cv' => 'required|file'
        ]);

        $perusahaan = $request->perusahaan ?: Lowongan::where('posisi', $request->posisi)->value('perusahaan');
        $file = $request->file('cv');

        $namaFile = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('upload'), $namaFile);

        Lamaran::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'hp' => $request->hp,
            'posisi' => $request->posisi,
            'perusahaan' => $perusahaan,
            'portfolio' => $request->portfolio,
            'cover_letter' => $request->cover,
            'cv' => $namaFile,
            'status' => 'menunggu'
        ]);

        return view('lamaran.sukses');
    }
}
