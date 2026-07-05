<?php

class Application
{
    private mysqli $connection;

    public function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function create(string $username, string $email, int $jobId): bool
    {
        $statement = mysqli_prepare(
            $this->connection,
            'INSERT INTO pelamar (username, email, job_id) VALUES (?, ?, ?)'
        );

        mysqli_stmt_bind_param($statement, 'ssi', $username, $email, $jobId);

        return mysqli_stmt_execute($statement);
    }
}
