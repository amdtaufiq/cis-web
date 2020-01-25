<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    $page = isset($_GET['page']) ? $_GET['page'] : false;
    
	$kode_jurusan = $_POST['kode_jurusan'];
	$nama_jurusan = $_POST['nama_jurusan'];
	$button = $_POST['button'];

// echo $kode_jurusan;
// echo $nama_jurusan;
// echo $button;

if($button == "TAMBAH"){

    mysqli_query($koneksi , "INSERT INTO jurusan (kode_jurusan, nama_jurusan) VALUES ('$kode_jurusan', '$nama_jurusan')");
    
}else if($button == "PERBAHARUI"){

    $jurusan_id = $_GET['jurusan_id'];
    
    mysqli_query ($koneksi, "UPDATE jurusan SET kode_jurusan='$kode_jurusan', nama_jurusan='$nama_jurusan' WHERE jurusan_id='$jurusan_id'");

}

header("location: ".BASE_URL."index.php?page=jurusan-list");
	