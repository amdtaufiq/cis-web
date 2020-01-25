<?php 
   include_once("../../function/koneksi.php");
   include_once("../../function/helper.php");
?>

<form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL."module/jurusan/action-import.php"; ?>">
	Pilih File: 
	<input name="data" type="file" required="required"> 
	<input name="upload" type="submit" value="Import">
</form>