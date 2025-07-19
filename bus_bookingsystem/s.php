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

// Function to get unique Start Routes
function get_start()
{
    global $con;
    $query = "SELECT DISTINCT TRIM(LOWER(bstart)) AS bstart FROM bus_details ORDER BY bstart";
    $result = mysqli_query($con, $query);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $bstart = ucwords($row['bstart']); // Capitalizes first letter of each word
        $selected = (isset($_POST['bstart']) && $_POST['bstart'] == $bstart) ? "selected" : "";
        echo "<option value=\"$bstart\" $selected>$bstart</option>";
    }
}

// Function to get unique End Routes
function get_end()
{
    global $con;
    $query = "SELECT DISTINCT TRIM(LOWER(bend)) AS bend FROM bus_details ORDER BY bend";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $bend = ucwords($row['bend']); // Capitalizes first letter of each word
        $selected = (isset($_POST['bend']) && $_POST['bend'] == $bend) ? "selected" : "";
        echo "<option value=\"$bend\" $selected>$bend</option>";
    }
}

// Fetch filtered buses based on dropdown selection
$whereClause = "";

if (isset($_POST['search'])) {
    $bstart = trim($_POST['bstart']);
    $bend = trim($_POST['bend']);

    if (!empty($bstart) && $bstart !== "Select Start Route") {
        $whereClause .= " AND bus_details.bstart = '$bstart'";
    }
    if (!empty($bend) && $bend !== "Select End Route") {
        $whereClause .= " AND bus_route.bend = '$bend'";
    }
}

// SQL query to fetch data
$query = "SELECT * FROM `register` INNER JOIN `bus_details` ON register.id = bus_details.bid INNER JOIN `bus_route` ON bus_route.bid=bus_details.bid WHERE 1 $whereClause";
$search_result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <form method="POST">
        <div class="row">
            <!-- Start Route Dropdown -->
            <div class="col-md-4">
                <select class="form-control" name="bstart">
                    <option>Select Start Route</option>
                    <?php get_start(); ?>
                </select>
            </div>

            <!-- End Route Dropdown -->
            <div class="col-md-4">
                <select class="form-control" name="bend">
                    <option>Select End Route</option>
                    <?php get_end(); ?>
                </select>
            </div>

            <!-- Find Bus Button -->
            <div class="col-md-2">
                <button type="submit" name="search" class="btn btn-primary w-100">Find Bus</button>
            </div>

            <!-- Clear Filter Button -->
            <div class="col-md-2">
                <button type="submit" name="clear" class="btn btn-secondary w-100">Clear Filter</button>
            </div>
        </div>
    </form>

    <hr>

    <!-- Bus List Table -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Bus ID</th>
                <th>Bus Name</th>
                <th>Start Route</th>
                <th>End Route</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($search_result)) : ?>
                <tr>
                    <td><?= $row['bid']; ?></td>
                    <td><?= $row['bus_name']; ?></td>
                    <td><?= $row['bstart']; ?></td>
                    <td><?= $row['bend']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
