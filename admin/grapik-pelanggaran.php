<?php

    include_once("function/koneksi.php");
    $query = "SELECT kelas.*, jurusan.* FROM kelas
    LEFT OUTER JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id 
    GROUP BY kelas.tingkat_kelas, kelas.jurusan_id, kelas.tipe_kelas
    ORDER BY kelas.tingkat_kelas ASC";
    $result=mysqli_query($koneksi,$query); 

    $query1 = "SELECT kelas.*, SUM(siswa.poin_pelanggaran_siswa) as total FROM kelas
    LEFT OUTER JOIN siswa ON kelas.kelas_id=siswa.kelas_id 
    GROUP BY kelas.tingkat_kelas, kelas.jurusan_id, kelas.tipe_kelas
    ORDER BY kelas.tingkat_kelas ASC";
    $result1 = mysqli_query($koneksi,$query1);

 ?>
<!DOCTYPE html>
<html>
    <head>
        <script src="js/Chart.js"></script>
    </head>
    <body>
        <canvas id="demobar" width="100" height="30"></canvas>

      	<script  type="text/javascript">

    	  var ctx = document.getElementById("demobar").getContext("2d");
    	  var data = {
    	            labels: [
                        <?php 
                            while($row=mysqli_fetch_assoc($result)){
                                $tipe=$row['tipe_kelas'];
                                $kode=$row['kode_jurusan'];
                                $tingkat=$row['tingkat_kelas'];    
                                echo '"' . $tingkat . ' ' . $kode . ' ' . $tipe . '",';
                            }
                        ?>
                    ],
    	            datasets: [
    	            {
    	              label: "Total Poin Pelanggaran",
    	              data: [
                          <?php
                             while($row=mysqli_fetch_assoc($result1)){
                                $poinPelanggaran = $row['total'];
                                 echo '"' . $poinPelanggaran . '",';
                            }
                          ?>
                      ],
                    backgroundColor: [
                                                
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",
                        "rgba(201, 29, 29, 1)",

                    ]
    	            }
    	            ]
    	            };

    	  var myBarChart = new Chart(ctx, {
    	            type: 'bar',
    	            data: data,
    	            options: {
    	            barValueSpacing: 20,
    	            scales: {
    	              yAxes: [{
    	                  ticks: {
    	                      min: 0,
                              beginAtZero: true
    	                  }
    	              }],
    	              xAxes: [{
    	                          gridLines: {
    	                              color: "rgba(0, 0, 0, 0)",
    	                          }
    	                      }]
    	              }
    	          }
    	        });
    	</script>

  </body>
</html>