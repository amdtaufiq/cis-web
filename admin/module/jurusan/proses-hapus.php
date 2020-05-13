<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $jurusan_id = $_POST['jurusan_id'];

    $result = mysqli_query($koneksi, "DELETE FROM jurusan WHERE jurusan_id=$jurusan_id");

    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}