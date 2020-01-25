<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    $page = isset($_GET['page']) ? $_GET['page'] : false;
    
    $nama_wali_kelas = $_POST['nama_wali_kelas'];
    $nomor_wali_kelas = $_POST['nomor_wali_kelas'];
    $tingkat_kelas = $_POST['tingkat_kelas'];
    $jurusan_id = $_POST['jurusan_id'];
    $tipe_kelas = $_POST['tipe_kelas'];
	$button = $_POST['button'];

if($button == "TAMBAH"){

    mysqli_query($koneksi , "INSERT INTO `kelas`(`nama_wali_kelas`, `nomor_wali_kelas`, `tingkat_kelas`, `jurusan_id`, `tipe_kelas`) 
    VALUES ('$nama_wali_kelas', '$nomor_wali_kelas', '$tingkat_kelas', '$jurusan_id', '$tipe_kelas')");
    
}else if($button == "PERBAHARUI"){

    $kelas_id = $_GET['kelas_id'];
    
    mysqli_query ($koneksi, "UPDATE `kelas` 
    SET 
    `nama_wali_kelas`='$nama_wali_kelas',
    `nomor_wali_kelas`='$nomor_wali_kelas',
    `tingkat_kelas`='$tingkat_kelas',
    `jurusan_id`='$jurusan_id',
    `tipe_kelas`='$tipe_kelas' 
    WHERE kelas_id='$kelas_id'");

}

header("location: ".BASE_URL."index.php?page=kelas-list");
	