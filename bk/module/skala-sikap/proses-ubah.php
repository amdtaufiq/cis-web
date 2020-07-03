<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $skala_sikap_id = $_POST['skala_sikap_id'];
    $skala = $_POST['skala1'];
    $poin_minimal = $_POST['poin_minimal1'];
    $poin_maksimal = $_POST['poin_maksimal1'];
    
    $result = mysqli_query($koneksi , "UPDATE skala_sikap SET skala='$skala', poin_minimal='$poin_minimal', poin_maksimal='$poin_maksimal' WHERE skala_sikap_id='$skala_sikap_id'");
    
    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}