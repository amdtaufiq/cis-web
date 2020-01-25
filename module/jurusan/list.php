<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    $queryjurusan = mysqli_query($koneksi, "SELECT * FROM jurusan");

?>
<div class="card-body">
    <h4 class="card-title">Data Jurusan</h4>
        <a href="index.php?page=jurusan-form" class="btn mb-1 btn-info btn-sm">Tambah
            <span class="btn-icon-right">
                <i class="fa fa-plus"></i>
            </span>
        </a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered zero-configuration">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Jurusan</th>
                        <th>Nama Jurusan</th>                           
                        <th>Action</th>                           
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        while($row=mysqli_fetch_assoc($queryjurusan)) {
                                           
                            echo "<tr>
                                <td>$no</td>
                                <td>$row[kode_jurusan]</td>
                                <td>$row[nama_jurusan]</td>
                                <td>
                                    <a  class='btn mb-1 btn-info btn-sm' href='index.php?page=jurusan-form&jurusan_id=$row[jurusan_id]'>EDIT</a>       
                                    <a  class='btn mb-1 btn-danger btn-sm' href='".BASE_URL."module/jurusan/delete.php?jurusan_id=$row[jurusan_id]'>DELETE</a>       
                                </td>	
                            </tr>";
                                                    
                            $no++;
                        }
                    ?>
                </tbody>                          
            </table>
        </div>
</div>
                        




