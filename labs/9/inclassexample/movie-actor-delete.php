<?php
  /* Delete a movie-actor relationship */
  
  /* Create a new database connection object, passing in the host, username,
     password, and database to use. The "@" suppresses errors. */
  @ $db = new mysqli('localhost', 'root', 'root', 'iit');
  
  if ($db->connect_error) {
    $connectErrors = array(
      'errors' => true,
      'errno' => mysqli_connect_errno(),
      'error' => mysqli_connect_error()
    );
    echo json_encode($connectErrors);
  } else {
    if (isset($_POST["movieId"]) && isset($_POST["actorId"])) {
      // get our ids and cast as integers
      $movieId = (int) $_POST["movieId"];
      $actorId = (int) $_POST["actorId"];
      
      // Setup a prepared statement. 
      $query = "delete from movie_actors where movieid = ? and actorid = ?";
      $statement = $db->prepare($query);
      // bind our variables to the question marks
      $statement->bind_param("ii", $movieId, $actorId);
      // make it so:
      $statement->execute();
      
      // return a json object that indicates success
      $success = array('errors'=>false,'message'=>'Relationship deleted successfully');
      echo json_encode($success);
      
      // close the prepared statement obj and the db connection
      $statement->close();
      $db->close();
    }
  }
?> 