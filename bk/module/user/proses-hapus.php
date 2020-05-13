<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $user_id = $_POST['user_id'];

    $result = mysqli_query($koneksi, "DELETE FROM user WHERE user_id=$user_id");

    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}