<?php
//variables for 
$servername = "localhost";
$username = "root";
$password = "PRLug022!";

$conn = mysqli_connect($servername, $username, $password); //create connection

if (!$conn) { //check connection
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

$conn->close(); //close connecition
?>