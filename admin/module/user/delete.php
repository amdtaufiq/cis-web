<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    
    $user_id = $_GET['user_id'];

    $queryDelete = mysqli_query($koneksi, "DELETE FROM user WHERE `user_id`=$user_id");

    header("location: ".BASE_URL."index.php?page=user-list");
