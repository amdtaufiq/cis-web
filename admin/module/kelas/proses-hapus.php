<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $kelas_id = $_POST['kelas_id'];

    $result = mysqli_query($koneksi, "DELETE FROM kelas WHERE kelas_id=$kelas_id");

    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}