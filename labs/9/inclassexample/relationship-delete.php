<?php
  /* Delete a movie-actor relationship */
  
  // Get the id from the request
  $movieid = isset($_POST['movieid']) ? (int)$_POST['movieid'] : 0;
  $actorid = isset($_POST['actorid']) ? (int)$_POST['actorid'] : 0;

  // Validate that we have both ids
  if ($movieid == 0 || $actorid == 0) {
    echo json_encode(array('error' => 'Invalid movie or actor ID'));
    exit();
  }

  /* Create a new database connection object, passing in the host, username,
     password, and database to use. The "@" suppresses errors. */
  @ $db = new mysqli('localhost', 'root', 'PRLugo22!', 'iit');
  
  if ($db->connect_error) {
    echo json_encode(array('error' => 'Could not connect to the database'));
    exit();
  } else {
    // Delete the relationship
    $query = "DELETE FROM relationship WHERE movieid = ? AND actorid = ?";
    $statement = $db->prepare($query);
    $statement->bind_param("ii", $movieid, $actorid);
    $statement->execute();

    if ($statement->affected_rows > 0) {
      echo json_encode(array('success' => true));
    } else {
      echo json_encode(array('error' => 'Could not delete the relationship'));
    }

    // close the prepared statement obj and the db connection
    $statement->close();
    $db->close();
  }
?> 