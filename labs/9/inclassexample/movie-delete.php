<?php
  /* delete a movie */
  
  /* create a new database connection object, passing in the host, username,
     password, and database to use. the "@" suppresses errors. */
  @ $db = new mysqli('localhost', 'root', 'root', 'iit');
  
  if ($db->connect_error) {
    $connectErrors = array(
      'errors' => true,
      'errno' => mysqli_connect_errno(),
      'error' => mysqli_connect_error()
    );
    echo json_encode($connectErrors);
  } else {
    if (isset($_POST["id"])) {
      // get our id and cast as an integer
      $movieId = (int) $_POST["id"];
      
      // first delete from movie_actors table due to foreign key constraint
      $query = "delete from movie_actors where movieid = ?";
      $statement = $db->prepare($query);
      // bind our variable to the question mark
      $statement->bind_param("i", $movieId);
      // make it so:
      $statement->execute();
      $statement->close();
      
      // then delete from movies table
      $query = "delete from movies where movieid = ?";
      $statement = $db->prepare($query);
      // bind our variable to the question mark
      $statement->bind_param("i", $movieId);
      // make it so:
      $statement->execute();
      
      // return a json object that indicates success
      $success = array('errors'=>false,'message'=>'delete successful');
      echo json_encode($success);
      
      // close the prepared statement obj and the db connection
      $statement->close();
      $db->close();
    }
  }
?> 