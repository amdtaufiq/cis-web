<?php
	include_once("function/koneksi.php");
	include_once("function/helper.php");

	$user_id = isset ($_GET['user_id']) ? $_GET['user_id'] : false;
	
	if($user_id) {
		$queryUser = mysqli_query($koneksi, "SELECT * FROM user WHERE `user_id`='$user_id'");
        $row = mysqli_fetch_assoc($queryUser);
        
        $user_id = $row['user_id'];
        $nama_user = $row['nama_user'];
        $nip = $row['nip'];
        $nomor_telpon = $row['nomor_telpon'];
        $username = $row['username'];
        $password = $row['password'];
        $level = $row['level'];
		$button = "PERBAHARUI";
	} else{
        $nama_user = "";
        $nip = "";
        $nomor_telpon = "";
        $username = "";
        $password = "";
        $level = "";
        $button = "TAMBAH";
    }

?>

<div class="card-body">
    <h4 class="card-title">Tambah User</h4>
    <div class="basic-form">
    <form action="<?php echo BASE_URL."module/user/action.php?user_id=$user_id"; ?>" method="POST">    
            
            <div class="form-group row">                
                <label class="col-sm-2 col-form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="nama_user" value="<?php echo $nama_user; ?>">
                </div> 
            </div>
            
            <div class="form-group row">                
                <label class="col-sm-2 col-form-label">NIP <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="nip" value="<?php echo $nip; ?>">
                </div> 
            </div>
            
            <div class="form-group row">                
                <label class="col-sm-2 col-form-label">Nomor Telpon <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="nomor_telpon" value="<?php echo $nomor_telpon; ?>">
                </div> 
            </div>

            <div class="form-group row">                
                <label class="col-sm-2 col-form-label">Username <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                </div> 
            </div>

            <div class="form-group row">                
                <label class="col-sm-2 col-form-label">Password <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="password">
                </div> 
            </div>

            <div class="form-group row">       
                <label class="col-sm-2 col-form-label">Level User <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <select class="form-control" id="sel1" name="level">
                        <option>-Pilih level-</option>
                        <option value="Guru BK" <?php if($level == "Guru BK"){echo "selected";} ?> >Guru BK</option>
                        <option value="Guru Piket" <?php if($level == "Guru Piket"){echo "selected";} ?> >Guru Piket</option>
                    </select>
                    <br>
                    <input type="submit" class="btn login-form__btn submit w-100" name="button" value="<?php echo $button; ?>" />
                </div> 
            </div>                                    
        </form>
    </div>
</div>
                            