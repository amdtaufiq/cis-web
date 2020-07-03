<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    $result = mysqli_query ($koneksi, "UPDATE `siswa` 
    SET 
    `poin_pelanggaran_siswa`=0");
    
    $result2 = mysqli_query ($koneksi, "DELETE FROM catatan_poin_pelanggaran");
    
    if($result && $result2){
        echo "sukses";
	} else {
	    echo "gagal";
	}