<?php

    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $akses = 'Admin';

    $query = mysqli_query($koneksi, "SELECT * FROM user 
    WHERE `username`='$username' AND `password`='$password' AND `level`='$akses'");

    if(mysqli_num_rows($query) == 0){
        header("location:". BASE_URL."login.php");
    }else {
        $row = mysqli_fetch_assoc($query);
        $user_id =  $row['user_id'];
        $level = $row['level'];
        session_start();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['level'] = $level;
        header("location:". BASE_URL."index.php");
    }
