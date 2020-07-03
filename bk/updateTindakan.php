<?php

    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $siswa_id = (int)$_POST['siswa_id'];

    if(isset($siswa_id)){
        
        $query = mysqli_query($koneksi,"SELECT tindakan FROM siswa WHERE siswa_id=$siswa_id");
        $row = mysqli_fetch_assoc($query);
        $status = $row['tindakan'];
        if($status == 0){
            mysqli_query($koneksi,"UPDATE siswa SET tindakan=1 WHERE siswa_id=$siswa_id");
            echo "SUKSES";
        }else{
            mysqli_query($koneksi,"UPDATE siswa SET tindakan=0 WHERE siswa_id=$siswa_id");
            echo "SUKSES";
        }
    }
    
?>