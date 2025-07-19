<?php
session_start();
include("db_connection.php");

// Redirect if not logged in
if (!isset($_SESSION['user_email'])) {
    echo "<script>alert('Please login first to book the bus'); window.location='index.php';</script>";
    exit();
}

// Fetch bus id from GET
if (!isset($_GET['bus_id'])) {
    echo "<script>alert('No bus selected'); window.location='index.php';</script>";
    exit();
}

$bus_id = $_GET['bus_id'];

// Fetch bus details
$bus_sql = "SELECT r.bname, r.oname, r.bno, r.bchasis, r.bengine, r.phone, d.bstart, d.bend, d.btype, d.fare, d.bstatus 
            FROM register r 
            JOIN bus_details d ON r.id = d.bid 
            WHERE d.bid = '$bus_id'";
$bus_result = mysqli_query($con, $bus_sql);
$bus = mysqli_fetch_assoc($bus_result);

// Fetch route
$route_sql = "SELECT route FROM bus_route WHERE bid = '$bus_id'";
$route_result = mysqli_query($con, $route_sql);
$routes = [];
while ($row = mysqli_fetch_assoc($route_result)) {
    $routes[] = $row['route'];
}
if (isset($_SESSION['user_email'])) {
    $email = $_SESSION['user_email'];
    $user_sql = "SELECT * FROM account WHERE uemail = ?";
    $stmt = $con->prepare($user_sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user_result = $stmt->get_result();
    if ($user_result->num_rows > 0) {
        $user = $user_result->fetch_assoc();
    }
}
?>
 <?php
 $result="";
// Check if form is submitted
if (isset($_POST['book_now'])) {
    $bus_id = $_POST['bus_id'];
    $user_email = $_POST['user_email'];
    $travel_date = $_POST['travel_date'];
    $notes = mysqli_real_escape_string($con, $_POST['notes'] ?? '');
    $check_sql = "SELECT * FROM booking WHERE bus_id = ? AND user_email = ? AND travel_date = ?";
    $check_stmt = $con->prepare($check_sql);
    $check_stmt->bind_param("iss", $bus_id, $user_email, $travel_date);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $result = '<div class="alert alert-warning">You have already booked this bus for the selected date.</div>';
    } else {
        // Insert booking into database
        $insert_sql = "INSERT INTO `booking` (bus_id, user_email, travel_date, notes) VALUES (?, ?, ?, ?)";
        $insert_stmt = $con->prepare($insert_sql);
        $insert_stmt->bind_param("isss", $bus_id, $user_email, $travel_date, $notes);

        if ($insert_stmt->execute()) {
           $result='<div class="alert alert-success">Booking Successfull</div>'; 
        } else {
            $result='<div class="alert alert-success">Error in Booking</div>'; 
        }
    }
    } 
?>
<?php include('uheader.php'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Page Header Start -->
    
    <br>

    
    <!-- Page Header End -->


    <!-- 404 Start -->
    <div class="page-content">
            <div class="container">
                <div class="card p-4 mb-5">
                    <h3 class="text-center mb-4">Bus Information</h3>
                     <strong><?php 
      echo $result; ?></strong>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Bus Name:</strong> <?= $bus['bname']; ?></p>
                            <p><strong>Owner Name:</strong> <?= $bus['oname']; ?></p>
                            <p><strong>Contact:</strong> <?= $bus['phone']; ?> | <?= $bus['bno']; ?></p>
                            <p><strong>Chasis No:</strong> <?= $bus['bchasis']; ?></p>
                            <p><strong>Engine No:</strong> <?= $bus['bengine']; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Start:</strong> <?= $bus['bstart']; ?></p>
                            <p><strong>End:</strong> <?= $bus['bend']; ?></p>
                            <p><strong>Type:</strong> <?= $bus['btype']; ?></p>
                            <p><strong>Status:</strong> <?= $bus['bstatus']; ?></p>
                            <p><strong>Fare:</strong> ₹<?= $bus['fare']; ?></p>
                        </div>
                    </div>

                    <hr>

                    <h4>Route Covered</h4>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($routes as $r): ?>
                            <li class="list-group-item"><?= $r; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="card shadow-sm mb-4">
                         <h3 class="text-center mb-4">User Information</h3>
        <div class="card-body">
          <h5 class="card-title">Your Information</h5>
          <p><strong>Name:</strong> <?= htmlspecialchars($user['uname']) ?></p>
          <p><strong>Email:</strong> <?= htmlspecialchars($user['uemail']) ?></p>
          <p><strong>Phone:</strong> <?= htmlspecialchars($user['uphone']) ?></p>
          <p><strong>Address:</strong> <?= htmlspecialchars($user['uaddress']) ?>, <?= htmlspecialchars($user['ucity']) ?>, <?= htmlspecialchars($user['ustate']) ?> - <?= htmlspecialchars($user['upin']) ?></p>
        </div>
      </div>
                    <hr>

                    <form action="" method="POST">

                        <input type="hidden" name="user_email" value="<?= $email; ?>">
                        <input type="hidden" name="bus_id" value="<?= $bus_id; ?>">
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label for="travel_date">Select Travel Date</label>
                                <input type="date" name="travel_date" id="travel_date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="notes">Notes (Optional)</label>
                                <textarea name="notes" id="notes" class="form-control" placeholder="Any special request..."></textarea>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" name="book_now" class="btn btn-success btn-rounded px-4">Confirm Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
   

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