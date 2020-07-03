<?php 

require_once 'connect.php';

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){

    $tanggal_pelanggaran = date('Y-m-d H:i:s');
    $siswa_id = $_POST['siswa_id'];
    $pelanggaran_id = $_POST['pelanggaran_id'];
    $user_id = $_POST['user_id'];
    $aksi = $_POST['aksi'];
    $bukti = $_POST['bukti'];
    $info = $_POST['info'];
    
    $query_pelanggaran = mysqli_query($conn, "SELECT * FROM pelanggaran WHERE pelanggaran_id='$pelanggaran_id'");
    $row_pelanggaran=mysqli_fetch_assoc($query_pelanggaran);

    $query_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE siswa_id='$siswa_id'");
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

    if($aksi=="+"){
       $poin_siswa = $row_siswa['poin_pelanggaran_siswa'] + $row_pelanggaran['poin_pelanggaran']; 
    }else if($aksi=="-"){
       $poin_siswa = $row_siswa['poin_pelanggaran_siswa'] - $row_pelanggaran['poin_pelanggaran']; 
    }
    
    for ($i = 0; $i < count($resultRowTahap); $i++){
        if ($poin_siswa >= $resultRowTahap[$i]['poin_awal'] && $poin_siswa <= $resultRowTahap[$i]['poin_akhir']) {
            $tahapAkhir = $resultRowTahap[$i]['tahap'];
            break;
        }
    }
    
    if ( $tanggal_pelanggaran == '' || $siswa_id == '' || $pelanggaran_id == '' || $user_id == '' ){

        echo 'Error';

    } else {
        
            
        if('$tahapAwal' != '$tahapAkhir'){
            mysqli_query ($conn, "UPDATE siswa SET tindakan=0 WHERE siswa_id='$siswa_id'");
        }
       
        mysqli_query ($conn, "UPDATE siswa SET poin_pelanggaran_siswa='$poin_siswa' WHERE siswa_id='$siswa_id'");

        $query = "INSERT INTO `catatan_poin_pelanggaran`(`tanggal_pelanggaran`, `siswa_id`, `pelanggaran_id`, `user_id`, `info`) VALUES ('$tanggal_pelanggaran','$siswa_id','$pelanggaran_id','$user_id','$info')";

        if ( mysqli_query($conn, $query) ){

            if ($bukti == null) {
                $finalPath = "/android-alpa/bukti/pelanggaran/default.png"; 
                $response["value"] = "1";
                $response["message"] = "Pelanggaran Siswa di Tambahkan";
    
                echo json_encode($response);
                mysqli_close($conn);
            } else{
                $id = mysqli_insert_id($conn);
                $path = "bukti/pelanggaran/$id.jpeg";
                $finalPath = "/android-alpa/".$path;

                $insert_bukti = "UPDATE catatan_poin_pelanggaran SET bukti='$finalPath' WHERE catatan_poin_pelanggaran_id='$id' ";
            
                if (mysqli_query($conn, $insert_bukti)) {
            
                    if ( file_put_contents( $path, base64_decode($bukti) ) ) {
                        $response["value"] = 1;
                        $response["message"] = "Pelanggaran Siswa di Tambahkan";
                        echo json_encode($response);
                        mysqli_close($conn);
                    }else{
                       $response["value"] = 0;
                        $response["message"] = "Oops! ".$name." Gagal ditambahkan, \n Silahkan Coba lagi!";
                        echo json_encode($response);  
                    }
                }
            }          
        } 
    }

} else {
    $response["value"] = 0;
    $response["message"] = "oops! Coba lagi!";
    echo json_encode($response);
}

?>