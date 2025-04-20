<?php
//global variables for database connection
$server = 'localhost';
$user = 'root';
$password = 'PRLugo22!';
$database = 'mySite';

//follows lab 9 to establish connection
$dbOk = false;

//creates new database connection object passing in global variables
@$db = new mysqli($server, $user, $password, $database);

//checks if connection is successful
if ($db->connect_error) {
   echo '<div class="messages">Could not connect to the database. Error: ';
   echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
} else {
   $dbOk = true;
}
?>
