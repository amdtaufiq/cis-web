<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $kode_mapel = $_POST['kode_mapel'];
    $nama_mapel = $_POST['nama_mapel'];
    
    $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT kode_mapel FROM mapel WHERE kode_mapel='$kode_mapel'"));
    
    $result ="INSERT INTO mapel (kode_mapel, nama_mapel) VALUES ('$kode_mapel', '$nama_mapel')";
    
    if($cek > 0){
        echo "sama";
    }else if(mysqli_query($koneksi, $result)){
        echo "sukses";
    }else{
        echo "gagal";
    }
    