<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    $page = isset($_GET['page']) ? $_GET['page'] : false;
    
    $poin = $_POST['poin'];
    $nama_siswa = $_POST['nama_siswa'];
    $nisn = $_POST['nisn'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kelas_id = $_POST['kelas_id'];
    $jumlah_poin = 100;
	$button = $_POST['button'];

if($button == "TAMBAH"){

    mysqli_query($koneksi , "INSERT INTO `siswa`(`poin`,`nama_siswa`, `nisn`, `jenis_kelamin`, `kelas_id`) 
    VALUES  ('$poin','$nama_siswa', '$nisn', '$jenis_kelamin', '$kelas_id')");

    
}else if($button == "PERBAHARUI"){

    $siswa_id = $_GET['siswa_id'];
    
    mysqli_query ($koneksi, "UPDATE `siswa` 
    SET 
    `poin`='$poin',
    `nama_siswa`='$nama_siswa',
    `nisn`='$nisn',
    `jenis_kelamin`='$jenis_kelamin',
    `kelas_id`='$kelas_id'
    WHERE siswa_id='$siswa_id'");

}

header("location: ".BASE_URL."index.php?page=siswa-list");
	