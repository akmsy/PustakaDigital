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

    <main>
        <div class="container-fluid vh-100 d-flex justify-content-center align-items-center" style="width: 800px;">
            <form action="proses_catat_peminjaman.php" class="shadow p-4 bg-body-tertiary rounded">
                <h1 class="text-center">Form Data Peminjaman</h1>
                <div class="mb-3">
                    <label class="form-label">Kode Peminjaman</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Peminjam</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Pilih Buku</label>
                    <select name="kategori" id="" class="form-select">
                        <option value="">Pilih Buku Tersedia</option>
                        <option value=""></option>
                    </select>
                </div>
                <div class="mb-3 d-flex">
                    <div class="me-3">
                        <label class="form-label">Tanggal Pinjam</label>
                        <input type="date" class="form-control" style="width: 365px;">
                    </div>
                    <div class="ms-2">
                        <label class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control" style="width: 365px;">
                    </div>
                </div>
            
                <div class="d-flex justify-content-center align-items-center">
                    <a href="koleksi_buku.php"><button type="button" class="btn btn-secondary me-2">Kembali</button></a>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</html>