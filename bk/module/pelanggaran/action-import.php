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
		$nama_pelanggaran = $row['A'];
		$poin_pelanggaran = $row['B']; 

		if($nama_pelanggaran == "" && $poin_pelanggaran == "")
			continue;
		if($numrow > 1){

			$query = "INSERT INTO pelanggaran (nama_pelanggaran, poin_pelanggaran) VALUES ('$nama_pelanggaran', '$poin_pelanggaran')";

			mysqli_query($koneksi, $query);
		}

		$numrow++;
	}
    unlink('tmp/'.$nama_file_baru);
}

header("location: ".BASE_URL."index.php?page=pelanggaran-list");

?>