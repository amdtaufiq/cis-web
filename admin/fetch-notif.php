<?php

    if(isset($_POST["view"])){
        include_once("function/koneksi.php");
        include_once("function/helper.php");

        if($_POST["view"] != ''){
            $update_query = "UPDATE catatan_poin_pelanggaran SET `status`=1 WHERE `status`=0";
            mysqli_query($koneksi, $update_query);
        }
        $query = "SELECT catatan_poin_pelanggaran.*,siswa.*, kelas.*, jurusan.*, pelanggaran.*, user.* FROM `catatan_poin_pelanggaran` 
        JOIN user ON catatan_poin_pelanggaran.user_id=user.user_id
        JOIN siswa ON catatan_poin_pelanggaran.siswa_id=siswa.siswa_id
        JOIN kelas ON siswa.kelas_id=kelas.kelas_id
        JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id
        JOIN pelanggaran ON catatan_poin_pelanggaran.pelanggaran_id=pelanggaran.pelanggaran_id
        ORDER BY catatan_poin_pelanggaran_id DESC LIMIT 3";

        $querytahap = mysqli_query($koneksi,"SELECT * FROM tahap_tindak");

        $resultRowTahap = mysqli_fetch_all($querytahap, MYSQLI_ASSOC);

        $result = mysqli_query($koneksi, $query);
        $output = '';


        if(mysqli_num_rows($result) > 0 ){
            while($row = mysqli_fetch_array($result)){
                $poin = $row['poin_pelanggaran_siswa'];
                $nama = $row['nama_siswa'];
                $tingkat = $row['tingkat_kelas'];
                $kode = $row['kode_jurusan'];
                $tipe = $row['tipe_kelas'];
                $pelanggaran = $row['nama_pelanggaran'];
                $tanggal = $row['tanggal_pelanggaran'];
                $user = $row['nama_user'];

                for ($i = 0; $i < count($resultRowTahap); $i++){
                    if ($poin >= $resultRowTahap[$i]['poin_awal'] && $poin <= $resultRowTahap[$i]['poin_akhir']) {
                        $tahap = $resultRowTahap[$i]['tahap'];
                        break;
                    }
                }

                $output .= '
                <div class="dropdown-content-body">
                    <ul>   
                        <li>
                            <a href="javascript:void()">
                                <span class="mr-3 avatar-icon bg-success"><i class="icon-plus"></i></span>
                                <div class="notification-content">
                                    <div class="media-body">
                                    <small class="notification-heading">'.$nama.' 
                                        <span class="font-weight-bold">('.$tingkat.' '.$kode.' '.$tipe.')</span> 
                                        <span class="text-muted">memasuki </span>
                                        <span class="font-weight-bold">'.$tahap.'</span>
                                        <span class="text-muted">dengan  </span> 
                                        <span class="font-weight-bold">Poin '.$poin.'</span>
                                    </small>
                                    <br>
                                    <small>
                                        <span class="text-muted ">'.$tanggal.'</span>
                                    </small>
                                </div> 
                                </div>
                            </a>
                        </li>                 
                    </ul>
                </div>
                ';
            }
        } else {
            $output .= '<li><a href="#" class="font-weight-bold" style="margin-left:16px">No Notification Found</a></li>';
        }

        $query1 = "SELECT * FROM catatan_poin_pelanggaran WHERE `status`=0";
        $result1 = mysqli_query($koneksi, $query1);
        $count = mysqli_num_rows($result1);
        $data = array(
            'notification' => $output,
            'unseen_notification' => $count
        );                       
        echo json_encode($data);
    }

?>