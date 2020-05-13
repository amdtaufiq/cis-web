<?php
	include_once("function/koneksi.php");
	include_once("function/helper.php");

	$pelanggaran_id = isset ($_GET['pelanggaran_id']) ? $_GET['pelanggaran_id'] : false;
	
	if($pelanggaran_id) {
		$querypelanggaran = mysqli_query($koneksi, "SELECT * FROM pelanggaran WHERE pelanggaran_id='$pelanggaran_id'");
        $row = mysqli_fetch_assoc($querypelanggaran);
        
        $pelanggaran_id = $row['pelanggaran_id'];
        $nama_pelanggaran = $row['nama_pelanggaran'];
        $poin_pelanggaran = $row['poin_pelanggaran'];
		$button = "PERBAHARUI";
	} else{
        $nama_pelanggaran = "";
        $poin_pelanggaran = "";
        $button = "TAMBAH";
    }

?>

<div class="card-body">
    <h4 class="card-title">Tambah Pelanggaran</h4>
    <div class="basic-form">
    <form action="<?php echo BASE_URL."module/pelanggaran/action.php?pelanggaran_id=$pelanggaran_id"; ?>" method="POST">    
            <div class="form-group row">                
                <label class="col-sm-2 col-form-label">Nama pelanggaran <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="nama_pelanggaran" value="<?php echo $nama_pelanggaran; ?>">
                </div> 
            </div>
            <div class="form-group row">       
                <label class="col-sm-2 col-form-label">Poin pelanggaran <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="poin_pelanggaran" value="<?php echo $poin_pelanggaran; ?>">
                    <br>
                    <input type="submit" class="btn login-form__btn submit w-100" name="button" value="<?php echo $button; ?>" />
                </div> 
            </div>                                    
        </form>
    </div>
</div>
                            