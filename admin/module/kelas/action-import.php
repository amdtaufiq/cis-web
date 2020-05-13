

<?php 
include_once("../../function/koneksi.php");
include_once("../../function/helper.php");
// include_once("../../PHPExcel/PHPExcel.php");

if(isset($_POST['import'])){
	$nama_file_baru = 'data.xlsx';

	require_once '../../PHPExcel/PHPExcel.php';


	$excelreader = new PHPExcel_Reader_Excel2007();

	$loadexcel = $excelreader->load('../../tmp/' .$nama_file_baru);
	$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

	$numrow = 1;
	foreach($sheet as $row){
		$nama_wali_kelas = $row['A'];
		$tingkat_kelas = $row['B'];
		$kode_jurusan = $row['C'];
		$tipe_kelas = $row['D']; 
		$kode_user = $row['E']; 

		if($numrow > 1){

			$query_id = mysqli_query($koneksi,"SELECT jurusan_id FROM jurusan WHERE kode_jurusan='$kode_jurusan'");
			$result = mysqli_fetch_array($query_id);
			$jurusan_id = $result['jurusan_id'];

			$query_id1 = mysqli_query($koneksi,"SELECT `user_id` FROM user WHERE nip='$kode_user'");
			$result1 = mysqli_fetch_array($query_id1);
			$user_id = $result1['user_id'];

			$query = "INSERT INTO `kelas`(`nama_wali_kelas`, `tingkat_kelas`, `jurusan_id`, `tipe_kelas`, `user_id`) 
			VALUES ('$nama_wali_kelas', '$tingkat_kelas', '$jurusan_id', '$tipe_kelas', '$user_id')";

			mysqli_query($koneksi, $query);
		}

		$numrow++;
	}
    unlink('tmp/'.$nama_file_baru);
}

header("location: ".BASE_URL."index.php?page=kelas-list");

?>