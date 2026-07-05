<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Job.php';

class JobController
{
    public function show(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $jobModel = new Job(Database::connect());
        $job = $jobModel->find($id);

        if (! $job) {
            die('Data pekerjaan tidak ditemukan');
        }

        require __DIR__ . '/../views/jobs/detail.php';
    }
}
