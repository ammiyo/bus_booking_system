
<?php  
$result='';
$host="localhost";
$user="root";
$password="";
$database="bus";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try{
    $con=mysqli_connect($host, $user, $password, $database);
}catch (Exception $ex){
    echo'Error';
}
  if(isset($_POST['insert'])){
    
    extract($_POST);
      
    
    $sql = "INSERT INTO `register`(`bname`, `oname`, `email`, `phone`, `bno`, `bchasis`, `bengine`) VALUES ('$bname','$oname','$email','$phone','$bno','$bchasis','$bengine')";
    $res = $con->query($sql);
          //header("location: add.php");
          $result='<div class="alert alert-success">Bus Account Created Successfully</div>';  
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
                                    <div class="register p-5">
                                        <strong><?php echo $result; ?></strong>
                                        <h1 class="mb-2">Welcome to Find My Bus</h1>
                                        <p>Create your Bus Account here</p>
                                        <form action="" class="mt-2 mt-sm-5" method="POST">
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Enter your Bus Name*</label>
                                                        <input type="text" class="form-control" name="bname" id="bname" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Enter Bus Owner Name*</label>
                                                        <input type="text" class="form-control" name="oname" id="oname" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                   <div class="form-group">
                                                        <label class="control-label">Enter your Email*</label>
                                                        <input type="email" class="form-control" name="email" id="email" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Enter your Phone Number*</label>
                                                        <input type="text" class="form-control" name="phone" id="phone" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Enter your Bus Registration Number*</label>
                                                        <input type="text" class="form-control" name="bno" id="bno" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Enter Bus Chasis Numner*</label>
                                                        <input type="text" class="form-control"  name="bchasis" id="bchasis" />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Enter Bus Engine Numner*</label>
                                                        <input type="text" class="form-control"  name="bengine" id="bengine" />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12 mt-3">
                                                    <input type="submit" name="insert" class="btn btn-primary text-uppercase" value="Create">
                                                </div>
                                                <div class="col-12  mt-3">
                                                    <p>Already have an account ?<a href="login.php">Log In</a></p>
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