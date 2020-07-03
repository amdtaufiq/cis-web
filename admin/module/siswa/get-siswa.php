<?php

include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

$siswa_id = isset ($_GET['siswa_id']) ? $_GET['siswa_id'] : false;
	
if($siswa_id) {
    $querySiswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE siswa_id='$siswa_id'");
    $data = mysqli_fetch_assoc($querySiswa);

    echo json_encode($data); 
}
        