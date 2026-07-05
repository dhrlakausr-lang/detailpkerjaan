<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobPosting;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'job_id' => ['required', 'integer', 'exists:jobs,id'],
        ]);

        $application = Application::create($data);
        $job = JobPosting::findOrFail($data['job_id']);

        return redirect()
            ->route('jobs.show', [
                'job' => $job,
                'status' => 'success',
                'lamaran_id' => $application->id,
            ]);
    }
}
