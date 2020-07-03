<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $siswa_id = $_POST['siswa_id'];
    $poin_pelanggaran_siswa = $_POST['poin_pelanggaran_siswa1'];
    $nama_siswa = $_POST['nama_siswa1'];
    $nis = $_POST['nis1'];
    $jenis_kelamin = $_POST['jenis_kelamin1'];
    $kelas_id = $_POST['kelas_id1'];

    $kode ='';
    
    $siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE siswa_id='$siswa_id'");
    while ($row=mysqli_fetch_array($siswa)){
        $kode = $row['nis'];
    }
    
    if($kode==$nis){
        $result = mysqli_query($koneksi , "UPDATE `siswa` 
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
    
    }else{
        $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT nis FROM siswa WHERE nis='$nis'"));
    
        $result ="UPDATE `siswa` 
    SET 
    `poin_pelanggaran_siswa`='$poin_pelanggaran_siswa',
    `nama_siswa`='$nama_siswa',
    `nis`='$nis',
    `jenis_kelamin`='$jenis_kelamin',
    `kelas_id`='$kelas_id'
    WHERE siswa_id='$siswa_id'";
        
        if($cek > 0){
            echo "sama";
        }else if(mysqli_query($koneksi, $result)){
            echo "sukses";
        }else{
            echo "gagal";
        }
    }
    