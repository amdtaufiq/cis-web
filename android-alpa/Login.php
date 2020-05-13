<?php
    require_once 'DB_Function.php';
    $db = new DB_Functions();
    // json response array
    $response = array("error" => FALSE);
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // menerima parameter POST ( email dan password )
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        // get the user by nomor rekam medis and password
        $user = $db->getUser($username, $password);
        if ($user != false) {
            // user ditemukan
            $response["error"] = FALSE;
            $response["user"]["nama_user"] = $user["nama_user"];
            $response["user"]["user_id"] = $user["user_id"];
            $response["user"]["level"] = $user["level"];
            echo json_encode($response);
        } else {
            // user tidak ditemukan password/email salah
            $response["error"] = TRUE;
            $response["error_msg"] = "Login gagal. Password/username";
            echo json_encode($response);
        }
    } else {
        $response["error"] = TRUE;
        $response["error_msg"] = "Parameter (username atau password) ada yang kurang";
        echo json_encode($response);
    }
?>