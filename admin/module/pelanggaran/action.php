<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    $page = isset($_GET['page']) ? $_GET['page'] : false;
    
	$nama_pelanggaran = $_POST['nama_pelanggaran'];
	$poin_pelanggaran = $_POST['poin_pelanggaran'];
	$button = $_POST['button'];



if($button == "TAMBAH"){

    mysqli_query($koneksi , "INSERT INTO pelanggaran (nama_pelanggaran, poin_pelanggaran) VALUES ('$nama_pelanggaran','$poin_pelanggaran')");
    
}else if($button == "PERBAHARUI"){

    $pelanggaran_id = $_GET['pelanggaran_id'];
    
    mysqli_query ($koneksi, "UPDATE pelanggaran SET nama_pelanggaran='$nama_pelanggaran', poin_pelanggaran='$poin_pelanggaran' WHERE pelanggaran_id='$pelanggaran_id'");

}

header("location: ".BASE_URL."index.php?page=pelanggaran-list");
	