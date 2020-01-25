<?php
	include_once("function/koneksi.php");
	include_once("function/helper.php");

	$jurusan_id = isset ($_GET['jurusan_id']) ? $_GET['jurusan_id'] : false;
	
	if($jurusan_id) {
		$queryjurusan = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE jurusan_id='$jurusan_id'");
        $row = mysqli_fetch_assoc($queryjurusan);
        
        $jurusan_id = $row['jurusan_id'];
        $kode_jurusan = $row['kode_jurusan'];
		$nama_jurusan = $row['nama_jurusan'];
		$button = "PERBAHARUI";
	} else{
        $kode_jurusan = "";
        $nama_jurusan = "";
        $button = "TAMBAH";
    }

?>

<div class="card-body">
    <h4 class="card-title">Tambah Jurusan</h4>
    <div class="basic-form">
    <form action="<?php echo BASE_URL."module/jurusan/action.php?jurusan_id=$jurusan_id"; ?>" method="POST">    
            <div class="form-group row">                
                <label class="col-sm-2 col-form-label">Kode Jurusan <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="kode_jurusan" value="<?php echo $kode_jurusan; ?>">
                </div> 
            </div>
            <div class="form-group row">       
                <label class="col-sm-2 col-form-label">Nama Jurusan <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="nama_jurusan" value="<?php echo $nama_jurusan; ?>">
                    <br>
                    <input type="submit" class="btn login-form__btn submit w-100" name="button" value="<?php echo $button; ?>" />
                </div> 
            </div>                                    
        </form>
    </div>
</div>
                            