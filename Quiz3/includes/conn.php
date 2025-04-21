<?php
// Database connection parameters
$db_host = 'localhost';      // MariaDB/MySQL server hostname
$db_user = 'root';          // Your database username
$db_password = 'PRLugo22!';  // Your database password
$db_name = 'mySite';        // Database name as specified in instructions

// Create connection
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set charset to ensure proper handling of special characters
mysqli_set_charset($conn, "utf8mb4");
?>
