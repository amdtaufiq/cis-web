<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $mapel_id = (int)$_POST['mapel_id'];

    if(isset($mapel_id)){
        
        $query = mysqli_query($koneksi,"SELECT status FROM mapel WHERE mapel_id=$mapel_id");
        $row = mysqli_fetch_assoc($query);
        $status = $row['status'];
        if($status == 0){
            mysqli_query($koneksi,"UPDATE mapel SET status=1 WHERE mapel_id=$mapel_id");
            echo "SUKSES";
        }else{
            mysqli_query($koneksi,"UPDATE mapel SET status=0 WHERE mapel_id=$mapel_id");
            echo "SUKSES";
        }
    }
    
?>