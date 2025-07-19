<?php
session_start();
include("db_connection.php");

// Redirect if not logged in
if (!isset($_SESSION['user_email'])) {
    echo "<script>alert('Please login first to view your bookings'); window.location='index.php';</script>";
    exit();
}

$email = $_SESSION['user_email'];
$result = "";

// Cancel booking logic
if (isset($_GET['cancel']) && is_numeric($_GET['cancel'])) {
    $booking_id = $_GET['cancel'];

    $cancel_sql = "DELETE FROM booking WHERE id = ? AND user_email = ?";
    $stmt = $con->prepare($cancel_sql);
    $stmt->bind_param("is", $booking_id, $email);

    if ($stmt->execute()) {
        $result = '<div class="alert alert-success">Booking cancelled successfully.</div>';
    } else {
        $result = '<div class="alert alert-danger">Failed to cancel booking.</div>';
    }
}

// Fetch bookings
$booking_sql = "SELECT b.id, b.travel_date, b.notes, d.fare, d.bstart, d.bend, r.bname, r.bno 
                FROM booking b 
                JOIN bus_details d ON b.bus_id = d.bid 
                JOIN register r ON d.bid = r.id 
                WHERE b.user_email = ? 
                ORDER BY b.travel_date DESC";

$stmt = $con->prepare($booking_sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$booking_result = $stmt->get_result();
?>

<?php include('uheader.php'); ?>

<div class="page-content">
    <div class="container">
        <div class="card p-4 mb-5">
            <h3 class="text-center mb-4">My Bookings</h3>
            <?php echo $result; ?>
            <?php if ($booking_result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Bus Name</th>
                                <th>Bus No</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Travel Date</th>
                                <th>Fare (₹)</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = $booking_result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['bname']) ?></td>
                                <td><?= htmlspecialchars($row['bno']) ?></td>
                                <td><?= htmlspecialchars($row['bstart']) ?></td>
                                <td><?= htmlspecialchars($row['bend']) ?></td>
                                <td><?= htmlspecialchars($row['travel_date']) ?></td>
                                <td><?= htmlspecialchars($row['fare']) ?></td>
                                <td><?= htmlspecialchars($row['notes']) ?></td>
                                <td>
                                    <a href="?cancel=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to cancel this booking?');" class="btn btn-danger btn-sm">Cancel</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-center">You have no bookings yet.</p>
            <?php endif; ?>
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

<!-- Scripts -->
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
<script src="js/main.js"></script>
</body>
</html>
