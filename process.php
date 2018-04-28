<?php

include "debug.php";
include "connectDB.php";

echo "working";

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
or die(debug("unable to connect"));

//Tells PhP to use myt7427 as the database
mysqli_select_db($_DBCONNECTION, "myt7427")
or die(debug("unable to reach table"));

$querryString = "SHOW TABLES LIKE 'taxi'";
$querry = mysqli_query($_DBCONNECTION, $querryString)
or die (debug("Could not complete querry"));
debug(mysqli_num_rows($querry));

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
    or die(debug("Create table not successful"));
    debug("Table Created");
}
else{
    debug("No Need to create table");
}

$day = substr($pickupDate, 0, 2);
$month = substr($pickupDate, 3, 2);
$year = substr($pickupDate, 6, 4);

$dateTime = $year  .'-' .$month ."-" .$day ." " .$pickupTime .":00";



$sqlString = $sqlString . "'$id', '$fname', '$lname', '$pnumber', '$unit', '$streetNo', '$streetName', '$suburbPickUp', '$suburbDest', '$dateTime', '$status', '$bookingDate', '$bookingTime');";

echo ($sqlString);
mysqli_query($_DBCONNECTION, $sqlString)
or die(debug("unable to post to db"));


echo $fname;
/**
 * Created by PhpStorm.
 * User: Thom
 * Date: 28/04/18
 * Time: 1:16 PM
 */