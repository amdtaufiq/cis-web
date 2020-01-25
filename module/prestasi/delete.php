<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    $prestasi_id = $_GET['prestasi_id'];

    $queryDelete = mysqli_query($koneksi, "DELETE FROM prestasi WHERE prestasi_id=$prestasi_id");

    header("location: ".BASE_URL."index.php?page=prestasi-list");
