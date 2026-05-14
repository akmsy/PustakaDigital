<?php 
    include 'koneksi.php';

    $idBuku = $_POST['id_buku'];
    $kodeBuku = $_POST['kode_buku'];
    $judulBuku = $_POST['judul'];
    $pengarangBuku = $_POST['pengarang'];
    $kategoriBuku = $_POST['kategori'];
    $stokBuku = $_POST['stok_buku'];

    var_dump($idBuku);

    $query = "UPDATE koleksi_buku SET kode_buku='$kodeBuku', judul='$judulBuku', pengarang='$pengarangBuku', kategori='$kategoriBuku', stok=$stokBuku WHERE id_buku=$idBuku";
    $result = mysqli_query($koneksi, $query);

    if($result){
        echo "Koleksi buku berhasil diedit!";
        header('Location: koleksi_buku.php?edit=sukses');
        exit();
    }
    else{
        echo "Tambah koleksi gagal: " . mysqli_error($koneksi);
    }
?>