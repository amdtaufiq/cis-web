<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $tahap_id = $_POST['tahap_id'];
    $tahap = $_POST['tahap1'];
    $keterangan = $_POST['keterangan1'];
    $poin_awal = $_POST['poin_awal1'];
    $poin_akhir = $_POST['poin_akhir1'];
    
    $result = mysqli_query($koneksi , "UPDATE tahap_tindak SET tahap='$tahap', keterangan='$keterangan', poin_awal='$poin_awal', poin_akhir='$poin_akhir' WHERE tahap_id='$tahap_id'");
    
    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}