<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    $siswa_id = $_GET['siswa_id'];

    $queryDelete = mysqli_query($koneksi, "DELETE FROM siswa WHERE siswa_id=$siswa_id");

    header("location: ".BASE_URL."index.php?page=siswa-list");
