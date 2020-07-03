<?php
    session_start();
    $siswa_id = $_SESSION['siswa_id'];
    $user_id = $_SESSION['user_id'];

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    $pelanggaran_id = $_POST['pelanggaran_id'];
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d H:i:s');
    $info = $_POST['info'];
    $bukti = $_FILES['bukti']['name'];
    
    $ekstensi_diperbolehkan = array('png','jpg'); 
    $x = explode('.', $bukti);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['bukti']['tmp_name'];   
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$bukti;
    $gambar= "/android-alpa/bukti/pelanggaran/".$nama_gambar_baru;
    
    
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
        move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT'].'/android-alpa/bukti/pelanggaran/'.$nama_gambar_baru);
        
        $query_pelanggaran = mysqli_query($koneksi, "SELECT * FROM pelanggaran WHERE pelanggaran_id='$pelanggaran_id'");
        $row_pelanggaran=mysqli_fetch_assoc($query_pelanggaran);
        
        $query_siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE siswa_id='$siswa_id'");
        $row_siswa=mysqli_fetch_assoc($query_siswa);
        
        $poinAwal = $row_siswa['poin_pelanggaran_siswa'];
        
        $querytahap = mysqli_query($koneksi,"SELECT * FROM tahap_tindak");
        $resultRowTahap = mysqli_fetch_all($querytahap, MYSQLI_ASSOC);
        
        for ($i = 0; $i < count($resultRowTahap); $i++){
            if ($poinAwal >= $resultRowTahap[$i]['poin_awal'] && $poinAwal <= $resultRowTahap[$i]['poin_akhir']) {
                $tahapAwal = $resultRowTahap[$i]['tahap'];
                break;
            }
        }
        
        for ($i = 0; $i < count($resultRowTahap); $i++){
            if ($poin_siswa >= $resultRowTahap[$i]['poin_awal'] && $poin_siswa <= $resultRowTahap[$i]['poin_akhir']) {
                $tahapAkhir = $resultRowTahap[$i]['tahap'];
                break;
            }
        }
        
        if('$tahapAwal' != '$tahapAkhir'){
            mysqli_query ($conn, "UPDATE siswa SET tindakan=0 WHERE siswa_id='$siswa_id'");
        }
        
        $poin_siswa = $row_siswa['poin_pelanggaran_siswa'] + $row_pelanggaran['poin_pelanggaran'];
        
        mysqli_query ($koneksi, "UPDATE `siswa` SET `poin_pelanggaran_siswa`='$poin_siswa'WHERE siswa_id='$siswa_id'");
        
        mysqli_query ($koneksi, "INSERT INTO `catatan_poin_pelanggaran`(`tanggal_pelanggaran`, `siswa_id`, `pelanggaran_id`, `user_id`, `bukti`, `info`) 
        VALUES ('$date','$siswa_id','$pelanggaran_id','$user_id', '$gambar', '$info')");
        
        header("location: ".BASE_URL."index.php?page=search-siswa-pelanggaran");
        
    }else{
        
        $query_pelanggaran = mysqli_query($koneksi, "SELECT * FROM pelanggaran WHERE pelanggaran_id='$pelanggaran_id'");
        $row_pelanggaran=mysqli_fetch_assoc($query_pelanggaran);
        
        $query_siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE siswa_id='$siswa_id'");
        $row_siswa=mysqli_fetch_assoc($query_siswa);
        
        $poinAwal = $row_siswa['poin_pelanggaran_siswa'];
        
        $querytahap = mysqli_query($koneksi,"SELECT * FROM tahap_tindak");
        $resultRowTahap = mysqli_fetch_all($querytahap, MYSQLI_ASSOC);
        
        for ($i = 0; $i < count($resultRowTahap); $i++){
            if ($poinAwal >= $resultRowTahap[$i]['poin_awal'] && $poinAwal <= $resultRowTahap[$i]['poin_akhir']) {
                $tahapAwal = $resultRowTahap[$i]['tahap'];
                break;
            }
        }
        
        for ($i = 0; $i < count($resultRowTahap); $i++){
            if ($poin_siswa >= $resultRowTahap[$i]['poin_awal'] && $poin_siswa <= $resultRowTahap[$i]['poin_akhir']) {
                $tahapAkhir = $resultRowTahap[$i]['tahap'];
                break;
            }
        }
        
        if('$tahapAwal' != '$tahapAkhir'){
            mysqli_query ($conn, "UPDATE siswa SET tindakan=0 WHERE siswa_id='$siswa_id'");
        }
        
        $poin_siswa = $row_siswa['poin_pelanggaran_siswa'] + $row_pelanggaran['poin_pelanggaran'];
        
        mysqli_query ($koneksi, "UPDATE `siswa` SET `poin_pelanggaran_siswa`='$poin_siswa'WHERE siswa_id='$siswa_id'");
        
        mysqli_query ($koneksi, "INSERT INTO `catatan_poin_pelanggaran`(`tanggal_pelanggaran`, `siswa_id`, `pelanggaran_id`, `user_id`, `info`) 
        VALUES ('$date','$siswa_id','$pelanggaran_id','$user_id', '$info')");
        
        header("location: ".BASE_URL."index.php?page=search-siswa-pelanggaran");
    }

?>