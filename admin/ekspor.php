<?php
	include_once("function/koneksi.php");
    include_once("function/helper.php");
    
    $tingkat_k="";
    $tipe_k="";
    $kode_j="";
    if(isset($_POST['search'])){
        $tingkat_k = $_POST['tingkat_kelas'];
        $_SESSION['tingkat_kelas'] = $tingkat_k;
        $tipe_k = $_POST['tipe_kelas'];
        $_SESSION['tipe_kelas'] = $tipe_k;
        $kode_j = $_POST['jurusan_id'];
        $_SESSION['jurusan_id'] = $kode_j;
    }

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    $queryskala = mysqli_query($koneksi, "SELECT * FROM skala_sikap");

    $resultRowSkala = mysqli_fetch_all($queryskala, MYSQLI_ASSOC);

    $querytahap = mysqli_query($koneksi,"SELECT * FROM tahap_tindak");

    $resultRowTahap = mysqli_fetch_all($querytahap, MYSQLI_ASSOC);

?>

<div class="card-body">
    <h4 class="card-title">Ekspor Data Siswa</h4><br />
    <form method="POST" action="">
        <div class="col-md-auto">
            <a href="proses-ekspor.php" class="btn mb-1 btn-warning btn-md float-right text-white" style="margin-right: 5px;" name="search">Ekspor
                <span class="btn-icon-right">
                    <i class="fa fa-download"></i>
                </span>
            </a>
            
            <select class="form-control-sm" id="tingkat_kelas" name="tingkat_kelas">
                <option value="">Tingkat Kelas</option>
                <option value="10" <?php if($tingkat_k == "10"){echo "selected";} ?> >10</option>
                <option value="11" <?php if($tingkat_k == "11"){echo "selected";} ?> >11</option>
                <option value="12" <?php if($tingkat_k == "12"){echo "selected";} ?> >12</option>
            </select>

            <select class="form-control-sm" id="sel1" name="jurusan_id">
                <option value="">Kode Jurusan</option>

                    <?php
                        $query = mysqli_query($koneksi, "SELECT jurusan_id, kode_jurusan, nama_jurusan
                        FROM jurusan 
                        ORDER BY kode_jurusan ASC");
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
        <div class="table-responsive">
            <table class="table table-striped table-bordered zero-configuration">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>                        
                        <th>JK</th>                        
                        <th>Nama Siswa</th>                          
                        <th>Kelas</th>  
                        <th>Poin</th>
                        <th>Skala</th>
                        <th>Tahap</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $tingkat_k = '%'. $tingkat_k .'%';
                        $tipe_k = '%'. $tipe_k .'%';
                        $kode_j = '%'. $kode_j .'%';
                        $skala = "";
                        $tahap= "";
                        
                        $no=1;
                        $query = "SELECT siswa.*,kelas.*, jurusan.* 
                                    FROM siswa
                                    JOIN kelas ON siswa.kelas_id=kelas.kelas_id 
                                    JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id
                                    WHERE kelas.tingkat_kelas LIKE ? AND kelas.tipe_kelas LIKE ? AND jurusan.jurusan_id LIKE ? AND siswa.status_siswa=1
                                    ORDER BY siswa.nis ASC";
                                
                        $siswa = $koneksi->prepare($query);
                        $siswa->bind_param('sss',$tingkat_k,$tipe_k,$kode_j);
                        $siswa->execute();
                        $res = $siswa->get_result();


                        if($res->num_rows > 0){
                            while ($row = $res->fetch_assoc()){
                                $poin_pelanggaran_siswa = $row['poin_pelanggaran_siswa'];
                                $poin = $poin_pelanggaran_siswa ;
                                $nama_siswa = $row['nama_siswa'];
                                $nis = $row['nis'];
                                $tingkat = $row['tingkat_kelas'];
                                $kode = $row['kode_jurusan'];
                                $tipe = $row['tipe_kelas'];
                                $jk = $row['jenis_kelamin'];

                                for ($i = 0; $i < count($resultRowSkala); $i++){
                                    if ($poin >= $resultRowSkala[$i]['poin_minimal'] && $poin <= $resultRowSkala[$i]['poin_maksimal']) {
                                        $skala = $resultRowSkala[$i]['skala'];
                                        break;
                                    }
                                }

                                for ($i = 0; $i < count($resultRowTahap); $i++){
                                    if ($poin >= $resultRowTahap[$i]['poin_awal'] && $poin <= $resultRowTahap[$i]['poin_akhir']) {
                                        $tahap = $resultRowTahap[$i]['tahap'];
                                        break;
                                    }
                                }

                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $nis; ?></td>
                                    <td><?php echo $jk; ?></td>
                                    <td><?php echo $nama_siswa; ?></td>
                                    <td><?php echo "$tingkat $kode $tipe"; ?></td>
                                    <td><?php echo $poin; ?></td>
                                    <td><?php echo $skala; ?></td>
                                    <td><?php echo $tahap; ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            
                        }

                        ?>
                </tbody>                          
            </table>
        </div>
</div>


</div>
    