<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $jurusan_id = (int)$_POST['jurusan_id'];

    if(isset($jurusan_id)){
        
        $query = mysqli_query($koneksi,"SELECT status_jurusan FROM jurusan WHERE jurusan_id=$jurusan_id");
        $row = mysqli_fetch_assoc($query);
        $status_jurusan = $row['status_jurusan'];
        if($status_jurusan == 0){
            mysqli_query($koneksi,"UPDATE jurusan SET status_jurusan=1 WHERE jurusan_id=$jurusan_id");
            echo "SUKSES";
        }else{
            mysqli_query($koneksi,"UPDATE jurusan SET status_jurusan=0 WHERE jurusan_id=$jurusan_id");
            echo "SUKSES";
        }
    }
    
?>