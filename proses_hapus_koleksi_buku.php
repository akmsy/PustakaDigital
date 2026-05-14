<?php 
    include 'koneksi.php';

    $idBuku = $_GET['id_buku'];
    // var_dump($idBuku);

    $query = "DELETE FROM koleksi_buku WHERE id_buku=$idBuku";
    $result = mysqli_query($koneksi, $query);

    if($result){
        echo "Koleksi buku berhasil ditambahkan!";
        header('Location: koleksi_buku.php?hapus=sukses');
        exit();
    }
    else{
        echo "Tambah koleksi gagal: " . mysqli_error($koneksi);
    }
?>