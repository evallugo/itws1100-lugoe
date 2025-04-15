<?php
// We'll need a database connection both for retrieving records and for
// inserting them.  Let's get it up front and use it for both processes
// to avoid opening the connection twice.  If we make a good connection,
// we'll change the $dbOk flag.
$dbOk = false;

/* Create a new database connection object, passing in the host, username,
   password, and database to use. The "@" suppresses errors. */
@$db = new mysqli('localhost', 'root', 'PRLugo22!', 'iit');

if ($db->connect_error) {
   echo json_encode(['success' => false, 'message' => 'Could not connect to the database. Error: ' . $db->connect_errno . ' - ' . $db->connect_error]);
   exit;
} else {
   $dbOk = true;
}

// Check if we have a movie ID
if (isset($_POST['movieid'])) {
   $movieid = intval($_POST['movieid']);
   
   if ($dbOk) {
      // First, delete from the movie_actor table to remove any relationships
      $deleteRelationsQuery = "DELETE FROM movie_actor WHERE movieid = ?";
      $statement = $db->prepare($deleteRelationsQuery);
      $statement->bind_param("i", $movieid);
      $statement->execute();
      $statement->close();
      
      // Now delete the movie
      $deleteQuery = "DELETE FROM movies WHERE movieid = ?";
      $statement = $db->prepare($deleteQuery);
      $statement->bind_param("i", $movieid);
      
      if ($statement->execute()) {
         echo json_encode(['success' => true, 'message' => 'Movie deleted successfully']);
      } else {
         echo json_encode(['success' => false, 'message' => 'Error deleting movie: ' . $db->error]);
      }
      
      $statement->close();
   }
} else {
   echo json_encode(['success' => false, 'message' => 'No movie ID provided']);
}

// Close the database connection
$db->close();
?> 