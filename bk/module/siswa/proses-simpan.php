<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $poin_pelanggaran_siswa = $_POST['poin_pelanggaran_siswa'];
    $poin_prestasi_siswa = $_POST['poin_prestasi_siswa'];
    $nama_siswa = $_POST['nama_siswa'];
    $nis = $_POST['nis'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kelas_id = $_POST['kelas_id'];
    
    $result = mysqli_query($koneksi , "INSERT INTO `siswa`(`poin_pelanggaran_siswa`,`poin_prestasi_siswa`,`nama_siswa`, `nis`, `jenis_kelamin`, `kelas_id`) 
    VALUES  ('$poin_pelanggaran_siswa','$poin_prestasi_siswa','$nama_siswa', '$nis', '$jenis_kelamin', '$kelas_id')");
    
    if($result){
        echo "sukses";
	} else {
	    echo "gagal";
	}