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
                    <button type="button" class="btn btn-light"><i class="bi bi-box-arrow-right"></i> Keluar</button>
                </div>
            </div>
        </nav>
    </header>

    <main class="ms-5 me-5">
        <h1 class="text-center mt-4 mb-4">Database Peminjaman</h1>
        <div class="d-flex justify-content-end mb-2" data-bs-target="#modalTambahKoleksi">
            <a href="catat_peminjaman.php"><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#tambahKoleksiBuku"><i class="bi bi-file-earmark-plus"></i> Catat Peminjaman</button></a>
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
            <tbody class="table-secondary">
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#aksiDikembalikan">Kembalikan</button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#aksiSelesai">Selesai</button>
                    </td>
                </tr>
            </tbody>
        </table>

    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</html>