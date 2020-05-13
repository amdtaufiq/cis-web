<div class="card-body">
	<a href="<?php echo BASE_URL.'index.php?page=kelas-list' ?>" class="btn btn-danger btn-md pull-right">Batal</a><br>
	<h3>Form Impor Data Kelas</h3><hr>

	<form method="post" action="" enctype="multipart/form-data">
		<a href="<?php echo BASE_URL.'format/KELAS.xlsx'; ?>" class="btn btn-outline-info btn-md">Unduh Format</a><br><br>

		<input type="file" name="file" class="pull-left btn-md">

		<button type="submit" name="preview" class="btn btn-success btn-md text-white">Lihat Data</button><br>
	</form>
	<?php
		if(isset($_POST['preview'])){
			$nama_file_baru = 'data.xlsx';

			if(is_file('tmp/'.$nama_file_baru)) 
				unlink('tmp/'.$nama_file_baru); 

			$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); 
			$tmp_file = $_FILES['file']['tmp_name'];

			if($ext == "xlsx"){
				move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);

				require_once 'PHPExcel/PHPExcel.php';

				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); 
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

				?>

				<form method='post' action="<?php echo BASE_URL."module/kelas/action-import.php"; ?>">
				<div class='alert alert-danger' id='kosong'>
				Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
				</div>

				<br>
				<h4>Data</h4>	
				
				<button type='submit' name='import' class='btn btn-warning text-white btn-md'>Impor</button>
				<br><br>

				<div class="tablle-responsive">
					<table class='table table-bordered'>
						<tr>
							<th>Nama Wali Kelas</th>
							<th></th>
							<th>Kelas</th>
							<th></th>
							<th>Guru BK</th>
						</tr>
				</div>
				<?php

					$numrow = 1;
					foreach($sheet as $row){ 
					
						$nama_wali_kelas = $row['A']; 
						$tingkat_kelas = $row['B'];
						$kode_jurusan = $row['C'];
						$tipe_kelas = $row['D']; 
						$kode_user = $row['E']; 

						if($numrow > 1){
							echo "<tr>";
							echo "<td>".$nama_wali_kelas."</td>";
							echo "<td>".$tingkat_kelas."</td>";
							echo "<td>".$kode_jurusan."</td>";
							echo "<td>".$tipe_kelas."</td>";
							echo "<td>".$kode_user."</td>";
							echo "</tr>";
						}

						$numrow++; 
					}

							echo "</table>";
				
								echo "<hr>";

							echo "</form>";
						}else{ 
							echo "<br><div class='alert alert-danger'>
							Hanya File Excel 2007 (.xlsx) yang diperbolehkan
							</div>";
						}
					}
				?>
</div>