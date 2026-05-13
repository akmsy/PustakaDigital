<?php
include 'koneksi.php';

if(isset($_GET['id_peminjaman'])){

    $idPeminjaman = $_GET['id_peminjaman'];

    $query = mysqli_query($koneksi, "UPDATE peminjaman SET status='Dikembalikan' WHERE id_peminjaman='$idPeminjaman'");

    if($query){
        header("Location: peminjaman.php?kembali=sukses");
        exit();
    } else {
        echo "Gagal mengembalikan buku";
    }

} else {
    echo "ID tidak ditemukan";
}
?>