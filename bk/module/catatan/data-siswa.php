<?php

include_once("../../function/koneksi.php");

  if(isset($_POST['query'])){
    $inpText = $_POST['query'];
    $query = "SELECT * FROM siswa
    JOIN kelas ON siswa.kelas_id=kelas.kelas_id 
    JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id
    WHERE siswa.nama_siswa LIKE '%$inpText%' OR siswa.nis LIKE '%$inpText%' ";
    $result = $koneksi->query($query);
    if($result->num_rows>0){
      while($row = $result->fetch_assoc()){
        echo '<a href="#" class="list-group-item list-group-item-action border-1">'.$row['nama_siswa'].'</a>';
      }
    }
    else{
      echo '<p class="list-group-item border-1">No Record</p>';
    }
  }
?>