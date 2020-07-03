<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    $queryskalasikap = mysqli_query($koneksi, "SELECT * FROM skala_sikap");

?>
<div class="card-body">
    <h4 class="card-title">Data Skala Sikap</h4><hr>
    <a href="#" class="btn mb-1 btn-info btn-md float-right fa fa-plus" style="margin: 5px;" id="btnTambah" data-toggle="modal" data-target="#modalTambah" role="button" ></a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover zero-configuration">
                <thead>
                    <tr class="text-center">
                        <th width="20px">No</th>
                        <th width="150px" class="text-center">Skala</th> 
                        <th width="150px" class="text-center">Poin Minimal</th>                          
                        <th width="150px" class="text-center">Poin Maksimal</th>                          
                        <th width="90px">Action</th>                           
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        while($row=mysqli_fetch_assoc($queryskalasikap)) {

                            $skala_sikap_id = $row['skala_sikap_id'];
                                           
                            echo "<tr>
                                <td class='text-center'>$no</td>
                                <td class='text-center'>$row[skala]</td>
                                <td class='text-center'>$row[poin_minimal]</td>
                                <td class='text-center'>$row[poin_maksimal]</td>
                                <td class='text-center'>
                                    <a  class='btn mb-1 btn-info btn-md fa fa-pencil getUbah' href='#' id='$skala_sikap_id'></a>
                                    <a  class='btn mb-1 btn-danger btn-md fa fa-trash btnHapus' href='#' id='$skala_sikap_id'></a>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Input Data Skala Sikap</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambah">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Skala</label>
                            <input type="text" class="form-control" id="skala" name="skala" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Poin Minimal</label>
                            <input type="text" class="form-control" id="poin_minimal" name="poin_minimal" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Poin Maksimal</label>
                            <input type="text" class="form-control" id="poin_maksimal" name="poin_maksimal" autocomplete="off">
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
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Data Jurusan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="formUbah">
                        <div class="modal-body">

                            <input type="hidden" class="form-control" id="skala_sikap_id" name="skala_sikap_id" autocomplete="off" readonly>

                            <div class="form-group">
                                <label>Skala</label>
                                <input type="text" class="form-control" id="skala1" name="skala1" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Poin Minimal</label>
                                <input type="text" class="form-control" id="poin_minimal1" name="poin_minimal1" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Poin Maksimal</label>
                                <input type="text" class="form-control" id="poin_maksimal1" name="poin_maksimal1" autocomplete="off">
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
        if ($('#skala').val()==""){
                    $( "#skala" ).focus();
                    swal("Peringatan!", "Skala tidak boleh kosong", "warning");
                }
                else if ($('#poin_minimal').val()==""){
                    $( "#poin_minimal" ).focus();
                    swal("Peringatan!", "Poin Minimal tidak boleh kosong", "warning");
                }
                else if ($('#poin_maksimal').val()==""){
                    $( "#poin_maksimal" ).focus();
                    swal("Peringatan!", "Poin Maksimal tidak boleh kosong", "warning");
                }
                
                else{
                    var data = $('#formTambah').serialize();
                    $.ajax({
                        type : "POST",
                        url  : "./module/skala-sikap/proses-simpan.php",
                        data : data,
                        success: function(result){ 
                            console.log(result);                        
                            if (result==="sukses") {
                                $('#modalTambah').modal('hide');
                                swal("Sukses!", "Data skala berhasil disimpan", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data skala tidak bisa disimpan", "error");
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
        var skala_sikap_id = $(this).attr("id");
        $.ajax({
                    type : "GET",
                    url  : "./module/skala-sikap/get-skala.php",
                    data : {skala_sikap_id:skala_sikap_id},
                    dataType : "JSON",
                    success: function(result){
                        $('#modalUbah').modal('show');
                        $('#skala_sikap_id').val(result.skala_sikap_id);
                        $('#skala1').val(result.skala);
                        $('#poin_minimal1').val(result.poin_minimal);
                        $('#poin_maksimal1').val(result.poin_maksimal);
                        console.log(result);

                    }
                });
    });

    document.getElementById('btnUbah').addEventListener("click", function(){
        if ($('#skala1').val()==""){
                    $( "#skala1" ).focus();
                    swal("Peringatan!", "Skala tidak boleh kosong", "warning");
                }
                else if ($('#poin_minimal1').val()==""){
                    $( "#poin_minimal1" ).focus();
                    swal("Peringatan!", "Poin Minimal tidak boleh kosong", "warning");
                }
                else if ($('#poin_maksimal1').val()==""){
                    $( "#poin_maksimal1" ).focus();
                    swal("Peringatan!", "Poin Maksimal tidak boleh kosong", "warning");
                }
                
                else{
                    var data = $('#formUbah').serialize();
                    $.ajax({
                        type : "POST",
                        url  : "./module/skala-sikap/proses-ubah.php",
                        data : data,
                        success: function(result){ 
                            console.log(result);                        
                            if (result==="sukses") {
                                $('#modalUbah').modal('hide');
                                swal("Sukses!", "Data Skala berhasil dirubah.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data Skala tidak bisa dirubah.", "error");
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
            var skala_sikap_id = $(this).attr("id");
            
            swal({
                    title: "Apakah Anda Yakin?",
                    text: "Akan menghapus data Skala ini",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Hapus!",
                    closeOnConfirm: false
                }, 
                function () {
                    $.ajax({
                        type : "POST",
                        url  : "./module/skala-sikap/proses-hapus.php",
                        data : {skala_sikap_id:skala_sikap_id},
                        success: function(result){                          
                            if (result==="sukses") {
                                swal("Sukses!", "Data Skala berhasil dihapus.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data Skala tidak bisa dihapus.", "error");
                                setTimeout(() => window.location.reload(), 1000);
                            }
                        }
                    });
                });
        });
    }

</script>
