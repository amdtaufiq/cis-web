<!-- import excel ke mysql -->
<!-- www.malasngoding.com -->

<?php 
include_once("../../function/koneksi.php");
include_once("../../function/helper.php");
include_once("../../function/excel_reader2.php");
?>

<?php
// upload file xls
$target = basename($_FILES['data']['name']) ;
move_uploaded_file($_FILES['data']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['data']['name'],0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['data']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);

// jumlah default data yang berhasil di import
// $berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){

	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$poin				= $data->val($i, 1);
	$nama_siswa			= $data->val($i, 2);
    $nisn				= $data->val($i, 3);
    $jenis_kelamin		= $data->val($i, 4);
	$tingkat			= $data->val($i, 5);
	$kode				= $data->val($i, 6);
	$tipe				= $data->val($i, 7);

	$kelas_id = mysqli_query($koneksi,"");
	
		// input data ke database (table data_pegawai)
		mysqli_query($koneksi , "INSERT INTO `siswa`(`poin`,`nama_siswa`, `nisn`, `jenis_kelamin`, `kelas_id`) 
		VALUES  ('$poin','$nama_siswa', '$nisn', '$jenis_kelamin', (SELECT kelas_id FROM `kelas` WHERE tingkat_kelas='$tingkat' AND jurusan_id IN (SELECT jurusan_id FROM `jurusan` WHERE kode_jurusan='$kode') AND tipe_kelas='$tipe') )");
		// $berhasil++;
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['data']['name']);

// alihkan halaman ke index.php
// header("location:index.php?berhasil=$berhasil");
header("location: ".BASE_URL."index.php?page=siswa-list");

?>