<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $pelanggaran_id = $_POST['pelanggaran_id'];

    $result = mysqli_query($koneksi, "DELETE FROM pelanggaran WHERE pelanggaran_id=$pelanggaran_id");

    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}