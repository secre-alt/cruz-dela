<?php
$server = "localhost";  
$username = "root";
$password = "";       
$database = "Secre-Alt";  

// Create connection
$con = mysqli_connect($server, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
