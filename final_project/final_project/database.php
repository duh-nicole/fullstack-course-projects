<?php
// PHP Script to connect to the grades database using MySQLi

// Database connection parameters
$servername = "localhost";
$username = "root"; // Use your MySQL username
$password = ""; // Use your MySQL password
$dbname = "grades";

// Create database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
