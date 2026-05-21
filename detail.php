<?php

include_once 'koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

$query = mysqli_query(
    $conn,
    "SELECT * FROM jobs WHERE id = $id"
);

$job = mysqli_fetch_assoc($query);

if(!$job){
    die("Data pekerjaan tidak ditemukan");
}

/* =========================
PROSES LAMAR
========================= */

if(isset($_POST['lamar'])){

    $username = $_POST['username'];
    $email    = $_POST['email'];
    $job_id   = $_POST['job_id'];

    mysqli_query(
        $conn,
        "INSERT INTO pelamar(username,email,job_id)
        VALUES('$username','$email','$job_id')"
    );

    echo "
    <script>
        alert('Lamaran berhasil dikirim!');
        window.location.href='detail.php?id=$job_id';
    </script>
    ";
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Pekerjaan</title>

    <link rel="stylesheet" href="./detail.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

    <!-- LOGO -->

    <div class="logo">

        <img src="logo.png">

    </div>

    <!-- PROFILE -->

    <div class="profile">

        <div class="avatar">U</div>

        <span>Hi, User</span>

    </div>

    <!-- CONTAINER -->

    <div class="container">

        <!-- TITLE -->

        <h1>Detail Pekerjaan</h1>

        <!-- CARD -->

        <div class="card">

            <!-- LEFT -->

            <div class="left">

                <h3>Nama Perusahaan</h3>
                <p><?= $job['company']; ?></p>

                <h3>Nama Pekerjaan</h3>
                <p><?= $job['title']; ?></p>

                <h3>Lokasi</h3>
                <p><?= $job['location']; ?></p>

                <h3>Gaji</h3>
                <p><?= $job['salary']; ?></p>

                <h3>Syarat & Deskripsi</h3>
                <p><?= $job['description']; ?></p>

                <!-- SOCIAL -->

                <h3>Contact</h3>

                <div class="social">

                    <a href="#">
                        <i class="fab fa-whatsapp"></i>
                    </a>

                    <a href="#">
                        <i class="fab fa-telegram"></i>
                    </a>

                    <a href="#">
                        <i class="fab fa-instagram"></i>
                    </a>

                </div>

            </div>

            <!-- RIGHT -->

            <div class="right">

                <div class="image-box"></div>

            </div>

        </div>

        <!-- FORM LAMAR -->

        <form method="POST" class="apply-form">

            <input
                type="hidden"
                name="job_id"
                value="<?= $job['id']; ?>"
            >

            <input
                type="text"
                name="username"
                placeholder="Masukkan Username"
                required
            >

            <input
                type="email"
                name="email"
                placeholder="Masukkan Email"
                required
            >

            <button
                type="submit"
                name="lamar"
                class="apply-btn"
            >

                <i class="fa-solid fa-paper-plane"></i>

                Lamar Sekarang

            </button>

        </form>

    </div>

</body>
</html>