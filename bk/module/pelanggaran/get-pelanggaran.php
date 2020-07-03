<?php

include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

$pelanggaran_id = isset ($_GET['pelanggaran_id']) ? $_GET['pelanggaran_id'] : false;
	
	if($pelanggaran_id) {
		$querypelanggaran = mysqli_query($koneksi, "SELECT * FROM pelanggaran WHERE pelanggaran_id='$pelanggaran_id'");
        $data = mysqli_fetch_assoc($querypelanggaran);

        echo json_encode($data); 
    }
        