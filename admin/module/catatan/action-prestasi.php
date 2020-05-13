<?php
    session_start();
    $siswa_id = $_SESSION['siswa_id'];
    $user_id = $_SESSION['user_id'];

include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

$prestasi_id = $_POST['prestasi_id'];
$date = date('Y-m-d H:i:s');
$query_prestasi = mysqli_query($koneksi, "SELECT * FROM prestasi WHERE prestasi_id='$prestasi_id'");
$row_prestasi=mysqli_fetch_assoc($query_prestasi);

$query_siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE siswa_id='$siswa_id'");
$row_siswa=mysqli_fetch_assoc($query_siswa);

$poin_siswa = $row_siswa['poin'] + $row_prestasi['poin_prestasi'];
mysqli_query ($koneksi, "UPDATE `siswa` SET `poin`='$poin_siswa'WHERE siswa_id='$siswa_id'");
mysqli_query ($koneksi, "INSERT INTO `catatan_poin_prestasi`(`tanggal_prestasi`, `siswa_id`, `prestasi_id`, `user_id`) 
VALUES ('$date','$siswa_id','$prestasi_id','$user_id')");

header("location: ".BASE_URL."index.php?page=siswa-list");



?>