<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $siswa_id = $_POST['siswa_id'];
    $poin_pelanggaran_siswa = $_POST['poin_pelanggaran_siswa1'];
    $nama_siswa = $_POST['nama_siswa1'];
    $nis = $_POST['nis1'];
    $jenis_kelamin = $_POST['jenis_kelamin1'];
    $kelas_id = $_POST['kelas_id1'];
    
    $result = mysqli_query ($koneksi, "UPDATE `siswa` 
    SET 
    `poin_pelanggaran_siswa`='$poin_pelanggaran_siswa',
    `nama_siswa`='$nama_siswa',
    `nis`='$nis',
    `jenis_kelamin`='$jenis_kelamin',
    `kelas_id`='$kelas_id'
    WHERE siswa_id='$siswa_id'");
    
    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}