<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $mapel_id = $_POST['mapel_id'];
    $kode_mapel = $_POST['kode_mapel1'];
    $nama_mapel = $_POST['nama_mapel1'];
    
    $kode ='';
    
    $mapel = mysqli_query($koneksi, "SELECT * FROM mapel WHERE mapel_id='$mapel_id'");
    while ($row=mysqli_fetch_array($mapel)){
        $kode = $row['kode_mapel'];
    }
    
    if($kode==$kode_mapel){
        $result = mysqli_query($koneksi , "UPDATE mapel SET nama_mapel='$nama_mapel' WHERE mapel_id='$mapel_id'");
    
        if($result){
            echo "sukses";
    	} else {
    	    echo "gagal";
    	}
    
    }else{
        $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT kode_mapel FROM mapel WHERE kode_mapel='$kode_mapel'"));
    
        $result ="UPDATE mapel SET kode_mapel='$kode_mapel', nama_mapel='$nama_mapel' WHERE mapel_id='$mapel_id'";
        
        if($cek > 0){
            echo "sama";
        }else if(mysqli_query($koneksi, $result)){
            echo "sukses";
        }else{
            echo "gagal";
        }
    }
    