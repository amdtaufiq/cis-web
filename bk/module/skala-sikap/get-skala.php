<?php

include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

$skala_sikap_id = isset ($_GET['skala_sikap_id']) ? $_GET['skala_sikap_id'] : false;
	
	if($skala_sikap_id) {
		$query = mysqli_query($koneksi, "SELECT * FROM skala_sikap WHERE skala_sikap_id='$skala_sikap_id'");
        $data = mysqli_fetch_assoc($query);

        echo json_encode($data); 
    }
        