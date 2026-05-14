<?php 
    include 'koneksi.php';
    $idBuku = $_GET['id_buku'];
    // var_dump($idBuku);
    $query = mysqli_query($koneksi, "SELECT * FROM koleksi_buku WHERE id_buku=$idBuku");
    $data = mysqli_fetch_array($query);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Pustaka Digital</title>
</head>
<body style="background-color: #d9e2f9;">
<!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Pustaka Digital</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="koleksi_buku.php">Koleksi Buku</a>
                        <a class="nav-link" href="peminjaman.php">Peminjaman</a>
                    </div>
                </div>
                <div class="justify-content-md-end">
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="bi bi-box-arrow-right"></i> Keluar</button>
                    <!-- Modal Logout -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Logout</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin logout?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                    <a href="logout.php" class="btn btn-danger">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container-fluid vh-100 d-flex justify-content-center align-items-center" style="width: 800px;">
            <form action="proses_edit_koleksi_buku.php" method="POST" class="shadow p-4 bg-body-tertiary rounded">
                <h1 class="text-center">Form Edit Buku</h1>
                <div class="mb-3">
                    <label class="form-label">ID Buku</label>
                    <input type="text" class="form-control" readonly value="<?= $data['id_buku']; ?>" name="id_buku">
                </div>
                <div class="mb-3 d-flex">
                    <div class="me-3">
                        <label class="form-label">Kode Buku</label>
                        <input type="text" class="form-control" style="width: 365px;" value="<?= $data['kode_buku']; ?>" name="kode_buku">
                    </div>
                    <div class="ms-2">
                        <label class="form-label">Jumlah Stok</label>
                        <input type="number" class="form-control" style="width: 365px;" value="<?= $data['stok']; ?>" name="stok_buku">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" value="<?= $data['judul'];?>" name="judul">
                </div>
                <div class="mb-3">
                    <label class="form-label">Pengarang</label>
                    <input type="text" class="form-control" value="<?= $data['pengarang']; ?>" name="pengarang">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" id="" class="form-select">
                        <option value="<?= $data['kategori']; ?>"><?= $data['kategori']; ?></option>
                        <option value="Fiksi">Fiksi</option>
                        <option value="Sejarah">Sejarah</option>
                        <option value="Teknologi">Teknologi</option>
                        <option value="Sains">Sains</option>
                    </select>
                </div>
            
                <div class="d-flex justify-content-center align-items-center">
                    <a href="koleksi_buku.php" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</html>