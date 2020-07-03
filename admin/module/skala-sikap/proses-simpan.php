<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $skala = $_POST['skala'];
    $poin_minimal = $_POST['poin_minimal'];
    $poin_maksimal = $_POST['poin_maksimal'];
    
    $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `skala_sikap` WHERE poin_minimal BETWEEN $poin_minimal AND $poin_maksimal OR poin_maksimal BETWEEN $poin_minimal AND $poin_maksimal OR skala='$skala'"));
    
    $result ="INSERT INTO skala_sikap (skala, poin_minimal, poin_maksimal) VALUES ('$skala', '$poin_minimal', '$poin_maksimal')";
    
    if($cek > 0){
        echo "sama";
    }else if($poin_minimal >= $poin_maksimal){
        echo "kurang";
    }else if(mysqli_query($koneksi, $result)){
        echo "sukses";
    }else{
        echo "gagal";
    }
    