<?php
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    
    // Validasi data
    if (empty($id) || empty($nim) || empty($nama) || empty($jenis_kelamin)) {
        header("Location: ../ubah.php?id=$id&error=empty");
        exit();
    }
    
    // Keluar string
    $id = mysqli_real_escape_string($conn, $id);
    $nim = mysqli_real_escape_string($conn, $nim);
    $nama = mysqli_real_escape_string($conn, $nama);
    $jenis_kelamin = mysqli_real_escape_string($conn, $jenis_kelamin);
    
    // Query UPDATE
    $query = "UPDATE mahasiswa SET nim = '$nim', nama = '$nama', jenis_kelamin = '$jenis_kelamin' WHERE id = '$id'";
    
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        // Cek apakah ada row yang terupdate
        if (mysqli_affected_rows($conn) > 0) {
            header("Location: ../index.php?success=updated");
        } else {
            // Jika tidak ada perubahan data (data sama dengan sebelumnya)
            header("Location: ../index.php?info=nochange");
        }
        exit();
    } else {
        header("Location: ../ubah.php?id=$id&error=failed");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}

mysqli_close($conn);
?>
