<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location: login.php");
    }
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
        <!--*******************
            Preloader start
        ********************-->
        <div id="preloader">
            <div class="loader">
                <svg class="circular" viewBox="25 25 50 50">
                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
                </svg>
            </div>
        </div>
        <!--*******************
            Preloader end
        ********************-->

        
        <!--**********************************
            Main wrapper start
        ***********************************-->
        <div id="main-wrapper">

            <!--**********************************
                Nav header start
            ***********************************-->
            <div class="nav-header">
                <div class="brand-logo">
                    <a href="index.php">
                        <b class="logo-abbr"><img src="images/logo.png" alt=""> </b>
                        <span class="logo-compact"><img src="./images/logo-compact.png" alt=""></span>
                        <span class="brand-title">
                            <img src="images/logo-text.png" alt="">
                        </span>
                    </a>
                </div>
            </div>
            <!--**********************************
                Nav header end
            ***********************************-->

            <!--**********************************
                Header start
            ***********************************-->
            <div class="header">    
                <div class="header-content clearfix">
                    
                    <div class="nav-control">
                        <div class="hamburger">
                            <span class="toggle-icon"><i class="icon-menu"></i></span>
                        </div>
                    </div>                
                </div>
            </div>
            <!--**********************************
                Header end ti-comment-alt
            ***********************************-->

            <!--**********************************
                Sidebar start
            ***********************************-->
            <<div class="nk-sidebar">           
                <div class="nk-nav-scroll">
                    <ul class="metismenu" id="menu">            
                        <li>
                            <a href="index.php" aria-expanded="false">
                                <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                            </a>                                       
                        </li>
                        <li class="mega-menu mega-menu-sm">
                            <a href="index.php?page=user-list" aria-expanded="false">
                                <i class="icon-user menu-icon"></i><span class="nav-text">Users</span>
                            </a>                        
                        </li>                    
                        <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon-envelope menu-icon"></i> <span class="nav-text">Data</span>
                            </a>
                            <ul aria-expanded="false">                                
                                <li><a href="index.php?page=jurusan-list">Jurusan</a></li>
                                <li><a href="index.php?page=kelas-list">Kelas</a></li>
                                <li><a href="index.php?page=siswa-list">Siswa</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="index.php?page=pelanggaran-list" aria-expanded="false">
                                <i class="icon-dislike menu-icon"></i><span class="nav-text">Pelanggaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=prestasi-list" aria-expanded="false">
                                <i class="icon-star menu-icon"></i><span class="nav-text">Prestasi</span>
                            </a>
                        </li>                    
                        <li>
                           <a href="index.php?page=skala-sikap-list" aria-expanded="false">
                                <i class="icon-target menu-icon"></i><span class="nav-text">Skala Sikap</span>
                            </a>
                        </li>
                        <li>
                           <a href="index.php?page=riwayat" aria-expanded="false">
                                <i class="icon-clock menu-icon"></i><span class="nav-text">Riwayat</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=ekspor" aria-expanded="false">
                                <i class="icon-close menu-icon"></i><span class="nav-text">Ekspor</span>
                            </a>
                        </li>                    
                        <li>
                            <a href="login.php" aria-expanded="false">
                                <i class="icon-logout menu-icon"></i><span class="nav-text">Logout</span>
                            </a>
                        </li>                    
                    </ul>
                </div>
            </div>
            <!--**********************************
                Sidebar end
            ***********************************-->

            <!--**********************************
                Content body start
            ***********************************-->
            <div class="content-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <?php
                                if(isset($_GET['page'])){
                                    $page = $_GET['page'];

                                    switch($page){
                                        case 'user-list':
                                            include "module/user/list.php";
                                        break;
                                        case 'user-form':
                                            include "module/user/form.php";
                                        break;
                                        case 'jurusan-list':
                                            include "module/jurusan/list.php";
                                        break;
                                        case 'jurusan-form':
                                            include "module/jurusan/form.php";
                                        break;   
                                        case 'kelas-list':
                                            include "module/kelas/list.php";
                                        break;
                                        case 'kelas-form':
                                            include "module/kelas/form.php";
                                        break; 
                                        case 'siswa-list':
                                            include "module/siswa/list.php";
                                        break;
                                        case 'siswa-form':
                                            include "module/siswa/form.php";
                                        break; 
                                        case 'pelanggaran-list':
                                            include "module/pelanggaran/list.php";
                                        break;
                                        case 'pelanggaran-form':
                                            include "module/pelanggaran/form.php";
                                        break; 
                                        case 'prestasi-list':
                                            include "module/prestasi/list.php";
                                        break;
                                        case 'prestasi-form':
                                            include "module/prestasi/form.php";
                                        break;
                                        case 'skala-sikap-list':
                                            include "module/skala-sikap/list.php";
                                        break;
                                        case 'skala-sikap-form':
                                            include "module/skala-sikap/form.php";
                                        break;  
                                        default:
                                            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                                        break;
                                    }
                                }else{
                                    include "main.php";
                                }

                            ?>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
                <!-- #/ container -->
        </div>

        <script src="plugins/common/common.min.js"></script>
        <script src="js/custom.min.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/gleek.js"></script>
        <script src="js/styleSwitcher.js"></script>


        <!-- Chartjs -->
        <script src="./plugins/chart.js/Chart.bundle.min.js"></script>
        <!-- Circle progress -->
        <script src="./plugins/circle-progress/circle-progress.min.js"></script>
        <!-- Datamap -->
        <script src="./plugins/d3v3/index.js"></script>
        <script src="./plugins/topojson/topojson.min.js"></script>
        <script src="./plugins/datamaps/datamaps.world.min.js"></script>
        <!-- Morrisjs -->
        <script src="./plugins/raphael/raphael.min.js"></script>
        <script src="./plugins/morris/morris.min.js"></script>
        <!-- Pignose Calender -->
        <script src="./plugins/moment/moment.min.js"></script>
        <script src="./plugins/pg-calendar/js/pignose.calendar.min.js"></script>
        <!-- ChartistJS -->
        <script src="./plugins/chartist/js/chartist.min.js"></script>
        <script src="./plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>

        <script src="./js/dashboard/dashboard-1.js"></script>
        <script src="./js/plugins-init/morris-init.js"></script>

        <script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
        <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
        <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>


    </body>

</html>