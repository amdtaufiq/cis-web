<?php 
    include_once("function/helper.php");
    session_start();
    session_destroy();
    header("location:".BASE_URL_BUKTI);
  
?>