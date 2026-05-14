<?php 
    session_start();
    include 'koneksi.php';

    $username = $_POST['username'];
    $password= $_POST['password'];

    if ($username == NULL || $password == NULL) {
        $_SESSION['login_null'] = "Username dan password tidak boleh kosong!";
        header('Location: login.php');
    } else {
        $query = "SELECT * FROM  users WHERE username='$username' AND password='$password'"; 
        $result = mysqli_query($koneksi, $query);

        if (mysqli_num_rows($result) > 0){
            $user= mysqli_fetch_assoc($result);
            $_SESSION['username'] = $user['username'];
            $_SESSION['logged_in'] = true;
            header('Location: index.php');
        } else {
            $_SESSION['login_error'] = "Username atau password salah! Silakan coba lagi.";
            header('Location: login.php');
        }
    }
?>