<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    $querypelanggaran = mysqli_query($koneksi, "SELECT * FROM pelanggaran");

?>
<div class="card-body">
    <h4 class="card-title">Data Pelanggaran</h4>
        <a href="index.php?page=pelanggaran-form" class="btn mb-1 btn-info btn-sm">Tambah
            <span class="btn-icon-right">
                <i class="fa fa-plus"></i>
            </span>
        </a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered zero-configuration">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggaran</th> 
                        <th>Poin Pelanggaran</th>                          
                        <th>Action</th>                           
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        while($row=mysqli_fetch_assoc($querypelanggaran)) {
                                           
                            echo "<tr>
                                <td>$no</td>
                                <td>$row[nama_pelanggaran]</td>
                                <td>$row[poin_pelanggaran]</td>
                                <td>
                                    <a  class='btn mb-1 btn-info btn-sm' href='index.php?page=pelanggaran-form&pelanggaran_id=$row[pelanggaran_id]'>EDIT</a>       
                                    <a  class='btn mb-1 btn-danger btn-sm' href='".BASE_URL."module/pelanggaran/delete.php?pelanggaran_id=$row[pelanggaran_id]'>DELETE</a>       
                                </td>	
                            </tr>";
                                                    
                            $no++;
                        }
                    ?>
                </tbody>                          
            </table>
        </div>
</div>
                        




