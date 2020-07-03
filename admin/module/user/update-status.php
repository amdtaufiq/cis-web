<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    $user_id = (int)$_POST['user_id'];

    if(isset($user_id)){
        
        $query = mysqli_query($koneksi,"SELECT status_user FROM user WHERE user_id=$user_id");
        $row = mysqli_fetch_assoc($query);
        $status = $row['status_user'];
        if($status == 0){
            mysqli_query($koneksi,"UPDATE user SET status_user=1 WHERE user_id=$user_id");
            echo "SUKSES INI";
        }else{
            mysqli_query($koneksi,"UPDATE user SET status_user=0 WHERE user_id=$user_id");
            echo "SUKSES";
        }
    }
    
?>