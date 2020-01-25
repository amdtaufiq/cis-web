<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    $skala_sikap_id = $_GET['skala_sikap_id'];

    $queryDelete = mysqli_query($koneksi, "DELETE FROM skala_sikap WHERE skala_sikap_id=$skala_sikap_id");

    header("location: ".BASE_URL."index.php?page=skala-sikap-list");
