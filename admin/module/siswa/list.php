<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php"); 
    
    $tingkat_k="";
    $tipe_k="";
    $kode_j="";
    if(isset($_POST['search'])){
        $tingkat_k = $_POST['tingkat_kelas'];
        $tipe_k = $_POST['tipe_kelas'];
        $kode_j = $_POST['jurusan_id'];
    }

    $page = isset($_GET['page']) ? $_GET['page'] : false;

?>

<div class="card-body">
    <h4 class="card-title">Data Siswa</h4><hr>    

    <div>
        <form method="POST">  
            <div class="col-md-auto">
                <a href="#" class="btn mb-1 btn-info btn-md float-right fa fa-plus" id="btnTambah" data-toggle="modal" data-target="#modalTambah" role="button"></a>
                <a href="index.php?page=import-siswa" class="btn mb-1 btn-warning btn-md float-right text-white" style="margin-right: 5px;">Impor</a>

                <select class="form-control-sm" id="tingkat_kelas" name="tingkat_kelas">
                    <option value="">Tingkat Kelas</option>
                    <option value="10" <?php if($tingkat_k == "10"){echo "selected";} ?> >10</option>
                    <option value="11" <?php if($tingkat_k == "11"){echo "selected";} ?> >11</option>
                    <option value="12" <?php if($tingkat_k == "12"){echo "selected";} ?> >12</option>
                </select>
            
                 <select class="form-control-sm" id="sel1" name="jurusan_id">
                    <option value="">Kode Jurusan</option>

                        <?php
                            $query = mysqli_query($koneksi, "SELECT jurusan_id, kode_jurusan, nama_jurusan
                            FROM jurusan 
                            ORDER BY kode_jurusan ASC");
                            while($row=mysqli_fetch_assoc($query)){
                                if($kode_j == $row['jurusan_id']){
                                    echo "<option value='$row[jurusan_id]' selected 'true'>$row[kode_jurusan]</option>";
                                }else{
                                    echo "<option value='$row[jurusan_id]'>$row[kode_jurusan]</option>";
                                }
                            }
                        ?>
                </select>

                <select class="form-control-sm" id="tipe_kelas" name="tipe_kelas">
                    <option value="">Tipe Kelas</option>
                    <option value="1" <?php if($tipe_k == "1"){echo "selected";} ?> >1</option>
                    <option value="2" <?php if($tipe_k == "2"){echo "selected";} ?> >2</option>
                    <option value="3" <?php if($tipe_k == "3"){echo "selected";} ?> >3</option>
                </select>

                <button class="btn btn-outline-warning" name="search">Filter</button>

            </div> 
        </form> 
    </div>
    <div class="basic-dropdown">
        <div class="dropdown bootstrap-modal">            
           
            <!-- PopUp Import -->
            <div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role = "document">
                    <div class="modal-content">
                        <div class="modal-header">                                    
                            <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL."module/siswa/action-import.php"; ?>">
                                <div class="form-group">
                                    <label class="col-lg-12 col-form-label">Pilih File <span class="text-danger">*</span></label>
                                    <input class="col-lg-12" name="data" type="file" required="required">        
                                                                     
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-sm login-form__btn submit" name="upload" value="Import" />                                                           

                                </div>
                            </form>
                        </div>
                                
                        <div class="modal-footer">     
                        </div>
                    </div>
                </div>
            </div>
            <!-- PopUp Import Over -->
        </div>
    </div> 
    
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered zero-configuration">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">Kelas</th>  
                    <th width="10%">Poin Pelanggaran</th>
                    <th width="10%">NIS</th>                        
                    <th width="48%">Nama Siswa</th>                          
                    <th width="5%">JK</th>                        
                    <th width="12%">Action</th>                           
                </tr>
            </thead>
            <tbody>
                <?php
                    $tingkat_k = '%'. $tingkat_k .'%';
                    $tipe_k = '%'. $tipe_k .'%';
                    $kode_j = '%'. $kode_j .'%';

                    $no=1;
                    $query = "SELECT siswa.*,kelas.*, jurusan.* 
                                FROM siswa
                                JOIN kelas ON siswa.kelas_id=kelas.kelas_id 
                                JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id
                                WHERE kelas.tingkat_kelas LIKE ? AND kelas.tipe_kelas LIKE ? AND jurusan.jurusan_id LIKE ? ORDER BY siswa.kelas_id ASC";
                                
                    $siswa = $koneksi->prepare($query);
                    $siswa->bind_param('sss',$tingkat_k,$tipe_k,$kode_j);
                    $siswa->execute();
                    $res = $siswa->get_result();


                    if($res->num_rows > 0){
                        while ($row = $res->fetch_assoc()){
                            $siswa_id = $row['siswa_id'];
                            $poin_pelanggaran_siswa = $row['poin_pelanggaran_siswa'];
                            $nama_siswa = $row['nama_siswa'];
                            $nis = $row['nis'];
                            $tingkat = $row['tingkat_kelas'];
                            $kode = $row['kode_jurusan'];
                            $tipe = $row['tipe_kelas'];
                            $jk = $row['jenis_kelamin'];

                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo "$tingkat $kode $tipe"; ?></td>
                                <td><?php echo $poin_pelanggaran_siswa; ?></td>
                                <td><?php echo $nis; ?></td>
                                <td><?php echo $nama_siswa; ?></td>
                                <td><?php echo $jk; ?></td>
                                <td>
                                    <a  class='btn mb-1 btn-info btn-md fa fa-pencil getUbah' href='#' id='<?php echo $siswa_id; ?>'></a>       
                                    <a  class='btn mb-1 btn-danger btn-md fa fa-trash btnHapus' href='#' id='<?php echo $siswa_id; ?>'></a>
                                       
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            
                        }

                        ?>
                </tbody>                          
            </table>
        </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambah">
                    <div class="modal-body">  

                        <div class="form-group col-lg-12">
                            <label>Kelas <span class="text-danger">*</span></label>
                            <select class="form-control" id="kelas_id" name="kelas_id">
                            <?php
                                $query = mysqli_query($koneksi, "SELECT kelas.*,jurusan.* FROM kelas 
                                JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id
                                ORDER BY kelas_id ASC");
                                while($row=mysqli_fetch_assoc($query)){
                                    echo "<option value='$row[kelas_id]'>$row[tingkat_kelas] $row[kode_jurusan] $row[tipe_kelas]</option>";
                                }
                            ?>
                            </select>
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Nama Siswa <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" autocomplete="off" autocomplete="off" onkeypress="return event.charCode < 48 || event.charCode > 57">
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Nomor Induk Siswa (NIS) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nis" name="nis" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Poin Pelanggaran Siswa <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="poin_pelanggaran_siswa" name="poin_pelanggaran_siswa" autocomplete="off" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>                        

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-reset" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary btn-submit" id="btnSimpan">Simpan</button>
                        </div>
                    </div>    
                </form>
            </div>
    </div>
</div>

<div class="modal fade" id="modalUbah" tabindex="-1" role="dialog" aria-labelledby="modalUbah" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formUbah">
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="siswa_id" name="siswa_id" autocomplete="off" readonly>

                    <div class="form-group col-lg-12">
                        <label>Kelas <span class="text-danger">*</span></label>
                        <select class="form-control" id="kelas_id1" name="kelas_id1">
                        <?php
                            $query = mysqli_query($koneksi, "SELECT kelas.*,jurusan.* FROM kelas 
                            JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id
                            ORDER BY kelas_id ASC");
                            while($row=mysqli_fetch_assoc($query)){
                                echo "<option value='$row[kelas_id]'>$row[tingkat_kelas] $row[kode_jurusan] $row[tipe_kelas]</option>";
                            }
                        ?>
                        </select>
                    </div>

                    <div class="form-group col-lg-12">
                        <label>Nama Siswa <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_siswa1" name="nama_siswa1" autocomplete="off" onkeypress="return event.charCode < 48 || event.charCode > 57">
                    </div>

                    <div class="form-group col-lg-12">
                        <label>Nomor Induk Siswa (NIS) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nis1" name="nis1" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                    </div>

                    <div class="form-group col-lg-12">
                        <label>Poin Pelanggaran Siswa <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="poin_pelanggaran_siswa1" name="poin_pelanggaran_siswa1" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                    </div>                    

                    <div class="form-group col-lg-12">
                        <label>Jenis Kelamin <span class="text-danger">*</span></label>
                        <select class="form-control" id="jenis_kelamin1" name="jenis_kelamin1">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>                    

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-reset" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btn-submit" id="btnUbah">Ubah</button>
                    </div>
                </div>    
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

    document.getElementById('btnSimpan').addEventListener("click", function(){
        if ($('#poin_pelanggaran_siswa').val()==""){
            $( "#poin_pelanggaran_siswa" ).focus();
            swal("Peringatan!", "Poin pelanggaran siswa tidak boleh kosong", "warning");
        } 
        else if ($('#nama_siswa').val()==""){
            $( "#nama_siswa" ).focus();
            swal("Peringatan!", "Nama siswa tidak boleh kosong", "warning");
        }
        else if ($('#nis').val()==""){
            $( "#nis" ).focus();
            swal("Peringatan!", "Nomor Induk Siswa (NIS) tidak boleh kosong", "warning");
        }               
        else{
            var data = $('#formTambah').serialize();
                $.ajax({
                    type : "POST",
                    url  : "./module/siswa/proses-simpan.php",
                    data : data,
                    success: function(result){ 
                    console.log(result);                        
                        if (result==="sukses") {
                            $('#modalTambah').modal('hide');
                            swal("Sukses!", "Data siswa berhasil disimpan", "success");
                            setTimeout(() => window.location.reload(), 1000);
                        } else {
                            swal("Gagal!", "Data siswa tidak bisa disimpan", "error");
                            setTimeout(() => window.location.reload(), 1000);
                        }
                    }
                });
                return false;
        }
    });

    var userSelection = document.getElementsByClassName('getUbah');
    

    for(let i = 0; i < userSelection.length; i++) {
    userSelection[i].addEventListener("click", function() {
        var siswa_id = $(this).attr("id");
        $.ajax({
                    type : "GET",
                    url  : "./module/siswa/get-siswa.php",
                    data : {siswa_id:siswa_id},
                    dataType : "JSON",
                    success: function(result){
                        console.log(result);
                        $('#modalUbah').modal('show');
                        $('#siswa_id').val(result.siswa_id);
                        $('#poin_pelanggaran_siswa1').val(result.poin_pelanggaran_siswa);
                        $('#nama_siswa1').val(result.nama_siswa);
                        $('#nis1').val(result.nis);
                        $('#jenis_kelamin1').val(result.jenis_kelamin);
                        $('#kelas_id1').val(result.kelas_id);

                    }
                });
    });

    document.getElementById('btnUbah').addEventListener("click", function(){
        if ($('#poin_pelanggaran_siswa1').val()==""){
            $( "#poin_pelanggaran_siswa1" ).focus();
            swal("Peringatan!", "Poin pelanggaran siswa tidak boleh kosong", "warning");
        } 
        else if ($('#nama_siswa1').val()==""){
            $( "#nama_siswa1").focus();
            swal("Peringatan!", "Nama siswa tidak boleh kosong", "warning");
        }
        else if ($('#nis1').val()==""){
            $( "#nis1").focus();
            swal("Peringatan!", "Nomor Induk Siswa (NIS) tidak boleh kosong", "warning");
        }    
        else{
                    var data = $('#formUbah').serialize();
                    $.ajax({
                        type : "POST",
                        url  : "./module/siswa/proses-ubah.php",
                        data : data,
                        success: function(result){ 
                            console.log(result);                        
                            if (result==="sukses") {
                                $('#modalUbah').modal('hide');
                                swal("Sukses!", "Data siswa berhasil diubah.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data siswa tidak bisa diubah.", "error");
                                setTimeout(() => window.location.reload(), 1000);
                            }
                        }
                    });
                    return false;
                }
        });
    }

    var userSelection = document.getElementsByClassName('btnHapus');

    for(let i = 0; i < userSelection.length; i++) {
        userSelection[i].addEventListener("click", function() {
            var siswa_id = $(this).attr("id");
            
            swal({
                    title: "Apakah Anda Yakin?",
                    text: "Akan menghapus data siswa ini",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Hapus!",
                    closeOnConfirm: false
                }, 
                function () {
                    $.ajax({
                        type : "POST",
                        url  : "./module/siswa/proses-hapus.php",
                        data : {siswa_id:siswa_id},
                        success: function(result){                          
                            if (result==="sukses") {
                                swal("Sukses!", "Data siswa berhasil dihapus.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data siswa tidak bisa dihapus.", "error");
                                setTimeout(() => window.location.reload(), 1000);
                            }
                        }
                    });
                });
        });
    }

</script>