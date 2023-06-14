<!DOCTYPE html>
<html>

<head>
    <title>User Form</title>
    <style>
        /* CSS styles for the form */
    </style>
    <script>
        // JavaScript validation
        function validateForm() {
            // Perform validation logic here
        }
    </script>
</head>

<body>
    <form action="process.php" method="POST" onsubmit="return validateForm()">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <input type="submit" value="Submit">
    </form>
</body>

</html>

<?php
// process.php

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];

    // Insert data into the users table
    $sql = "INSERT INTO users (username, email) VALUES ('$username', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error inserting record: " . $conn->error;
    }
}

// Close the connection
$conn->close();
