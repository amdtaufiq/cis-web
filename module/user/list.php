<?php
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;

    $querUser = mysqli_query($koneksi, "SELECT * FROM user");

?>
<div class="card-body">
    <h4 class="card-title">Data User</h4>
        <a href="index.php?page=user-form" class="btn mb-1 btn-info btn-sm">Tambah
            <span class="btn-icon-right">
                <i class="fa fa-plus"></i>
            </span>
        </a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered zero-configuration">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>NIP</th>
                        <th>Nomor Telpon</th>                           
                        <th>Username</th>   
                        <th>Level User</th>          
                        <th>Action</th>                           
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        while($row=mysqli_fetch_assoc($querUser)) {
                                           
                            echo "<tr>
                                <td>$no</td>
                                <td>$row[nama_user]</td>
                                <td>$row[nip]</td>
                                <td>$row[nomor_telpon]</td>
                                <td>$row[username]</td>
                                <td>$row[level]</td>
                                <td>
                                    <a  class='btn mb-1 btn-info btn-sm' href='index.php?page=user-form&user_id=$row[user_id]'>EDIT</a>       
                                    <a  class='btn mb-1 btn-danger btn-sm' href='".BASE_URL."module/user/delete.php?user_id=$row[user_id]'>DELETE</a>       
                                </td>	
                            </tr>";
                                                    
                            $no++;
                        }
                    ?>
                </tbody>                          
            </table>
        </div>
</div>
                        




