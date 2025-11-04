<?php
// Proses hapus data mahasiswa dari database

// Include koneksi database
include '../config/koneksi.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id != '') {
    // Query DELETE untuk menghapus data 
    $query = "DELETE FROM mahasiswa WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        // Mengalihkan ke index.php setelah berhasil dihapus
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Jika ID tidak ada, Mengalihkan ke index
    header("Location: ../index.php");
    exit();
}
?>