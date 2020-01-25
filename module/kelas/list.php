<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    // $querKelas = mysqli_query($koneksi, "SELECT * FROM kelas");
    $querKelas = mysqli_query($koneksi, "SELECT kelas.*,jurusan.kode_jurusan 
    FROM kelas 
    JOIN jurusan 
    ON kelas.jurusan_id=jurusan.jurusan_id");


?>
<div class="card-body">
    <h4 class="card-title">Data kelas</h4>
        <a href="index.php?page=kelas-form" class="btn mb-1 btn-info btn-sm">Tambah
            <span class="btn-icon-right">
                <i class="fa fa-plus"></i>
            </span>
        </a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered zero-configuration">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>                        
                        <th>Nama Wali Kelas</th>
                        <th>Nomor Wali Kelas</th>                           
                        <th>Action</th>                           
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        while($row=mysqli_fetch_assoc($querKelas)) {
                                           
                            echo "<tr>
                                <td>$no</td>
                                <td>$row[tingkat_kelas] $row[kode_jurusan] $row[tipe_kelas]</td>
                                <td>$row[nama_wali_kelas]</td>
                                <td>$row[nomor_wali_kelas]</td>
                                <td>
                                    <a  class='btn mb-1 btn-info btn-sm' href='index.php?page=kelas-form&kelas_id=$row[kelas_id]'>EDIT</a>       
                                    <a  class='btn mb-1 btn-danger btn-sm' href='".BASE_URL."module/kelas/delete.php?kelas_id=$row[kelas_id]'>DELETE</a>       
                                </td>	
                            </tr>";
                                                    
                            $no++;
                        }
                    ?>
                </tbody>                          
            </table>
        </div>
</div>
                        




