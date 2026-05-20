<?php

include_once 'koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST['username'];
    $email    = $_POST['email'];
    $job_id   = $_POST['job_id'];

    $query = mysqli_query($conn,
        "INSERT INTO pelamar (username, email, job_id)
        VALUES ('$username', '$email', '$job_id')"
    );

    if($query){
        echo "
        <script>
            alert('Lamaran berhasil dikirim!');
            window.location.href='detailpkerjaan.php?id=$job_id';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Gagal mengirim lamaran!');
            window.history.back();
        </script>
        ";
    }

}

?>