<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    $querytahap = mysqli_query($koneksi,"SELECT * FROM tahap_tindak");

    $resultRowTahap = mysqli_fetch_all($querytahap, MYSQLI_ASSOC);

    $queryskala = mysqli_query($koneksi, "SELECT * FROM skala_sikap");

    $resultRowSkala = mysqli_fetch_all($queryskala, MYSQLI_ASSOC);

    $tingkat_k="";
    $tipe_k="";
    $kode_j="";
    if(isset($_POST['search'])){
        $tingkat_k = $_POST['tingkat_kelas'];
        $tipe_k = $_POST['tipe_kelas'];
        $kode_j = $_POST['jurusan_id'];
    }

?>
<div class="card-body">
    <h4 class="card-title">Status Siswa</h4>
        <div>
            <form method="POST">  
                <div class="col-md-auto">
                
                    <select class="form-control-sm" id="tingkat_kelas" name="tingkat_kelas">
                        <option value="">Tingkat Kelas</option>
                        <option value="10" <?php if($tingkat_k == "10"){echo "selected";} ?> >10</option>
                        <option value="11" <?php if($tingkat_k == "11"){echo "selected";} ?> >11</option>
                        <option value="12" <?php if($tingkat_k == "12"){echo "selected";} ?> >12</option>
                    </select>
                
                    <select class="form-control-sm" id="sel1" name="jurusan_id">
                        <option value="">Kode Jurusan</option>

                            <?php
                                $query = mysqli_query($koneksi, "SELECT jurusan.*, kelas.*
                                FROM jurusan 
                                LEFT OUTER JOIN kelas ON jurusan.jurusan_id=kelas.jurusan_id
                                WHERE kelas.user_id='$user_id'
                                GROUP BY jurusan.kode_jurusan ASC");
                                while($row=mysqli_fetch_assoc($query)){
                                    if($kode_j == $row['jurusan_id']){
                                        echo "<option value='$row[jurusan_id]' selected 'true'>$row[kode_jurusan]</option>";
                                    }else{
                                        echo "<option value='$row[jurusan_id]'>$row[kode_jurusan]</option>";
                                    }
                                }
                            ?>
                    </select>

                    <select class="form-control-sm" id="tipe_kelas" name="tipe_kelas">
                        <option value="">Tipe Kelas</option>
                        <option value="1" <?php if($tipe_k == "1"){echo "selected";} ?> >1</option>
                        <option value="2" <?php if($tipe_k == "2"){echo "selected";} ?> >2</option>
                        <option value="3" <?php if($tipe_k == "3"){echo "selected";} ?> >3</option>
                    </select>

                    <button class="btn btn-outline-warning" name="search">Filter</button>
                </div> 
            </form> 
        </div>

        <div class="table-responsive">
            <table class="table table-bordered zero-configuration">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Poin Pelanggaran Siswa</th>                          
                        <th>Skala Sikap</th>                        
                        <th>Status</th>
                        <th>Tindakan</th>                       
                        <th>Action</th>                           
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $tingkat_k = '%'. $tingkat_k .'%';
                        $tipe_k = '%'. $tipe_k .'%';
                        $kode_j = '%'. $kode_j .'%';

                        $querysiswa = "SELECT siswa.*,kelas.*, jurusan.* FROM siswa
                        JOIN kelas ON siswa.kelas_id=kelas.kelas_id 
                        JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id
                        WHERE kelas.tingkat_kelas LIKE ? AND kelas.tipe_kelas LIKE ? AND jurusan.jurusan_id LIKE ? AND kelas.user_id='$user_id'
                        ORDER BY siswa.siswa_id ASC";

                        $siswa = $koneksi->prepare($querysiswa);
                        $siswa->bind_param('sss',$tingkat_k,$tipe_k,$kode_j);
                        $siswa->execute();
                        $res = $siswa->get_result();

                        $no=1;
                        $skala="";
                        $tahap="";
                        if($res->num_rows > 0){
                            while ($row = $res->fetch_assoc()){

                            $siswa_id = $row['siswa_id'];
                            
                            $poin_pelanggaran_siswa=$row['poin_pelanggaran_siswa'];
                            $poin = $poin_pelanggaran_siswa;
                            
                            for ($i = 0; $i < count($resultRowSkala); $i++){
                                if ($poin >= $resultRowSkala[$i]['poin_minimal'] && $poin <= $resultRowSkala[$i]['poin_maksimal']) {
                                    $skala = $resultRowSkala[$i]['skala'];
                                    break;
                                }
                            }

                            for ($i = 0; $i < count($resultRowTahap); $i++){
                                if ($poin >= $resultRowTahap[$i]['poin_awal'] && $poin <= $resultRowTahap[$i]['poin_akhir']) {
                                    $tahap = $resultRowTahap[$i]['tahap'];
                                    $keterangan = $resultRowTahap[$i]['keterangan'];
                                    $warna = $resultRowTahap[$i]['warna'];
                                    break;
                                }
                            }

                            echo "<tr bgcolor='".$warna."'>
                            <td>$no</td>
                            <td>$row[nama_siswa]</td>
                            <td>$row[tingkat_kelas] $row[kode_jurusan] $row[tipe_kelas]</td>
                            <td class='text-center'>$poin_pelanggaran_siswa</td>
                            <td class='text-center'>$skala</td>
                            <td>$tahap</td>
                            <td class='text-center'><input id='".$siswa_id."' onclick='onChangeTindakan(".$siswa_id.")' type='checkbox'"; if($row['tindakan'] == 1 ){echo 'checked';} echo "></td>
                            <td>";
                            
                            ?>
                                    <a  class="btn mb-1 btn-info btn-sm fa fa-eye" data-toggle="modal" href="#edit<?php echo $row['siswa_id']; ?>"></a>
                                    <div class="modal fade" id="edit<?php echo $row['siswa_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Detail</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                
                                                <div class="modal-body">
                                                <?php
                                                    $siswa_id = $row['siswa_id'];
                                                    $nama_siswa = $row['nama_siswa'];
                                                    $jk = $row['jenis_kelamin'];
                                                    $nis = $row['nis'];
                                                    $tingkat = $row['tingkat_kelas'];
                                                    $kode = $row['kode_jurusan'];
                                                    $tipe = $row['tipe_kelas'];
                                                    $poin_pelanggaran_siswa=$row['poin_pelanggaran_siswa'];
                                                    $poin = $poin_pelanggaran_siswa;
                                                    $skala;
                                                    $tahap;
                                                    if($row['tindakan'] == 0){
                                                        $tindakan = "Belum ditindak";
                                                    }else{
                                                        $tindakan = "Sudah ditindak";
                                                    }
                                                ?>
                                                    <form>
                                                        <div class="form-group">
                                                            <label class="col-lg-2">Nama Siswa</label>
                                                            <label> : </label>
                                                            <label class="col-lg-auto"><?php echo $nama_siswa; ?></label>                                                
                                                        </div> 
                                                        <div class="form-group">
                                                            <label class="col-lg-2">Kelas</label>
                                                            <label> : </label>
                                                            <label class="col-lg-auto"><?php echo "$tingkat $kode $tipe"; ?></label>                                                
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-2">Poin</label>
                                                            <label> : </label>
                                                            <label class="col-lg-auto"><?php echo $poin; ?></label>                                                
                                                        </div> 
                                                        <div class="form-group">
                                                            <label class="col-lg-2">Skala Sikap</label>
                                                            <label> : </label>
                                                            <label class="col-lg-auto"><?php echo $skala; ?></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-2">Status Siswa</label>
                                                            <label> : </label>
                                                            <label class="col-lg-auto"><?php echo $tahap; ?></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-2">Tindakan</label>
                                                            <label> : </label>
                                                            <label class="col-lg-auto"><?php echo $tindakan; ?></label>
                                                        </div>

                                                        <div class="form-group">
                                                            <h4 class="col-lg-12 text-center">Catatan Pelanggaran</h4> 
                                                    
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
                                                    </form>
                                                </div>
                                                <!-- selesai konten dinamis -->
                                                <!-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>       
                                <?php
                                echo '</td> 
                            </tr>';                   
                            $no++;
                        }
                    }else{

                    }
                    ?>
                </tbody>             
            </table>
        </div>
</div>
<script>
    function onChangeTindakan(siswa_id) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange  = function() {
            if (this.readyState == 4 && this.status == 200) {
                swal("Sukses!", "Tindakan untuk siswa berhasil dirubah", "success");

                setTimeout(() => window.location.reload(), 1000);
            }
        };

        xhr.open('POST', 'updateTindakan.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(`siswa_id=${siswa_id}&status=${status}`);

    }
</script>