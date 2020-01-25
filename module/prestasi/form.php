<?php
	include_once("function/koneksi.php");
	include_once("function/helper.php");

	$prestasi_id = isset ($_GET['prestasi_id']) ? $_GET['prestasi_id'] : false;
	
	if($prestasi_id) {
		$queryprestasi = mysqli_query($koneksi, "SELECT * FROM prestasi WHERE prestasi_id='$prestasi_id'");
        $row = mysqli_fetch_assoc($queryprestasi);
        
        $prestasi_id = $row['prestasi_id'];
        $nama_prestasi = $row['nama_prestasi'];
        $poin_prestasi = $row['poin_prestasi'];
		$button = "PERBAHARUI";
	} else{
        $nama_prestasi = "";
        $poin_prestasi = "";
        $button = "TAMBAH";
    }

?>

<div class="card-body">
    <h4 class="card-title">Tambah prestasi</h4>
    <div class="basic-form">
    <form action="<?php echo BASE_URL."module/prestasi/action.php?prestasi_id=$prestasi_id"; ?>" method="POST">    
            <div class="form-group row">                
                <label class="col-sm-2 col-form-label">Nama Prestasi <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="nama_prestasi" value="<?php echo $nama_prestasi; ?>">
                </div> 
            </div>
            <div class="form-group row">       
                <label class="col-sm-2 col-form-label">Poin Prestasi <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="poin_prestasi" value="<?php echo $poin_prestasi; ?>">
                    <br>
                    <input type="submit" class="btn login-form__btn submit w-100" name="button" value="<?php echo $button; ?>" />
                </div> 
            </div>                                    
        </form>
    </div>
</div>
                            