<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "lokerinaja"
);

if(!$conn){
    die("Koneksi database gagal!");
}

?>