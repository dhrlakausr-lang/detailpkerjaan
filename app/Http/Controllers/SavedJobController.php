<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavedJobController extends Controller
{
    private function ensureUser()
    {
        if (! session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login untuk menyimpan lowongan');
        }

        if (session('role') === 'hr') {
            return redirect()->route('admin.lamaran.index')->with('error', 'Akun HR tidak bisa menyimpan lowongan');
        }

        return null;
    }

    public function index()
    {
        if ($response = $this->ensureUser()) {
            return $response;
        }

        $savedRows = DB::table('saved_jobs')
            ->where('user_id', session('user_id'))
            ->latest()
            ->get();

        $lowonganIds = $savedRows->where('source_type', 'lowongan')->pluck('source_id')->all();
        $jobIds = $savedRows->where('source_type', 'job')->pluck('source_id')->all();

        $lowongan = Lowongan::whereIn('id', $lowonganIds)->get()->keyBy('id');
        $jobs = JobPosting::whereIn('id', $jobIds)->get()->keyBy('id');

        $savedJobs = $savedRows->map(function ($saved) use ($lowongan, $jobs) {
            $item = $saved->source_type === 'lowongan'
                ? $lowongan->get($saved->source_id)
                : $jobs->get($saved->source_id);

            if (! $item) {
                return null;
            }

            return [
                'id' => $saved->id,
                'source_type' => $saved->source_type,
                'source_id' => $saved->source_id,
                'title' => $saved->source_type === 'lowongan' ? $item->posisi : $item->title,
                'company' => $saved->source_type === 'lowongan' ? $item->perusahaan : $item->company,
                'location' => $saved->source_type === 'lowongan' ? $item->lokasi : $item->location,
                'salary' => $saved->source_type === 'lowongan' ? $item->gaji_format : $item->salary,
                'url' => $saved->source_type === 'lowongan'
                    ? route('lowongan.detail', $item->id)
                    : route('jobs.show', $item->id),
            ];
        })->filter()->values();

        return view('saved-jobs.index', compact('savedJobs'));
    }

    public function toggle(Request $request)
    {
        if (! session()->has('user_id')) {
            return response()->json([
                'saved' => false,
                'message' => 'Silakan login untuk menyimpan lowongan.',
                'redirect' => route('login'),
            ], 401);
        }

        if (session('role') === 'hr') {
            return response()->json([
                'saved' => false,
                'message' => 'Akun HR tidak bisa menyimpan lowongan.',
            ], 403);
        }

        $data = $request->validate([
            'source_type' => 'required|in:job,lowongan',
            'source_id' => 'required|integer|min:1',
        ]);

        $exists = DB::table('saved_jobs')
            ->where('user_id', session('user_id'))
            ->where('source_type', $data['source_type'])
            ->where('source_id', $data['source_id'])
            ->first();

        if ($exists) {
            DB::table('saved_jobs')->where('id', $exists->id)->delete();

            return response()->json([
                'saved' => false,
                'message' => 'Lowongan dihapus dari simpanan.',
            ]);
        }

        DB::table('saved_jobs')->insert([
            'user_id' => session('user_id'),
            'source_type' => $data['source_type'],
            'source_id' => $data['source_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'saved' => true,
            'message' => 'Lowongan disimpan.',
        ]);
    }
}
