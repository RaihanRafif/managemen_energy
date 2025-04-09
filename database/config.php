<?php
// Koneksi ke database
// $servername = "192.168.1.147";
// $username = "energy"; // Ganti dengan username database Anda
// $password = "energypass"; // Ganti dengan password database Anda
// $dbname = "smartgrid_cas";

$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "lab_me";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
