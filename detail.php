<?php

include_once 'koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

// DETAIL JOB
$query = mysqli_query(
    $conn,
    "SELECT * FROM jobs WHERE id = $id"
);

$job = mysqli_fetch_assoc($query);

// AMBIL SEMUA JOB
$allJobs = mysqli_query(
    $conn,
    "SELECT id, title FROM jobs"
);

$jobsArray = [];

// MASUKKAN KE ARRAY
while($row = mysqli_fetch_assoc($allJobs)){

    $jobsArray[
        strtolower($row['title'])
    ] = $row['id'];

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Detail Pekerjaan</title>

    <!-- ICON -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="detail.css">

</head>

<body>

    <!-- BACK -->
    <a href="index.html" class="back-btn">

        <i class="fa-solid fa-arrow-left"></i>

    </a>

    <!-- LOGO -->
    <div class="logo">

        <img src="LOGO.png" alt="Logo">

    </div>

    <!-- PROFILE -->
    <div class="profile"
        onclick="toggleMenu(event)">

        <div class="avatar">
            U
        </div>

        <span>
            Hi, User
        </span>

        <!-- DROPDOWN -->
        <div class="dropdown"
            id="dropdownMenu">

            <p>User</p>

            <button onclick="logout()">
                Logout
            </button>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="container">

        <!-- TITLE -->
        <div class="title-bar">

            <div class="title-wrapper">

                <h1>
                    Detail Pekerjaan
                </h1>

                <!-- SEARCH -->
                <div class="search-container"
                    id="searchContainer">

                    <!-- BUTTON SEARCH -->
                    <button
                        class="search-btn"
                        id="searchBtn"
                        type="button"
                    >

                        <i class="fa-solid fa-magnifying-glass"></i>

                    </button>

                    <!-- INPUT SEARCH -->
                    <input
                        type="text"
                        class="search-input"
                        id="searchInput"
                        placeholder="Cari pekerjaan..."
                    >

                </div>

            </div>

        </div>

        <!-- NOT FOUND -->
        <p
            id="notFound"
            class="not-found"
            style="display:none;"
        >

            Tidak dapat menemukan pekerjaan tersebut

        </p>

        <!-- CARD -->
        <div class="card">

            <!-- LEFT -->
            <div class="left">

                <h3>Nama Perusahaan</h3>

                <p>
                    <?= $job['company']; ?>
                </p>

                <h3>Nama Pekerjaan</h3>

                <p>
                    <?= $job['title']; ?>
                </p>

                <h3>Lokasi</h3>

                <p>
                    <?= $job['location']; ?>
                </p>

                <h3>Gaji</h3>

                <p>
                    Rp<?= number_format($job['salary']); ?>
                </p>

                <h3>Syarat & Deskripsi</h3>

                <p>
                    <?= $job['requirements']; ?>
                </p>

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

                <!-- APPLY -->
                <a href="lamar.html"
                class="apply-btn">

                    <i class="fa-solid fa-paper-plane"></i>

                    Lamar Sekarang

                </a>

            </div>

            <!-- RIGHT -->
            <div class="right">

                <div class="image-box"></div>

            </div>

        </div>

    </div>

    <!-- JS -->
    <script>

        // ===============================
        // SEARCH POPUP
        // ===============================

        const searchBtn =
        document.getElementById("searchBtn");

        const searchContainer =
        document.getElementById("searchContainer");

        const searchInput =
        document.getElementById("searchInput");

        const notFound =
        document.getElementById("notFound");

        // OPEN SEARCH

        searchBtn.addEventListener("click", () => {

            searchContainer.classList.toggle("active");

            searchInput.focus();

        });

        // ===============================
        // SEARCH JOB
        // ===============================

        searchInput.addEventListener("keydown", (e) => {

            // ENTER
            if(e.key === "Enter"){

                const keyword =

                searchInput.value
                .toLowerCase()
                .trim();

                // DATA JOB DARI DATABASE
                const jobs =
                <?= json_encode($jobsArray); ?>;

                // JIKA ADA
                if(jobs[keyword]){

                    window.location.href =

                    `detail.php?id=${jobs[keyword]}`;

                }else{

                    notFound.style.display = "block";

                }

            }

        });

        // HIDE ERROR SAAT NGETIK

        searchInput.addEventListener("input", () => {

            notFound.style.display = "none";

        });

        // ===============================
        // DROPDOWN MENU
        // ===============================

        function toggleMenu(event){

            event.stopPropagation();

            const menu =
            document.getElementById("dropdownMenu");

            if(menu.style.display === "block"){

                menu.style.display = "none";

            }else{

                menu.style.display = "block";

            }

        }

        // CLOSE DROPDOWN

        window.addEventListener("click", function(){

            document
            .getElementById("dropdownMenu")
            .style.display = "none";

        });

        // ===============================
        // LOGOUT
        // ===============================

        function logout(){

            alert("Logout berhasil!");

            window.location.href = "index.html";

        }

    </script>

    </div>

<footer class="footer">
    <div class="footer-content">
        <a href="#">Tentang Kami</a>
        <a href="#">Kontak</a>
        <a href="#">Kebijakan Privasi</a>
        <a href="#">Pusat Bantuan</a>
    </div>
</footer>

</body>

</html>