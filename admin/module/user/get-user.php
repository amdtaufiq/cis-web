<?php

include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

$user_id = isset ($_GET['user_id']) ? $_GET['user_id'] : false;
	
	if($user_id) {
		$queryUser = mysqli_query($koneksi, "SELECT * FROM user WHERE `user_id`='$user_id'");
        $data = mysqli_fetch_assoc($queryUser);

        echo json_encode($data); 
    }
        