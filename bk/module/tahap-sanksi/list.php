<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    $query = mysqli_query($koneksi, "SELECT * FROM tahap_tindak");

?>
<div class="card-body">
    <h4 class="card-title">Data Tahap Tindak Siswa</h4><hr>
    <a href="#" class="btn mb-1 btn-info btn-md float-right fa fa-plus" style="margin: 5px;" id="btnTambah" data-toggle="modal" data-target="#modalTambah" role="button"></a>
    <a href="index.php?page=import-tahap-sanksi" class="btn mb-1 btn-warning btn-md float-right text-white" style="margin: 5px;">Impor</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover zero-configuration">
                <thead>
                    <tr class="text-center">
                        <th width="20px">No</th>
                        <th>Tahap</th> 
                        <th>Keterangan</th> 
                        <th width="50px" class="text-center">Bobot Minimal Poin</th>                          
                        <th width="50px" class="text-center">Bobot Maksimal Poin</th>                          
                        <th width="90px" class="text-center">Action</th>                           
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        while($row=mysqli_fetch_assoc($query)) {

                            $tahap_id = $row['tahap_id'];
                                           
                            echo "<tr>
                                <td class='text-center'>$no</td>
                                <td>$row[tahap]</td>
                                <td>$row[keterangan]</td>
                                <td class='text-center'>$row[poin_awal]</td>
                                <td class='text-center'>$row[poin_akhir]</td>
                                <td class='text-center'>
                                    <a  class='btn mb-1 btn-info btn-md fa fa-pencil getUbah' href='#' id='$tahap_id'></a>
                                    <a  class='btn mb-1 btn-danger btn-md fa fa-trash btnHapus' href='#' id='$tahap_id'></a>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Input Data Tahap Tindak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambah">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tahap</label>
                            <input type="text" class="form-control" id="tahap" name="tahap" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Poin Awal</label>
                            <input type="text" class="form-control" id="poin_awal" name="poin_awal" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Poin Akhir</label>
                            <input type="text" class="form-control" id="poin_akhir" name="poin_akhir" autocomplete="off">
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
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Data Tahap Tindak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="formUbah">
                        <div class="modal-body">

                            <input type="hidden" class="form-control" id="tahap_id" name="tahap_id" autocomplete="off" readonly>

                            <div class="form-group">
                                <label>Tahap</label>
                                <input type="text" class="form-control" id="tahap1" name="tahap1" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" id="keterangan1" name="keterangan1" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Poin Awal</label>
                                <input type="text" class="form-control" id="poin_awal1" name="poin_awal1" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Poin Akhir</label>
                                <input type="text" class="form-control" id="poin_akhir1" name="poin_akhir1" autocomplete="off">
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
        if ($('#tahap').val()==""){
                    $( "#tahap" ).focus();
                    swal("Peringatan!", "Tahap tidak boleh kosong", "warning");
        }

        else if ($('#keterangan').val()==""){
                    $( "#keterangan" ).focus();
                    swal("Peringatan!", "Keterangan tidak boleh kosong", "warning");
                }
                else if ($('#poin_awal').val()==""){
                    $( "#poin_awal" ).focus();
                    swal("Peringatan!", "Poin Awal tidak boleh kosong", "warning");
                }
                else if ($('#poin_akhir').val()==""){
                    $( "#poin_akhir" ).focus();
                    swal("Peringatan!", "Poin Akhir tidak boleh kosong", "warning");
                }
                
                else{
                    var data = $('#formTambah').serialize();
                    $.ajax({
                        type : "POST",
                        url  : "./module/tahap-sanksi/proses-simpan.php",
                        data : data,
                        success: function(result){ 
                            console.log(result);                        
                            if (result==="sukses") {
                                $('#modalTambah').modal('hide');
                                swal("Sukses!", "Data tahap tindak berhasil disimpan", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data tahap tindak tidak bisa disimpan", "error");
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
        var tahap_id = $(this).attr("id");
        $.ajax({
                    type : "GET",
                    url  : "./module/tahap-sanksi/get-tahap.php",
                    data : {tahap_id:tahap_id},
                    dataType : "JSON",
                    success: function(result){
                        $('#modalUbah').modal('show');
                        $('#tahap_id').val(result.tahap_id);
                        $('#tahap1').val(result.tahap);
                        $('#keterangan1').val(result.keterangan);
                        $('#poin_awal1').val(result.poin_awal);
                        $('#poin_akhir1').val(result.poin_akhir);
                        console.log(result);

                    }
                });
    });

    document.getElementById('btnUbah').addEventListener("click", function(){
        if ($('#tahap1').val()==""){
                    $( "#tahap1" ).focus();
                    swal("Peringatan!", "Tahap tidak boleh kosong", "warning");
        }
        else if ($('#keterangan1').val()==""){
                    $( "#keterangan1" ).focus();
                    swal("Peringatan!", "Keterangan tidak boleh kosong", "warning");
                }
                else if ($('#poin_awal1').val()==""){
                    $( "#poin_awal1" ).focus();
                    swal("Peringatan!", "Poin Awal tidak boleh kosong", "warning");
                }
                else if ($('#poin_akhir1').val()==""){
                    $( "#poin_akhir1" ).focus();
                    swal("Peringatan!", "Poin Akhir tidak boleh kosong", "warning");
                }
                
                else{
                    var data = $('#formUbah').serialize();
                    $.ajax({
                        type : "POST",
                        url  : "./module/tahap-sanksi/proses-ubah.php",
                        data : data,
                        success: function(result){ 
                            console.log(result);                        
                            if (result==="sukses") {
                                $('#modalUbah').modal('hide');
                                swal("Sukses!", "Data tahap tindak berhasil dirubah.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data tahap tindak tidak bisa dirubah.", "error");
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
            var tahap_id = $(this).attr("id");
            
            swal({
                    title: "Apakah Anda Yakin?",
                    text: "Akan menghapus data tahap tindak ini",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Hapus!",
                    closeOnConfirm: false
                }, 
                function () {
                    $.ajax({
                        type : "POST",
                        url  : "./module/tahap-sanksi/proses-hapus.php",
                        data : {tahap_id:tahap_id},
                        success: function(result){                          
                            if (result==="sukses") {
                                swal("Sukses!", "Data tahap tindak berhasil dihapus.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data tahap tindak tidak bisa dihapus.", "error");
                                setTimeout(() => window.location.reload(), 1000);
                            }
                        }
                    });
                });
        });
    }

</script>
