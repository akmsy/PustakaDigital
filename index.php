<?php 
    session_start();
    include 'koneksi.php';
    
    if (!isset($_SESSION['logged_in'])){
        header('location: login.php');
        exit();
    } else {
        include 'koleksi_buku.php';
    }
?>