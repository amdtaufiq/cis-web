<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $tahap_id = (int)$_POST['tahap_id'];

    if(isset($tahap_id)){
        
        $query = mysqli_query($koneksi,"SELECT status_tahap FROM tahap_tindak WHERE tahap_id=$tahap_id");
        $row = mysqli_fetch_assoc($query);
        $status_tahap = $row['status_tahap'];
        if($status_tahap == 0){
            mysqli_query($koneksi,"UPDATE tahap_tindak SET status_tahap=1 WHERE tahap_id=$tahap_id");
            echo "SUKSES";
        }else{
            mysqli_query($koneksi,"UPDATE tahap_tindak SET status_tahap=0 WHERE tahap_id=$tahap_id");
            echo "SUKSES";
        }
    }
    
?>