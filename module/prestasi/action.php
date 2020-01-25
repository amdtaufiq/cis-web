<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    $page = isset($_GET['page']) ? $_GET['page'] : false;
    
	$nama_prestasi = $_POST['nama_prestasi'];
	$poin_prestasi = $_POST['poin_prestasi'];
	$button = $_POST['button'];



if($button == "TAMBAH"){

    mysqli_query($koneksi , "INSERT INTO prestasi (nama_prestasi, poin_prestasi) VALUES ('$nama_prestasi','$poin_prestasi')");
    
}else if($button == "PERBAHARUI"){

    $prestasi_id = $_GET['prestasi_id'];
    
    mysqli_query ($koneksi, "UPDATE prestasi SET nama_prestasi='$nama_prestasi', poin_prestasi='$poin_prestasi' WHERE prestasi_id='$prestasi_id'");

}

header("location: ".BASE_URL."index.php?page=prestasi-list");
	