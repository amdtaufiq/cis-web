<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $kode_jurusan = $_POST['kode_jurusan'];
    $nama_jurusan = $_POST['nama_jurusan'];
    
    $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT kode_jurusan FROM jurusan WHERE kode_jurusan='$kode_jurusan'"));
    
    $result ="INSERT INTO jurusan (kode_jurusan, nama_jurusan) VALUES ('$kode_jurusan', '$nama_jurusan')";
    
    if($cek > 0){
        echo "sama";
    }else if(mysqli_query($koneksi, $result)){
        echo "sukses";
    }else{
        echo "gagal";
    }
    