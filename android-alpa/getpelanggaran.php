<?php 

require_once 'connect.php';

$type = $_GET['item_type'];
$key = $_GET['key'];
$status = 1;

if ($key!='') {
    if ($type == 'pelanggaran') {
        $query = "SELECT * FROM pelanggaran WHERE status_pelanggaran=$status AND nama_pelanggaran LIKE '%$key%'";
        $result = mysqli_query($conn, $query);
        $response = array();
        while( $row = mysqli_fetch_assoc($result) ){
            array_push($response, 
            array(
                'pelanggaran_id'=>$row['pelanggaran_id'],
                'poin_pelanggaran'=>$row['poin_pelanggaran'],
                'nama_pelanggaran'=>$row['nama_pelanggaran']) 
            );
        }
        echo json_encode($response);   
    }
} else {
    $query = "SELECT * FROM pelanggaran WHERE status_pelanggaran=$status";
    $result = mysqli_query($conn, $query);
    $response = array();
    while( $row = mysqli_fetch_assoc($result) ){
        array_push($response, 
        array(
            'pelanggaran_id'=>$row['pelanggaran_id'],
            'poin_pelanggaran'=>$row['poin_pelanggaran'],
            'nama_pelanggaran'=>$row['nama_pelanggaran'])
        );
    }
    echo json_encode($response);   
    
}

mysqli_close($conn);

?>