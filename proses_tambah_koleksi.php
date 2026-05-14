<?php 
    include 'koneksi.php';

    $kodeBuku = $_POST['kode_buku'];
    $judulBuku = $_POST['judul'];
    $pengarangBuku = $_POST['pengarang'];
    $kategoriBuku = $_POST['kategori'];
    $stokBuku = $_POST['stok_buku'];

    $query = "INSERT INTO koleksi_buku (kode_buku, judul, pengarang, kategori, stok) VALUES ('$kodeBuku', '$judulBuku', '$pengarangBuku', '$kategoriBuku', $stokBuku)";
    $result = mysqli_query($koneksi, $query);

    if($result){
        echo "Koleksi buku berhasil ditambahkan!";
        header('location: index.php');
        exit();
    }
    else{
        echo "Tambah koleksi gagal: " . mysqli_error($koneksi);
    }
?>