<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    $queryprestasi = mysqli_query($koneksi, "SELECT * FROM prestasi");

?>
<div class="card-body">
    <h4 class="card-title">Data Prestasi</h4>
        <a href="index.php?page=prestasi-form" class="btn mb-1 btn-info btn-sm">Tambah
            <span class="btn-icon-right">
                <i class="fa fa-plus"></i>
            </span>
        </a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered zero-configuration">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Prestasi</th> 
                        <th>Poin Prestasi</th>                          
                        <th>Action</th>                           
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        while($row=mysqli_fetch_assoc($queryprestasi)) {
                                           
                            echo "<tr>
                                <td>$no</td>
                                <td>$row[nama_prestasi]</td>
                                <td>$row[poin_prestasi]</td>
                                <td>
                                    <a  class='btn mb-1 btn-info btn-sm' href='index.php?page=prestasi-form&prestasi_id=$row[prestasi_id]'>EDIT</a>       
                                    <a  class='btn mb-1 btn-danger btn-sm' href='".BASE_URL."module/prestasi/delete.php?prestasi_id=$row[prestasi_id]'>DELETE</a>       
                                </td>	
                            </tr>";
                                                    
                            $no++;
                        }
                    ?>
                </tbody>                          
            </table>
        </div>
</div>
                        




