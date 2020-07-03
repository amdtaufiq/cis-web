<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    $pelanggaran_id = $_GET['pelanggaran_id'];

    $queryDelete = mysqli_query($koneksi, "DELETE FROM pelanggaran WHERE pelanggaran_id=$pelanggaran_id");

    header("location: ".BASE_URL."index.php?page=pelanggaran-list");
