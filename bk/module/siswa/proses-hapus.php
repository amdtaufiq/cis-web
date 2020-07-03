<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $siswa_id = $_POST['siswa_id'];

    $result = mysqli_query($koneksi, "DELETE FROM siswa WHERE siswa_id=$siswa_id");

    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}