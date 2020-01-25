<?php
	include_once("function/koneksi.php");
	include_once("function/helper.php");

	$kelas_id = isset ($_GET['kelas_id']) ? $_GET['kelas_id'] : false;
	
	if($kelas_id) {
		$querykelas = mysqli_query($koneksi, "SELECT * FROM kelas WHERE kelas_id='$kelas_id'");
        $row = mysqli_fetch_assoc($querykelas);
        
        $kelas_id = $row['kelas_id'];
        $nama_wali_kelas = $row['nama_wali_kelas'];
        $nomor_wali_kelas = $row['nomor_wali_kelas'];
        $tingkat_kelas = $row['tingkat_kelas'];
        $jurusan_id = $row['jurusan_id'];
        $tipe_kelas = $row['tipe_kelas'];
		$button = "PERBAHARUI";
	} else{
        $kelas_id = "";
        $nama_wali_kelas = "";
        $nomor_wali_kelas = "";
        $tingkat_kelas = "";
        $jurusan_id = "";
        $tipe_kelas = "";
        $button = "TAMBAH";
    }

?>

<div class="card-body">
    <h4 class="card-title">Tambah kelas</h4>
    <div class="basic-form">
    <form action="<?php echo BASE_URL."module/kelas/action.php?kelas_id=$kelas_id"; ?>" method="POST">    
            <div class="form-group row">                
                <label class="col-sm-2 col-form-label">Nama Wali Kelas <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="nama_wali_kelas" value="<?php echo $nama_wali_kelas; ?>">
                </div> 
            </div>
            <div class="form-group row">       
                <label class="col-sm-2 col-form-label">Nomor Wali Kelas <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="nomor_wali_kelas" value="<?php echo $nomor_wali_kelas; ?>">
                </div> 
            </div> 
            <div class="form-group row">       
                <label class="col-sm-2 col-form-label">Tingkat Kelas <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <select class="form-control" id="sel1" name="tingkat_kelas">
                        <option value="X" <?php if($tingkat_kelas == "X"){echo "selected";} ?> >X</option>
                        <option value="XI" <?php if($tingkat_kelas == "XI"){echo "selected";} ?> >XI</option>
                        <option value="XII" <?php if($tingkat_kelas == "XII"){echo "selected";} ?> >XII</option>
                    </select>
                </div> 
            </div>
            <div class="form-group row">       
                <label class="col-sm-2 col-form-label">Jurusan <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <select class="form-control" id="sel1" name="jurusan_id">
                        <?php
                            $query = mysqli_query($koneksi, "SELECT jurusan_id, kode_jurusan, nama_jurusan
                            FROM jurusan 
                            ORDER BY kode_jurusan ASC");
                            while($row=mysqli_fetch_assoc($query)){
                                if($jurusan_id == $row['jurusan_id']){
                                    echo "<option value='$row[jurusan_id]' selected 'true'>$row[kode_jurusan] ($row[nama_jurusan])</option>";
                                }else{
                                    echo "<option value='$row[jurusan_id]'>$row[kode_jurusan] ($row[nama_jurusan])</option>";
                                }
                            }
                        ?>
                    </select>
                </div> 
            </div>
            <div class="form-group row">       
                <label class="col-sm-2 col-form-label">Tipe Kelas <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <select class="form-control" id="sel1" name="tipe_kelas">
                        <option value="1" <?php if($tipe_kelas == "1"){echo "selected";} ?> >1</option>
                        <option value="2" <?php if($tipe_kelas == "2"){echo "selected";} ?> >2</option>
                        <option value="3" <?php if($tipe_kelas == "3"){echo "selected";} ?> >3</option>
                        <option value="4" <?php if($tipe_kelas == "4"){echo "selected";} ?> >4</option>
                        <option value="5" <?php if($tipe_kelas == "5"){echo "selected";} ?> >5</option>
                        <option value="6" <?php if($tipe_kelas == "6"){echo "selected";} ?> >6</option>
                    </select>
                </div> 
            </div>  
            <br>
            <input type="submit" class="btn login-form__btn submit w-100" name="button" value="<?php echo $button; ?>" />                                               
        </form>
    </div>
</div>
                            