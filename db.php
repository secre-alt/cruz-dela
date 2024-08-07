<?php

$hostname = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbname = "Login_Form";
$conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbname);
if (!$conn) {
    die("Something went wrong. Please try again!");
}

echo "connected succesfully";

?>