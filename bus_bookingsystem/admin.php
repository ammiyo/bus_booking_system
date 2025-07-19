<?php
$result="";
    ob_start();
    session_start();
    $con=mysqli_connect("localhost", "root", "", "bus");
    //Response.Cache.SetNoStore();
    if(isset($_POST['login']))
    {
        $adminid = mysqli_real_escape_string($con, strtolower($_POST['adminid']));
        //$phone = mysqli_real_escape_string($con, $_POST['phone']);
        $check_email = "SELECT * from admin WHERE adminid = '$adminid'";
        $check_email_run = mysqli_query($con, $check_email);
        $result = mysqli_num_rows($check_email_run);
        if($result > 0)
        {
            $row1 = mysqli_fetch_assoc($check_email_run);
            $bno=$row1['bno'];
            header('Location: view_bus.php');
        //$_SESSION['bno'] = $bno;
        
        
        }
        else
        {
           $result='<div class="alert alert-success">Invalid Bus Registration Number</div>';
        }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Find My Bus</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin template that can be used to build dashboards for CRM, CMS, etc." />
    <meta name="author" content="Potenza Global Solutions" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- app favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- plugin stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors.css" />
    <!-- app style -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css" />
</head>

<body class="bg-white">
    <!-- begin app -->
    <div class="app">
        <!-- begin app-wrap -->
        <div class="app-wrap">
            <!-- begin pre-loader -->
            <div class="loader">
                <div class="h-100 d-flex justify-content-center">
                    <div class="align-self-center">
                        <img src="assets/img/loader/loader.svg" alt="loader">
                    </div>
                </div>
            </div>
            <!-- end pre-loader -->

            <!--start login contant-->
            <div class="app-contant">
                <div class="bg-white">
                    <div class="container-fluid p-0">
                        <div class="row no-gutters">
                            <div class="col-sm-6 col-lg-5 col-xxl-3  align-self-center order-2 order-sm-1">
                                <div class="d-flex align-items-center h-100-vh">
                                    <div class="login p-50">
                                        <strong><?php echo $result; ?></strong>
                                        <h1 class="mb-2">Welcome to Find My Bus</h1>
                                        <p>Administrator Login</p>
                                        <form action="" class="mt-3 mt-sm-5" method="POST">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Enter Admin ID</label>
                                                        <input type="text" class="form-control" name="adminid" id="adminid" />
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-12 mt-3">
                                                    <input type="submit" name="login" class="btn btn-primary text-uppercase" value="Log In">
                                                </div>
                                                
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xxl-9 col-lg-7 bg-gradient o-hidden order-1 order-sm-2">
                                <div class="row align-items-center h-100">
                                    <div class="col-7 mx-auto ">
                                        <img class="img-fluid" src="assets/img/bg/busi.svg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end login contant-->
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->



    <!-- plugins -->
    <script src="assets/js/vendors.js"></script>

    <!-- custom app -->
    <script src="assets/js/app.js"></script>
</body>


</html>