<?php 

$db_host ="localhost";
$db_user ="root";
$db_pass ="";
$db_name = "nwind";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn){
    die("koneksi GAGAL:". mysqli_connect_error());
}

// echo "koneksi BERHASIL";


?>