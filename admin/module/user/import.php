<div class="card-body">
	<a href="<?php echo BASE_URL.'index.php?page=user-list' ?>" class="btn btn-danger btn-md pull-right">Batal</a><br>
    <br>
    <h3>Form Impor Data</h3><hr>

    <form method="post" action="" enctype="multipart/form-data">
        <a href="<?php echo BASE_URL.'format/USER.xlsx'; ?>" class="btn btn-md btn-outline-info">
            Unduh Format
        </a><br><br>

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

			<form method='post' action="<?php echo BASE_URL."module/user/action-import.php"; ?>">
			<div class='alert alert-danger' id='kosong'>
			Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
			</div>
			<br>
			<h4>Preview Data Pengguna</h4>
			<button type='submit' name='import' class='btn btn-md btn-warning text-white'></span> Import</button>
			<br><br>
			<table class='table table-bordered'>
				<tr>
					<th>Nama User</th>
					<th>Kode Guru</th>
					<th>Kode Mapel</th>
					<th>Username</th>
	                <th>Password</th>
					<th>Level</th>
				</tr>

				<?php

				$numrow = 1;
				foreach($sheet as $row){ 
				
					$nama_user = $row['A']; 
					$nip = $row['B'];
					$kode_mapel = $row['C'];
					$username = $row['D'];
					$password = $row['E']; 
					$level = $row['F']; 

					if($numrow > 1){
						echo "<tr>";
						echo "<td>".$nama_user."</td>";
						echo "<td>".$nip."</td>";
						echo "<td>".$kode_mapel."</td>";
						echo "<td>".$username."</td>";
						echo "<td>".$password."</td>";
						echo "<td>".$level."</td>";
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