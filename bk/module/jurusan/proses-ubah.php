<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $jurusan_id = $_POST['jurusan_id'];
    $kode_jurusan = $_POST['kode_jurusan1'];
    $nama_jurusan = $_POST['nama_jurusan1'];
    
    $result = mysqli_query($koneksi , "UPDATE jurusan SET kode_jurusan='$kode_jurusan', nama_jurusan='$nama_jurusan' WHERE jurusan_id='$jurusan_id'");
    
    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}