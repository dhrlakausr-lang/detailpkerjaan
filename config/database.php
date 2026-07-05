<?php

class Database
{
    public static function connect(): mysqli
    {
        $connection = mysqli_connect(
            'localhost',
            'root',
            '',
            'lokerinaja'
        );

        if (! $connection) {
            die('Koneksi database gagal!');
        }

        return $connection;
    }
}
