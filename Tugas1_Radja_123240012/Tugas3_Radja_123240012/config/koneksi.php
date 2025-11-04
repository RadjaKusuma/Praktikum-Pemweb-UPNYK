<?php
// File koneksi database, digunakan di semua file PHP lain untuk kita integrasikan ke MySQL

// Konfigurasi database
$host = "localhost";        // Host database (biasanya localhost)
$username = "root";         // Username MySQL (default: root)
$password = "";             // Password MySQL (default: kosong untuk XAMPP)
$database = "spedatugas3";  // Nama database yang sudah saya dibuat

// Membuat koneksi ke database kita
$conn = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$conn) {
    // Jika koneksi gagal, tampilkan pesan error dan hentikan eksekusi
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Set charset agar mendukung karakter UTF-8 (Indonesia)
mysqli_set_charset($conn, "utf8mb4");

// Koneksi berhasil, variabel $conn siap digunakan 
?>
