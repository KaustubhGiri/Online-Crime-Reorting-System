<?php 



// Database credentials 

$host="localhost";

$username="";

$password="";

$database_name="crime_report";  



$con = new mysqli($host, $username, $password, $database_name); 

if (!$con) {

  die("Connection failed: " . $con->connect_error);

}



?>