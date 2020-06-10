<?php
//connecting php with database
ob_start(); //This turns on output buffering
session_start();  //this will store the values of variable and will maintain  the session as if we dont use this then if any error occurs whole data entered by user is set to null even if the values are correct...with this we also need to include session variables while fetching value from form.  
$timezone= date_default_timezone_set("Asia/Kolkata");
$con=mysqli_connect("localhost","root","","network");  //connection variable to database //connecting database with php, value returned by mysqli_connect() is stored in variable $con, it takes four parameters, 1. host name, 2 username for database, 3. password, 4 database name
if(mysqli_connect_errno()){  //this check if some errors occured during connection, if yes then returns the error.
	echo "failed to connect:". mysqli_connect_errno();
}

?>