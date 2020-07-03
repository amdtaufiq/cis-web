<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $tahap = $_POST['tahap'];
    $keterangan = $_POST['keterangan'];
    $poin_awal = $_POST['poin_awal'];
    $poin_akhir = $_POST['poin_akhir'];
    
    $result = mysqli_query($koneksi , "INSERT INTO tahap_tindak (tahap, keterangan, poin_awal, poin_akhir) VALUES ('$tahap','$keterangan', '$poin_awal', '$poin_akhir')");
    
    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}