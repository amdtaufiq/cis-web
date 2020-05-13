<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $tahap = $_POST['tahap'];
    $keterangan = $_POST['keterangan'];
    $poin_awal = $_POST['poin_awal'];
    $poin_akhir = $_POST['poin_akhir'];
    $warna = $_POST['warna'];
    
    $result = mysqli_query($koneksi , "INSERT INTO tahap_tindak (tahap, keterangan, poin_awal, poin_akhir, warna) VALUES ('$tahap','$keterangan', '$poin_awal', '$poin_akhir', '$warna')");
    
    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}