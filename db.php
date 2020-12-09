<?php 
error_reporting(0);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//  session_start(); 
  ?>
<?php


$mysql_conn = new mysqli("localhost","root","", "socialmedia");

// Check connection
if ($mysql_conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";



$_SESSION['fixed_data'] = " DATE( published ) < DATE('2015-07-21') AND  DATE( published ) > DATE('2015-07-10') ";
//$_SESSION['fixed_data'] = "";
$_SESSION['from_data'] = "";
$_SESSION['to_data'] =  "2015-06-21";

?>