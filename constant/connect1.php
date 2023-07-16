<?php
/* Local Database*/

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "store1";
$store_url = "http://localhost/GSM_final/GSM_final/";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



?> 