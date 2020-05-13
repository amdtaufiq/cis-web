<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    $queryjurusan = mysqli_query($koneksi, "SELECT * FROM jurusan");   

?>
<div class="card-body">
    <h4 class="card-title">Data Jurusan</h4><hr>
    <a href="#" class="btn mb-1 btn-info btn-md float-right fa fa-plus" style="margin: 5px;" id="btnTambah" data-toggle="modal" data-target="#modalTambah" role="button" ></a>
    <a href="index.php?page=import-jurusan" class="btn mb-1 btn-warning btn-md float-right text-white" style="margin: 5px;">Impor</a>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover zero-configuration">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="13%">Kode Jurusan</th>
                    <th width="70%">Nama Jurusan</th>                           
                    <th width="12%">Action</th>                           
                </tr>
            </thead>
            <tbody>
            <?php
                    $no=1;
                    while($row=mysqli_fetch_assoc($queryjurusan)) {

                        $jurusan_id = $row['jurusan_id'];
                                          
                        echo "<tr>
                            <td>$no</td>
                            <td>$row[kode_jurusan]</td>
                            <td>$row[nama_jurusan]</td>
                            <td>
                                <a  class='btn mb-1 btn-info btn-md fa fa-pencil getUbah' href='#' id='$jurusan_id'></a>
                                <a  class='btn mb-1 btn-danger btn-md fa fa-trash btnHapus' href='#' id='$jurusan_id'></a>
                            </td>   
                        </tr>";
                                      
                            $no++;
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
                    <h5 class="modal-title" id="exampleModalLabel">Input Data Jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambah">
                    <div class="modal-body">
                        <div class="form-group col-lg-12">
                            <label>Kode Jurusan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kode_jurusan" name="kode_jurusan" autocomplete="off" onkeypress="return event.charCode < 48 || event.charCode > 57" style="text-transform:uppercase">
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Nama Jurusan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" autocomplete="off" onkeypress="return event.charCode < 48 || event.charCode > 57">
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
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formUbah">
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="jurusan_id" name="jurusan_id" autocomplete="off" readonly>

                    <div class="form-group col-lg-12">
                        <label>Kode Jurusan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="kode_jurusan1" name="kode_jurusan1" autocomplete="off" onkeypress="return event.charCode < 48 || event.charCode > 57" style="text-transform:uppercase">
                    </div>

                    <div class="form-group col-lg-12">
                        <label>Nama Jurusan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_jurusan1" name="nama_jurusan1" autocomplete="off" onkeypress="return event.charCode < 48 || event.charCode > 57">
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
        if ($('#kode_jurusan').val()==""){
                    $( "#kode_jurusan" ).focus();
                    swal("Peringatan!", "Kode Jurusan tidak boleh kosong", "warning");
                }
                else if ($('#nama_jurusan').val()==""){
                    $( "#nama_jurusan" ).focus();
                    swal("Peringatan!", "Nama Jurusan tidak boleh kosong", "warning");
                }
                
                else{
                    var data = $('#formTambah').serialize();
                    $.ajax({
                        type : "POST",
                        url  : "./module/jurusan/proses-simpan.php",
                        data : data,
                        success: function(result){ 
                            console.log(result);                        
                            if (result==="sukses") {
                                $('#modalTambah').modal('hide');
                                swal("Sukses!", "Data Jurusan berhasil disimpan", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data Jurusan tidak bisa disimpan", "error");
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
        var jurusan_id = $(this).attr("id");
        $.ajax({
                    type : "GET",
                    url  : "./module/jurusan/get-jurusan.php",
                    data : {jurusan_id:jurusan_id},
                    dataType : "JSON",
                    success: function(result){
                        $('#modalUbah').modal('show');
                        $('#jurusan_id').val(result.jurusan_id);
                        $('#kode_jurusan1').val(result.kode_jurusan);
                        $('#nama_jurusan1').val(result.nama_jurusan);
                        console.log(result);

                    }
                });
    });

    document.getElementById('btnUbah').addEventListener("click", function(){
        if ($('#kode_jurusan1').val()==""){
                    $( "#kode_jurusan1" ).focus();
                    swal("Peringatan!", "Kode Jurusan tidak boleh kosong", "warning");
                }
                else if ($('#nama_jurusan1').val()==""){
                    $( "#nama_jurusan1" ).focus();
                    swal("Peringatan!", "Nama Jurusan tidak boleh kosong", "warning");
                }
                
                else{
                    var data = $('#formUbah').serialize();
                    $.ajax({
                        type : "POST",
                        url  : "./module/jurusan/proses-ubah.php",
                        data : data,
                        success: function(result){ 
                            console.log(result);                        
                            if (result==="sukses") {
                                $('#modalUbah').modal('hide');
                                swal("Sukses!", "Data Jurusan berhasil diubah.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data Jurusan tidak bisa diubah.", "error");
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
            var jurusan_id = $(this).attr("id");
            
            swal({
                    title: "Apakah Anda Yakin?",
                    text: "Akan menghapus data Jurusan ini",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Hapus!",
                    closeOnConfirm: false
                }, 
                function () {
                    $.ajax({
                        type : "POST",
                        url  : "./module/jurusan/proses-hapus.php",
                        data : {jurusan_id:jurusan_id},
                        success: function(result){                          
                            if (result==="sukses") {
                                swal("Sukses!", "Data Jurusan berhasil dihapus.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data Jurusan tidak bisa dihapus.", "error");
                                setTimeout(() => window.location.reload(), 1000);
                            }
                        }
                    });
                });
        });
    }

</script>
