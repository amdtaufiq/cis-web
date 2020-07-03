<?php

    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $queryskala = mysqli_query($koneksi, "SELECT * FROM skala_sikap");

    $resultRowSkala = mysqli_fetch_all($queryskala, MYSQLI_ASSOC);

    $siswa_id = $_GET['siswa_id'];
    
    $poin = $_GET['poin'];
    
    $querySiswa = mysqli_query($koneksi,"SELECT siswa.*,kelas.*, jurusan.* FROM siswa
        JOIN kelas ON siswa.kelas_id=kelas.kelas_id 
        JOIN jurusan ON kelas.jurusan_id=jurusan.jurusan_id
        WHERE siswa.siswa_id=$siswa_id");
                        
    for ($i = 0; $i < count($resultRowSkala); $i++){
        if ($poin >= $resultRowSkala[$i]['poin_minimal'] && $poin <= $resultRowSkala[$i]['poin_maksimal']) {
            $skala = $resultRowSkala[$i]['skala'];
            break;
        }
    }
    
    $queryPelanggaran = mysqli_query($koneksi,"
        SELECT catatan_poin_pelanggaran.*, pelanggaran.*, user.* FROM catatan_poin_pelanggaran
        JOIN pelanggaran ON catatan_poin_pelanggaran.pelanggaran_id=pelanggaran.pelanggaran_id
        JOIN user ON catatan_poin_pelanggaran.user_id=user.user_id
        WHERE catatan_poin_pelanggaran.siswa_id='$siswa_id'");
                        
    while($row=mysqli_fetch_assoc($querySiswa)){                   
                        
        require('fpdf.php');
        // intance object dan memberikan pengaturan halaman PDF
        $pdf = new FPDF('p','mm','A4'); 
         $pdf->SetMargins(20, 20);
        
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',24);
        // mencetak string 
        $pdf->Cell(0,10,'SMK NEGERI 1 KENDAL',0,1,'C');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(0,7,'Jalan Soekarno Hatta Barat KM.03, Purwokerto, Patebon, Sukup Kulon, Purwokerto,',0,1,'C');
        $pdf->Cell(0,3,'Kec. Patebon, Kabupaten Kendal, Jawa Tengah',0,1,'C');
        
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(0,12,'',0,1);
        $pdf->SetFont('Arial','BU',16);
        $pdf->Cell(0,3,'REKAP PELANGGARAN SISWA',0,1,'C');
        $pdf->Cell(0,5,'',0,1);
        
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(25,6,'Nama',0,0);
        $pdf->Cell(20,6,':',0,0,'R');
        $pdf->Cell(27,6,$row['nama_siswa'],0,1);
        
        $pdf->Cell(25,6,'Kelas',0,0);
        $pdf->Cell(20,6,':',0,0,'R');
        $pdf->Cell(27,6,$row['tingkat_kelas']." ".$row['nama_jurusan']." ".$row['tipe_kelas'],0,1);
        
        $pdf->Cell(25,6,'NIS',0,0);
        $pdf->Cell(20,6,':',0,0,'R');
        $pdf->Cell(27,6,$row['nis'],0,1);
        
        $pdf->Cell(25,6,'Poin Pelanggaran',0,0);
        $pdf->Cell(20,6,':',0,0,'R');
        $pdf->Cell(27,6,$poin,0,1);
        
        $pdf->Cell(25,6,'Skala Sikap',0,0);
        $pdf->Cell(20,6,':',0,0,'R');
        $pdf->Cell(27,6,$skala,0,1);
        
        $pdf->Cell(0,7,'',0,1);
        
        
        $pdf->SetFont('Arial','B',12,'C');
        $pdf->Cell(10,6,'No.',1,0,'C');
        $pdf->Cell(35,6,'Waktu',1,0,'C');
        $pdf->Cell(35,6,'Nama Guru',1,0,'C');
        $pdf->Cell(85,6,'Pelanggaran',1,1,'C');
        
        $pdf->SetFont('Arial','',10);
        
        if (mysqli_num_rows($queryPelanggaran) > 0){
            $no=1;
            while($roww=mysqli_fetch_array($queryPelanggaran)){
                $cellWidth=85; 
        	    $cellHeight=6; 
        	
            	if($pdf->GetStringWidth($roww['nama_pelanggaran']) < $cellWidth){
            		$line=1;
            	}else{
            		
            		$textLength=strlen($roww['nama_pelanggaran']);	
            		$errMargin=6;		
            		$startChar=0;		
            		$maxChar=0;			
            		$textArray=array();	
            		$tmpString="";		
            		
            		while($startChar < $textLength){ 
            
                        while( 
            			$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
            			($startChar+$maxChar) < $textLength ) {
            				$maxChar++;
            				$tmpString=substr($roww['nama_pelanggaran'],$startChar,$maxChar);
            			}
            			$startChar=$startChar+$maxChar;
            			array_push($textArray,$tmpString);
            			$maxChar=0;
            			$tmpString='';
            			
            		}
            		$line=count($textArray);
            	}
        	
            $pdf->SetFillColor(255,255,255);
            $pdf->Cell(10,($line * $cellHeight),$no++,1,0,'C');
            $pdf->Cell(35,($line * $cellHeight),date("d F Y", strtotime($roww['tanggal_pelanggaran'])),1,0,'L');
            $pdf->Cell(35,($line * $cellHeight),$roww['nama_user'],1,0,'L');
            $pdf->MultiCell($cellWidth,$cellHeight,$roww['nama_pelanggaran'].' ('.$roww['poin_pelanggaran'].' poin)',1,1,'L');
        
            }
        }else{
            $pdf->Cell(165,6,'Tidak terdapat catatan pelanggaran',1,1,C);
        }
        
        $pdf->Output();
    }

?>