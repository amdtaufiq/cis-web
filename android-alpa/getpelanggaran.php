<?php 

require_once 'connect.php';

$type = $_GET['item_type'];

if (isset($_GET['key'])) {
    $key = $_GET["key"];
    if ($type == 'pelanggaran') {
        $query = "SELECT * FROM pelanggaran WHERE poin_pelanggaran LIKE '%$key%' OR nama_pelanggaran LIKE '%$key%' ";
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
    if ($type == 'pelanggaran') {
        $query = "SELECT * FROM pelanggaran";
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
}

mysqli_close($conn);

?>