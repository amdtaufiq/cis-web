<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    $queryskalasikap = mysqli_query($koneksi, "SELECT * FROM skala_sikap");

?>
<div class="card-body">
    <h4 class="card-title">Data Skala Sikap</h4>
        <a href="index.php?page=skala-sikap-form" class="btn mb-1 btn-info btn-sm">Tambah
            <span class="btn-icon-right">
                <i class="fa fa-plus"></i>
            </span>
        </a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered zero-configuration">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Skala</th> 
                        <th>Poin Minimal</th>                          
                        <th>Poin Maksimal</th>                          
                        <th>Action</th>                           
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        while($row=mysqli_fetch_assoc($queryskalasikap)) {
                                           
                            echo "<tr>
                                <td>$no</td>
                                <td>$row[skala]</td>
                                <td>$row[poin_minimal]</td>
                                <td>$row[poin_maksimal]</td>
                                <td>
                                    <a  class='btn mb-1 btn-info btn-sm' href='index.php?page=skala-sikap-form&skala_sikap_id=$row[skala_sikap_id]'>EDIT</a>       
                                    <a  class='btn mb-1 btn-danger btn-sm' href='".BASE_URL."module/skala-sikap/delete.php?skala_sikap_id=$row[skala_sikap_id]'>DELETE</a>       
                                </td>	
                            </tr>";
                                                    
                            $no++;
                        }
                    ?>
                </tbody>                          
            </table>
        </div>
</div>
                        




