<?php
session_start();
?>
<?php include('uheader.php'); ?>
<?php include('functions.php'); ?>
   <?php
$host = "localhost";
$user = "root";
$password = "";
$database = "bus";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $con = mysqli_connect($host, $user, $password, $database);
} catch (Exception $ex) {
    echo 'Error';
}
                     
                   
                 $whereClause = "";

if (isset($_POST['search'])) {
    $bstart = trim($_POST['bstart']);
    $bend = trim($_POST['bend']);

    if (!empty($bstart) && $bstart !== "Select Start Route") {
        $whereClause .= " AND bus_details.bstart = '$bstart'";
    }
    if (!empty($bend) && $bend !== "Select End Route") {
        $whereClause .= " AND bus_details.bend = '$bend'";
    }
}

// SQL query to fetch data
$query = "SELECT * FROM `register` INNER JOIN `bus_details` ON register.id = bus_details.bid INNER JOIN `bus_route` ON bus_details.bid=bus_route.bid WHERE 1 $whereClause";
$search_result = mysqli_query($con, $query);
               ?>
               <?php 
               if (isset($_POST['login'])) {
    $uemail = mysqli_real_escape_string($con, $_POST['uemail']);
    $upassword = mysqli_real_escape_string($con, $_POST['upassword']);

    $query = "SELECT * FROM `account` WHERE uemail='$uemail' AND upassword='$upassword'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        //$_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['uemail'];
        echo "<script>alert('Login Successful'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }
}
 ?>

<?php
// DB connection
$con = new mysqli("localhost", "root", "", "bus");

// Fetch bus count
$bus_result = mysqli_query($con, "SELECT COUNT(*) AS total_buses FROM register");
$bus_data = mysqli_fetch_assoc($bus_result);
$total_buses = $bus_data['total_buses'];

// Fetch passenger count
$passenger_result = mysqli_query($con, "SELECT COUNT(*) AS total_passengers FROM account");
$passenger_data = mysqli_fetch_assoc($passenger_result);
$total_passengers = $passenger_data['total_passengers'];
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                        
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="singin-email-2">Email Address *</label>
                                            <input type="email" class="form-control" id="uemail" name="uemail" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password-2">Password *</label>
                                            <input type="password" class="form-control" id="upassword" name="upassword" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            

                                           

                                            <a href="forgot.php" class="forgot-link">Forgot Your Password?</a>
                                        </div>
                                        <div class="form-footer">
                                            

                                           

                                            <a href="create.php" class="forgot-link">Create Account</a>
                                        </div><!-- End .form-footer -->
                                    
      </div>
      <div class="modal-footer">
        
        <button type="submit" name="login" class="btn btn-primary">Login</button>
      </div>
    </div>
    </form>
  </div>
</div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Header End -->


        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->
<br><br><br>

        <!-- Booking Start -->
        <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="bg-white shadow" style="padding: 35px;">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <form action="" method="POST">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <select class="form-control" name="bstart" id="bstart">
                                            <option>Select Start Route</option>
                                               <?php get_start(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <select class="form-control" name="bend" id="bend">
                                            <option>Select End Route</option>
                                               <?php get_end(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                            <button class="btn btn-primary w-100" type="submit" name="search">Find Bus</button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary w-100" type="submit" name="clear">Clear Filer</button>
                        </div>
                            </div>
                        </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Booking End -->


        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
    <h6 class="section-title text-start text-primary text-uppercase">About Us</h6>
    <h1 class="mb-4">Welcome to <span class="text-primary text-uppercase">Find My Bus</span></h1>
    <p class="mb-4">We help you find registered buses and manage your travel efficiently. Our growing network ensures safe and timely journeys across various routes.</p>
    <div class="row g-3 pb-4">
        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
            <div class="border rounded p-1">
                <div class="border rounded text-center p-4">
                    <i class="fa fa-bus fa-2x text-primary mb-2"></i>
                    <h2 class="mb-1" data-toggle="counter-up"><?php echo $total_buses; ?></h2>
                    <p class="mb-0">Registered Buses</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
            <div class="border rounded p-1">
                <div class="border rounded text-center p-4">
                    <i class="fa fa-users fa-2x text-primary mb-2"></i>
                    <h2 class="mb-1" data-toggle="counter-up"><?php echo $total_passengers; ?></h2>
                    <p class="mb-0">Registered Passengers</p>
                </div>
            </div>
        </div>
    </div>
    
</div>

                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-end">
                             <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="bus.avif" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="bus1.jpeg" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-end">
                               <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="bus2.jpeg" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                              <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="bus3.jpeg" style="margin-top: 25%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Room Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Our Buses</h6>
                    <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Buses</span></h1>
                </div>
               
                <div class="row g-4">
                  <?php while ($row = mysqli_fetch_assoc($search_result)) : ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden">
                            
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0"><?php echo $row['bname']; ?></h5>
                                    <div class="ps-2">
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bus text-primary me-2"></i><?php echo $row['bstart']; ?></small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bus text-primary me-2"></i><?php echo $row['bend']; ?></small>
                                    <small><i class="fa fa-rupee text-primary me-2"></i><?php echo $row['fare']; ?></small>
                                </div>
                                <p class="text-body mb-3">
                                    Bus Type: <?php echo $row['btype']; ?>
                                    <br>
                                     Bus Owner Name: <?php echo $row['oname']; ?>
                                     <br>
                                      Contact No. : <?php echo $row['phone']; ?>
                                      <br>
                                       Bus Registration No. : <?php echo $row['bno']; ?>
                                       <br>
                                        Bus Route: <?php echo $row['route']; ?>
                                </p>
                               <div class="d-flex justify-content-between">
    <?php if (isset($_SESSION['user_email'])) {?>
    <a href="book.php?bus_id=<?php echo $row['bid']; ?>" class="btn btn-success">Book Now</a>
<?php } else {?>
    <button class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Login to Book</button>
<?php }?>
</div>
                            </div>
                        </div>
                    </div>
                   <?php endwhile; ?>
                
                </div>
                
            </div>
        </div>
        <br><br><br><br>
        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved. 
                            
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>