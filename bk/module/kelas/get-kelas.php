<?php

include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

$kelas_id = isset ($_GET['kelas_id']) ? $_GET['kelas_id'] : false;
	
if($kelas_id) {
    $querykelas = mysqli_query($koneksi, "SELECT * FROM kelas WHERE kelas_id='$kelas_id'");
    $data = mysqli_fetch_assoc($querykelas);

    echo json_encode($data); 
}
        