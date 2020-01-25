<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    $jurusan_id = $_GET['jurusan_id'];

    $queryDelete = mysqli_query($koneksi, "DELETE FROM jurusan WHERE jurusan_id=$jurusan_id");

    header("location: ".BASE_URL."index.php?page=jurusan-list");
