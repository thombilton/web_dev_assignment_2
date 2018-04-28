<?php

include "debug.php";
include "connectDB.php";

echo "working";

$id = 123456;
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$unit = $_POST['unit'];
$streetNo = $_POST['streetNo'];
$streetName = $_POST['streetName'];
$suburbPickUp = $_POST['suburbPickUp'];
$suburbDest = $_POST['suburbDest'];
$pickupDate = $_POST['pickupDate'];
$pickupTime = $_POST['pickupTime'];
$status = "unassigned";
$bookingTime = date("h:i:s");
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
        unit VARCHAR(100),
        streetNo VARCHAR(100) NOT NULL,
        streetName VARCHAR(100) NOT NULL,
        suburbPickUp VARCHAR(100) NOT NULL,
        suburbDest VARCHAR(100) NOT NULL,
        pickupDate VARCHAR(100) NOT NULL,
        pickupTime VARCHAR(100) NOT NULL,
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



$sqlString = $sqlString . "'$id', '$fname', '$lname', '$unit', '$streetNo', '$streetName', '$suburbPickUp', '$suburbDest', '$pickupDate', '$pickupTime', '$status', '$bookingDate', '$bookingTime');";

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