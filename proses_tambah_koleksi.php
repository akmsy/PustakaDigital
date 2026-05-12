<?php 
    include 'koneksi.php';

    $kodeBuku = $_GET['kode_buku'];
    $judulBuku = $_GET['judul'];
    $pengarangBuku = $_GET['pengarang'];
    $kategoriBuku = $_GET['kategori'];
    $stokBuku = $_GET['stok_buku'];

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