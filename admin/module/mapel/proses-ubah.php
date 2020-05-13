<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $mapel_id = $_POST['mapel_id'];
    $kode_mapel = $_POST['kode_mapel1'];
    $nama_mapel = $_POST['nama_mapel1'];
    
    $result = mysqli_query($koneksi , "UPDATE mapel SET kode_mapel='$kode_mapel', nama_mapel='$nama_mapel' WHERE mapel_id='$mapel_id'");
    
    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}