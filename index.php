<?php 
    session_start();
    include 'koneksi.php';

    if (!isset($_SESSION['logged_in'])){
        header('location: login.php');
        exit();
    } else {
        $_SESSION['login_success'] = "Login Berhasil!";
        header("Location: koleksi_buku.php");
        exit;
    }
?>