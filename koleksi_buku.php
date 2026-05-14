<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include 'koneksi.php';
    
    if (!isset($_SESSION['logged_in'])){
        header('location: login.php');
        exit();
    }
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

    <?php if(isset($_SESSION['login_success'])) { ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <?= $_SESSION['login_success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <?php unset($_SESSION['login_success']); ?>
    <?php } ?>

    <main class="ms-5 me-5">
        <h1 class="text-center mt-4 mb-4">Koleksi Buku</h1>
        <div class="d-flex justify-content-end mb-2" data-bs-target="#modalTambahKoleksi">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#tambahKoleksiBuku"><i class="bi bi-plus-lg"></i> Tambah Koleksi</button>
        </div>

        <!-- Modal Tambah Koleksi-->
        <div class="modal fade" id="tambahKoleksiBuku" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Koleksi Buku</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form action="proses_tambah_koleksi.php" method="POST">
                            <div class="mb-3 d-flex">
                                <div class="me-3">
                                    <label class="form-label">Kode Buku</label>
                                    <input type="text" class="form-control" name="kode_buku">
                                </div>
                                <div class="ms-2">
                                    <label class="form-label">Stok Buku</label>
                                    <input type="number" class="form-control" name="stok_buku">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Judul Buku</label>
                                <input type="text" class="form-control" name="judul">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pengarang</label>
                                <input type="text" class="form-control" name="pengarang">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="kategori" id="" class="form-select">
                                    <option value="">Pilih Kategori Buku</option>
                                    <option value="Fiksi">Fiksi</option>
                                    <option value="Sejarah">Sejarah</option>
                                    <option value="Teknologi">Teknologi</option>
                                    <option value="Sains">Sains</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table shadow p-3 mb-5 bg-body-tertiary rounded">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Kode Buku</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php 
                    $query = mysqli_query($koneksi, "SELECT * FROM koleksi_buku");
                    while ($data = mysqli_fetch_array($query)){ 
                ?>
                <tr>
                    <td><?= $data['id_buku'];?></td>
                    <td><?= $data['kode_buku'];?></td>
                    <td><?= $data['judul'];?></td>
                    <td><?= $data['pengarang'];?></td>
                    <td><?= $data['kategori'];?></td>
                    <td><?= $data['stok'];?></td>
                    <td><?= $data['status'];?></td>
                    <td>
                        <a href="edit_koleksi_buku.php?id_buku=<?= $data['id_buku']; ?>" class="btn btn-success">Edit</a>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#hapus<?= $data['id_buku']; ?>">Hapus</button>
                    </td>
                </tr>
                <!-- Konfirmasi Modal Hapus Koleksi -->
                <div class="modal fade" id="hapus<?= $data['id_buku']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus Koleksi Buku <b><?= $data['judul']; ?></b>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <a href="proses_hapus_koleksi_buku.php?id_buku=<?= $data['id_buku']; ?>" class="btn btn-danger" data-bs-target="#hapusKoleksiBukuSuccess">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </tbody>
        </table>

        <!-- Modal Tambah Koleksi Success -->
        <div class="modal fade" id="tambahKoleksiBukuSuccess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Berhasil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Buku berhasil ditambah!
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">OK</button></a>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal Hapus Koleksi Success -->
        <div class="modal fade" id="hapusKoleksiBukuSuccess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Berhasil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Buku berhasil dihapus!
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">OK</button></a>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Koleksi Success -->
        <div class="modal fade" id="editKoleksiBukuSuccess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Berhasil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Buku berhasil diedit!
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">OK</button></a>
                </div>
                </div>
            </div>
        </div>
    </main>

    <?php if (isset($_GET['tambah'])) { ?>
        <script>
            window.onload = function(){
                var myModal = new bootstrap.Modal(
                    document.getElementById('tambahKoleksiBukuSuccess')
                );
                myModal.show();
            }
        </script>
    <?php } ?>

    <?php if (isset($_GET['hapus'])) { ?>
        <script>
            window.onload = function(){
                var myModal = new bootstrap.Modal(
                    document.getElementById('hapusKoleksiBukuSuccess')
                );
                myModal.show();
            }
        </script>
    <?php } ?>

    <?php if (isset($_GET['edit'])) { ?>
        <script>
            window.onload = function(){
                var myModal = new bootstrap.Modal(
                    document.getElementById('editKoleksiBukuSuccess')
                );
                myModal.show();
            }
        </script>
    <?php } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>
</html>