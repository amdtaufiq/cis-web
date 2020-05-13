<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $kelas_id = $_POST['kelas_id'];
    $nama_wali_kelas = $_POST['nama_wali_kelas1'];
    $tingkat_kelas = $_POST['tingkat_kelas1'];
    $jurusan_id = $_POST['jurusan_id1'];
    $tipe_kelas = $_POST['tipe_kelas1'];
    $user_id = $_POST['user_id1'];

    
    $result =   mysqli_query ($koneksi, "UPDATE `kelas` 
    SET 
    `nama_wali_kelas`='$nama_wali_kelas',
    `tingkat_kelas`='$tingkat_kelas',
    `jurusan_id`='$jurusan_id',
    `tipe_kelas`='$tipe_kelas',
    `user_id`='$user_id' 
    WHERE kelas_id='$kelas_id'");
    
    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}