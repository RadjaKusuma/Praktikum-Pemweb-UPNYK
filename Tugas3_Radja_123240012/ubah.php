<?php
include 'config/koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$id = mysqli_real_escape_string($conn, $id);

$query = "SELECT * FROM mahasiswa WHERE id = '$id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    header("Location: index.php?error=notfound");
    exit();
}

$mahasiswa = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speda - Update Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/logo-speda.png" alt="Speda Logo" style="height: 30px;">
                Speda
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambah.php">Tambah Mahasiswa</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="text-light me-2">Hello Budi</span>
                    <img src="img/logo-user.jpg" alt="User Logo" class="rounded-circle" style="height: 40px; width: 40px;">
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="content-panel">
            <h3>Update Mahasiswa</h3>
            <form method="POST" action="logic/logicubah.php" class="mt-3">
                <!-- PENTING: Hidden input untuk ID -->
                <input type="hidden" name="id" value="<?php echo $mahasiswa['id']; ?>">
                
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" 
                           value="<?php echo htmlspecialchars($mahasiswa['nim']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" 
                           value="<?php echo htmlspecialchars($mahasiswa['nama']); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" 
                               id="laki-laki" value="Laki-laki" 
                               <?php echo ($mahasiswa['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?> required>
                        <label class="form-check-label" for="laki-laki">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" 
                               id="perempuan" value="Perempuan"
                               <?php echo ($mahasiswa['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?> required>
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
