<?php

namespace Database\Seeders;

use App\Models\JobPosting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ],
        );

        $jobs = [
            [
                'title' => 'Admin Operasional',
                'company' => 'Sculptify Indonesia',
                'location' => 'Jakarta Barat, DKI Jakarta',
                'salary' => 'Rp 4 jt - 5 jt',
                'description' => 'Bertanggung jawab membantu aktivitas administrasi operasional harian, pengelolaan data, dan koordinasi kebutuhan internal perusahaan.',
            ],
            [
                'title' => 'Web Developer',
                'company' => 'LokerinAja Digital',
                'location' => 'Jakarta Selatan, DKI Jakarta',
                'salary' => 'Rp 6 jt - 8 jt',
                'description' => 'Mengembangkan dan merawat aplikasi web perusahaan, memperbaiki bug, serta berkolaborasi dengan tim produk dan desain.',
            ],
            [
                'title' => 'Kasir Store',
                'company' => 'KOI Teppanyaki Home Service',
                'location' => 'Jakarta Utara, DKI Jakarta',
                'salary' => 'Rp 3 jt - 4 jt',
                'description' => 'Melayani transaksi pelanggan, menjaga kerapian area kasir, dan membantu operasional toko sesuai SOP.',
            ],
            [
                'title' => 'Teknisi Maintenance',
                'company' => 'Prima Teknik Nusantara',
                'location' => 'Bekasi, Jawa Barat',
                'salary' => 'Rp 4,5 jt - 6 jt',
                'description' => 'Melakukan pemeriksaan, perawatan, dan perbaikan perangkat teknis di lokasi pelanggan maupun kantor.',
            ],
        ];

        foreach ($jobs as $job) {
            JobPosting::query()->updateOrCreate(
                ['title' => $job['title'], 'company' => $job['company']],
                $job,
            );
        }
    }
}
