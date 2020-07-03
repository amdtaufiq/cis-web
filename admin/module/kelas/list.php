<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    // $querKelas = mysqli_query($koneksi, "SELECT * FROM kelas");
    $querKelas = mysqli_query($koneksi, "SELECT kelas.*,jurusan.*, user.* FROM kelas 
    JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id
    JOIN user ON kelas.user_id=user.user_id
    ORDER BY kelas.kelas_id ASC");

?>
<div class="card-body">
    <h4 class="card-title">Data Kelas</h4><hr>
    <a href="#" class="btn mb-1 btn-info btn-md float-right fa fa-plus" style="margin: 5px;" id="btnTambah" data-toggle="modal" data-target="#modalTambah" role="button"></a>
    <a href="index.php?page=import-kelas" class="btn mb-1 btn-warning btn-md float-right text-white" style="margin: 5px;">Impor</a>

        <div class="table-responsive">
            <table class="table table-striped table-bordered zero-configuration">
                <thead>
                    <tr class='text-center'>
                        <th width="5%">No</th>
                        <th width="37%">Nama Wali Kelas</th>
                        <th width="15%">Kelas</th>                        
                        <th width="25%">Guru BK</th>                           
                        <th width="12%">Status</th>                           
                        <th width="6%">Action</th>                           
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        while($row=mysqli_fetch_assoc($querKelas)) {

                            $kelas_id = $row['kelas_id'];
                                           
                            echo "<tr>
                                <td class='text-center'>$no</td>
                                <td>$row[nama_wali_kelas]</td>
                                <td>$row[tingkat_kelas] $row[kode_jurusan] $row[tipe_kelas]</td>
                                <td>$row[nama_user]</td>
                                <td>
                                <input id='".$kelas_id."' style='margin-right:10px;' onclick='onChangeTindakan(".$kelas_id.")' type='checkbox'"; if($row['status_kelas'] == 1 ){echo 'checked';} echo ">";
                                if($row['status_kelas']==1){echo "Aktif";}else{echo "Non-aktif";}
                                echo "
                                </td>
                                <td class='text-center'>
                                    <a  class='btn mb-1 btn-info btn-md fa fa-pencil getUbah' href='#' id='$kelas_id'></a>
                                </td>	
                            </tr>
                            ";
                                                    
                            $no++;
                        }
                    ?>
                    <!--<a  class='btn mb-1 btn-danger btn-md fa fa-trash btnHapus' href='#' id='$kelas_id'></a>-->
                </tbody>                          
            </table>
        </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Data Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambah">
                    <div class="modal-body">
                        <div class="form-group col-lg-12">
                            <label>Nama Wali Kelas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_wali_kelas" name="nama_wali_kelas" autocomplete="off" autocomplete="off" onkeypress="return event.charCode < 48 || event.charCode > 57">
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Tingkat Kelas <span class="text-danger">*</span></label>
                            <select class="form-control" id="tingkat_kelas" name="tingkat_kelas">
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Jurusan <span class="text-danger">*</span></label>
                            <select class="form-control" id="jurusan_id" name="jurusan_id">
                                <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE status_jurusan=1 ORDER BY kode_jurusan ASC");
                                    while($row=mysqli_fetch_assoc($query)){
                                        echo "<option value='$row[jurusan_id]'>$row[kode_jurusan] ($row[nama_jurusan])</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Tipe Kelas <span class="text-danger">*</span></label>
                            <select class="form-control" id="tipe_kelas" name="tipe_kelas">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Guru BK <span class="text-danger">*</span></label>
                            <select class="form-control" id="user_id" name="user_id">
                                <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE level='Guru BK' AND status_user=1");
                                    while($row=mysqli_fetch_assoc($query)){
                                        echo "<option value='$row[user_id]'>$row[nama_user]</option>";
                                    }
                                ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formUbah">
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="kelas_id" name="kelas_id" autocomplete="off" readonly>

                    <div class="form-group col-lg-12">
                    <label>Nama Wali Kelas <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_wali_kelas1" name="nama_wali_kelas1" autocomplete="off" autocomplete="off" onkeypress="return event.charCode < 48 || event.charCode > 57">
                </div>

                <div class="form-group col-lg-12">
                    <label>Tingkat Kelas <span class="text-danger">*</span></label>
                    <select class="form-control" id="tingkat_kelas1" name="tingkat_kelas1">
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>

                <div class="form-group col-lg-12">
                    <label>Jurusan <span class="text-danger">*</span></label>
                    <select class="form-control" id="jurusan_id1" name="jurusan_id1">
                        <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE status_jurusan=1 ORDER BY kode_jurusan ASC");
                            while($row=mysqli_fetch_assoc($query)){
                                echo "<option value='$row[jurusan_id]'>$row[kode_jurusan] ($row[nama_jurusan])</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group col-lg-12">
                    <label>Tipe Kelas <span class="text-danger">*</span></label>
                    <select class="form-control" id="tipe_kelas1" name="tipe_kelas1">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <div class="form-group col-lg-12">
                    <label>Guru BK <span class="text-danger">*</span></label>
                    <select class="form-control" id="user_id1" name="user_id1">
                        <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM user WHERE level='Guru BK' AND status_user=1");
                            while($row=mysqli_fetch_assoc($query)){
                                echo "<option value='$row[user_id]'>$row[nama_user]</option>";
                            }
                        ?>
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

    function onChangeTindakan(kelas_id) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange  = function() {
            if (this.readyState == 4 && this.status == 200) {
                // swal("Sukses!", "Status siswa berhasil diubah", "success");
                setTimeout(() => window.location.reload());
            }
        };

        xhr.open('POST', './module/kelas/update-status.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(`kelas_id=${kelas_id}`);

    }

    document.getElementById('btnSimpan').addEventListener("click", function(){
        if ($('#nama_wali_kelas').val()==""){
            $( "#nama_wali_kelas" ).focus();
            swal("Peringatan!", "Nama Wali Kelas tidak boleh kosong", "warning");
        }                
        else{
            var data = $('#formTambah').serialize();
                $.ajax({
                    type : "POST",
                    url  : "./module/kelas/proses-simpan.php",
                    data : data,
                    success: function(result){ 
                    console.log(result);                        
                        if (result==="sukses") {
                            $('#modalTambah').modal('hide');
                            swal("Sukses!", "Data Kelas berhasil disimpan", "success");
                            setTimeout(() => window.location.reload(), 1000);
                        } else {
                            swal("Gagal!", "Data Kelas tidak bisa disimpan", "error");
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
        var kelas_id = $(this).attr("id");
        $.ajax({
                    type : "GET",
                    url  : "./module/kelas/get-kelas.php",
                    data : {kelas_id:kelas_id},
                    dataType : "JSON",
                    success: function(result){
                        $('#modalUbah').modal('show');
                        $('#kelas_id').val(result.kelas_id);
                        $('#nama_wali_kelas1').val(result.nama_wali_kelas);
                        $('#tingkat_kelas1').val(result.tingkat_kelas);
                        $('#jurusan_id1').val(result.jurusan_id);
                        $('#tipe_kelas1').val(result.tipe_kelas);
                        $('#user_id1').val(result.user_id);
                    }
                });
    });

    document.getElementById('btnUbah').addEventListener("click", function(){
        if ($('#nama_wali_kelas1').val()==""){
            $( "#nama_wali_kelas1" ).focus();
            swal("Peringatan!", "Nama Wali Kelas tidak boleh kosong", "warning");
        }     
        else{
                    var data = $('#formUbah').serialize();
                    $.ajax({
                        type : "POST",
                        url  : "./module/kelas/proses-ubah.php",
                        data : data,
                        success: function(result){ 
                            console.log(result);                        
                            if (result==="sukses") {
                                $('#modalUbah').modal('hide');
                                swal("Sukses!", "Data kelas berhasil diubah.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data kelas tidak bisa diubah.", "error");
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
            var kelas_id = $(this).attr("id");
            
            swal({
                    title: "Apakah Anda Yakin?",
                    text: "Akan menghapus data Kelas ini",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Hapus!",
                    closeOnConfirm: false
                }, 
                function () {
                    $.ajax({
                        type : "POST",
                        url  : "./module/kelas/proses-hapus.php",
                        data : {kelas_id:kelas_id},
                        success: function(result){                          
                            if (result==="sukses") {
                                swal("Sukses!", "Data Kelas berhasil dihapus.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data Kelas tidak bisa dihapus.", "error");
                                setTimeout(() => window.location.reload(), 1000);
                            }
                        }
                    });
                });
        });
    }

</script>




