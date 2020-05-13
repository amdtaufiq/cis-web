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
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>SIBIKO</title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
        <!-- Pignose Calender -->
        <link href="./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
        <!-- Chartist -->
        <link rel="stylesheet" href="./plugins/chartist/css/chartist.min.css">
        <link rel="stylesheet" href="./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
        <!-- Custom Stylesheet -->
        <link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

    </head>

    <body>

        <form action="#" method="POST">  
        <div class="form-group row">
                <div class="col-lg-2">
                    <select class="form-control" id="tingkat_kelas" name="tingkat_kelas">
                        <option value=""> Select Tipe Kelas</option>
                        <option value="X" <?php if($tingkat_k == "X"){echo "selected";} ?> >X</option>
                        <option value="XI" <?php if($tingkat_k == "XI"){echo "selected";} ?> >XI</option>
                        <option value="XII" <?php if($tingkat_k == "XII"){echo "selected";} ?> >XII</option>
                    </select>
                </div> 

                <div class="col-lg-2">
                    <select class="form-control" id="sel1" name="jurusan_id">
                    <option value="">Select Kode Jurusan</option>

                        <?php
                            $query = mysqli_query($koneksi, "SELECT jurusan_id, kode_jurusan, nama_jurusan
                            FROM jurusan 
                            ORDER BY kode_jurusan ASC");
                            while($row=mysqli_fetch_assoc($query)){
                                if($kode_j == $row['jurusan_id']){
                                    echo "<option value='$row[jurusan_id]' selected 'true'>$row[kode_jurusan] ($row[nama_jurusan])</option>";
                                }else{
                                    echo "<option value='$row[jurusan_id]'>$row[kode_jurusan] ($row[nama_jurusan])</option>";
                                }
                            }
                        ?>
                    </select>
                </div> 

                <div class="col-lg-2">
                    <select class="form-control" id="tipe_kelas" name="tipe_kelas">
                        <option value=""> Select Tingkat Kelas</option>
                        <option value="1" <?php if($tipe_k == "1"){echo "selected";} ?> >1</option>
                        <option value="2" <?php if($tipe_k == "2"){echo "selected";} ?> >2</option>
                        <option value="3" <?php if($tipe_k == "3"){echo "selected";} ?> >3</option>
                        <option value="4" <?php if($tipe_k == "4"){echo "selected";} ?> >4</option>
                        <option value="5" <?php if($tipe_k == "5"){echo "selected";} ?> >5</option>
                        <option value="6" <?php if($tipe_k == "6"){echo "selected";} ?> >6</option>
                    </select>
                </div> 

                <div class="col-lg-1">
                    <button class="btn btn-warning" name="search">Filter</button>
                </div>
            </div>
        </form>  

        <div class="card-body">
    <h4 class="card-title">Data Siswa</h4>
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
                        $tingkat_k = '%'. $tingkat_k .'%';
                        $tipe_k = '%'. $tipe_k .'%';
                        $kode_j = '%'. $kode_j .'%';

                        $no=1;
                        $query = "SELECT siswa.*,kelas.*, jurusan.* 
                                    FROM siswa
                                    JOIN kelas ON siswa.kelas_id=kelas.kelas_id 
                                    JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id
                                    WHERE kelas.tingkat_kelas LIKE ? AND kelas.tipe_kelas LIKE ? AND jurusan.jurusan_id LIKE ? ORDER BY siswa.siswa_id ASC";
                                
                        $siswa = $koneksi->prepare($query);
                        $siswa->bind_param('sss',$tingkat_k,$tipe_k,$kode_j);
                        $siswa->execute();
                        $res = $siswa->get_result();


                        if($res->num_rows > 0){
                            while ($row = $res->fetch_assoc()){
                                $poin = $row['poin'];
                                $nama_siswa = $row['nama_siswa'];
                                $nisn = $row['nisn'];
                                $tingkat = $row['tingkat_kelas'];
                                $kode = $row['kode_jurusan'];
                                $tipe = $row['tipe_kelas'];
                                $jk = $row['jenis_kelamin'];

                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $poin; ?></td>
                                    <td><?php echo $nama_siswa; ?></td>
                                    <td><?php echo $nisn; ?></td>
                                    <td><?php echo "$tingkat $kode $tipe"; ?></td>
                                    <td><?php echo $jk; ?></td>
                                    <td>
                                    <a  class='btn mb-1 btn-info btn-sm' href=<?php echo "index.php?page=siswa-form&siswa_id=$row[siswa_id]"; ?>>EDIT</a>       
                                    <a  class='btn mb-1 btn-danger btn-sm' href=<?php echo "module/siswa/delete.php?siswa_id=$row[siswa_id]"; ?>>DELETE</a>    
                                    </td>
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

    </body>

