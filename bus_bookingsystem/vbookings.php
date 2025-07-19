<?php 
ob_start();
session_start();
include("db_connection.php");

$bno = $_SESSION['bno']; // Bus Owner ID from session

// Fetch all bus bookings for this owner
$query = "SELECT * from `register` INNER JOIN `booking` ON register.id=booking.bus_id INNER JOIN `account` ON booking.user_email=account.uemail INNER JOIN `bus_details` ON booking.bus_id=bus_details.bid WHERE register.bno='$bno'
          ";

$result = mysqli_query($con, $query);
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
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">View your Bookings</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>User Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Journey Date</th>
                                                        <th>Source</th>
                                                        <th>Destination</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sn = 1;
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo "<tr>
                                                                <td>{$sn}</td>
                                                                <td>{$row['uname']}</td>
                                                                <td>{$row['uemail']}</td>
                                                                <td>{$row['uphone']}</td>
                                                                <td>{$row['travel_date']}</td>
                                                                <td>{$row['bstart']}</td>
                                                                <td>{$row['bend']}</td>
                                                                
                                                            </tr>";
                                                            $sn++;
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='8' class='text-center'>No bookings found.</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- app-main -->
            </div> <!-- app-container -->
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