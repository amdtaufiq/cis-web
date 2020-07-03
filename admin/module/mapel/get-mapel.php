<?php

include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

$mapel_id = isset ($_GET['mapel_id']) ? $_GET['mapel_id'] : false;
	
	if($mapel_id) {
		$querymapel = mysqli_query($koneksi, "SELECT * FROM mapel WHERE mapel_id='$mapel_id'");
        $data = mysqli_fetch_assoc($querymapel);

        echo json_encode($data); 
    }
        