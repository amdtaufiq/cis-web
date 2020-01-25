<?php
	include_once("function/koneksi.php");
	include_once("function/helper.php");

	$skala_sikap_id = isset ($_GET['skala_sikap_id']) ? $_GET['skala_sikap_id'] : false;
	
	if($skala_sikap_id) {
		$queryskala_sikap = mysqli_query($koneksi, "SELECT * FROM skala_sikap WHERE skala_sikap_id='$skala_sikap_id'");
        $row = mysqli_fetch_assoc($queryskala_sikap);
        
        $skala_sikap_id = $row['skala_sikap_id'];
        $skala = $row['skala'];
        $poin_minimal = $row['poin_minimal'];
        $poin_maksimal = $row['poin_maksimal'];
		$button = "PERBAHARUI";
	} else{
        $skala = "";
        $poin_minimal = "";
        $poin_maksimal = "";
        $button = "TAMBAH";
    }

?>

<div class="card-body">
    <h4 class="card-title">Tambah Skala Sikap</h4>
    <div class="basic-form">
    <form action="<?php echo BASE_URL."module/skala-sikap/action.php?skala_sikap_id=$skala_sikap_id"; ?>" method="POST">    
            <div class="form-group row">       
                <label class="col-sm-2 col-form-label">Skala <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <select class="form-control" id="sel1" name="skala">
                        <option>-Pilih Skala-</option>
                        <option value="A" <?php if($skala == "A"){echo "selected";} ?> >A</option>
                        <option value="AB" <?php if($skala == "AB"){echo "selected";} ?> >AB</option>
                        <option value="B" <?php if($skala == "B"){echo "selected";} ?> >B</option>
                        <option value="BC" <?php if($skala == "BC"){echo "selected";} ?> >BC</option>
                        <option value="C" <?php if($skala == "C"){echo "selected";} ?> >C</option>
                        <option value="D" <?php if($skala == "D"){echo "selected";} ?> >D</option>
                        <option value="E" <?php if($skala == "E"){echo "selected";} ?> >E</option>
                    </select>
                </div> 
            </div>         
            <div class="form-group row">                
                <label class="col-sm-2 col-form-label">Poin Minimal <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="poin_minimal" value="<?php echo $poin_minimal; ?>">
                </div> 
            </div>
            <div class="form-group row">       
                <label class="col-sm-2 col-form-label">Poin Maksimal <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="poin_maksimal" value="<?php echo $poin_maksimal; ?>">
                    <br>
                    <input type="submit" class="btn login-form__btn submit w-100" name="button" value="<?php echo $button; ?>" />
                </div> 
            </div>                                    
        </form>
    </div>
</div>
                            