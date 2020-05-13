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
    
    $poin_pelanggaran_siswa = $row['poin_pelanggaran_siswa'];
    $nama_siswa = $row['nama_siswa'];
    $tingkat = $row['tingkat_kelas'];
    $kode = $row['kode_jurusan'];
    $tipe = $row['tipe_kelas'];
  }

?>

  <div class="card-body">
    <h4 class="card-title">Data Siswa</h4>
    <div class="basic-form">
    <form action="<?php echo BASE_URL."module/catatan/action-pelanggaran.php"; ?>" id="comment_form" method="POST">
      
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Poin Pelanggaran Siswa</th>
                        <th>Skala</th>
                        <th>Nama Siswa</th>                          
                        <th>Kelas</th>                        
                        <th>Status</th>                         
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $poin_pelanggaran_siswa; ?></td>
                        <td>#</td>
                        <td><?php echo $nama_siswa; ?></td>                          
                        <td><?php echo $tingkat." ".$kode." ".$tipe; ?></td>                        
                        <td>#</td>                         
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
        <br>
        <input type="submit" class="btn login-form__btn submit w-100" name="button" value="TAMBAH"/>                                               
    </form>
    </div>

    