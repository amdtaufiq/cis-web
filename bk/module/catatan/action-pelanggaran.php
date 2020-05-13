<?php
    session_start();
    $siswa_id = $_SESSION['siswa_id'];
    $user_id = $_SESSION['user_id'];

include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

$pelanggaran_id = $_POST['pelanggaran_id'];
$date = date('Y-m-d H:i:s');
$query_pelanggaran = mysqli_query($koneksi, "SELECT * FROM pelanggaran WHERE pelanggaran_id='$pelanggaran_id'");
$row_pelanggaran=mysqli_fetch_assoc($query_pelanggaran);

$query_siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE siswa_id='$siswa_id'");
$row_siswa=mysqli_fetch_assoc($query_siswa);

$poin_siswa = $row_siswa['poin_pelanggaran_siswa'] + $row_pelanggaran['poin_pelanggaran'];
mysqli_query ($koneksi, "UPDATE `siswa` SET `poin_pelanggaran_siswa`='$poin_siswa'WHERE siswa_id='$siswa_id'");
mysqli_query ($koneksi, "INSERT INTO `catatan_poin_pelanggaran`(`tanggal_pelanggaran`, `siswa_id`, `pelanggaran_id`, `user_id`) 
VALUES ('$date','$siswa_id','$pelanggaran_id','$user_id')");

header("location: ".BASE_URL."index.php?page=status-siswa-list");



?>