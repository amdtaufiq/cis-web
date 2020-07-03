<?php

include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

$tahap_id = isset ($_GET['tahap_id']) ? $_GET['tahap_id'] : false;
	
	if($tahap_id) {
		$query = mysqli_query($koneksi, "SELECT * FROM tahap_tindak WHERE tahap_id='$tahap_id'");
        $data = mysqli_fetch_assoc($query);

        echo json_encode($data); 
    }
        