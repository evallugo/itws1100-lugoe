<?php
// Create a new database connection object
@$db = new mysqli('localhost', 'phpmyadmin', 'phpmyadmin', 'iit');

if ($db->connect_error) {
   die('Could not connect to the database. Error: ' . $db->connect_errno . ' - ' . $db->connect_error);
}

// Sample movie-actor relationships
// Format: array('movie_title' => array('actor_first_name', 'actor_last_name'))
$relationships = array(
   'The Shawshank Redemption' => array(
      array('Morgan', 'Freeman'),
      array('Tim', 'Robbins')
   ),
   'Forrest Gump' => array(
      array('Tom', 'Hanks'),
      array('Gary', 'Sinise')
   ),
   'The Godfather' => array(
      array('Al', 'Pacino'),
      array('Marlon', 'Brando')
   ),
   'Titanic' => array(
      array('Leonardo', 'DiCaprio'),
      array('Kate', 'Winslet')
   ),
   'The Dark Knight' => array(
      array('Christian', 'Bale'),
      array('Heath', 'Ledger')
   )
);

// Insert relationships into the database
$successCount = 0;
foreach ($relationships as $movieTitle => $actors) {
   // Get movie ID
   $query = "SELECT movieid FROM movies WHERE title = ?";
   $stmt = $db->prepare($query);
   $stmt->bind_param("s", $movieTitle);
   $stmt->execute();
   $result = $stmt->get_result();
   
   if ($row = $result->fetch_assoc()) {
      $movieId = $row['movieid'];
      
      // For each actor in this movie
      foreach ($actors as $actor) {
         // Get actor ID
         $query = "SELECT actorid FROM actors WHERE first_names = ? AND last_name = ?";
         $stmt = $db->prepare($query);
         $stmt->bind_param("ss", $actor[0], $actor[1]);
         $stmt->execute();
         $result = $stmt->get_result();
         
         if ($row = $result->fetch_assoc()) {
            $actorId = $row['actorid'];
            
            // Check if relationship already exists
            $query = "SELECT * FROM movie_actors WHERE movieid = ? AND actorid = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("ii", $movieId, $actorId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows == 0) {
               // Insert relationship
               $query = "INSERT INTO movie_actors (movieid, actorid) VALUES (?, ?)";
               $stmt = $db->prepare($query);
               $stmt->bind_param("ii", $movieId, $actorId);
               
               if ($stmt->execute()) {
                  $successCount++;
               }
            }
         }
      }
   }
}

echo "Successfully added $successCount movie-actor relationships to the database.";

// Close the database connection
$db->close();
?> 