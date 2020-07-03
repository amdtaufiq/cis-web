<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $pelanggaran_id = $_POST['pelanggaran_id'];
    $nama_pelanggaran = $_POST['nama_pelanggaran1'];
    $poin_pelanggaran = $_POST['poin_pelanggaran1'];
    
    $result = mysqli_query($koneksi , "UPDATE pelanggaran SET nama_pelanggaran='$nama_pelanggaran', poin_pelanggaran='$poin_pelanggaran' WHERE pelanggaran_id='$pelanggaran_id'");
    
    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}