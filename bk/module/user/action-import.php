<?php 
include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

if(isset($_POST['import'])){
	$nama_file_baru = 'data.xlsx';

	require_once '../../PHPExcel/PHPExcel.php';


	$excelreader = new PHPExcel_Reader_Excel2007();

	$loadexcel = $excelreader->load('../../tmp/' .$nama_file_baru);
	$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

	$numrow = 1;
	foreach($sheet as $row){
		$nama_user = $row['A']; 
		$nip = $row['B'];
		$nomor_telpon = $row['C'];
		$username = $row['D'];
		$password = md5($row['E']); 
		$level = $row['F']; 

		if($numrow > 1){

			$query = "INSERT INTO `user`(`nama_user`,`nip`, `nomor_telpon`, `username`, `password`, `level`) 
			VALUES  ('$nama_user','$nip', '$nomor_telpon', '$username', '$password', '$level')";

			mysqli_query($koneksi, $query);
		}

		$numrow++;
	}
    unlink('tmp/'.$nama_file_baru);
}

header("location: ".BASE_URL."index.php?page=user-list");

?>