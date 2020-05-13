<?php 

require_once 'connect.php';

$type = $_GET['item_type'];

if (isset($_GET['key'])) {
    $key = $_GET["key"];
    if ($type == 'siswa') {
        $query = "SELECT siswa.*,kelas.*, jurusan.* 
                    FROM siswa
                    JOIN kelas ON siswa.kelas_id=kelas.kelas_id 
                    JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id 
                    WHERE siswa.nama_siswa LIKE '%$key%' OR siswa.nis LIKE '%$key%' OR kelas.tingkat_kelas LIKE '%$key%' OR jurusan.kode_jurusan LIKE '%$key%' OR kelas.tipe_kelas LIKE '%$key%' ";
        $result = mysqli_query($conn, $query);
        $response = array();
        while( $row = mysqli_fetch_assoc($result) ){
            array_push($response, 
            array(
                'siswa_id'=>$row['siswa_id'],
                'poin_pelanggaran_siswa'=>$row['poin_pelanggaran_siswa'],
                'poin_prestasi_siswa'=>$row['poin_prestasi_siswa'],
                'nama_siswa'=>$row['nama_siswa'],
                'nis'=>$row['nis'], 
                'jenis_kelamin'=>$row['jenis_kelamin'], 
                'tingkat_kelas'=>$row['tingkat_kelas'],
                'kode_jurusan' =>$row['kode_jurusan'],
                'tipe_kelas'  =>$row['tipe_kelas']) 
            );
        }
        echo json_encode($response);   
    }
} else {
    if ($type == 'siswa') {
        $query = "SELECT * FROM siswa";
        $result = mysqli_query($conn, $query);
        $response = array();
        while( $row = mysqli_fetch_assoc($result) ){
            array_push($response, 
            array(
                'siswa_id'=>$row['siswa_id'],
                'poin_pelanggaran_siswa'=>$row['poin_pelanggaran_siswa'],
                'poin_prestasi_siswa'=>$row['poin_prestasi_siswa'],
                'nama_siswa'=>$row['nama_siswa'],
                'nis'=>$row['nis'], 
                'jenis_kelamin'=>$row['jenis_kelamin'], 
                'tingkat_kelas'=>$row['tingkat_kelas'],
                'kode_jurusan' =>$row['kode_jurusan'],
                'tipe_kelas'  =>$row['tipe_kelas'])  
            );
        }
        echo json_encode($response);   
    }
}

mysqli_close($conn);

?>