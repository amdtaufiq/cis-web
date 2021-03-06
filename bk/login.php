<?php

    include_once("function/helper.php");
    session_start();
	if(isset($_SESSION["user_id"]) && isset($_SESSION["level"]) ){
		header("location: ".BASE_URL."index.php");
	}

?>


<!DOCTYPE html>
<html class="h-100" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>CIS</title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/user_sibiko.png">

        <link href="css/style.css" rel="stylesheet">
        <style>
            .warning-form{color: #FF0000;}
        </style>
        
    </head>

    <body class="h-100">

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

        <div class="login-form-bg h-100">
            <div class="container h-100">
                <div class="row justify-content-center h-100">
                    <div class="col-xl-6">
                        <div class="form-input-content">
                            <div class="card login-form mb-0">
                                <div class="card-body pt-5">
                                    <a class="text-center" href="proses-login.php"> 
                                        <h3>CIS</h3>
                                            <br>
                                        <h5>Counseling Guidance Information System</h5>
                                    </a>
            
                                    <form class="mt-5 mb-5 login-input" action="proses-login.php" method="post">

                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control text-center" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control text-center" placeholder="Password" required>
                                        </div>
                                        <input type="submit" value="LOGIN" name="login" class="btn login-form__btn submit w-100">                                        
                                    </form>

                                    <p class="mt-5 login-form__footer">Forgot Password? <a href="#" class="text-primary" onclick="alert('Hubungi Developer 087808007942')">Call Me</a> now !</p>                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        

        <!--**********************************
            Scripts
        ***********************************-->
        <script src="plugins/common/common.min.js"></script>
        <script src="js/custom.min.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/gleek.js"></script>
        <script src="js/styleSwitcher.js"></script>
    </body>
</html>