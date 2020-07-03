<?php

include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

$jurusan_id = isset ($_GET['jurusan_id']) ? $_GET['jurusan_id'] : false;
	
	if($jurusan_id) {
		$queryjurusan = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE jurusan_id='$jurusan_id'");
        $data = mysqli_fetch_assoc($queryjurusan);

        echo json_encode($data); 
    }
        