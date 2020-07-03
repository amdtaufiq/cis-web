<?php
class DB_Functions {
    private $conn;
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // koneksi ke database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
    // destructor
    function __destruct() {
         
    }
    
    public function getUser($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return NULL;
        }
    }
  
}
?>