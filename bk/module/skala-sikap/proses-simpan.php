<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $skala = $_POST['skala'];
    $poin_minimal = $_POST['poin_minimal'];
    $poin_maksimal = $_POST['poin_maksimal'];
    
    $result = mysqli_query($koneksi , "INSERT INTO skala_sikap (skala, poin_minimal, poin_maksimal) VALUES ('$skala', '$poin_minimal', '$poin_maksimal')");
    
    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}