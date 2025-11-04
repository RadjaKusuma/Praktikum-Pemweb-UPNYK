<?php
include 'config/koneksi.php';

$search = "";
$whereClause = "";

if (isset($_GET['cari']) && !empty($_GET['cari'])) {
    $search = $_GET['cari'];
    $search = mysqli_real_escape_string($conn, $search);
    $whereClause = "WHERE nama LIKE '%$search%'";
}

$query = "SELECT * FROM mahasiswa $whereClause ORDER BY id ASC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speda - Data Mahasiswa</title>
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
                        <a class="nav-link active" href="index.php">Home</a>
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

    <div class="container mt-4">
        <h3>Daftar Mahasiswa</h3>
        <div class="row mt-3">
            <div class="col-md-6">
                <form method="GET" action="index.php">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari Mahasiswa..." 
                               name="cari" value="<?php echo htmlspecialchars($search); ?>">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-dark table-striped mt-2">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;  
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>"; 
                        echo "<td>" . htmlspecialchars($row['nim']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jenis_kelamin']) . "</td>";
                        echo "<td>";
                        echo "<a href='ubah.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Update</a> ";
                        echo "<button class='btn btn-danger btn-sm delete-btn' data-id='" . $row['id'] . "' data-nama='" . htmlspecialchars($row['nama']) . "' data-bs-toggle='modal' data-bs-target='#delete-modal'>Delete</button>";
                        echo "</td>";
                        echo "</tr>";
                        $no++;  
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="delete-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="delete-message">Apakah anda yakin ingin menghapus mahasiswa?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#" id="confirm-delete-btn" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const deleteMessage = document.getElementById('delete-message');
            const confirmDeleteBtn = document.getElementById('confirm-delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const nama = this.getAttribute('data-nama');
                    
                    deleteMessage.textContent = `Apakah anda yakin menghapus mahasiswa dengan nama ${nama}?`;
                    confirmDeleteBtn.href = `logic/logicdelete.php?id=${id}`;
                });
            });
        });
    </script>
</body>
</html>
<?php mysqli_close($conn); ?>
