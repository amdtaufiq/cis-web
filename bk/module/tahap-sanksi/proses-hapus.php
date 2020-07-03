<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $tahap_id = $_POST['tahap_id'];

    $result = mysqli_query($koneksi, "DELETE FROM tahap_tindak WHERE tahap_id=$tahap_id");

    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}