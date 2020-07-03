<?php
    session_start();
    $siswa_id = $_SESSION['siswa_id'];
    $user_id = $_SESSION['user_id'];

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    date_default_timezone_set('Asia/Jakarta');
    $tanggal_prestasi = date('Y-m-d H:i:s');
    $info = $_POST['info'];
    $bukti = $_FILES['bukti']['name'];
    
    $ekstensi_diperbolehkan = array('png','jpg'); 
    $x = explode('.', $bukti);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['bukti']['tmp_name'];   
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$bukti;
    $gambar = "/android-alpa/bukti/prestasi/".$nama_gambar_baru;
    
    
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
        
        move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT'].'/android-alpa/bukti/prestasi/'.$nama_gambar_baru);
        
        mysqli_query ($koneksi, "INSERT INTO `catatan_prestasi`(`nama_prestasi`,`tanggal_prestasi`, `siswa_id`, `user_id`, `bukti`) VALUES ('$nama_prestasi','$tanggal_prestasi','$siswa_id','$user_id' , '$gambar') ");
        
        header("location: ".BASE_URL."index.php?page=search-siswa-prestasi");
        
    }else{
        
        mysqli_query ($koneksi, "INSERT INTO `catatan_prestasi`(`nama_prestasi`,`tanggal_prestasi`, `siswa_id`, `user_id`) VALUES ('$nama_prestasi','$tanggal_prestasi','$siswa_id','$user_id')");
        
        header("location: ".BASE_URL."index.php?page=search-siswa-prestasi");
    }

?>