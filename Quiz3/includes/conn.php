<?php
// database connection parameters
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'PRLugo22!';
$db_name = 'mySite';

// establish database connection
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// check if connection failed
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// set charset for proper character handling
mysqli_set_charset($conn, "utf8mb4");
?>
