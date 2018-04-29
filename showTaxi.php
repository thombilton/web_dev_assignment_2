<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php

include "debug.php";
include "connectDB.php";

$_DBCONNECTION = mysqli_connect("$dbAddr", "$dbUser", "$dbPw", "$dbName")
or die(debug("unable to connect"));

mysqli_select_db($_DBCONNECTION, "myt7427")
or die(debug("unable to reach table"));

date_default_timezone_set("Pacific/Auckland");

$currentDateTime = date("Y-m-d H:i") . ":00";
debug($currentDateTime);
$newDateTime = date("Y-m-d H:i", strtotime('+2 hours')) . ":00";
debug($newDateTime);

$query = "SELECT * FROM taxi WHERE pickupDate BETWEEN '$currentDateTime' AND '$newDateTime' AND status='unassigned'";
debug($query);
$results = mysqli_query($_DBCONNECTION, $query);

debug(mysqli_num_rows($results));

if (mysqli_num_rows($results) != 0) {

    echo "<div class='table-responsive'>";
    echo "<table class='table'>";
    echo "<tr><th>Reference</th><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Pickup Suburb</th><th>Destination Suburb</th><th>Pickup Date (y-m-d h:m:s)</th></tr>";
    $row = mysqli_fetch_row($results);
    while ($row) {
        echo "<tr><td>{$row[0]}</td>";
        echo "<td>{$row[1]}</td>";
        echo "<td>{$row[2]}</td>";
        echo "<td>{$row[3]}</td>";
        echo "<td>{$row[7]}</td>";
        echo "<td>{$row[8]}</td>";
        echo "<td>{$row[9]}</td>";
        $row = mysqli_fetch_row($results);
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "There are no bookings Available";
}

?>
</body>
</html>