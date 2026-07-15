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

        $uploadedCv = $request->file('cv');
        if ($uploadedCv && ! $uploadedCv->isValid()) {
            $uploadErrors = [
                UPLOAD_ERR_INI_SIZE => 'CV gagal diupload karena melebihi upload_max_filesize PHP (' . ini_get('upload_max_filesize') . ').',
                UPLOAD_ERR_FORM_SIZE => 'CV gagal diupload karena melebihi batas ukuran form.',
                UPLOAD_ERR_PARTIAL => 'CV hanya terupload sebagian. Coba upload ulang.',
                UPLOAD_ERR_NO_FILE => 'CV belum dipilih.',
                UPLOAD_ERR_NO_TMP_DIR => 'Folder temporary upload PHP tidak tersedia.',
                UPLOAD_ERR_CANT_WRITE => 'Server gagal menulis file upload.',
                UPLOAD_ERR_EXTENSION => 'Upload CV dihentikan oleh ekstensi PHP.',
            ];

            return back()
                ->withInput()
                ->withErrors([
                    'cv' => $uploadErrors[$uploadedCv->getError()] ?? 'CV gagal diupload. Limit PHP saat ini: upload_max_filesize=' . ini_get('upload_max_filesize') . ', post_max_size=' . ini_get('post_max_size') . '.',
                ]);
        }

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'hp' => 'required',
            'posisi' => 'required',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:20480',
        ], [
            'cv.required' => 'CV wajib diupload.',
            'cv.file' => 'CV gagal diupload. Pastikan ukuran file tidak melebihi batas upload server.',
            'cv.mimes' => 'CV harus berformat PDF, DOC, atau DOCX.',
            'cv.max' => 'Ukuran CV maksimal 20 MB.',
            'uploaded' => 'File gagal diupload. Coba gunakan file yang lebih kecil atau naikkan limit upload server.',
        ]);

        $perusahaan = $request->perusahaan ?: Lowongan::where('posisi', $request->posisi)->value('perusahaan');
        $file = $request->file('cv');

        $namaFile = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('upload'), $namaFile);

        $lamaran = Lamaran::create([
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

        return view('lamaran.sukses', compact('lamaran'));
    }

    public function confirmInterview(Lamaran $lamaran)
    {
        if ($response = $this->ensurePelamar()) {
            return $response;
        }

        $this->authorizeLamaranOwner($lamaran);

        if (($lamaran->status ?? 'menunggu') !== 'diterima' || ! $lamaran->interview_schedule) {
            return back()->with('error', 'Jadwal interview belum tersedia untuk lamaran ini.');
        }

        $lamaran->update([
            'applicant_response' => 'akan_datang',
            'reschedule_requested_at' => null,
            'reschedule_schedule' => null,
            'reschedule_reason' => null,
            'reschedule_status' => null,
            'reschedule_admin_note' => null,
        ]);

        return back()->with('success', 'Konfirmasi kehadiran berhasil dikirim ke HR.');
    }

    public function requestReschedule(Request $request, Lamaran $lamaran)
    {
        if ($response = $this->ensurePelamar()) {
            return $response;
        }

        $this->authorizeLamaranOwner($lamaran);

        if (($lamaran->status ?? 'menunggu') !== 'diterima' || ! $lamaran->interview_schedule) {
            return back()->with('error', 'Jadwal interview belum tersedia untuk lamaran ini.');
        }

        if ($lamaran->reschedule_requested_at) {
            return back()->with('error', 'Reschedule hanya bisa diajukan satu kali untuk setiap lamaran.');
        }

        $request->validate([
            'reschedule_schedule' => 'required|date|after:now',
            'reschedule_reason' => 'required|string|max:1000',
        ]);

        $lamaran->update([
            'applicant_response' => 'reschedule_diajukan',
            'reschedule_requested_at' => now(),
            'reschedule_schedule' => $request->reschedule_schedule,
            'reschedule_reason' => $request->reschedule_reason,
            'reschedule_status' => 'menunggu',
            'reschedule_admin_note' => null,
        ]);

        return back()->with('success', 'Pengajuan reschedule berhasil dikirim ke HR.');
    }

    private function authorizeLamaranOwner(Lamaran $lamaran): void
    {
        if ($lamaran->email !== session('email')) {
            abort(403, 'Kamu hanya bisa mengelola lamaran milik akun sendiri.');
        }
    }
}
