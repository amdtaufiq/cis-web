<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    $kelas_id = $_GET['kelas_id'];

    $queryDelete = mysqli_query($koneksi, "DELETE FROM kelas WHERE kelas_id=$kelas_id");

    header("location: ".BASE_URL."index.php?page=kelas-list");
