<?php
/*
 * Queries the database to find bookings that are not assigned and are in the next 2 hours
 * Returns a JSON string back that contains this info
 */
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

}

?>