<?php

include "debug.php";
include('../../private/connectDB.php');

date_default_timezone_set("Pacific/Auckland");


$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$pnumber = $_POST['pnumber'];
$unit = $_POST['unit'];
$streetNo = $_POST['streetNo'];
$streetName = $_POST['streetName'];
$suburbPickUp = $_POST['suburbPickUp'];
$suburbDest = $_POST['suburbDest'];
$pickupDate = $_POST['pickupDate'];
$pickupTime = $_POST['pickupTime'];
$status = "unassigned";
$bookingTime = date("H:i:s");
$bookingDate = date("d-m-Y", time());

$sqlString = "INSERT INTO taxi VALUES(";

//Conects to the database using the strings stored in private/connectDB.php
$_DBCONNECTION = mysqli_connect("$dbAddr", "$dbUser", "$dbPw", "$dbName")
or die();

//Tells PhP to use myt7427 as the database
mysqli_select_db($_DBCONNECTION, "myt7427")
or die();

$querryString = "SHOW TABLES LIKE 'taxi'";
$querry = mysqli_query($_DBCONNECTION, $querryString)
or die ();
if (mysqli_num_rows($querry) == 0) {
    $querryString = "CREATE TABLE taxi (
        id VARCHAR(100) NOT NULL PRIMARY KEY,
        fname VARCHAR(100) NOT NULL,
        lname VARCHAR(100) NOT NULL,
        pnumber VARCHAR(20) NOT NULL,
        unit INT,
        streetNo INT NOT NULL,
        streetName VARCHAR(100) NOT NULL,
        suburbPickUp VARCHAR(100) NOT NULL,
        suburbDest VARCHAR(100) NOT NULL,
        pickupDate DATETIME NOT NULL,
        status VARCHAR(100) NOT NULL,
        bookingDate VARCHAR (100) NOT NULL,
        bookingTime VARCHAR(100) NOT NULL)";

    mysqli_query($_DBCONNECTION, $querryString)
    or die();
} else {

}

$day = substr($pickupDate, 8, 2);
$month = substr($pickupDate, 5, 2);
$year = substr($pickupDate, 0, 4);

$dateTime = $year . '-' . $month . "-" . $day . " " . $pickupTime . ":00";


do{
    $id = $streetNo . rand(0,9999);
}while (mysqli_num_rows(mysqli_query($_DBCONNECTION, "SELECT id FROM taxi WHERE id = $id") !=0));


$sqlString = $sqlString . "'$id', '$fname', '$lname', '$pnumber', '$unit', '$streetNo', '$streetName', '$suburbPickUp', '$suburbDest', '$dateTime', '$status', '$bookingDate', '$bookingTime');";

mysqli_query($_DBCONNECTION, $sqlString)
or die();

echo $id;
