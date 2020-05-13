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
		$poin_pelanggaran_siswa = $row['A']; 
		$nama_siswa = $row['B'];
		$nis = $row['C'];
		$jenis_kelamin = $row['D'];
		$tingkat_kelas = $row['E']; 
		$kode_jurusan = $row['F']; 
		$tipe_kelas = $row['G']; 
		

		if($numrow > 1){

			$query_id = mysqli_query($koneksi,"SELECT jurusan_id FROM jurusan WHERE kode_jurusan='$kode_jurusan'");
			$result = mysqli_fetch_array($query_id);
			$jurusan_id = $result['jurusan_id'];

			$query_id2 = mysqli_query($koneksi,"SELECT kelas_id FROM `kelas` WHERE jurusan_id='$jurusan_id' AND tingkat_kelas='$tingkat_kelas' AND tipe_kelas='$tipe_kelas'");
			$result2 = mysqli_fetch_array($query_id2);
			$kelas_id = $result2['kelas_id'];

			// echo $numrow." ".$poin_pelanggaran_siswa." ".$poin_prestasi_siswa." ".$nis." ".$nama_siswa." ".$jenis_kelamin." ".$kelas_id."<br />";
			
			$query = "INSERT INTO `siswa`(`poin_pelanggaran_siswa`,`nama_siswa`, `nis`, `jenis_kelamin`, `kelas_id`) 
			VALUES  ('$poin_pelanggaran_siswa', '$nama_siswa', '$nis', '$jenis_kelamin', '$kelas_id')";

			mysqli_query($koneksi, $query);
		}

		$numrow++;
	}
	
    unlink('tmp/'.$nama_file_baru);
}

header("location: ".BASE_URL."index.php?page=siswa-list");

?>