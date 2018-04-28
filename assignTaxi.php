<?php
include "debug.php";
include "connectDB.php";

$userIn = $_POST['userIn'];
//Conects to the database using the strings stored in private/connectDB.php
$_DBCONNECTION = mysqli_connect("$dbAddr", "$dbUser", "$dbPw", "$dbName")
or die(debug("unable to connect"));

//Tells PhP to use myt7427 as the database
mysqli_select_db($_DBCONNECTION, "myt7427")
or die(debug("unable to reach table"));

//checks if the entry exists
$querryString = "SELECT * FROM taxi WHERE id = '$userIn' AND status = 'unassigned';";
$querry = mysqli_query($_DBCONNECTION, $querryString)
or die (debug("Could not complete querry"));

if(mysqli_num_rows($querry) == 1){
    $querryString = "UPDATE taxi SET status = 'assigned' WHERE id = '$userIn'";
    $querry = mysqli_query($_DBCONNECTION, $querryString)
    or die (debug("Could not complete querry"));

    echo 'The booking request ';
    echo $userIn;
    echo " has been properly assigned";
}
else{
    echo "There are no bookings with that reference or this reference is already assigned";
}
