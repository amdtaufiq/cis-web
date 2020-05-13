<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $nama_wali_kelas = $_POST['nama_wali_kelas'];
    $tingkat_kelas = $_POST['tingkat_kelas'];
    $jurusan_id = $_POST['jurusan_id'];
    $tipe_kelas = $_POST['tipe_kelas'];
    $user_id = $_POST['user_id'];
    
    $result = mysqli_query($koneksi , "INSERT INTO `kelas`(`nama_wali_kelas`, `tingkat_kelas`, `jurusan_id`, `tipe_kelas`,`user_id`) 
    VALUES ('$nama_wali_kelas', '$tingkat_kelas', '$jurusan_id', '$tipe_kelas', '$user_id')");
    
    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}