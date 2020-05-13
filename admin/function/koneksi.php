<?php
    $server = "localhost";
    $user = "u545409461_sibiko";
    $pass = "sibiko";
    $dbname = "u545409461_sibiko";

    $koneksi = mysqli_connect($server, $user, $pass, $dbname) or die ("gagal terkoneksi");

    // date_default_timezone_set('Asia/Jakarta');
 
    // $sekarang = new DateTime();
    // $menit = $sekarang -> getOffset() / 60;
    
    // $tanda = ($menit < 0 ? -1 : 1);
    // $menit = abs($menit);
    // $jam = floor($menit / 60);
    // $menit -= $jam * 60;
    
    // $offset = sprintf('%+d:%02d', $tanda * $jam, $menit);

    // mysql_query("SET time_zone = '$offset'");
    


?>