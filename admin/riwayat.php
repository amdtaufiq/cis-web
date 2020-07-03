<?php

    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $tingkat_k="";
    $tipe_k="";
    $kode_j="";
    if(isset($_POST['search'])){
        $tingkat_k = $_POST['tingkat_kelas'];
        $tipe_k = $_POST['tipe_kelas'];
        $kode_j = $_POST['jurusan_id'];
    }

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    $queryskala = mysqli_query($koneksi, "SELECT * FROM skala_sikap");

    $resultRowSkala = mysqli_fetch_all($queryskala, MYSQLI_ASSOC);

?>

<style>

.tab {
  overflow: hidden;
}

.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

.tab button:hover {
  background-color: #ddd;
}

.tab button.active {
  background-color: #7571f9;
  color: #FFFFFF;
}

.tabcontent {
  display: none;
  padding: 6px 12px;
  -webkit-animation: fadeEffect 1s;
  animation: fadeEffect 1s;
}

@-webkit-keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}

table{
  border-collapse: collapse;
  overflow-x: auto;
  display: block;
  max-width: 100%;
}
</style>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Pelanggaran')" id="defaultOpen">Catatan Pelanggaran Siswa</button>
  <button class="tablinks" onclick="openCity(event, 'Prestasi')">Catatan Prestasi Siswa</button>
</div>

<div class="card-body">
  <form method="POST" action="">
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

  <div id="Pelanggaran" class="tabcontent">
   <?php

        $tingkat_k = '%'. $tingkat_k .'%';
        $tipe_k = '%'. $tipe_k .'%';
        $kode_j = '%'. $kode_j .'%';

        $riwayatPelanggaran ="SELECT catatan_poin_pelanggaran.*,siswa.*, kelas.*, jurusan.*, pelanggaran.*, user.* 
        FROM `catatan_poin_pelanggaran` 
        JOIN user ON catatan_poin_pelanggaran.user_id=user.user_id
        JOIN siswa ON catatan_poin_pelanggaran.siswa_id=siswa.siswa_id
        JOIN kelas ON siswa.kelas_id=kelas.kelas_id
        JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id
        JOIN pelanggaran ON catatan_poin_pelanggaran.pelanggaran_id=pelanggaran.pelanggaran_id 
        WHERE kelas.tingkat_kelas LIKE ? AND kelas.tipe_kelas LIKE ? AND jurusan.jurusan_id LIKE ?
        ORDER BY catatan_poin_pelanggaran.catatan_poin_pelanggaran_id DESC";

        $siswa = $koneksi->prepare($riwayatPelanggaran);
        $siswa->bind_param('sss',$tingkat_k,$tipe_k,$kode_j);
        $siswa->execute();
        $res = $siswa->get_result();

        ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered zero-configuration" >
                    <thead>
                        <tr>
                            <th width="10%">Tanggal</th>
                            <th width="10%">Waktu</th>
                            <th width="10%">User</th>
                            <th width="20%">Nama Siswa</th>                          
                            <th width="10%">Kelas</th>                          
                            <th width="20%">Pelanggaran</th>                        
                            <th width="10%">Poin Pelanggaran</th>  
                            <th width="5%">Tindakan</th>                      
                            <th width="5%">Foto</th>                                                  
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                            $siswa_id = $row['siswa_id'];
                            $tanggal = date("d M Y", strtotime($row['tanggal_pelanggaran']));
                            $waktu = date("H:i", strtotime($row['tanggal_pelanggaran']));
                            $user = $row['username'];
                            $nama_siswa = $row['nama_siswa'];
                            $tingkat = $row['tingkat_kelas'];
                            $kode = $row['kode_jurusan'];
                            $tipe = $row['tipe_kelas'];
                            $nama_pelanggaran = $row['nama_pelanggaran'];
                            $poin_pelanggaran = $row['poin_pelanggaran'];
                            $bukti = $row['bukti'];
                            if($row['tindakan'] == 0){
                              $tindakan = " Belum";
                            }else{
                                $tindakan = " Sudah";
                            }

                            echo "
                            <tr>
                                <td>$tanggal</td>
                                <td>$waktu</td>
                                <td>$user</td>
                                <td>$nama_siswa</td>
                                <td>$tingkat $kode $tipe</td>
                                <td>$nama_pelanggaran</td>
                                <td class='text-center'>$poin_pelanggaran</td>
                                <td class='text-center'><input id='".$siswa_id."' onclick='onChangeTindakan(".$siswa_id.")' type='checkbox'"; if($row['tindakan'] == 1 ){echo 'checked';} echo ">$tindakan</td>

                                <td class='text-center'> "; ?>
                                  <a class="btn mb-1 btn-info btn-sm fa fa-eye " href="<?php echo BASE_URL_BUKTI.$bukti; ?>" target="_blank"></a>
                                </td>
                                  
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>           
</div>

