<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    $querypelanggaran = mysqli_query($koneksi, "SELECT * FROM pelanggaran");

?>
<div class="card-body">
    <h4 class="card-title">Data Pelanggaran</h4><hr>
    <a href="#" class="btn mb-1 btn-info btn-md float-right fa fa-plus" style="margin: 5px;" id="btnTambah" data-toggle="modal" data-target="#modalTambah" role="button"></a>
    <a href="index.php?page=import-pelanggaran" class="btn mb-1 btn-warning btn-md float-right text-white" style="margin: 5px;">Impor</a>        

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover zero-configuration">
                <thead>
                    <tr class="text-center">
                        <th width="20px">No</th>
                        <th>Nama Pelanggaran</th> 
                        <th width="125px">Poin Pelanggaran</th>                          
                        <th width="90px">Action</th>                           
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        while($row=mysqli_fetch_assoc($querypelanggaran)) {

                            $pelanggaran_id = $row['pelanggaran_id'];
                                           
                            echo "<tr>
                                <td>$no</td>
                                <td>$row[nama_pelanggaran]</td>
                                <td class='text-center'>$row[poin_pelanggaran]</td>
                                <td>
                                    <a  class='btn mb-1 btn-info btn-md fa fa-pencil getUbah' href='#' id='$pelanggaran_id'></a>
                                    <a  class='btn mb-1 btn-danger btn-md fa fa-trash btnHapus' href='#' id='$pelanggaran_id'></a>
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
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Input Data Pelanggaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambah">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Pelanggaran</label>
                            <input type="text" class="form-control" id="nama_pelanggaran" name="nama_pelanggaran" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Poin Pelanggaran</label>
                            <input type="text" class="form-control" id="poin_pelanggaran" name="poin_pelanggaran" autocomplete="off">
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
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Data Pelanggaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="formUbah">
                        <div class="modal-body">

                            <input type="hidden" class="form-control" id="pelanggaran_id" name="pelanggaran_id" autocomplete="off" readonly>

                            <div class="form-group">
                                <label>Nama Pelanggaran</label>
                                <input type="text" class="form-control" id="nama_pelanggaran1" name="nama_pelanggaran1" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Poin Pelanggaran</label>
                                <input type="text" class="form-control" id="poin_pelanggaran1" name="poin_pelanggaran1" autocomplete="off">
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
        if ($('#nama_pelanggaran').val()==""){
                    $( "#nama_pelanggaran" ).focus();
                    swal("Peringatan!", "Nama Pelanggaran tidak boleh kosong", "warning");
                }
                else if ($('#poin_pelanggaran').val()==""){
                    $( "#poin_pelanggaran" ).focus();
                    swal("Peringatan!", "Poin Pelanggaran tidak boleh kosong", "warning");
                }
                
                else{
                    var data = $('#formTambah').serialize();
                    $.ajax({
                        type : "POST",
                        url  : "./module/pelanggaran/proses-simpan.php",
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
        var pelanggaran_id = $(this).attr("id");
        $.ajax({
                    type : "GET",
                    url  : "./module/pelanggaran/get-pelanggaran.php",
                    data : {pelanggaran_id:pelanggaran_id},
                    dataType : "JSON",
                    success: function(result){
                        $('#modalUbah').modal('show');
                        $('#pelanggaran_id').val(result.pelanggaran_id);
                        $('#nama_pelanggaran1').val(result.nama_pelanggaran);
                        $('#poin_pelanggaran1').val(result.poin_pelanggaran);
                        console.log(result);

                    }
                });
    });

    document.getElementById('btnUbah').addEventListener("click", function(){
        if ($('#nama_pelanggaran1').val()==""){
                    $( "#nama_pelanggaran1" ).focus();
                    swal("Peringatan!", "Nama Pelanggaran tidak boleh kosong", "warning");
                }
                else if ($('#poin_pelanggaran1').val()==""){
                    $( "#poin_pelanggaran1" ).focus();
                    swal("Peringatan!", "Poin Pelanggaran tidak boleh kosong", "warning");
                }
                
                else{
                    var data = $('#formUbah').serialize();
                    $.ajax({
                        type : "POST",
                        url  : "./module/pelanggaran/proses-ubah.php",
                        data : data,
                        success: function(result){ 
                            console.log(result);                        
                            if (result==="sukses") {
                                $('#modalUbah').modal('hide');
                                swal("Sukses!", "Data Jurusan berhasil dirubah.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data Jurusan tidak bisa dirubah.", "error");
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
            var pelanggaran_id = $(this).attr("id");
            
            swal({
                    title: "Apakah Anda Yakin?",
                    text: "Akan menghapus data pelanggaran ini",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Hapus!",
                    closeOnConfirm: false
                }, 
                function () {
                    $.ajax({
                        type : "POST",
                        url  : "./module/pelanggaran/proses-hapus.php",
                        data : {pelanggaran_id:pelanggaran_id},
                        success: function(result){                          
                            if (result==="sukses") {
                                swal("Sukses!", "Data pelanggaran berhasil dihapus.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data pelanggaran tidak bisa dihapus.", "error");
                                setTimeout(() => window.location.reload(), 1000);
                            }
                        }
                    });
                });
        });
    }

</script>
