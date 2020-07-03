<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $jurusan_id = $_POST['jurusan_id'];
    $kode_jurusan = $_POST['kode_jurusan1'];
    $nama_jurusan = $_POST['nama_jurusan1'];
    
    $kode ='';
    
    $jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE jurusan_id='$jurusan_id'");
    while ($row=mysqli_fetch_array($jurusan)){
        $kode = $row['kode_jurusan'];
    }
    
    if($kode==$kode_jurusan){
        $result = mysqli_query($koneksi , "UPDATE jurusan SET nama_jurusan='$nama_jurusan' WHERE jurusan_id='$jurusan_id'");
    
        if($result){
            echo "sukses";
    	} else {
    	    echo "gagal";
    	}
    
    }else{
        $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jurusan WHERE kode_jurusan='$kode_jurusan'"));
    
        $result ="UPDATE jurusan SET kode_jurusan='$kode_jurusan', nama_jurusan='$nama_jurusan' WHERE jurusan_id='$jurusan_id'";
        
        if($cek > 0){
            echo "sama";
        }else if(mysqli_query($koneksi, $result)){
            echo "sukses";
        }else{
            echo "gagal";
        }
    }
    
   