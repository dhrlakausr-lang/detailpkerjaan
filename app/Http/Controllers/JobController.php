<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class JobController extends Controller
{
    public function show(Request $request, JobPosting $job)
    {
        return $this->renderDetail($request, $job, 'job', JobPosting::query()
            ->where('id', '!=', $job->id)
            ->orderByDesc('id')
            ->limit(3)
            ->get());
    }

    public function showLowongan(Request $request, Lowongan $lowongan)
    {
        $job = new JobPosting([
            'title' => $lowongan->posisi,
            'company' => $lowongan->perusahaan ?: 'LokerinAja',
            'location' => $lowongan->lokasi,
            'salary' => $lowongan->gaji_format,
            'description' => $lowongan->deskripsi ?: 'Detail lowongan tersedia melalui LokerinAja.',
        ]);
        $job->id = $lowongan->id;

        $otherJobs = Lowongan::query()
            ->where('id', '!=', $lowongan->id)
            ->latest()
            ->limit(3)
            ->get()
            ->map(function (Lowongan $item) {
                $other = new JobPosting([
                    'title' => $item->posisi,
                    'company' => $item->perusahaan ?: 'LokerinAja',
                    'location' => $item->lokasi,
                    'salary' => $item->gaji_format,
                    'description' => $item->deskripsi ?: 'Detail lowongan tersedia melalui LokerinAja.',
                ]);
                $other->id = $item->id;
                $other->source_type = 'lowongan';

                return $other;
            });

        return $this->renderDetail($request, $job, 'lowongan', $otherJobs);
    }

    private function renderDetail(Request $request, JobPosting $job, string $sourceType, $otherJobs)
    {
        $profile = $this->jobProfile($this->jobCategory($job->title), $job->title);
        $isSaved = false;
        $savedLookup = [];

        $displayName = '';
        $userEmail = '';

        if (session()->has('user_id') && Schema::hasTable('users')) {
            $query = DB::table('users')->where('id', session('user_id'));
            $user = $query->first();

            if ($user) {
                $displayName = $user->nama ?? $user->name ?? $user->username ?? '';
                $userEmail = $user->email ?? '';
            }

            if (Schema::hasTable('saved_jobs')) {
                $isSaved = DB::table('saved_jobs')
                    ->where('user_id', session('user_id'))
                    ->where('source_type', $sourceType)
                    ->where('source_id', $job->id)
                    ->exists();

                $savedLookup = DB::table('saved_jobs')
                    ->where('user_id', session('user_id'))
                    ->get()
                    ->mapWithKeys(fn ($saved) => [$saved->source_type . ':' . $saved->source_id => true])
                    ->all();
            }
        }

        $displayName = $displayName ?: session('nama', session('username', ''));
        $userEmail = $userEmail ?: session('email', '');

        $completionUrl = url('/lamaran-user') . '?job_id=' . urlencode((string) $job->id);

        if ($request->integer('lamaran_id') > 0) {
            $completionUrl .= '&lamaran_id=' . urlencode((string) $request->integer('lamaran_id'));
        }

        return view('jobs.show', [
            'job' => $job,
            'profile' => $profile,
            'otherJobs' => $otherJobs,
            'displayName' => $displayName,
            'userEmail' => $userEmail,
            'userInitial' => $displayName !== '' ? strtoupper(substr($displayName, 0, 1)) : 'U',
            'isLoggedIn' => $displayName !== '',
            'status' => $request->query('status'),
            'completionUrl' => $completionUrl,
            'sourceType' => $sourceType,
            'isSaved' => $isSaved,
            'savedLookup' => $savedLookup,
            'shareUrl' => $request->fullUrl(),
            'requirements' => [
                'Kerja di lokasi',
                'Penuh Waktu',
                $profile['education'],
                $profile['experience'],
            ],
        ]);
    }

    private function jobCategory(string $title): string
    {
        $title = strtolower($title);

        if (str_contains($title, 'teknisi')) {
            return 'Teknik';
        }

        if (str_contains($title, 'kasir') || str_contains($title, 'spg') || str_contains($title, 'store manager')) {
            return 'Retail';
        }

        if (str_contains($title, 'developer') || str_contains($title, 'ui/ux') || str_contains($title, 'database')) {
            return 'IT';
        }

        return 'Administrasi';
    }

    private function jobProfile(string $category, string $title): array
    {
        $profiles = [
            'Administrasi' => [
                'division' => 'Administrasi & Operasional',
                'education' => 'Minimal SMA/SMK',
                'experience' => '0 - 2 tahun pengalaman',
                'workType' => 'Penuh Waktu - Kerja di lokasi',
                'skills' => ['Microsoft Office', 'Data Entry', 'Komunikasi', 'Arsip Dokumen', 'Administrasi', 'Customer Service'],
                'benefits' => ['THR', 'BPJS Kesehatan', 'BPJS Ketenagakerjaan', 'Training Internal'],
                'responsibilities' => [
                    'Mengelola dokumen, data, dan kebutuhan administrasi harian perusahaan.',
                    'Membantu koordinasi antar tim agar proses kerja berjalan rapi dan tepat waktu.',
                    'Melayani kebutuhan informasi internal maupun eksternal dengan ramah dan akurat.',
                ],
                'qualifications' => [
                    'Teliti, komunikatif, dan mampu menggunakan komputer untuk pekerjaan harian.',
                    'Mampu mengatur prioritas kerja serta menjaga kerahasiaan data perusahaan.',
                    'Bersedia bekerja secara langsung di kantor sesuai jadwal yang ditentukan.',
                ],
                'industry' => 'Business Support Services',
                'employees' => '11 - 50 karyawan',
            ],
            'Teknik' => [
                'division' => 'Teknik & Maintenance',
                'education' => 'Minimal SMK Teknik',
                'experience' => '1 - 3 tahun pengalaman',
                'workType' => 'Penuh Waktu - Kerja di lokasi',
                'skills' => ['Troubleshooting', 'Maintenance', 'Instalasi', 'Keselamatan Kerja', 'Problem Solving', 'Laporan Teknis'],
                'benefits' => ['THR', 'BPJS Kesehatan', 'Uang Transport', 'Peralatan Kerja'],
                'responsibilities' => [
                    'Melakukan pemeriksaan, perawatan, dan perbaikan perangkat sesuai bidang pekerjaan.',
                    'Menangani kendala teknis di lokasi dengan prosedur kerja yang aman.',
                    'Membuat laporan pekerjaan dan rekomendasi perbaikan kepada atasan.',
                ],
                'qualifications' => [
                    'Memahami dasar kelistrikan, jaringan, AC, atau perangkat teknis sesuai posisi.',
                    'Sigap turun ke lapangan dan mampu menyelesaikan masalah secara sistematis.',
                    'Memiliki sikap kerja disiplin, rapi, dan mengutamakan keselamatan.',
                ],
                'industry' => 'Technical Services',
                'employees' => '11 - 100 karyawan',
            ],
            'Retail' => [
                'division' => 'Retail & Store Operations',
                'education' => 'Minimal SMA/SMK',
                'experience' => '0 - 2 tahun pengalaman',
                'workType' => 'Penuh Waktu - Shift di toko',
                'skills' => ['Pelayanan Pelanggan', 'Penjualan', 'Kasir', 'Display Produk', 'Stock Opname', 'Komunikasi'],
                'benefits' => ['THR', 'Insentif Penjualan', 'BPJS Kesehatan', 'Jenjang Karier'],
                'responsibilities' => [
                    'Melayani pelanggan dan membantu proses transaksi atau kebutuhan produk di toko.',
                    'Menjaga kerapian area kerja, display barang, dan ketersediaan stok.',
                    'Mendukung target penjualan serta menjalankan SOP toko dengan konsisten.',
                ],
                'qualifications' => [
                    'Ramah, percaya diri, dan nyaman berinteraksi langsung dengan pelanggan.',
                    'Bersedia bekerja dengan sistem shift, akhir pekan, atau hari libur.',
                    'Memiliki ketelitian saat menangani transaksi dan stok barang.',
                ],
                'industry' => 'Retail',
                'employees' => '51 - 200 karyawan',
            ],
            'IT' => [
                'division' => 'Information Technology',
                'education' => 'Minimal D3/S1 atau portofolio relevan',
                'experience' => '1 - 3 tahun pengalaman',
                'workType' => 'Penuh Waktu - Hybrid/Onsite',
                'skills' => ['Problem Solving', 'SQL', 'UI/UX', 'Web Development', 'Testing', 'Dokumentasi Teknis'],
                'benefits' => ['THR', 'Health Insurance', 'Laptop Kerja', 'Learning Budget'],
                'responsibilities' => [
                    'Mengembangkan, merawat, atau mengelola sistem digital sesuai kebutuhan perusahaan.',
                    'Berkolaborasi dengan tim produk, operasional, dan stakeholder terkait.',
                    'Melakukan dokumentasi, testing, dan perbaikan agar sistem stabil digunakan.',
                ],
                'qualifications' => [
                    'Memiliki pemahaman teknis sesuai posisi dan siap belajar tools baru.',
                    'Mampu membaca kebutuhan pengguna lalu menerjemahkannya menjadi solusi.',
                    'Teliti saat mengerjakan detail, dokumentasi, dan proses debugging.',
                ],
                'industry' => 'Technology',
                'employees' => '11 - 100 karyawan',
            ],
        ];

        $profile = $profiles[$category] ?? $profiles['Administrasi'];

        if (stripos($title, 'ui/ux') !== false) {
            $profile['skills'] = ['Figma', 'Wireframing', 'User Research', 'Prototype', 'Design System', 'Usability Testing'];
            $profile['division'] = 'Design & Product';
        }

        if (stripos($title, 'web developer') !== false) {
            $profile['skills'] = ['HTML', 'CSS', 'JavaScript', 'PHP', 'Database', 'Git'];
        }

        if (stripos($title, 'database') !== false) {
            $profile['skills'] = ['SQL', 'Backup Database', 'Data Security', 'Query Optimization', 'MySQL', 'Reporting'];
        }

        return $profile;
    }
}
