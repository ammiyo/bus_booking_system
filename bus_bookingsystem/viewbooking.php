<?php 
ob_start();
session_start();
include("db_connection.php");

// Fetch all bookings
$query = "SELECT * FROM booking 
          INNER JOIN account ON booking.user_email = account.uemail 
          INNER JOIN register ON booking.bus_id = register.id 
          INNER JOIN bus_details ON booking.bus_id = bus_details.bid 
          ORDER BY booking.id DESC";

$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Bookings - Admin</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin - View All Bookings" />
    <meta name="author" content="Potenza Global Solutions" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
    <div class="app">
        <div class="app-wrap">
            <div class="loader">
                <div class="h-100 d-flex justify-content-center">
                    <div class="align-self-center">
                        <img src="assets/img/loader/loader.svg" alt="loader">
                    </div>
                </div>
            </div>

            <header class="app-header top-bar">
                <nav class="navbar navbar-expand-md">
                    <div class="navbar-header d-flex align-items-center">
                        <a href="javascript:void(0)" class="mobile-toggle"><i class="ti ti-align-right"></i></a>
                        <a class="navbar-brand" href="index.html">
                            <img src="assets/img/n2.png" class="img-fluid logo-desktop" alt="logo" />
                            <img src="assets/img/logo1.png" class="img-fluid logo-mobile" alt="logo" />
                        </a>
                    </div>
                </nav>
            </header>

            <div class="app-container">
                <aside class="app-navbar">
                    <div class="sidebar-nav scrollbar scroll_light">
                        <ul class="metismenu" id="sidebarNav">
                            <li><a href="view_bus.php" aria-expanded="false"><i class="nav-icon ti ti-comment"></i><span class="nav-title">View Bus</span></a> </li>
                            <li><a href="vpassengers.php" aria-expanded="false"><i class="nav-icon ti ti-comment"></i><span class="nav-title">View Passengers</span></a> </li>
                            <li><a href="viewbooking.php" aria-expanded="false"><i class="nav-icon ti ti-comment"></i><span class="nav-title">View Bookings</span></a> </li>
                            
                            <li><a href="admin.php" aria-expanded="false"><i class="nav-icon ti ti-comment"></i><span class="nav-title">Log Out</span></a> </li>
                        </ul>
                    </div>
                </aside>

                <div class="app-main" id="main">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">All Bookings</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Passenger</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Bus</th>
                                                        <th>From</th>
                                                        <th>To</th>
                                                        <th>Fare</th>
                                                        <th>Travel Date</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sn = 1;
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $status = isset($row['status']) ? ucfirst($row['status']) : 'Active';
                                                            echo "<tr>
                                                                <td>{$sn}</td>
                                                                <td>{$row['uname']}</td>
                                                                <td>{$row['uemail']}</td>
                                                                <td>{$row['uphone']}</td>
                                                                <td>{$row['bname']}</td>
                                                                <td>{$row['bstart']}</td>
                                                                <td>{$row['bend']}</td>
                                                                <td>₹{$row['fare']}</td>
                                                                <td>{$row['travel_date']}</td>
                                                                <td>{$status}</td>
                                                            </tr>";
                                                            $sn++;
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='10' class='text-center'>No bookings found.</td></tr>";
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

            <footer class="footer">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-left">
                        <p>&copy; Copyright 2019. All rights reserved.</p>
                    </div>
                    <div class="col col-sm-6 ml-sm-auto text-center text-sm-right">
                        <p><a target="_blank" href="https://www.templateshub.net">Templates Hub</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="assets/js/vendors.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>