<div id="Prestasi" class="tabcontent">
  <?php
        $tingkat_k = '%'. $tingkat_k .'%';
        $tipe_k = '%'. $tipe_k .'%';
        $kode_j = '%'. $kode_j .'%';

    $riwayatprestasi ="SELECT catatan_prestasi.*,siswa.*, kelas.*, jurusan.*, user.* 
    FROM `catatan_prestasi` 
    JOIN user ON catatan_prestasi.user_id=user.user_id
    JOIN siswa ON catatan_prestasi.siswa_id=siswa.siswa_id
    JOIN kelas ON siswa.kelas_id=kelas.kelas_id
    JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id
    WHERE kelas.tingkat_kelas LIKE ? AND kelas.tipe_kelas LIKE ? AND jurusan.jurusan_id LIKE ?
    ORDER BY catatan_prestasi.catatan_prestasi_id DESC";

    $siswa = $koneksi->prepare($riwayatprestasi);
    $siswa->bind_param('sss',$tingkat_k,$tipe_k,$kode_j);
    $siswa->execute();
    $res = $siswa->get_result();
    

    ?>
    <div class="table-responsive">
      <table class="table table-striped table-bordered zero-configuration">
        <thead>
            <tr>
                <th width="30px">Tanggal</th>
                <th width="30px">Waktu</th>
                <th width="100px">User</th>
                <th width="200px">Nama Siswa</th>                          
                <th width="100px">Kelas</th>                          
                <th width="600px">Catatan Prestasi</th>                        
                <th width="50px">Foto</th>                        
            </tr>
        </thead>
        <tbody>
          <?php 
           if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                  $tanggal = date("d F Y", strtotime($row['tanggal_prestasi']));
                  $waktu = date("H:i", strtotime($row['tanggal_prestasi']));
                  $user = $row['nama_user'];
                  $nama_siswa = $row['nama_siswa'];
                  $tingkat = $row['tingkat_kelas'];
                  $kode = $row['kode_jurusan'];
                  $tipe = $row['tipe_kelas'];
                  $nama_prestasi = $row['nama_prestasi'];
                  $bukti = $row['bukti'];

                  echo "
                  <tr>
                      <td>$tanggal</td>
                      <td>$waktu</td>
                      <td>$user</td>
                      <td>$nama_siswa</td>
                      <td>$tingkat $kode $tipe</td>
                      <td>$nama_prestasi</td>
                      <td class='text-center'> "; ?>
                          <a class="btn mb-1 btn-info btn-sm fa fa-eye " href="<?php echo BASE_URL_BUKTI.$bukti; ?>" target="_blank"></a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
      </table>
    </div>
</div>
</div>

<script>
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }

    document.getElementById("defaultOpen").click();
    
    $(document).ready(function() {
        $('.image-link').magnificPopup({type:'image'});
    });
    
    function onChangeTindakan(siswa_id) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange  = function() {
            if (this.readyState == 4 && this.status == 200) {
                swal("Sukses!", "Status siswa berhasil diubah", "success");

                setTimeout(() => window.location.reload(), 1000);
            }
        };

        xhr.open('POST', 'updateTindakan.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(`siswa_id=${siswa_id}&status=${status}`);

    }

    </script>