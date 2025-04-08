<?php 
  include('includes/init.inc.php'); // include the DOCTYPE and opening tags
  include('includes/functions.inc.php'); // functions
?>
<title>Movies &amp; Actors - ITWS</title>   

<?php include('includes/head.inc.php'); ?>

<h1>Movies &amp; Actors</h1>
      
<?php include('includes/menubody.inc.php'); ?>

<?php
// we'll need a database connection for retrieving records
$dbOk = false;

/* create a new database connection object, passing in the host, username,
     password, and database to use. the "@" suppresses errors. */
@$db = new mysqli('localhost', 'root', 'root', 'iit');

if ($db->connect_error) {
   echo '<div class="messages">could not connect to the database. error: ';
   echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
} else {
   $dbOk = true;
}

// Process form submission for adding a relationship
$relationshipMessage = '';
if (isset($_POST["addRelationship"]) && $dbOk) {
   $movieId = (int)$_POST["movieId"];
   $actorId = (int)$_POST["actorId"];
   
   if ($movieId > 0 && $actorId > 0) {
      // Check if relationship already exists
      $checkQuery = "SELECT * FROM movie_actors WHERE movieid = ? AND actorid = ?";
      $checkStmt = $db->prepare($checkQuery);
      $checkStmt->bind_param("ii", $movieId, $actorId);
      $checkStmt->execute();
      $checkResult = $checkStmt->get_result();
      
      if ($checkResult->num_rows > 0) {
         $relationshipMessage = '<div class="messages"><h4>error: this relationship already exists</h4></div>';
      } else {
         // Add the relationship
         $insQuery = "INSERT INTO movie_actors (movieid, actorid) VALUES (?, ?)";
         $insStmt = $db->prepare($insQuery);
         $insStmt->bind_param("ii", $movieId, $actorId);
         $insStmt->execute();
         
         if ($insStmt->affected_rows > 0) {
            $relationshipMessage = '<div class="messages"><h4>success: relationship added</h4></div>';
         } else {
            $relationshipMessage = '<div class="messages"><h4>error: could not add relationship</h4></div>';
         }
         $insStmt->close();
      }
      $checkStmt->close();
   } else {
      $relationshipMessage = '<div class="messages"><h4>error: please select both a movie and an actor</h4></div>';
   }
}
?>

<h3>add movie-actor relationship</h3>
<?php echo $relationshipMessage; ?>

<form id="relationshipForm" name="relationshipForm" action="movie-actors.php" method="post">
   <fieldset>
      <div class="formData">
         <?php if ($dbOk): ?>
            <label class="field" for="movieId">movie:</label>
            <div class="value">
               <select name="movieId" id="movieId">
                  <option value="0">-- select a movie --</option>
                  <?php
                  $movieQuery = "SELECT movieid, title, year FROM movies ORDER BY title";
                  $movieResult = $db->query($movieQuery);
                  while ($movie = $movieResult->fetch_assoc()) {
                     echo '<option value="' . $movie['movieid'] . '">' . 
                          htmlspecialchars($movie['title']) . ' (' . $movie['year'] . ')</option>';
                  }
                  $movieResult->free();
                  ?>
               </select>
            </div>
            
            <label class="field" for="actorId">actor:</label>
            <div class="value">
               <select name="actorId" id="actorId">
                  <option value="0">-- select an actor --</option>
                  <?php
                  $actorQuery = "SELECT actorid, first_names, last_name FROM actors ORDER BY last_name, first_names";
                  $actorResult = $db->query($actorQuery);
                  while ($actor = $actorResult->fetch_assoc()) {
                     echo '<option value="' . $actor['actorid'] . '">' . 
                          htmlspecialchars($actor['first_names'] . ' ' . $actor['last_name']) . '</option>';
                  }
                  $actorResult->free();
                  ?>
               </select>
            </div>
            
            <input type="submit" value="add relationship" id="addRelationship" name="addRelationship" />
         <?php endif; ?>
      </div>
   </fieldset>
</form>

<h3>movies and their actors</h3>
<table id="movieActorTable">
   <?php
   if ($dbOk) {
      // query to get movies and their actors
      $query = 'SELECT m.movieid, m.title, m.year, GROUP_CONCAT(CONCAT(a.first_names, " ", a.last_name) SEPARATOR ", ") as actors 
                FROM movies m 
                LEFT JOIN movie_actors ma ON m.movieid = ma.movieid 
                LEFT JOIN actors a ON ma.actorid = a.actorid 
                GROUP BY m.movieid 
                ORDER BY m.title';
      
      $result = $db->query($query);
      $numRecords = $result->num_rows;

      echo '<tr><th>title:</th><th>year:</th><th>actors:</th><th>actions:</th></tr>';
      for ($i = 0; $i < $numRecords; $i++) {
         $record = $result->fetch_assoc();
         if ($i % 2 == 0) {
            echo "\n" . '<tr id="movie-actor-' . $record['movieid'] . '"><td>';
         } else {
            echo "\n" . '<tr class="odd" id="movie-actor-' . $record['movieid'] . '"><td>';
         }
         echo htmlspecialchars($record['title']);
         echo '</td><td>';
         echo htmlspecialchars($record['year']);
         echo '</td><td>';
         echo htmlspecialchars($record['actors'] ? $record['actors'] : 'No actors assigned');
         echo '</td><td>';
         echo '<a href="movie-actor-details.php?id=' . $record['movieid'] . '" class="btn">manage</a>';
         echo '</td></tr>';
      }

      $result->free();

      // finally, let's close the database
      $db->close();
   }
   ?>
</table>

<?php include('includes/foot.inc.php');
// footer info and closing tags
?> 