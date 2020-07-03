<div class="card-body">
	<a href="<?php echo BASE_URL.'index.php?page=pelanggaran-list' ?>" class="btn btn-danger btn-md pull-right">Batal</a><br>
    <br>
    <h3>Form Impor Data</h3><hr>

    <form method="post" action="" enctype="multipart/form-data">
		<a href="<?php echo BASE_URL.'format/JENIS_PELANGGARAN.xlsx'; ?>" class="btn btn-outline-info btn-md">Unduh Format</a><br><br>

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

				<form method='post' action="<?php echo BASE_URL."module/pelanggaran/action-import.php"; ?>">
					<div class='alert alert-danger' id='kosong'>
					Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
					</div>

					<br>
	                <h4>Data</h4>
	                
	                <button type='submit' name='import' class='btn btn-md btn-warning text-white'>Impor</button>
	                <br><br>
	                <div class="table-responsive">
	                	         
						<table class='table table-bordered'>
							<tr class='text-center'>
								<th>Nama Pelanggaran</th>
								<th>Poin Pelanggaran</th>
							</tr>

							<?php

								$numrow = 1;
								$kosong = 0;
								foreach($sheet as $row){ 
								
									$nama_pelanggaran = $row['A']; 
									$kode_pelanggaran = $row['B']; 

									if($nama_pelanggaran == "" && $kode_pelanggaran == "")
										continue; 

									if($numrow > 1){
										$kode_td = ( ! empty($nama_pelanggaran))? "" : " style='background: #E07171;'"; 
										$nama_td = ( ! empty($kode_pelanggaran))? "" : " style='background: #E07171;'";

										if($nama_pelanggaran == "" or $kode_pelanggaran == ""){
											$kosong++;
										}

										echo "<tr>";
										echo "<td".$kode_td.">".$nama_pelanggaran."</td>";
										echo "<td class='text-center'".$nama_td.">".$kode_pelanggaran."</td>";
										echo "</tr>";
									}

									$numrow++; 
								}

						echo "</table>";				

					if($kosong > 1){
					?>
						<script>
						$(document).ready(function(){
							$("#jumlah_kosong").html('<?php echo $kosong; ?>');

							$("#kosong").show();
						});
						</script>
					<?php
					}else{ 
						echo "<hr>";					
					}

				echo "</form>";
			}else{ 
				echo "<br><div class='alert alert-danger'>
				Hanya File Excel 2007 (.xlsx) yang diperbolehkan
				</div>";
			}
		}
	?>
</div>