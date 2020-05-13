<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $user_id = $_POST['user_id'];
    $nama_user = $_POST['nama_user1'];
    $nip = $_POST['nip1'];
    $mapel_id = $_POST['mapel_id1'];
    $username = $_POST['username1'];
    $password = md5($_POST['password1']);
    $level = $_POST['level1'];
    
    $result = mysqli_query ($koneksi, "UPDATE user 
    SET `nama_user`='$nama_user', `nip`='$nip', `mapel_id`='$mapel_id', `username`='$username', `password`='$password', `level`='$level'
    WHERE `user_id`='$user_id'");
    
    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}