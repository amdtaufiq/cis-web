<?php 

require_once 'connect.php';

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){

    $tanggal_prestasi = date('Y-m-d H:i:s');
    $nama_prestasi = $_POST['nama_prestasi'];
    $siswa_id = $_POST['siswa_id'];
    $user_id = $_POST['user_id'];
    $bukti = $_POST['bukti'];

    
    if ( $nama_prestasi == '' || $tanggal_prestasi == '' || $siswa_id == '' || $user_id == '' ){

        echo 'Error';

    } else {

        $query = "INSERT INTO `catatan_prestasi`(`nama_prestasi`,`tanggal_prestasi`, `siswa_id`, `user_id`) VALUES ('$nama_prestasi','$tanggal_prestasi','$siswa_id','$user_id')";

        if ( mysqli_query($conn, $query) ){
            if ($bukti == null) {
                $finalPath = "/android-alpa/bukti/prestasi/default.png"; 
                $response["value"] = "1";
                $response["message"] = "Prestasi Siswa di Tambahkan";
    
                echo json_encode($response);
                mysqli_close($conn);
            } else{
                $id = mysqli_insert_id($conn);
                $path = "bukti/prestasi/$id.jpeg";
                $finalPath = "/android-alpa/".$path;

                $insert_bukti = "UPDATE catatan_prestasi SET bukti='$finalPath' WHERE catatan_prestasi_id='$id' ";
            
                if (mysqli_query($conn, $insert_bukti)) {
            
                    if ( file_put_contents( $path, base64_decode($bukti) ) ) {
                        $response["value"] = 1;
                        $response["message"] = "Prestasi Siswa di Tambahkan";
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

    mysqli_close($conn);

} else {
    $response["value"] = 0;
    $response["message"] = "oops! Coba lagi!";
    echo json_encode($response);
}

?>