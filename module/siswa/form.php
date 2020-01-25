<?php
	include_once("function/koneksi.php");
	include_once("function/helper.php");

	$siswa_id = isset ($_GET['siswa_id']) ? $_GET['siswa_id'] : false;
	
	if($siswa_id) {
		$querysiswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE siswa_id='$siswa_id'");
        $row = mysqli_fetch_assoc($querysiswa);
        
        $siswa_id = $row['siswa_id'];
        $poin = $row['poin'];
        $nama_siswa = $row['nama_siswa'];
        $nisn = $row['nisn'];
        $jenis_kelamin = $row['jenis_kelamin'];
        $kelas_id = $row['kelas_id'];
		$button = "PERBAHARUI";
	} else{
        $siswa_id = "";
        $poin = "";
        $nama_siswa = "";
        $nisn = "";
        $jenis_kelamin = "";
        $kelas_id = "";
        $button = "TAMBAH";
    }

?>

<div class="card-body">
    <h4 class="card-title">Tambah Siswa</h4>
    <div class="basic-form">
    <form action="<?php echo BASE_URL."module/siswa/action.php?siswa_id=$siswa_id"; ?>" method="POST">    
            <div class="form-group row">                
                <label class="col-sm-2 col-form-label">Poin <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="number" min="0" max="100" class="form-control" name="poin" value="<?php echo $poin; ?>">
                </div> 
            </div>
            <div class="form-group row">                
                <label class="col-sm-2 col-form-label">Nama Siswa <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="nama_siswa" value="<?php echo $nama_siswa; ?>">
                </div> 
            </div>
            <div class="form-group row">       
                <label class="col-sm-2 col-form-label">Nomor Induk Siswa Negara (NISN) <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="nisn" value="<?php echo $nisn; ?>">
                </div> 
            </div> 
            <div class="form-group row">       
                <label class="col-sm-2 col-form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <select class="form-control" id="sel1" name="jenis_kelamin">
                        <option value="L" <?php if($jenis_kelamin == "L"){echo "selected";} ?> >Laki-laki</option>
                        <option value="P" <?php if($jenis_kelamin == "P"){echo "selected";} ?> >Perempuan</option>
                    </select>
                </div> 
            </div>
            <div class="form-group row">       
                <label class="col-sm-2 col-form-label">Kelas <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <select class="form-control" id="sel1" name="kelas_id">
                        <?php
                            $query = mysqli_query($koneksi, "SELECT kelas.*,jurusan.*
                            FROM kelas 
                            JOIN jurusan 
                            ON kelas.jurusan_id=jurusan.jurusan_id
                            ORDER BY kelas_id ASC");
                            while($row=mysqli_fetch_assoc($query)){
                                if($kelas_id == $row['kelas_id']){
                                    echo "<option value='$row[kelas_id]' selected 'true'>$row[tingkat_kelas] $row[kode_jurusan] $row[tipe_kelas]</option>";
                                }else{
                                    echo "<option value='$row[kelas_id]'>$row[tingkat_kelas] $row[kode_jurusan] $row[tipe_kelas]</option>";
                                }
                            }
                        ?>
                    </select>
                </div> 
            </div>
            <br>
            <input type="submit" class="btn login-form__btn submit w-100" name="button" value="<?php echo $button; ?>" />                                               
        </form>
    </div>
</div>
                            