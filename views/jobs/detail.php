<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Pekerjaan</title>

    <link rel="stylesheet" href="./laravel-lokerinaja/public/css/detail.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body class="legacy-detail">

    <button class="back-btn" type="button" onclick="history.back()" aria-label="Kembali ke daftar pekerjaan">
        <i class="fa-solid fa-arrow-left"></i>
    </button>

    <!-- LOGO -->

    <div class="logo">

        <img src="LOGO.png" alt="LokerinAja">

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
                <p><?= htmlspecialchars($job['company'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>

                <h3>Nama Pekerjaan</h3>
                <p><?= htmlspecialchars($job['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>

                <h3>Lokasi</h3>
                <p><?= htmlspecialchars($job['location'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>

                <h3>Gaji</h3>
                <p><?= htmlspecialchars($job['salary'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>

                <h3>Syarat & Deskripsi</h3>
                <p><?= htmlspecialchars($job['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>

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

        <form method="POST" action="lamar.php" class="apply-form">

            <input
                type="hidden"
                name="job_id"
                value="<?= htmlspecialchars((string) ($job['id'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>"
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
