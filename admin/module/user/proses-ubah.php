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
    
    $kode ='';
    
    $user = mysqli_query($koneksi, "SELECT * FROM user WHERE `user_id`='$user_id'");
    while ($row=mysqli_fetch_array($user)){
        $kode = $row['nip'];
    }
    
    if($kode==$nip){
        $result = mysqli_query($koneksi , "UPDATE user SET `nama_user`='$nama_user', `mapel_id`='$mapel_id', `username`='$username', `password`='$password', `level`='$level' WHERE `user_id`='$user_id'");
    
        if($result){
            echo "sukses";
    	} else {
    	    echo "gagal";
    	}
    
    }else{
        $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT nip FROM user WHERE `nip`='$nip'"));
    
        $result ="UPDATE user SET `nama_user`='$nama_user', `nip`='$nip', `mapel_id`='$mapel_id', `username`='$username', `password`='$password', `level`='$level' WHERE `user_id`='$user_id'";
        
        if($cek > 0){
            echo "sama";
        }else if(mysqli_query($koneksi, $result)){
            echo "sukses";
        }else{
            echo "gagal";
        }
    }
    