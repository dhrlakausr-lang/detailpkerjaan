<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Application.php';

class ApplicationController
{
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: detail.php');
            exit;
        }

        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $jobId = (int) ($_POST['job_id'] ?? 0);

        if ($username === '' || ! filter_var($email, FILTER_VALIDATE_EMAIL) || $jobId <= 0) {
            $this->redirectWithAlert('Data lamaran tidak valid!', "detail.php?id={$jobId}");
        }

        $applicationModel = new Application(Database::connect());
        $isCreated = $applicationModel->create($username, $email, $jobId);

        if ($isCreated) {
            $this->redirectWithAlert('Lamaran berhasil dikirim!', "detail.php?id={$jobId}");
        }

        $this->redirectWithAlert('Gagal mengirim lamaran!', "detail.php?id={$jobId}");
    }

    private function redirectWithAlert(string $message, string $url): void
    {
        $safeMessage = json_encode($message);
        $safeUrl = json_encode($url);

        echo "
        <script>
            alert({$safeMessage});
            window.location.href = {$safeUrl};
        </script>
        ";

        exit;
    }
}
