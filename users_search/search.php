<?php
// search.php

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("\nConnection failed: " . $conn->connect_error);
}

// Handle search
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $search = $_GET["search"];

    // Search query
    $sql = "SELECT * FROM users WHERE username LIKE '%$search%' OR email LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display search results in a table
        echo "<table>";
        echo "<tr><th>ID</th><th>Username</th><th>Email</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["username"] . "</td><td>" . $row["email"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "\nNo results found";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Search</title>
    <style>
        /* CSS styles for the form and table */
    </style>
</head>

<body>
    <form action="search.php" method="GET">
        <input type="text" name="search" placeholder="Search...">
        <input type="submit" value="Search">
    </form>
</body>

</html>