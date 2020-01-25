<?php
	include_once("function/koneksi.php");
    include_once("function/helper.php");
    
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
                <div class="col-lg-1">
                    <select class="form-control" id="sel1" name="tingkat_kelas">
                        <option value="X">X</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div> 

                <div class="col-lg-1">
                    <select class="form-control" id="sel1" name="jurusan_id">
                        <?php
                            $query = mysqli_query($koneksi, "SELECT jurusan_id, kode_jurusan, nama_jurusan
                            FROM jurusan 
                            ORDER BY kode_jurusan ASC");
                            while($row=mysqli_fetch_assoc($query)){
                                    echo "<option value='$row[jurusan_id]'>$row[kode_jurusan]</option>";
                            }
                        ?>
                    </select>
                </div> 

                <div class="col-lg-1">
                    <select class="form-control" id="sel1" name="tipe_kelas">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="4">5</option>
                        <option value="4">6</option>
                        <option value="4">7</option>
                        <option value="4">8</option>
                        <option value="4">9</option>
                    </select>
                </div> 
            </div>
        </form>  

    </body>