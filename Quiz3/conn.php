<?php

$server = "localhost";
$user = "root";
$password = "PRLugo22!"; 
$database = "mySite";

$conn = new mysqli($server, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
