<?php 
    include 'koneksi.php';

    $kodePeminjaman = $_POST['kode_peminjaman'];
    $idBuku= $_POST['id_buku'];
    $namaPeminjam = $_POST['nama_peminjam'];
    $tglPinjam = $_POST['tgl_pinjam'];
    $tglKembali = $_POST['tgl_kembali'];

    // cek stok
    $cekStok = mysqli_query($koneksi, "SELECT stok FROM koleksi_buku WHERE id_buku='$idBuku'");
    $data = mysqli_fetch_assoc($cekStok);

    if (!$data) {
    header('Location: catat_peminjaman.php?error=buku_tidak_ditemukan');
    exit();
    }

    if ($data['stok'] <= 0) {
        header('Location: catat_peminjaman.php?error=stok_habis');
        exit();
    }

    $query = "INSERT INTO peminjaman (kode_peminjaman, peminjam, id_buku, tanggal_pinjam, tanggal_kembali) VALUES ('$kodePeminjaman', '$namaPeminjam', $idBuku, '$tglPinjam', '$tglKembali')";
    $result = mysqli_query($koneksi, $query);

    if($result){
        echo "Peminjaman Buku berhasil dicatat!";
        header('Location: peminjaman.php?peminjaman=sukses');
        exit();
    }
    else{
        echo "Peminjaman Buku gagal: " . mysqli_error($koneksi);
    }
?>