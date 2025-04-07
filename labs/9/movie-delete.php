<?php
include('includes/init.inc.php');
include('includes/functions.inc.php');

$dbOk = false;

@$db = new mysqli('localhost', 'root', 'root', 'iit');

if ($db->connect_error) {
   echo '<div class="messages">Could not connect to the database. Error: ';
   echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
} else {
   $dbOk = true;
}

if ($dbOk) {
   $movieid = $_POST['movieid'];
   
   // First delete from movie_actors table due to foreign key constraint
   $deleteQuery = "delete from movie_actors where movieid = ?";
   $statement = $db->prepare($deleteQuery);
   $statement->bind_param("i", $movieid);
   $statement->execute();
   $statement->close();
   
   // Then delete from movies table
   $deleteQuery = "delete from movies where movieid = ?";
   $statement = $db->prepare($deleteQuery);
   $statement->bind_param("i", $movieid);
   $statement->execute();
   
   echo '<div class="messages"><h4>Success: ' . $statement->affected_rows . ' movie deleted from database.</h4></div>';
   
   $statement->close();
   $db->close();
}
?> 