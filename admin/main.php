<?php

    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $query_jurusan = mysqli_query($koneksi,"SELECT * FROM jurusan");
    $count_jurusan = mysqli_num_rows($query_jurusan);
    $query_kelas = mysqli_query($koneksi,"SELECT * FROM kelas");
    $count_kelas = mysqli_num_rows($query_kelas);
    $query_siswa = mysqli_query($koneksi,"SELECT * FROM siswa");
    $count_siswa = mysqli_num_rows($query_siswa);
    
    $query = "SELECT kelas.*, jurusan.* FROM kelas
    LEFT OUTER JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id ORDER BY kelas.kelas_id ASC";
    $result=mysqli_query($koneksi,$query); 

    $query1 = "SELECT kelas.*, SUM(siswa.poin_pelanggaran_siswa) as total FROM siswa  
    LEFT OUTER JOIN kelas ON siswa.kelas_id=kelas.kelas_id 
    GROUP BY kelas.kelas_id
    ORDER BY kelas.kelas_id ASC";
    $result1 = mysqli_query($koneksi,$query1);

?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-4">
            <a href="index.php?page=siswa-list">
                <div class="card card-widget">
                    <div class="card-body gradient-7 text-center">
                        <span class="card-widget__icon"><i class="icon-user"></i></span><hr>
                        <h2 class="card-widget__title"><?php echo $count_siswa; ?> Siswa</h2>   
                    </div>
                </div>
            </a>    
        </div>

        <div class="col-4">
            <a href="index.php?page=kelas-list">        
                <div class="card card-widget">
                    <div class="card-body gradient-2 text-center">
                        <span class="card-widget__icon"><i class="icon-home"></i></span><hr>
                        <h2 class="card-widget__title"><?php echo $count_kelas; ?> Kelas</h2>   
                    </div>
                </div>
            </a>    
        </div>


        <div class="col-4">
            <a href="index.php?page=jurusan-list">
                <div class="card card-widget">
                    <div class="card-body gradient-3 text-center">
                        <span class="card-widget__icon"><i class="icon-tag"></i></span><hr>
                        <h2 class="card-widget__title"><?php echo $count_jurusan; ?> Jurusan</h2>                    
                    </div>
                </div>
            </a>    
        </div>
        <div class="col-lg-12">         
            <?php include 'grapik-pelanggaran.php'; ?>
        </div>          
    <div>    
</div>    