<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $skala_sikap_id = $_POST['skala_sikap_id'];

    $result = mysqli_query($koneksi, "DELETE FROM skala_sikap WHERE skala_sikap_id=$skala_sikap_id");

    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}