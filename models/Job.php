<?php

class Job
{
    private mysqli $connection;

    public function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function find(int $id): ?array
    {
        $statement = mysqli_prepare(
            $this->connection,
            'SELECT * FROM jobs WHERE id = ? LIMIT 1'
        );

        mysqli_stmt_bind_param($statement, 'i', $id);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);
        $job = mysqli_fetch_assoc($result);

        return $job ?: null;
    }
}
