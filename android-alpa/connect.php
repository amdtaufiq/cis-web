<?php 
define('host', 'localhost');
define('user', 'u545409461_sibiko');
define('pass', 'sibiko');
define('db', 'u545409461_sibiko');

$conn = mysqli_connect(host, user, pass, db) or die('Unable to Connect');

date_default_timezone_set('Asia/Jakarta');
?>