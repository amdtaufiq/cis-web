<?php

    include_once("function/koneksi.php");
    include_once("function/helper.php");


    $query_jurusan = mysqli_query($koneksi,"SELECT jurusan.*, kelas.* FROM jurusan LEFT OUTER JOIN kelas ON jurusan.jurusan_id = kelas.jurusan_id WHERE `user_id`='$user_id' GROUP BY jurusan.jurusan_id");
    $count_jurusan = mysqli_num_rows($query_jurusan);
    $query_kelas = mysqli_query($koneksi,"SELECT * FROM kelas WHERE `user_id`=$user_id");
    $count_kelas = mysqli_num_rows($query_kelas);
    $query_siswa = mysqli_query($koneksi,"SELECT siswa.*, kelas.* FROM siswa LEFT OUTER JOIN kelas ON siswa.kelas_id = kelas.kelas_id WHERE `user_id`='$user_id' GROUP BY siswa.siswa_id");
    $count_siswa = mysqli_num_rows($query_siswa);

?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-4">
            <div class="card card-widget" >
                <div class="card-body gradient-7 text-center">
                    <span class="card-widget__icon"><i class="icon-user"></i></span><hr>
                    <h2 class="card-widget__title"><?php echo $count_siswa; ?> Siswa</h2>           
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-widget">
                <div class="card-body gradient-2 text-center">
                    <span class="card-widget__icon"><i class="icon-home"></i></span><hr>
                    <h2 class="card-widget__title"><?php echo $count_kelas; ?> Kelas</h2>                          
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-widget">
                <div class="card-body gradient-3 text-center">
                    <span class="card-widget__icon"><i class="icon-tag"></i></span><hr>
                    <h2 class="card-widget__title"><?php echo $count_jurusan; ?> Jurusan</h2>          
                </div>
            </div>    
        </div>
        
        <div class="col-lg-12">         
            <?php include 'grapik-pelanggaran.php'; ?>
        </div> 
    <div>    
</div>    