<?php
  @ $db = new mysqli('localhost', 'root', 'PRLugo22!', 'iit');
  
  if ($db->connect_error) {
    $connectErrors = array(
      'errors' => true,
      'errno' => mysqli_connect_errno(),
      'error' => mysqli_connect_error()
    );
    echo json_encode($connectErrors);
  } else {
    if (isset($_POST["movieid"]) && isset($_POST["actorid"])) {
      $movieId = (int) $_POST["movieid"];
      $actorId = (int) $_POST["actorid"];
      
      $query = "DELETE FROM relationship WHERE movieid = ? AND actorid = ?";
      $statement = $db->prepare($query);
      $statement->bind_param("ii", $movieId, $actorId);
      $statement->execute();
      
      $success = array('errors'=>false,'message'=>'Delete successful');
      echo json_encode($success);
      
      $statement->close();
      $db->close();
    }
  }
?> 