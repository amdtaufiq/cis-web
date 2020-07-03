<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    // $querKelas = mysqli_query($koneksi, "SELECT * FROM kelas");
    $querKelas = mysqli_query($koneksi, "SELECT kelas.*,jurusan.kode_jurusan FROM kelas JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id
    ORDER BY kelas.kelas_id ASC");

?>
<div class="card-body">
    <h4 class="card-title">Data Kelas</h4><hr>
    <a href="#" class="btn mb-1 btn-info btn-md float-right fa fa-plus" style="margin: 5px;" id="btnTambah" data-toggle="modal" data-target="#modalTambah" role="button"></a>
    <a href="index.php?page=import-kelas" class="btn mb-1 btn-warning btn-md float-right text-white" style="margin: 5px;">Impor</a>

        <div class="table-responsive">
            <table class="table table-striped table-bordered zero-configuration">
                <thead>
                    <tr>
                        <th width="20px">No</th>
                        <th width="55px">Kelas</th>                        
                        <th>Nama Wali Kelas</th>
                        <th width="150px">Nomor Wali Kelas</th>                           
                        <th width="90px">Action</th>                           
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        while($row=mysqli_fetch_assoc($querKelas)) {

                            $kelas_id = $row['kelas_id'];
                                           
                            echo "<tr>
                                <td>$no</td>
                                <td>$row[tingkat_kelas] $row[kode_jurusan] $row[tipe_kelas]</td>
                                <td>$row[nama_wali_kelas]</td>
                                <td>$row[nomor_wali_kelas]</td>
                                <td>
                                    <a  class='btn mb-1 btn-info btn-md fa fa-pencil getUbah' href='#' id='$kelas_id'></a>
                                    <a  class='btn mb-1 btn-danger btn-md fa fa-trash btnHapus' href='#' id='$kelas_id'></a>
                                </td>	
                            </tr>
                            ";
                                                    
                            $no++;
                        }
                    ?>
                </tbody>                          
            </table>
        </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Input Data Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambah">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Wali Kelas</label>
                            <input type="text" class="form-control" id="nama_wali_kelas" name="nama_wali_kelas" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Nomor Wali Kelas</label>
                            <input type="text" class="form-control" id="nomor_wali_kelas" name="nomor_wali_kelas" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Tingkat Kelas</label>
                            <select class="form-control" id="tingkat_kelas" name="tingkat_kelas">
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jurusan</label>
                            <select class="form-control" id="jurusan_id" name="jurusan_id">
                                <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY kode_jurusan ASC");
                                    while($row=mysqli_fetch_assoc($query)){
                                        echo "<option value='$row[jurusan_id]'>$row[kode_jurusan] ($row[nama_jurusan])</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tipe Kelas</label>
                            <select class="form-control" id="tipe_kelas" name="tipe_kelas">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Guru BK</label>
                            <select class="form-control" id="user_id" name="user_id">
                                <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE level='Guru BK'");
                                    while($row=mysqli_fetch_assoc($query)){
                                        echo "<option value='$row[user_id]'>$row[nama_user]</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-submit" id="btnSimpan">Simpan</button>
                            <button type="button" class="btn btn-danger btn-reset" data-dismiss="modal">Batal</button>
                        </div>
                    </div>    
                </form>
            </div>
    </div>
</div>

<div class="modal fade" id="modalUbah" tabindex="-1" role="dialog" aria-labelledby="modalUbah" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Data Kelas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="formUbah">
                        <div class="modal-body">

                            <input type="hidden" class="form-control" id="kelas_id" name="kelas_id" autocomplete="off" readonly>

                            <div class="form-group">
                            <label>Nama Wali Kelas</label>
                            <input type="text" class="form-control" id="nama_wali_kelas1" name="nama_wali_kelas1" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Nomor Wali Kelas</label>
                            <input type="text" class="form-control" id="nomor_wali_kelas1" name="nomor_wali_kelas1" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Tingkat Kelas</label>
                            <select class="form-control" id="tingkat_kelas1" name="tingkat_kelas1">
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jurusan</label>
                            <select class="form-control" id="jurusan_id1" name="jurusan_id1">
                                <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY kode_jurusan ASC");
                                    while($row=mysqli_fetch_assoc($query)){
                                        echo "<option value='$row[jurusan_id]'>$row[kode_jurusan] ($row[nama_jurusan])</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tipe Kelas</label>
                            <select class="form-control" id="tipe_kelas1" name="tipe_kelas1">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Guru BK</label>
                            <select class="form-control" id="user_id1" name="user_id1">
                                <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE level='Guru BK'");
                                    while($row=mysqli_fetch_assoc($query)){
                                        echo "<option value='$row[user_id]'>$row[nama_user]</option>";
                                    }
                                ?>
                            </select>
                        </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-submit" id="btnUbah">Ubah</button>
                                <button type="button" class="btn btn-danger btn-reset" data-dismiss="modal">Batal</button>
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div>

<script type="text/javascript">

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
                        $('#nomor_wali_kelas1').val(result.nomor_wali_kelas);
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
                                swal("Sukses!", "Data kelas berhasil dirubah.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data kelas tidak bisa dirubah.", "error");
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




