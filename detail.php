<?php

include_once 'koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

/* =========================
DETAIL JOB
========================= */

$query = mysqli_query(
    $conn,
    "SELECT * FROM jobs WHERE id = $id"
);

$job = mysqli_fetch_assoc($query);

/* =========================
PROSES LAMAR
========================= */

if(isset($_POST['lamar'])){

    $username = $_POST['username'];
    $email    = $_POST['email'];
    $job_id   = $_POST['job_id'];

    mysqli_query(
        $conn,
        "INSERT INTO pelamar(username, email, job_id)
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

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

    <!-- =========================
        NAVBAR
    ========================== -->

    <nav class="navbar">

        <div class="logo">
            LokerInAja
        </div>

        <ul>

            <li>
                <a href="index.php">
                    Home
                </a>
            </li>

            <li>
                <a href="#">
                    Tentang
                </a>
            </li>

            <li>
                <a href="#">
                    Kontak
                </a>
            </li>

        </ul>

    </nav>

    <!-- =========================
        DETAIL JOB
    ========================== -->

    <section class="detail-job">

        <div class="card-detail">

            <h1>
                <?= $job['title']; ?>
            </h1>

            <p class="company">
                <?= $job['company']; ?>
            </p>

            <p class="location">
                <i class="fa-solid fa-location-dot"></i>
                <?= $job['location']; ?>
            </p>

            <p class="salary">
                <i class="fa-solid fa-money-bill"></i>
                <?= $job['salary']; ?>
            </p>

            <div class="description">
                <?= $job['description']; ?>
            </div>

            <!-- =========================
                FORM LAMAR
            ========================== -->

            <form method="POST">

                <input
                    type="hidden"
                    name="job_id"
                    value="<?= $job['id']; ?>"
                >

                <!-- USERNAME -->
                <input
                    type="text"
                    name="username"
                    placeholder="Masukkan Username"
                    required
                >

                <!-- EMAIL -->
                <input
                    type="email"
                    name="email"
                    placeholder="Masukkan Email"
                    required
                >

                <!-- BUTTON -->
                <button
                    type="submit"
                    name="lamar"
                    class="btn-lamar"
                >
                    Lamar Sekarang
                </button>

            </form>

        </div>

    </section>

</body>
</html>