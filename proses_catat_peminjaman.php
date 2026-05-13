<?php 
    include 'koneksi.php';

    $kodePeminjaman = $_GET['kode_peminjaman'];
    $namaPeminjam = $_GET['nama_peminjam'];
    $judulBuku= $_GET['judul_buku'];
    $tglPinjam = $_GET['tgl_pinjam'];
    $tglKembali = $_GET['tgl_kembali'];

    $query = "INSERT INTO peminjaman (kode_peminjaman, peminjam, judul, tanggal_pinjam, tanggal_kembali) VALUES ('$kodePeminjaman', '$namaPeminjam', '$judulBuku', '$tglPinjam', '$tglKembali')";
    $result = mysqli_query($koneksi, $query);

    if($result){
        echo "Peminjaman Buku berhasil dicatat!";
        header('location: peminjaman.php?peminjaman=sukses');
        exit();
    }
    else{
        echo "Peminjaman Buku gagal: " . mysqli_error($koneksi);
    }
?>