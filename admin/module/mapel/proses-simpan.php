<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $kode_mapel = $_POST['kode_mapel'];
    $nama_mapel = $_POST['nama_mapel'];
    
    $result = mysqli_query($koneksi , "INSERT INTO mapel (kode_mapel, nama_mapel) VALUES ('$kode_mapel', '$nama_mapel')");
    
    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}