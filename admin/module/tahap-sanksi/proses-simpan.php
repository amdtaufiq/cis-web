<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $tahap = $_POST['tahap'];
    $keterangan = $_POST['keterangan'];
    $poin_awal = $_POST['poin_awal'];
    $poin_akhir = $_POST['poin_akhir'];
    $warna = $_POST['warna'];
    
    $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `tahap_tindak` WHERE poin_awal BETWEEN $poin_awal AND $poin_akhir OR poin_akhir BETWEEN $poin_awal AND $poin_akhir OR tahap='$tahap'"));
    
    $result ="INSERT INTO tahap_tindak (tahap, keterangan, poin_awal, poin_akhir, warna) VALUES ('$tahap','$keterangan', '$poin_awal', '$poin_akhir', '$warna')";
    
    if($cek > 0){
        echo "sama";
    }else if($poin_awal >= $poin_akhir){
        echo "kurang";
    }else if(mysqli_query($koneksi, $result)){
        echo "sukses";
    }else{
        echo "gagal";
    }
    