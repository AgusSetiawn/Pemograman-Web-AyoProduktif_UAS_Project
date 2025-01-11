<?php
// Ganti dengan data yang sesuai dengan konfigurasi database Anda
$host = 'localhost';  // Nama host, bisa 'localhost'
$dbname = 'ayo_produktif';  // Nama database
$username = 'root';  // Username database
$password = '';  // Password database (biasanya kosong untuk XAMPP)

try {
    // Membuat koneksi ke database dengan PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Menangani error jika koneksi gagal
    echo "Koneksi gagal: " . $e->getMessage();
    die();
}

// Fungsi untuk mendapatkan koneksi
function getDB() {
    global $pdo;
    return $pdo;
}
?>
