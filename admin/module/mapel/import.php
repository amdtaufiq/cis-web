<div class="card-body">
    <a href="<?php echo BASE_URL.'index.php?page=mapel-list' ?>" class="btn btn-danger btn-md pull-right">Batal</a><br>
    <br>
    <h3>Form Impor Data</h3><hr>

    <form method="post" action="" enctype="multipart/form-data">
        <a href="<?php echo BASE_URL.'format/MAPEL.xlsx'; ?>" class="btn btn-md btn-outline-info">
            Unduh Format
        </a><br><br>

        <input type="file" name="file" class="pull-left btn-md">

        <button type="submit" name="preview" class="btn btn-success btn-md text-white">Lihat Data</button>
    </form>
    <?php
        if(isset($_POST['preview'])){
            $nama_file_baru = 'data.xlsx';

            if(is_file('tmp/'.$nama_file_baru)) 
                unlink('tmp/'.$nama_file_baru); 

            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); 
            $tmp_file = $_FILES['file']['tmp_name'];

            if($ext == "xlsx"){
                move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);

                require_once 'PHPExcel/PHPExcel.php';

                $excelreader = new PHPExcel_Reader_Excel2007();
                $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); 
                $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

                ?>

                <form method='post' action="<?php echo BASE_URL."module/mapel/action-import.php"; ?>">
                    <div class='alert alert-danger' id='kosong'>
                    Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
                    </div>
                    <br>
                    <h4>Data Mata Pelajaran</h4>
                    
                    <button type='submit' name='import' class='btn btn-md btn-warning text-white'>Impor</button>
                    <br><br>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                             <tr>
                                <th>Kode Mapel</th>
                                <th>Nama Mapel</th>
                            </tr>
                            <?php

                                $numrow = 1;
                                $kosong = 0;
                                foreach($sheet as $row){ 
                                
                                    $kode_mapel = $row['A']; 
                                    $nama_mapel = $row['B']; 

                                    if($kode_mapel == "" && $nama_mapel == "")
                                        continue; 

                                    if($numrow > 1){
                                        $kode_td = ( ! empty($kode_mapel))? "" : " style='background: #E07171;'"; 
                                        $nama_td = ( ! empty($nama_mapel))? "" : " style='background: #E07171;'";

                                        if($kode_mapel == "" or $nama_mapel == ""){
                                            $kosong++;
                                        }

                                        echo "<tr>";
                                        echo "<td".$kode_td.">".$kode_mapel."</td>";
                                        echo "<td".$nama_td.">".$nama_mapel."</td>";
                                        echo "</tr>";
                                    }

                                    $numrow++; 
                                }

                                 echo "</table>";

                                if($kosong > 1){
                                ?>
                                    <script>
                                    $(document).ready(function(){
                                        $("#jumlah_kosong").html('<?php echo $kosong; ?>');

                                        $("#kosong").show();
                                    });
                                    </script>
                                <?php
                                }else{ 
                                    echo "<hr>";
                                }

                                echo "</form>";
                                ?>
                        </table>
                    </div>
                    <?php
                        
            }else{ 
                echo "<br><div class='alert alert-danger'>
                Hanya File Excel 2007 (.xlsx) yang diperbolehkan
                </div>";
            }
        }
    ?>
</div>