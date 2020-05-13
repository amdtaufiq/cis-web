<div class="card-body">
	<a href="<?php echo BASE_URL.'index.php?page=siswa-list' ?>" class="btn btn-danger btn-md pull-right">Batal</a><br>
	<br>
    <h3>Form Impor Data</h3><hr>

    <form method="post" action="" enctype="multipart/form-data">
		<a href="<?php echo BASE_URL.'format/SISWA.xlsx'; ?>" class="btn btn-outline-info btn-md">Unduh Format</a><br><br>

		<input type="file" name="file" class="pull-left">

		<button type="submit" name="preview" class="btn btn-success btn-md text-white">Lihat Data</button>
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

				<form method='post' action="<?php echo BASE_URL."module/siswa/action-import.php"; ?>">
				<div class='alert alert-danger' id='kosong'>
				Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
				</div>
				
				<br>
                <h4>Data</h4>
				
				<button type='submit' name='import' class='btn btn-warning text-white btn-md'>Impor</button>
				<br><br>
				<div class="table-responsive">
					
					<table class='table table-bordered'>
					
						<tr>
							<th width="16%">Poin Pelanggaran Siswa</th>
							<th>Nomor Siswa</th>
							<th>NIS</th>
							<th>JK</th>
							<th colspan='3' class='text-center'>Kelas</th>
						</tr>

						<?php

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
									echo "<tr>";
									echo "<td>".$poin_pelanggaran_siswa."</td>";
									echo "<td>".$nama_siswa."</td>";
									echo "<td>".$nis."</td>";
									echo "<td>".$jenis_kelamin."</td>";
									echo "<td>".$tingkat_kelas."</td>";
									echo "<td>".$kode_jurusan."</td>";
									echo "<td>".$tipe_kelas."</td>";
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
		</table>
</div>