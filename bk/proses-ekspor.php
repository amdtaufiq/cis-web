<?php

    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $queryskala = mysqli_query($koneksi, "SELECT * FROM skala_sikap");

    $resultRowSkala = mysqli_fetch_all($queryskala, MYSQLI_ASSOC);

    $querytahap = mysqli_query($koneksi,"SELECT * FROM tahap_tindak");

    $resultRowTahap = mysqli_fetch_all($querytahap, MYSQLI_ASSOC);

    session_start(); 
        
    $tingkat_kelas = $_SESSION['tingkat_kelas'];
    $tipe_kelas = $_SESSION['tipe_kelas'];
    $jurusan_id = $_SESSION['jurusan_id'];
    $user_id = $_SESSION['user_id'];

    $queryJurusan = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE jurusan_id='$jurusan_id'");

    $resultRowJurusan = mysqli_fetch_assoc($queryJurusan);

    $kode_jurusan = $resultRowJurusan['kode_jurusan'];

    if($tingkat_kelas=="" && $tipe_kelas=="" && $jurusan_id==""){
        $nama_file = "Semua Kelas.xls";
    }else if($tingkat_kelas!="" && $tipe_kelas=="" && $jurusan_id==""){
        $nama_file = "Kelas $tingkat_kelas.xls";
    }else if($tingkat_kelas!="" && $tipe_kelas=="" && $jurusan_id!=""){
        $nama_file = "$tingkat_kelas $kode_jurusan.xls";
    }else if($tingkat_kelas!="" && $tipe_kelas!="" && $jurusan_id!=""){
        $nama_file = "$tingkat_kelas $kode_jurusan $tipe_kelas.xls";
    }

    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=$nama_file");

    $tingkat_k = '%'. $tingkat_kelas .'%';
    $tipe_k = '%'. $tipe_kelas .'%';
    $kode_j = '%'. $jurusan_id .'%';

    $query = "SELECT siswa.*,kelas.*, jurusan.* 
             FROM siswa
             JOIN kelas ON siswa.kelas_id=kelas.kelas_id 
             JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id
             WHERE kelas.tingkat_kelas LIKE ? AND kelas.tipe_kelas LIKE ? AND jurusan.jurusan_id LIKE ? AND kelas.user_id='$user_id' ORDER BY siswa.siswa_id ASC";
                                
            $siswa = $koneksi->prepare($query);
            $siswa->bind_param('sss',$tingkat_k,$tipe_k,$kode_j);
            $siswa->execute();
            $res = $siswa->get_result();

?>

<table border="1">
    <tr>
        <th>NIS</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Kelas</th>
        <th>Poin</th>
        <th>Skala</th>
        <th>Tahap</th>
    </tr>
<?php
            $skala = "";
            $tahap= "";
            if($res->num_rows > 0){
                while ($row = $res->fetch_assoc()){
                    $poin_pelanggaran_siswa = $row['poin_pelanggaran_siswa'];
                    $poin = $poin_pelanggaran_siswa;
                    $nama_siswa = $row['nama_siswa'];
                    $nis = $row['nis'];
                    $tingkat = $row['tingkat_kelas'];
                    $kode = $row['kode_jurusan'];
                    $tipe = $row['tipe_kelas'];
                    $jk = $row['jenis_kelamin'];        

                    for ($i = 0; $i < count($resultRowSkala); $i++){
                        if ($poin >= $resultRowSkala[$i]['poin_minimal'] && $poin <= $resultRowSkala[$i]['poin_maksimal']) {
                            $skala = $resultRowSkala[$i]['skala'];
                            break;
                        }
                    }

                    for ($i = 0; $i < count($resultRowTahap); $i++){
                        if ($poin >= $resultRowTahap[$i]['poin_awal'] && $poin <= $resultRowTahap[$i]['poin_akhir']) {
                            $tahap = $resultRowTahap[$i]['tahap'];
                            $keterangan = $resultRowTahap[$i]['keterangan'];
                            break;
                        }
                    }
                    ?>
                    <tr>
                        <td><?php echo $nis; ?></td>
                        <td><?php echo $nama_siswa; ?></td>
                        <td><?php echo $jk; ?></td>
                        <td><?php echo "$tingkat $kode $tipe"; ?></td>
                        <td><?php echo $poin; ?></td>
                        <td><?php echo $skala; ?></td>
                        <td><?php echo $tahap; ?></td>
                    </tr>
                    <?php
                }
            } else {
                
            }
?>
</table>