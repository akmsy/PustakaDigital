<?php 
    include 'koneksi.php';
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
                        <a class="nav-link" href="koleksi_buku.php">Koleksi Buku</a>
                        <a class="nav-link active" aria-current="page" href="peminjaman.php">Peminjaman</a>
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

    <main class="ms-5 me-5">
        <h1 class="text-center mt-4 mb-4">Database Peminjaman</h1>
        <div class="d-flex justify-content-end mb-2" data-bs-target="#modalTambahKoleksi">
            <a href="catat_peminjaman.php" type="button" class="btn btn-secondary"><i class="bi bi-file-earmark-plus"></i> Catat Peminjaman</a>
        </div>
        
        <table class="table shadow p-3 mb-5 bg-body-tertiary rounded">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Kode Peminjaman</th>
                    <th>Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php 
                    $query = mysqli_query($koneksi, "SELECT p.*, kb.judul AS judul, 
                                        CASE
                                        WHEN p.status = 'Dikembalikan' THEN 'Dikembalikan'
                                        WHEN CURDATE() > p.tanggal_kembali THEN 'Terlambat'
                                        ELSE 'Dipinjam'
                                        END AS status_peminjaman 
                                        FROM peminjaman p JOIN koleksi_buku kb ON p.id_buku = kb.id_buku");
                    $no = 1;
                    while ($data = mysqli_fetch_array($query)){ 
                ?>
                <tr>
                    <!-- <td> <?= $data['id_peminjaman']; ?></td> -->
                    <td><?= $no++; ?></td>
                    <td><?= $data['kode_peminjaman']; ?></td>
                    <td><?= $data['peminjam']; ?></td>
                    <td><?= $data['judul']; ?></td>
                    <td><?= $data['tanggal_pinjam']; ?></td>
                    <td><?= $data['tanggal_kembali']; ?></td>
                    <td><?= $data['status_peminjaman']; ?></td>
                    <td>
                        <?php if (in_array($data['status_peminjaman'], ['Dipinjam', 'Terlambat'])) { ?>
                            <!-- <a href="kembalikan.php?id_peminjaman=<?= $data['id_peminjaman']; ?>" class="btn btn-info btn-sm">Kembalikan</a> -->
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#kembalikan<?= $data['id_peminjaman'];?>">Kembalikan</button>
                        <?php } elseif ($data['status_peminjaman'] == 'Dikembalikan') { ?>
                            <button class="btn btn-success btn-sm" disabled>Selesai</button>
                        <?php } ?>
                    </td>
                </tr>
                <!-- Konfirmasi Kembalikan Peminjaman Buku -->
                <div class="modal fade" id="kembalikan<?= $data['id_peminjaman']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Pengembalian</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Yakin ingin memproses pengembalian buku <b><?= $data['judul']; ?></b> (<?= $data['kode_peminjaman']; ?>)?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <a href="kembalikan.php?id_peminjaman=<?= $data['id_peminjaman']; ?>" class="btn btn-danger">Kembalikan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </tbody>
        </table>

        <!-- Modal Catat Peminjaman Success -->
        <div class="modal fade" id="catatPeminjamanSuccess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Catat Peminjaman Berhasil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Peminjaman berhasil dicatat!
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">OK</button></a>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal Kembalikan Peminjaman Success -->
        <div class="modal fade" id="KembalikanPeminjamanSuccess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pengembalian Berhasil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Buku berhasil dikembalikan!
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">OK</button></a>
                </div>
                </div>
            </div>
        </div>
    </main>

    <?php if (isset($_GET['peminjaman'])) { ?>
        <script>
            window.onload = function(){
                var myModal = new bootstrap.Modal(
                    document.getElementById('catatPeminjamanSuccess')
                );
                myModal.show();
            }
        </script>
    <?php } ?>

    <?php if (isset($_GET['kembali'])) { ?>
        <script>
            window.onload = function(){
                var myModal = new bootstrap.Modal(
                    document.getElementById('KembalikanPeminjamanSuccess')
                );
                myModal.show();
            }
        </script>
    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>
</html>