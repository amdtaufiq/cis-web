<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $kelas_id = (int)$_POST['kelas_id'];

    if(isset($kelas_id)){
        
        $query = mysqli_query($koneksi,"SELECT status_kelas FROM kelas WHERE kelas_id=$kelas_id");
        $row = mysqli_fetch_assoc($query);
        $status_kelas = $row['status_kelas'];
        if($status_kelas == 0){
            mysqli_query($koneksi,"UPDATE kelas SET status_kelas=1 WHERE kelas_id=$kelas_id");
            echo "SUKSES";
        }else{
            mysqli_query($koneksi,"UPDATE kelas SET status_kelas=0 WHERE kelas_id=$kelas_id");
            echo "SUKSES";
        }
    }
    
?>