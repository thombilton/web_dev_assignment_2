<?php

include "debug.php";
include('../../private/connectDB.php');

$_DBCONNECTION = mysqli_connect("$dbAddr", "$dbUser", "$dbPw", "$dbName")
or die();

mysqli_select_db($_DBCONNECTION, "myt7427")
or die();

date_default_timezone_set("Pacific/Auckland");

$currentDateTime = date("Y-m-d H:i") . ":00";
$newDateTime = date("Y-m-d H:i", strtotime('+2 hours')) . ":00";

$query = "SELECT id, fname, lname, pnumber, suburbPickUp, suburbDest ,pickupDate FROM taxi WHERE pickupDate BETWEEN '$currentDateTime' AND '$newDateTime' AND status='unassigned'";
$results = mysqli_query($_DBCONNECTION, $query);

if (mysqli_num_rows($results) != 0) {

    $resultsArray = array();

    while ($row = mysqli_fetch_assoc($results)){
        $resultsArray[] = $row;
    }

    echo json_encode($resultsArray);

/*    echo "<div class='table-responsive'>";
    echo "<table class='table'>";
    echo "<tr><th>Reference</th><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Pickup Suburb</th><th>Destination Suburb</th><th>Pickup Date (y-m-d h:m:s)</th></tr>";
    $row = mysqli_fetch_row($results);
    while ($row) {
        echo "<tr><td>{$row[0]}</td>";
        echo "<td>{$row[1]}</td>";
        echo "<td>{$row[2]}</td>";
        echo "<td>{$row[3]}</td>";
        echo "<td>{$row[4]}</td>";
        echo "<td>{$row[5]}</td>";
        echo "<td>{$row[6]}</td>";
        $row = mysqli_fetch_row($results);
    }
    echo "</table>";
    echo "</div>";

*/

} else {
    //echo "There are no bookings Available";
}

?>