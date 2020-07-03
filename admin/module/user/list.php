<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    $querUser = mysqli_query($koneksi, "SELECT user.*, mapel.* FROM user
    JOIN mapel ON user.mapel_id=mapel.mapel_id");

?>
<div class="card-body">
    <h4 class="card-title">Data Pengguna</h4><hr>
    <a href="#" class="btn mb-1 btn-info btn-md float-right fa fa-plus" id="btnTambah" data-toggle="modal" data-target="#modalTambah" role="button" ></a>
    <a href="index.php?page=import-user" class="btn mb-1 btn-warning btn-md float-right text-white" style="margin-right: 5px;">Impor</a>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover zero-configuration">
            <thead>
                <tr class='text-center'>
                    <th width="5%">No</th>
                    <th width="20%">Nama Lengkap</th>
                    <th width="13%">Kode Guru</th>
                    <th width="13%">Kode Mapel</th>
                    <th width="14%">Username</th>   
                    <th width="14%">Level User</th>          
                    <th width="12%">Status</th>                           
                    <th width="6%">Action</th>                           
                </tr>
            </thead>
            <tbody>
                <?php
                    $no=1;
                    while($row=mysqli_fetch_assoc($querUser)) {
                        
                        $user_id = $row['user_id'];
                        
                        if($user_id == "130"){
                            continue;
                        }

                        
                                           
                        echo "<tr>
                            <td class='text-center'>$no</td>
                            <td>$row[nama_user]</td>
                            <td>$row[nip]</td>
                            <td>$row[kode_mapel]</td>
                            <td>$row[username]</td>
                            <td>$row[level]</td>
                            <td>
                            <input id='".$user_id."' style='margin-right:10px;' onclick='onChangeTindakan(".$user_id.")' type='checkbox'"; if($row['status_user'] == 1 ){echo 'checked';} echo ">";
                            if($row['status_user']==1){echo "Aktif";}else{echo "Non-aktif";}
                            echo "
                            </td>
                            <td class='text-center'>
                                <button  class='btn mb-1 btn-info btn-md fa fa-pencil getUbah' href='#' id='$user_id' ></button>
                            </td>	
                        </tr>";                    
                        $no++;
                    }
                ?>
                <!--<button  class='btn mb-1 btn-danger btn-md fa fa-trash btnHapus' href='#' id='$user_id' disabled value='true'></button>-->
            </tbody>                          
        </table>
    </div>
</div>
                        
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Data Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTambah">
                <div class="modal-body">
                    <div class="form-group col-lg-12">
                        <label class="col-form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user" autocomplete="off" onkeypress="return event.charCode < 48 || event.charCode > 57">
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="col-form-label">Kode Guru <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nip" name="nip" autocomplete="off">
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="col-form-label">Mata Pelajaran<span class="text-danger">*</span></label>
                        <select class="form-control" id="mapel_id" name="mapel_id">
                            <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM mapel WHERE status=1");
                                while($row=mysqli_fetch_assoc($query)){
                                    echo "<option value='$row[mapel_id]'>$row[kode_mapel]($row[nama_mapel])</option>";
                                }
                            ?>
                        </select>                                
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="col-form-label">Username<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" name="username" autocomplete="off">
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="col-form-label">Password<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="off">
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="col-form-label">Level<span class="text-danger">*</span></label>
                        <select class="form-control" id="level" name="level">
                            <option value="Guru BK">Guru BK</option>
                            <option value="Guru Mapel">Guru Mapel</option>
                            <option value="Admin">Admin</option>
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
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formUbah">
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="user_id" name="user_id" autocomplete="off" onkeyup="manage(this)" readonly>

                    <div class="form-group col-lg-12">
                        <label class="col-form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_user1" name="nama_user1" autocomplete="off" onkeypress="return event.charCode < 48 || event.charCode > 57">
                    </div>

                    <div class="form-group col-lg-12">
                        <label>Kode Guru <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nip1" name="nip1" autocomplete="off">
                    </div>
                    
                    <div class="form-group col-lg-12">
                        <label>Mapel <span class="text-danger">*</span></label>
                        <select class="form-control" id="mapel_id1" name="mapel_id1">
                            <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM mapel WHERE status=1");
                                while($row=mysqli_fetch_assoc($query)){
                                    echo "<option value='$row[mapel_id]'>$row[kode_mapel]($row[nama_mapel])</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-lg-12">
                        <label>Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username1" name="username1" autocomplete="off">
                    </div>

                    <div class="form-group col-lg-12">
                        <label>Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password1" name="password1" autocomplete="off">
                    </div>

                    <div class="form-group col-lg-12">
                        <label>Level <span class="text-danger">*</span></label>
                        <select class="form-control" id="level1" name="level1" >
                            <option value="Guru BK">Guru BK</option>
                            <option value="Guru Mapel">Guru Mapel</option>
                            <option value="Admin">Admin</option>
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

    function onChangeTindakan(user_id) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange  = function() {
            if (this.readyState == 4 && this.status == 200) {
                // swal("Sukses!", "Status siswa berhasil diubah", "success");
                setTimeout(() => window.location.reload());
            }
        };

        xhr.open('POST', './module/user/update-status.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(`user_id=${user_id}`);

    }

    function manage(user_id) {
        var level = document.getElementById('level1');
        if (user_id.value == '130') {
            console.log('TRUE')
            level.disabled = true;
        }
        else {
            level.disabled = false;
            console.log('FALSE')
        }
    }

    document.getElementById('btnSimpan').addEventListener("click", function(){
        if ($('#nama_user').val()==""){
            $( "#nama_user" ).focus();
            swal("Peringatan!", "Nama lengkap tidak boleh kosong", "warning");
        }
        else if ($('#nip').val()==""){
            $( "#nip" ).focus();
            swal("Peringatan!", "NIP tidak boleh kosong", "warning");
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
                            if(result==="sama"){
                                swal("Gagal!", "Kode pengguna sudah terdaftar", "error");
                            } else if (result==="sukses") {
                                $('#modalTambah').modal('hide');
                                swal("Sukses!", "Data pengguna berhasil disimpan", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data pengguna tidak bisa disimpan", "error");
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
                        $('#mapel_id1').val(result.mapel_id);
                        $('#nip1').val(result.nip);
                        $('#username1').val(result.username);
                        $('#level1').val(result.level);
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
                            if(result==="sama"){
                                swal("Gagal!", "Kode pengguna sudah terdaftar", "error");
                            } else if (result==="sukses") {
                                $('#modalUbah').modal('hide');
                                swal("Sukses!", "Data pengguna berhasil diubah.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data pengguna tidak bisa diubah.", "error");
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
                    text: "Akan menghapus data pengguna ini",
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
                                swal("Sukses!", "Data pengguna berhasil dihapus.", "success");
                                setTimeout(() => window.location.reload(), 1000);
                            } else {
                                swal("Gagal!", "Data pengguna tidak bisa dihapus.", "error");
                                setTimeout(() => window.location.reload(), 1000);
                            }
                        }
                    });
                });
        });
    }

</script>




