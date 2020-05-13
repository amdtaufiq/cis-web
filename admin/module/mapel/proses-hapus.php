<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $mapel_id = $_POST['mapel_id'];

    $result = mysqli_query($koneksi, "DELETE FROM mapel WHERE mapel_id=$mapel_id");

    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}