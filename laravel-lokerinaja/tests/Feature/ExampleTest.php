<?php

namespace Tests\Feature;

use App\Models\JobPosting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_job_detail_page_can_be_opened(): void
    {
        $job = JobPosting::query()->create([
            'title' => 'Admin Operasional',
            'company' => 'Sculptify Indonesia',
            'location' => 'Jakarta Barat, DKI Jakarta',
            'salary' => 'Rp 4 jt - 5 jt',
            'description' => 'Mengelola administrasi operasional harian.',
        ]);

        $this->get(route('jobs.show', $job))
            ->assertOk()
            ->assertSee('Admin Operasional')
            ->assertSee('Sculptify Indonesia');
    }

    public function test_user_can_submit_application(): void
    {
        $job = JobPosting::query()->create([
            'title' => 'Web Developer',
            'company' => 'LokerinAja Digital',
            'location' => 'Jakarta Selatan, DKI Jakarta',
            'salary' => 'Rp 6 jt - 8 jt',
            'description' => 'Mengembangkan aplikasi web perusahaan.',
        ]);

        $this->post(route('applications.store'), [
            'username' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'job_id' => $job->id,
        ])
            ->assertRedirect(route('jobs.show', [
                'job' => $job,
                'status' => 'success',
                'lamaran_id' => 1,
            ]));

        $this->assertDatabaseHas('pelamar', [
            'username' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'job_id' => $job->id,
        ]);
    }
}
