<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $skala_sikap_id = (int)$_POST['skala_sikap_id'];

    if(isset($skala_sikap_id)){
        
        $query = mysqli_query($koneksi,"SELECT status_skala FROM skala_sikap WHERE skala_sikap_id=$skala_sikap_id");
        $row = mysqli_fetch_assoc($query);
        $status_skala = $row['status_skala'];
        if($status_skala == 0){
            mysqli_query($koneksi,"UPDATE skala_sikap SET status_skala=1 WHERE skala_sikap_id=$skala_sikap_id");
            echo "SUKSES";
        }else{
            mysqli_query($koneksi,"UPDATE skala_sikap SET status_skala=0 WHERE skala_sikap_id=$skala_sikap_id");
            echo "SUKSES";
        }
    }
    
?>