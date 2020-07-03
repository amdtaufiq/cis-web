<?php
    session_start();
    $user_id = $_SESSION["user_id"];
    $level = $_SESSION["level"];

    include_once("function/koneksi.php");
    include_once("function/helper.php");

    if($user_id && $level=='Guru BK'){
        $queryProfile = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id=$user_id");
        $row = mysqli_fetch_assoc($queryProfile);
    }else {
        header("location:". BASE_URL."login.php");
    }

    $username = $row['username'];
    $level = $row['level'];

    $_SESSION['user_id'] = $user_id;
    $_SESSION['level'] = $level;
    
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>CIS</title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="images/user_sibiko.png">                
        <!-- Custom Stylesheet -->
        <link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="./plugins/toastr/css/toastr.min.css" rel="stylesheet">

        <link href="./plugins/sweetalert/css/sweetalert.css" rel="stylesheet">

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
                        <b class="logo-abbr">
                            <!-- <h3 class="text-white">S</h3> -->
                            <img src="images/S.png" style="width: 20px; height:20px; margin-top:0px;" alt=""> 
                            
                        </b>
                        <span class="logo-compact"><img src="./images/logo-compact.png" alt=""></span>
                        <span class="brand-title">
                            <!-- <h3 class="text-white">S I B I K O</h3> -->
                            <img src="images/SIBIKO.png" style="width: 60px;" alt="">
                            
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
                    <div class="header-right">
                        <ul class="clearfix"> 
                            <li class="icons dropdown">
                                <div class="user-img position-relative toggle" data-toggle="dropdown">                                    
                                    <img src="icons/bell.png" alt="">
                                    <span class="badge badge-pill count" >
                                    </span>
                                </div>
                                <div class="drop-down animated fadeIn dropdown-menu drop dropdown-notfication">
                                    <div class="dropdown-content-heading d-flex justify-content-between">
                                        
                                    </div>
                                </div>
                            </li>

                            <li class="icons dropdown">
                                <div class="user-img position-relative" data-toggle="dropdown">
                                    <img src="icons/user.png" alt="">
                                </div>
                                <div class="drop-down dropdown-profile dropdown-menu">
                                    <div class="dropdown-content-body">
                                        <ul>                                            
                                            <li>
                                                <a><?php echo $username ?></a>
                                                <small class="text-muted"><?php echo $level ?></small>
                                            </li>
                                            
                                            <li><a href="logout.php">Keluar</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>               
                        </ul>
                    </div>
                </div>
            </div>
            <!--**********************************
                Header end ti-comment-alt
            ***********************************-->

            <!--**********************************
                Sidebar start
            ***********************************-->
            <div class="nk-sidebar">           
                <div class="nk-nav-scroll">
                    <ul class="metismenu" id="menu">            
                        <li>
                            <a href="index.php" aria-expanded="false">
                                <i class="icon-speedometer menu-icon"></i><span class="nav-text">Beranda</span>
                            </a>                                       
                        </li>
                        <li>
                            <a href="index.php?page=search-siswa-pelanggaran" aria-expanded="false">
                                <i class="icon-dislike menu-icon"></i><span class="nav-text">Catatan Pelanggaran</span>
                            </a>                                       
                        </li>
                        <li>
                            <a href="index.php?page=search-siswa-prestasi" aria-expanded="false">
                                <i class="icon-like menu-icon"></i><span class="nav-text">Catatan Prestasi</span>
                            </a>                                       
                        </li>
                        <li>
                           <a href="index.php?page=status-siswa-list" aria-expanded="false">
                                <i class="icon-docs menu-icon"></i><span class="nav-text">Status Siswa</span>
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
                                        case 'catatan-pelanggaran-form':
                                            include "module/catatan/form-pelanggaran.php";
                                        break;
                                        case 'search-siswa-pelanggaran':
                                            include "module/catatan/search-siswa-pelanggaran.php";
                                        break;
                                        case 'catatan-prestasi-form':
                                            include "module/catatan/form-prestasi.php";
                                        break;
                                        case 'search-siswa-prestasi':
                                            include "module/catatan/search-siswa-prestasi.php";
                                        break;
                                        case 'status-siswa-list':
                                            include "status-siswa-list.php";
                                        break;
                                        case 'riwayat':
                                            include "riwayat.php";
                                        break;
                                        case 'ekspor':
                                            include "ekspor.php";
                                        break;  
                                        default:
                                            include "not-found.php";
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
            <!--<div class="footer">-->
            <!--    <div class="copyright">-->
            <!--        <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>-->
            <!--    </div>-->
            <!--</div>-->
        </div>

        <script src="plugins/common/common.min.js"></script>
        <script src="js/custom.min.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/gleek.js"></script>
        <script src="js/styleSwitcher.js"></script>

        <script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
        <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
        <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

        <script src="js/Chart.js"></script>

        <script src="./plugins/toastr/js/toastr.min.js"></script>
        <script src="./plugins/toastr/js/toastr.init.js"></script>
        
        <script src="./plugins/sweetalert/js/sweetalert.min.js"></script>
        <script src="./plugins/sweetalert/js/sweetalert-dev.js"></script>


        <script>
            $(document).ready(function(){
            
            function load_unseen_notification(view = '')
            {
            $.ajax({
            url:"fetch-notif.php",
            method:"POST",
            data:{view:view},
            dataType:"json",
            success:function(data)
            {
                $('.drop').html(data.notification);
                if(data.unseen_notification > 0)
                {
                $('.count').html(data.unseen_notification);
                }else{
                    $('.count').text('0');
                }
            }
            });
            }
            
            load_unseen_notification();
            
            $(document).on('click', '.toggle', function(){
            $('.count').html('');
            load_unseen_notification('yes');
            });
            
            setInterval(function(){ 
            load_unseen_notification();; 
            }, 5000);
            
            });
        </script>

        
        <script>
		        $(document).ready(function(){
			        $("#kosong").hide();
		        });
		</script>  
        
                        
    </body>

</html>
