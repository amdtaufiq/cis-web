<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $poin_pelanggaran_siswa = $_POST['poin_pelanggaran_siswa'];
    $nama_siswa = $_POST['nama_siswa'];
    $nis = $_POST['nis'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kelas_id = $_POST['kelas_id'];
    
     $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT nis FROM siswa WHERE nis='$nis'"));
    
    $result ="INSERT INTO `siswa`(`poin_pelanggaran_siswa`,`nama_siswa`, `nis`, `jenis_kelamin`, `kelas_id`) 
    VALUES  ('$poin_pelanggaran_siswa','$nama_siswa', '$nis', '$jenis_kelamin', '$kelas_id')";
    
    if($cek > 0){
        echo "sama";
    }else if(mysqli_query($koneksi, $result)){
        echo "sukses";
    }else{
        echo "gagal";
    }