<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $nama_pelanggaran = $_POST['nama_pelanggaran'];
    $poin_pelanggaran = $_POST['poin_pelanggaran'];
    
    $result = mysqli_query($koneksi , "INSERT INTO pelanggaran (nama_pelanggaran, poin_pelanggaran) VALUES ('$nama_pelanggaran', '$poin_pelanggaran')");
    
    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}