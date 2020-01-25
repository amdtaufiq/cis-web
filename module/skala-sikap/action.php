<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    $page = isset($_GET['page']) ? $_GET['page'] : false;
    
    $skala = $_POST['skala'];
    $poin_minimal = $_POST['poin_minimal'];
    $poin_maksimal = $_POST['poin_maksimal'];
	$button = $_POST['button'];



if($button == "TAMBAH"){

    mysqli_query($koneksi , "INSERT INTO skala_sikap (skala, poin_minimal, poin_maksimal) VALUES ('$skala','$poin_minimal','$poin_maksimal')");
    
}else if($button == "PERBAHARUI"){

    $skala_sikap_id = $_GET['skala_sikap_id'];
    
    mysqli_query ($koneksi, "UPDATE skala_sikap SET skala='$skala', poin_minimal='$poin_minimal', poin_maksimal='$poin_maksimal' WHERE skala_sikap_id='$skala_sikap_id'");

}

header("location: ".BASE_URL."index.php?page=skala-sikap-list");
	