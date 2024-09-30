<?php
$server = "localhost";  
$username = "root";
$password = "";       
$database = "secre-alt";  

// Create connection
$con = mysqli_connect($server, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<?php
$host = 'localhost';  // Host name
$db_username = 'root';  // Database username
$db_password = '';  // Database password (empty if you haven't set a password for XAMPP)
$db_name = 'secre-alt';  // Database name

$con = mysqli_connect($host, $db_username, $db_password, $db_name);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
