<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $nama_user = $_POST['nama_user'];
    $nip = $_POST['nip'];
    $mapel_id = $_POST['mapel_id'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];

    $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT nip FROM user WHERE nip='$nip'"));
    
    $result ="INSERT INTO `user`(`nama_user`, `nip`, `mapel_id`, `username`, `password`, `level`) 
    VALUES ('$nama_user', '$nip', '$mapel_id', '$username', '$password', '$level')";
    
    if($cek > 0){
        echo "sama";
    }else if(mysqli_query($koneksi, $result)){
        echo "sukses";
    }else{
        echo "gagal";
    }
