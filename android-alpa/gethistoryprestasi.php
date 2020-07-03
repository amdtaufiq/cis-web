<?php 

require_once 'connect.php';

if (isset($_GET['siswa_id'])) {
    $siswa_id = $_GET["siswa_id"];
    $query = "SELECT catatan_prestasi.*, user.nama_user FROM `catatan_prestasi` JOIN user ON catatan_prestasi.user_id = user.user_id WHERE catatan_prestasi.siswa_id='$siswa_id'";
    $result = mysqli_query($conn, $query);
    $response = array();
    while( $row = mysqli_fetch_assoc($result) ){
        array_push($response, 
        array(
            'siswa_id'=>$row['siswa_id'],
            'tanggal_prestasi'=> date("d M Y", strtotime($row['tanggal_prestasi'])),
            'nama_prestasi'=>$row['nama_prestasi'],
            'nama_user'  =>$row['nama_user']) 
        );
    }
    echo json_encode($response);   
}
 

mysqli_close($conn);

?>