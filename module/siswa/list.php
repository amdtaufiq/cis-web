<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    // $querKelas = mysqli_query($koneksi, "SELECT * FROM kelas");
    $queryKelas = mysqli_query($koneksi, "SELECT siswa.*,kelas.*, jurusan.*
    FROM siswa
    JOIN kelas ON siswa.kelas_id=kelas.kelas_id 
    JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id");


?>
<div class="card-body">
    <h4 class="card-title">Data Siswa</h4>
        <a href="index.php?page=siswa-form" class="btn mb-1 btn-info btn-sm">Tambah
            <span class="btn-icon-right">
                <i class="fa fa-plus"></i>
            </span>
        </a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered zero-configuration">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Poin</th>
                        <th>Nama Siswa</th>                          
                        <th>NISN</th>                        
                        <th>Kelas</th>  
                        <th>Jenis Kelamin</th>                        
                        <th>Action</th>                           
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        while($row=mysqli_fetch_assoc($queryKelas)) {
                                           
                            echo "<tr>
                                <td>$no</td>
                                <td>$row[poin]</td>
                                <td>$row[nama_siswa]</td>
                                <td>$row[nisn]</td>
                                <td>$row[tingkat_kelas] $row[kode_jurusan] $row[tipe_kelas]</td>
                                <td>$row[jenis_kelamin]</td>

                                <td>
                                    <a  class='btn mb-1 btn-info btn-sm' href='index.php?page=siswa-form&siswa_id=$row[siswa_id]'>EDIT</a>       
                                    <a  class='btn mb-1 btn-danger btn-sm' href='".BASE_URL."module/siswa/delete.php?siswa_id=$row[siswa_id]'>DELETE</a>       
                                </td>	
                            </tr>";
                                                    
                            $no++;
                        }
                    ?>
                </tbody>                          
            </table>
        </div>
</div>
                        




