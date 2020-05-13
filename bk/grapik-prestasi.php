<?php

    include_once("function/koneksi.php");
    $query = "SELECT kelas.*, jurusan.* FROM kelas
    LEFT OUTER JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id ORDER BY kelas.kelas_id ASC";
    $result=mysqli_query($koneksi,$query); 

    $query1 = "SELECT kelas.*, SUM(siswa.poin_prestasi_siswa) as total FROM siswa  
    LEFT OUTER JOIN kelas ON siswa.kelas_id=kelas.kelas_id 
    GROUP BY kelas.kelas_id
    ORDER BY kelas.kelas_id ASC";
    $result1 = mysqli_query($koneksi,$query1);

 ?>
<!DOCTYPE html>
<html>
    <head>
        <script src="js/Chart.js"></script>
    </head>
    <body>
        <canvas id="demobar1" width="100" height="30"></canvas>

      	<script  type="text/javascript">

    	  var ctx = document.getElementById("demobar1").getContext("2d");
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
    	              label: "Total Poin Prestasi",
    	              data: [
                          <?php
                             while($row=mysqli_fetch_assoc($result1)){
                                $poinprestasi = $row['total'];
                                 echo '"' . $poinprestasi . '",';
                            }
                          ?>
                      ],
                    backgroundColor: [
                                                
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",
                        "#7571f9",

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