<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $kode_jurusan = $_POST['kode_jurusan'];
    $nama_jurusan = $_POST['nama_jurusan'];
    
    $result = mysqli_query($koneksi , "INSERT INTO jurusan (kode_jurusan, nama_jurusan) VALUES ('$kode_jurusan', '$nama_jurusan')");
    
    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}