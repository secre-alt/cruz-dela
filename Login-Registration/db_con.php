<?php
$server = "localhost";  
$username = "root";
$password = "";       
$database = "Secre_Alt";  // Use the database you created earlier

// Create connection
$con = mysqli_connect($server, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to create a table
$sql = "CREATE TABLE Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($con, $sql)) {
    echo "Table Users created successfully!";
} else {
    echo "Error creating table: " . mysqli_error($con);
}

// Close the connection
mysqli_close($con);
?>
