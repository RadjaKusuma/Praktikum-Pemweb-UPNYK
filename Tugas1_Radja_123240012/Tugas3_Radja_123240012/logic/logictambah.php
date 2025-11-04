<?php
// Include file koneksi database
include '../config/koneksi.php';

// Cek apakah form sudah di-submit dengan method POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Ambil data dari form menggunakan $_POST
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    
    // Validasi data (cek apakah ada yang kosong) 
    if (empty($nim) || empty($nama) || empty($jenis_kelamin)) {
        // Jika ada field yang kosong, megalihkan kembali ke form tambah
        header("Location: ../tambah.php?error=empty");
        exit();
    }
    
    // Keluar string untuk mencegah SQL Injection
    $nim = mysqli_real_escape_string($conn, $nim);
    $nama = mysqli_real_escape_string($conn, $nama);
    $jenis_kelamin = mysqli_real_escape_string($conn, $jenis_kelamin);
    
    // Query INSERT untuk menambah data ke database
    $query = "INSERT INTO mahasiswa (nim, nama, jenis_kelamin) VALUES ('$nim', '$nama', '$jenis_kelamin')";
    
    // Eksekusi query
    $result = mysqli_query($conn, $query);
    
    // Cek apakah query berhasil
    if ($result) {
        // Jika berhasil, mengalihkan ke index.php dengan pesan sukses
        header("Location: ../index.php?success=added");
        exit();
    } else {
        // Jika gagal, mengalihkan ke tambah.php dengan pesan error
        header("Location: ../tambah.php?error=failed");
        exit();
    }
    
} else {
    // Jika bukan method POST, redirect ke halaman tambah
    header("Location: ../tambah.php");
    exit();
}

// Tutup koneksi database
mysqli_close($conn);
?>
