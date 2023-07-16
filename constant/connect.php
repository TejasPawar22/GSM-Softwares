<?php 
// DB credentials.
$localhost = "localhost";
$username = "root";
$password = "root";
$dbname = "store1";
$store_url = "http://localhost/GSM_final/GSM_final/";
// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}
?>





