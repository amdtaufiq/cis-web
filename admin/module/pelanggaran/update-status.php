<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $pelanggaran_id = (int)$_POST['pelanggaran_id'];

    if(isset($pelanggaran_id)){
        
        $query = mysqli_query($koneksi,"SELECT status_pelanggaran FROM pelanggaran WHERE pelanggaran_id=$pelanggaran_id");
        $row = mysqli_fetch_assoc($query);
        $status_pelanggaran = $row['status_pelanggaran'];
        if($status_pelanggaran == 0){
            mysqli_query($koneksi,"UPDATE pelanggaran SET status_pelanggaran=1 WHERE pelanggaran_id=$pelanggaran_id");
            echo "SUKSES";
        }else{
            mysqli_query($koneksi,"UPDATE pelanggaran SET status_pelanggaran=0 WHERE pelanggaran_id=$pelanggaran_id");
            echo "SUKSES";
        }
    }
    
?>