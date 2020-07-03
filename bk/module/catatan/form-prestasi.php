<?php

    include_once("function/koneksi.php");
    include_once("function/helper.php");
    

  if(isset($_POST['submit'])){
    $data = $_POST['search'];
    $sql = "SELECT siswa.*, kelas.*, jurusan.* FROM siswa
    JOIN kelas ON siswa.kelas_id=kelas.kelas_id 
    JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id
    WHERE siswa.nama_siswa = '$data'";
    $result = $koneksi->query($sql);
    $row = $result->fetch_assoc();

    $siswa_id = $row['siswa_id'];
    $_SESSION['siswa_id'] = $siswa_id;
    $nama_siswa = $row['nama_siswa'];
    $tingkat = $row['tingkat_kelas'];
    $kode = $row['kode_jurusan'];
    $tipe = $row['tipe_kelas'];
    $nis = $row['nis'];
    
  }

?>

<div class="card-body">
    <h4 class="card-title">Data Siswa</h4>
    <div class="basic-form">
        <form action="<?php echo BASE_URL."module/catatan/action-prestasi.php"; ?>" id="comment_form" method="POST" enctype="multipart/form-data">
          
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>                          
                            <th>NIS</th>                        
                            <th>Kelas</th>   
                            <th class="text-center">Histori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $nama_siswa; ?></td>                          
                            <td><?php echo $nis; ?></td>                          
                            <td><?php echo $tingkat." ".$kode." ".$tipe; ?></td>    
                            <td class="text-center">
                                <a  class="btn mb-1 btn-info btn-sm fa fa-eye" data-toggle="modal" href="#edit<?php echo $row['siswa_id']; ?>"></a>
                                <div class="modal fade" id="edit<?php echo $row['siswa_id']; ?>" target="_blank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Histori Catatan Prestasi</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <h4 class="col-lg-12 text-center">Catatan Prestasi</h4> 
                                            
                                                    <div class="table-responsive">
                                                        <table class="table header-border">
                                                            <thead>
                                                                <tr class="table-primary">
                                                                    <th style="width: 150px; text-align: center;">Tanggal</th>
                                                                    <th style="width: 50px; text-align: center;">Waktu</th>
                                                                    <th style="text-align: center;">Catatan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    $queryCatatanPrestasi = mysqli_query($koneksi,"SELECT * FROM catatan_prestasi
                                                                    WHERE catatan_prestasi.siswa_id='$siswa_id'");

                                                                    if (mysqli_num_rows($queryCatatanPrestasi) > 0) {
                                                                        while ($roww=mysqli_fetch_assoc($queryCatatanPrestasi)) {
                                                                            $tanggal = date("d F Y", strtotime($roww['tanggal_prestasi']));
                                                                            $waktu = date("H:i", strtotime($roww['tanggal_prestasi']));
                                                                            $catatanprestasi = $roww['nama_prestasi'];
                                                                             
                                                                            ?>
                                                          
                                                                            <tr class="table-primary">
                                                                                <td><?php echo $tanggal; ?></td>
                                                                                <td><?php echo $waktu; ?></td>
                                                                                <td><?php echo $catatanprestasi; ?></td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }else{
                                                                        ?>
                                                                            <tr class="table-primary" style="text-align: center;">
                                                                                <td colspan='3'>Tidak terdapat catatan prestasi</td>
                                                                            </tr>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                            </tbody>           
                                                        </table>                                        
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Keterangan </label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="info" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Bukti </label>
                <div class="col-lg-10">
                    <input type="file" class="form-control" name="bukti" autocomplete="off">
                </div>
            </div>
            <input type="submit" class="btn login-form__btn submit w-100" name="button" value="TAMBAH"/>                                               
        </form>
    </div>
    </div>

    