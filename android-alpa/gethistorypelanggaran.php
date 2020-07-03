<?php 

require_once 'connect.php';

if (isset($_GET['siswa_id'])) {
    $siswa_id = $_GET["siswa_id"];
    $query = "SELECT catatan_poin_pelanggaran.*, user.nama_user, pelanggaran.nama_pelanggaran FROM `catatan_poin_pelanggaran` JOIN user ON catatan_poin_pelanggaran.user_id=user.user_id JOIN pelanggaran ON catatan_poin_pelanggaran.pelanggaran_id=pelanggaran.pelanggaran_id WHERE catatan_poin_pelanggaran.siswa_id='$siswa_id'";
    $result = mysqli_query($conn, $query);
    $response = array();
    while( $row = mysqli_fetch_assoc($result) ){
        array_push($response, 
        array(
            'siswa_id'=>$row['siswa_id'],
            'tanggal_pelanggaran'=> date("d M Y", strtotime($row['tanggal_pelanggaran'])),
            'nama_pelanggaran'=>$row['nama_pelanggaran'],
            'nama_user'  =>$row['nama_user']) 
        );
    }
    echo json_encode($response);   
}
 

mysqli_close($conn);

?>