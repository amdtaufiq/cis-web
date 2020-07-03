<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    $querUser = mysqli_query($koneksi, "SELECT * FROM user");

?>
<div class="card-body">
    <h4 class="card-title">Data User</h4><hr>
    <a href="#" class="btn mb-1 btn-info btn-md float-right fa fa-plus" id="btnTambah" data-toggle="modal" data-target="#modalTambah" role="button" ></a>
    <a href="index.php?page=import-user" class="btn mb-1 btn-warning btn-md float-right text-white" style="margin-right: 5px;">Impor</a>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover zero-configuration">
            <thead>
                <tr>
                    <th>No</th>
                    <th width="125px">Nama Lengkap</th>
                    <th width="125px">NIP</th>
                    <th width="100px">Nomor Telpon</th>                           
                    <th width="50px">Username</th>   
                    <th width="100px">Level User</th>          
                    <th width="90px">Action</th>                           
                </tr>
            </thead>
            <tbody>
                <?php
                    $no=1;
                    while($row=mysqli_fetch_assoc($querUser)) {

                        $user_id = $row['user_id'];
                                           
                        echo "<tr>
                            <td>$no</td>
                            <td>$row[nama_user]</td>
                            <td>$row[nip]</td>
                            <td>$row[nomor_telpon]</td>
                            <td>$row[username]</td>
                            <td>$row[level]</td>
                            <td>
                                <a  class='btn mb-1 btn-info btn-md fa fa-pencil getUbah' href='#' id='$user_id'></a>
                                <a  class='btn mb-1 btn-danger btn-md fa fa-trash btnHapus' href='#' id='$user_id'></a>
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
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Input Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambah">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_user" name="nama_user" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" autocomplete="off">
                        </div>
                        
                        <div class="form-group">
                            <label>Nomor Telpon</label>
                            <input type="text" class="form-control" id="nomor_telpon" name="nomor_telpon" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" id="username" name="username" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Level</label>
                            <select class="form-control" id="level" name="level">
                                <option value="Guru BK">Guru BK</option>
                                <option value="Guru Piket">Guru Piket</option>
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
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Data Jurusan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="formUbah">
                        <div class="modal-body">

                            <input type="hidden" class="form-control" id="user_id" name="user_id" autocomplete="off" readonly>

                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_user1" name="nama_user1" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" class="form-control" id="nip1" name="nip1" autocomplete="off">
                            </div>
                            
                            <div class="form-group">
                                <label>Nomor Telpon</label>
                                <input type="text" class="form-control" id="nomor_telpon1" name="nomor_telpon1" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" id="username1" name="username1" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" id="password1" name="password1" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Level</label>
                                <select class="form-control" id="level1" name="level1">
                                    <option value="Guru BK">Guru BK</option>
                                    <option value="Guru Piket">Guru Piket</option>
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
        if ($('#nama_user').val()==""){
            $( "#nama_user" ).focus();
            swal("Peringatan!", "Nama lengkap tidak boleh kosong", "warning");
        }
        else if ($('#nip').val()==""){
            $( "#nip" ).focus();
            swal("Peringatan!", "NIP tidak boleh kosong", "warning");
        }
        else if ($('#nomor_telpon').val()==""){
            $( "#nomor_telpon" ).focus();
            swal("Peringatan!", "Nomor telpon tidak boleh kosong", "warning");
        }
        else if ($('#username').val()==""){
            $( "#username" ).focus();
            swal("Peringatan!", "Username tidak boleh kosong", "warning");
        }
        else if ($('#password').val()==""){
            $( "#password" ).focus();
            swal("Peringatan!", "Password tidak boleh kosong", "warning");
        }
                
        else{
                    var data = $('#formTambah').serialize();
                    $.ajax({
                        type : "POST",
                        url  : "./module/user/proses-simpan.php",
                        data : data,
                        success: function(result){ 
                            console.log(result);                        
                            if (result==="sukses") {
                                $('#modalTambah').modal('hide');
                                swal("Sukses!", "Data user berhasil disimpan", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data user tidak bisa disimpan", "error");
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
        var user_id = $(this).attr("id");
        $.ajax({
                    type : "GET",
                    url  : "./module/user/get-user.php",
                    data : {user_id:user_id},
                    dataType : "JSON",
                    success: function(result){
                        $('#modalUbah').modal('show');
                        $('#user_id').val(result.user_id);
                        $('#nama_user1').val(result.nama_user);
                        $('#nip1').val(result.nip);
                        $('#nomor_telpon1').val(result.nomor_telpon);
                        $('#username1').val(result.username);
                        // $('#password1').val(result.password);
                        $('#level1').val(result.level);
                        console.log(result);

                    }
                });
    });

    document.getElementById('btnUbah').addEventListener("click", function(){
        if ($('#nama_user1').val()==""){
            $( "#nama_user1" ).focus();
            swal("Peringatan!", "Nama lengkap tidak boleh kosong", "warning");
        }
        else if ($('#nip1').val()==""){
            $( "#nip1" ).focus();
            swal("Peringatan!", "NIP tidak boleh kosong", "warning");
        }
        else if ($('#nomor_telpon1').val()==""){
            $( "#nomor_telpon1" ).focus();
            swal("Peringatan!", "Nomor telpon tidak boleh kosong", "warning");
        }
        else if ($('#username1').val()==""){
            $( "#username1" ).focus();
            swal("Peringatan!", "Username tidak boleh kosong", "warning");
        }
        else if ($('#password1').val()==""){
            $( "#password1").focus();
            swal("Peringatan!", "Password tidak boleh kosong", "warning");
        }        
        else{
                    var data = $('#formUbah').serialize();
                    $.ajax({
                        type : "POST",
                        url  : "./module/user/proses-ubah.php",
                        data : data,
                        success: function(result){ 
                            console.log(result);                        
                            if (result==="sukses") {
                                $('#modalUbah').modal('hide');
                                swal("Sukses!", "Data user berhasil dirubah.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data user tidak bisa dirubah.", "error");
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
            var user_id = $(this).attr("id");
            
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
                        url  : "./module/user/proses-hapus.php",
                        data : {user_id:user_id},
                        success: function(result){                          
                            if (result==="sukses") {
                                swal("Sukses!", "Data user berhasil dihapus.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data user tidak bisa dihapus.", "error");
                                setTimeout(() => window.location.reload(), 1000);
                            }
                        }
                    });
                });
        });
    }

</script>




