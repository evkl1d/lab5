<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("\nConnection failed: " . $conn->connect_error);
}

// Create the database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "\nDatabase created successfully";
} else {
    echo "\nError creating database: " . $conn->error;
}

// Close the connection
$conn->close();

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("\nConnection failed: " . $conn->connect_error);
}

// Create the users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "\nTable created successfully";
} else {
    echo "\nError creating table: " . $conn->error;
}

// Close the connection
$conn->close();
?>

