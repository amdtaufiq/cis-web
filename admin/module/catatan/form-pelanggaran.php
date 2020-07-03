<?php

    include_once("function/koneksi.php");
    include_once("function/helper.php");
    
    
    $querytahap = mysqli_query($koneksi,"SELECT * FROM tahap_tindak");

    $resultRowTahap = mysqli_fetch_all($querytahap, MYSQLI_ASSOC);

    $queryskala = mysqli_query($koneksi, "SELECT * FROM skala_sikap");

    $resultRowSkala = mysqli_fetch_all($queryskala, MYSQLI_ASSOC);

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
    
    $poin_pelanggaran_siswa = $row['poin_pelanggaran_siswa'];
    $nama_siswa = $row['nama_siswa'];
    $tingkat = $row['tingkat_kelas'];
    $kode = $row['kode_jurusan'];
    $tipe = $row['tipe_kelas'];
    
    for ($i = 0; $i < count($resultRowSkala); $i++){
        if ($poin_pelanggaran_siswa >= $resultRowSkala[$i]['poin_minimal'] && $poin_pelanggaran_siswa <= $resultRowSkala[$i]['poin_maksimal']) {
            $skala = $resultRowSkala[$i]['skala'];
            break;
        }
    }
    for ($i = 0; $i < count($resultRowTahap); $i++){
        if ($poin_pelanggaran_siswa >= $resultRowTahap[$i]['poin_awal'] && $poin_pelanggaran_siswa <= $resultRowTahap[$i]['poin_akhir']) {
            $tahap = $resultRowTahap[$i]['tahap'];
            break;
        }
    }
  }

?>

<div class="card-body">
    <h4 class="card-title">Data Siswa</h4>
    <div class="basic-form">
        <form action="<?php echo BASE_URL."module/catatan/action-pelanggaran.php"; ?>" id="comment_form" method="POST" enctype="multipart/form-data">
          
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Poin Pelanggaran Siswa</th>
                            <th>Skala</th>
                            <th>Nama Siswa</th>                          
                            <th>Kelas</th>                        
                            <th>Tahap</th>  
                            <th class="text-center">Histori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $poin_pelanggaran_siswa; ?></td>
                            <td><?php echo $skala; ?></td>
                            <td><?php echo $nama_siswa; ?></td>                          
                            <td><?php echo $tingkat." ".$kode." ".$tipe; ?></td>                        
                            <td><?php echo $tahap; ?></td>
                            <td class="text-center">
                                <a  class="btn mb-1 btn-info btn-sm fa fa-eye" data-toggle="modal" href="#edit<?php echo $row['siswa_id']; ?>"></a>
                                <div class="modal fade" id="edit<?php echo $row['siswa_id']; ?>" target="_blank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Histori Catatan Pelanggaran</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="table-responsive">
                                                        <table class="table header-border">
                                                            <thead>
                                                                <tr class="table-danger">
                                                                    <th style="width: 150px; text-align: center;">Tanggal</th>
                                                                    <th style="width: 50px; text-align: center;">Waktu</th>
                                                                    <th style="text-align: center;">Catatan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    $queryCatatanPelanggaran = mysqli_query($koneksi,"SELECT catatan_poin_pelanggaran.*, pelanggaran.* FROM catatan_poin_pelanggaran
                                                                    JOIN pelanggaran ON catatan_poin_pelanggaran.pelanggaran_id=pelanggaran.pelanggaran_id
                                                                    WHERE catatan_poin_pelanggaran.siswa_id='$siswa_id'");

                                                                    if (mysqli_num_rows($queryCatatanPelanggaran) > 0) {
                                                                        while ($roww=mysqli_fetch_assoc($queryCatatanPelanggaran)) {
                                                                            $tanggal = date("d F Y", strtotime($roww['tanggal_pelanggaran']));
                                                                            $waktu = date("H:i", strtotime($roww['tanggal_pelanggaran']));
                                                                            $catatanPelanggaran = $roww['nama_pelanggaran'];
                                                                             
                                                                            ?>
                                                          
                                                                            <tr class="table-danger">
                                                                                <td><?php echo $tanggal; ?></td>
                                                                                <td><?php echo $waktu; ?></td>
                                                                                <td><?php echo $catatanPelanggaran; ?></td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }else{
                                                                        ?>
                                                                            <tr class="table-danger" style="text-align: center;">
                                                                                <td colspan='3'>Tidak terdapat catatan pelanggaran</td>
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
                <label class="col-sm-2 col-form-label">Pelanggaran </label>
                <div class="col-lg-10">
                    <select class="form-control" id="sel1" name="pelanggaran_id">
                        <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM pelanggaran ORDER BY nama_pelanggaran ASC");
                            while($row=mysqli_fetch_assoc($query)){
                                echo "<option value='$row[pelanggaran_id]'>$row[nama_pelanggaran] ($row[poin_pelanggaran] Poin)</option>";
                            }
                        ?>
                    </select>
                </div> 
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Catatan </label>
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

    