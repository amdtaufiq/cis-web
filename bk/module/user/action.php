<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    $page = isset($_GET['page']) ? $_GET['page'] : false;

    $nama_user = $_POST['nama_user'];
    $nip = $_POST['nip'];
    $nomor_telpon = $_POST['nomor_telpon'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];
	$button = $_POST['button'];


if($button == "TAMBAH"){

    mysqli_query($koneksi , "INSERT INTO `user`(`nama_user`, `nip`, `nomor_telpon`, `username`, `password`, `level`) 
    VALUES ('$nama_user', '$nip', '$nomor_telpon', '$username', '$password', '$level')");
    
}else if($button == "PERBAHARUI"){

    $user_id = $_GET['user_id'];
    
    mysqli_query ($koneksi, "UPDATE user 
    SET `nama_user`='$nama_user', `nip`='$nip', `nomor_telpon`='$nomor_telpon', `username`='$username', `password`='$password', `level`='$level'
    WHERE `user_id`='$user_id'");

}

header("location: ".BASE_URL."index.php?page=user-list");
	