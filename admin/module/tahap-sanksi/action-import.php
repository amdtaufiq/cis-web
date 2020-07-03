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
		$tahap = $row['A']; 
		$keterangan = $row['B']; 
		$poin_awal= $row['C'];
		$poin_akhir= $row['D'];

		if($tahap == "" && $keterangan == "" && $poin_awal == "" && $poin_akhir == "")
			continue;
		if($numrow > 1){

			$query = "INSERT INTO tahap_tindak (tahap, keterangan, poin_awal, poin_akhir) VALUES ('$tahap', '$keterangan', '$poin_awal', '$poin_akhir')";

			mysqli_query($koneksi, $query);
		}

		$numrow++;
	}
    unlink('tmp/'.$nama_file_baru);
}

header("location: ".BASE_URL."index.php?page=tahap-sanksi-list");

?>