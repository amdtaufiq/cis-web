<?php 

require_once 'connect.php';

$type = $_GET['item_type'];

if (isset($_GET['key'])) {
    $key = $_GET["key"];
    if ($type == 'prestasi') {
        $query = "SELECT * FROM prestasi WHERE poin_prestasi LIKE '%$key%' OR nama_prestasi LIKE '%$key%' ";
        $result = mysqli_query($conn, $query);
        $response = array();
        while( $row = mysqli_fetch_assoc($result) ){
            array_push($response, 
            array(
                'prestasi_id'=>$row['prestasi_id'],
                'poin_prestasi'=>$row['poin_prestasi'],
                'nama_prestasi'=>$row['nama_prestasi']) 
            );
        }
        echo json_encode($response);   
    }
} else {
    if ($type == 'prestasi') {
        $query = "SELECT * FROM prestasi";
        $result = mysqli_query($conn, $query);
        $response = array();
        while( $row = mysqli_fetch_assoc($result) ){
            array_push($response, 
            array(
                'prestasi_id'=>$row['prestasi_id'],
                'poin_prestasi'=>$row['poin_prestasi'],
                'nama_prestasi'=>$row['nama_prestasi'])
            );
        }
        echo json_encode($response);   
    }
}

mysqli_close($conn);

?>