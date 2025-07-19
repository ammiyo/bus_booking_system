<?php 
ob_start();
session_start();
$bno = $_SESSION['bno'];
?>
<?php 
$con=mysqli_connect("localhost","root","","bus");
$bname="";
$oname="";
if(isset($_GET['bno']))
    $bno=$_GET['bno'];
else

    $sql="SELECT * FROM `register` WHERE bno='$bno'";
    $result=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($result))
    {

        $bname=$row['bname'];
         $oname=$row['oname'];
         $email=$row['email'];
         $phone=$row['phone'];
         $oname=$row['oname'];
         $bno=$row['bno'];
         $bchasis=$row['bchasis'];
         $bengine=$row['bengine'];
         $id=$row['id'];
         

    }

?>

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
        
    
    $sql = "INSERT INTO `bus_details`(`bid`, `bstart`, `bend`, `btype`, `fare`) VALUES ('$bid','$bstart','$bend','$btype','$fare')";
    $res = $con->query($sql);
          //header("location: add_route.php");
          $result='<div class="alert alert-success">Bus Detials Added Successfully</div>';  
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
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
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
            <!-- begin app-header -->
            <header class="app-header top-bar">
                <!-- begin navbar -->
                <nav class="navbar navbar-expand-md">

                    <!-- begin navbar-header -->
                    <div class="navbar-header d-flex align-items-center">
                        <a href="javascript:void:(0)" class="mobile-toggle"><i class="ti ti-align-right"></i></a>
                        <a class="navbar-brand" href="index.html">
                            <img src="assets/img/n2.png" class="img-fluid logo-desktop" alt="logo" />
                            <img src="assets/img/logo1.png" class="img-fluid logo-mobile" alt="logo" />
                        </a>
                    </div>
            
                <!-- end navbar -->
            </header>
            <!-- end app-header -->
            <!-- begin app-container -->
            <div class="app-container">
                <!-- begin app-nabar -->
                <aside class="app-navbar">
                    <!-- begin sidebar-nav -->
                    <div class="sidebar-nav scrollbar scroll_light">
                        <ul class="metismenu " id="sidebarNav">
                            <li><a href="bus_details.php" aria-expanded="false"><i class="nav-icon ti ti-comment"></i><span class="nav-title">Add Bus Details</span></a> </li>
                            <li><a href="add_route.php" aria-expanded="false"><i class="nav-icon ti ti-comment"></i><span class="nav-title">Add Bus Route Details</span></a> </li>
                            <li><a href="vbookings.php" aria-expanded="false"><i class="nav-icon ti ti-comment"></i><span class="nav-title">View Bookings</span></a> </li>
                            
                            <li><a href="login.php" aria-expanded="false"><i class="nav-icon ti ti-comment"></i><span class="nav-title">Log Out</span></a> </li>
                        </ul>
                    </div>
                    <!-- end sidebar-nav -->
                </aside>
                <!-- end app-navbar -->
                <!-- begin app-main -->
                <div class="app-main" id="main">
                    <!-- begin container-fluid -->
                    <div class="container-fluid">
                        <!-- begin row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <strong><?php echo $result; ?></strong>
                                            <h4 class="card-title">Add More Bus Details</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Name of the Bus</label>
                                                    <input type="text" class="form-control" id="bname" name="bname" value="<?php echo $bname; ?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Name of the Bus Owner</label>
                                                    <input type="text" class="form-control" id="oname" name="oname" value="<?php echo $oname; ?>" >
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                   <label for="inputAddress">Onwer Email</label>
                                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                                                <input type="hidden" class="form-control" id="bid" name="bid" value="<?php echo $id; ?>">
                                                
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputAddress2">Owner Phone Number</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputCity">Bus Registration Number</label>
                                                    <input type="text" class="form-control" id="bno" name="bno" value="<?php echo $bno; ?>">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputState">Bus Chasis Number</label>
                                                   <input type="text" class="form-control" id="bchasis" name="bchasis" value="<?php echo $bchasis; ?>">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputZip">Bus Engine Number</label>
                                                    <input type="text" class="form-control" id="bengine" name="bengine" value="<?php echo $bengine; ?>">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputCity">Bus Route Start From</label>
                                                    <input type="text" class="form-control" id="bstart" name="bstart">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputState">Bus Route Ends At</label>
                                                   <input type="text" class="form-control" id="bend" name="bend">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputZip">Bus Type</label>
                                                    <Select class="form-control" id="btype" name="btype">
                                                        <option>Select Any</option>
                                                        <option value="AC">AC</option>
                                                        <option value="Non AC">Non AC</option>
                                                        <option value="Semi Sleeper">Semi Sleeper</option>
                                                    </Select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputZip">Bus Fare</label>
                                                    <input type="text" class="form-control" id="fare" name="fare" >
                                                </div>
                                            </div>
                                            <button type="submit" name="insert" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container-fluid -->
                </div>
                <!-- end app-main -->
            </div>
            <!-- end app-container -->
            <!-- begin footer -->
            <footer class="footer">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-left">
                        <p>&copy; Copyright 2019. All rights reserved.</p>
                    </div>
                    <div class="col  col-sm-6 ml-sm-auto text-center text-sm-right">
                        <p><a target="_blank" href="https://www.templateshub.net">Templates Hub</a></p>
                    </div>
                </div>
            </footer>
            <!-- end footer -->
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