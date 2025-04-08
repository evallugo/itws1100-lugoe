<?php 
  include('includes/init.inc.php'); // include the DOCTYPE and opening tags
  include('includes/functions.inc.php'); // functions
?>
<title>Movie-Actor Details - ITWS</title>   

<?php include('includes/head.inc.php'); ?>

<h1>Movie-Actor Details</h1>
      
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

$movieId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$movieTitle = '';
$movieYear = '';
$message = '';

// Process form submission for adding a relationship
if (isset($_POST["addActor"]) && $dbOk) {
   $actorId = (int)$_POST["actorId"];
   
   if ($actorId > 0) {
      // Check if relationship already exists
      $checkQuery = "SELECT * FROM movie_actors WHERE movieid = ? AND actorid = ?";
      $checkStmt = $db->prepare($checkQuery);
      $checkStmt->bind_param("ii", $movieId, $actorId);
      $checkStmt->execute();
      $checkResult = $checkStmt->get_result();
      
      if ($checkResult->num_rows > 0) {
         $message = '<div class="messages"><h4>error: this actor is already assigned to this movie</h4></div>';
      } else {
         // Add the relationship
         $insQuery = "INSERT INTO movie_actors (movieid, actorid) VALUES (?, ?)";
         $insStmt = $db->prepare($insQuery);
         $insStmt->bind_param("ii", $movieId, $actorId);
         $insStmt->execute();
         
         if ($insStmt->affected_rows > 0) {
            $message = '<div class="messages"><h4>success: actor added to movie</h4></div>';
         } else {
            $message = '<div class="messages"><h4>error: could not add actor to movie</h4></div>';
         }
         $insStmt->close();
      }
      $checkStmt->close();
   } else {
      $message = '<div class="messages"><h4>error: please select an actor</h4></div>';
   }
}

// Get movie details
if ($dbOk && $movieId > 0) {
   $movieQuery = "SELECT title, year FROM movies WHERE movieid = ?";
   $movieStmt = $db->prepare($movieQuery);
   $movieStmt->bind_param("i", $movieId);
   $movieStmt->execute();
   $movieResult = $movieStmt->get_result();
   
   if ($movieResult->num_rows > 0) {
      $movie = $movieResult->fetch_assoc();
      $movieTitle = $movie['title'];
      $movieYear = $movie['year'];
   } else {
      $message = '<div class="messages"><h4>error: movie not found</h4></div>';
   }
   $movieResult->free();
   $movieStmt->close();
}
?>

<h3>movie: <?php echo htmlspecialchars($movieTitle . ' (' . $movieYear . ')'); ?></h3>
<?php echo $message; ?>

<div class="card">
   <h4>add actor to this movie</h4>
   <form id="addActorForm" name="addActorForm" action="movie-actor-details.php?id=<?php echo $movieId; ?>" method="post">
      <fieldset>
         <div class="formData">
            <?php if ($dbOk): ?>
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
               
               <input type="submit" value="add actor" id="addActor" name="addActor" />
            <?php endif; ?>
         </div>
      </fieldset>
   </form>
</div>

<div class="card">
   <h4>actors in this movie</h4>
   <table id="movieActorsTable">
      <?php
      if ($dbOk && $movieId > 0) {
         // query to get actors for this movie
         $query = 'SELECT a.actorid, a.first_names, a.last_name, a.dob 
                  FROM actors a 
                  JOIN movie_actors ma ON a.actorid = ma.actorid 
                  WHERE ma.movieid = ? 
                  ORDER BY a.last_name, a.first_names';
         
         $stmt = $db->prepare($query);
         $stmt->bind_param("i", $movieId);
         $stmt->execute();
         $result = $stmt->get_result();
         $numRecords = $result->num_rows;

         if ($numRecords > 0) {
            echo '<tr><th>name:</th><th>date of birth:</th><th>actions:</th></tr>';
            for ($i = 0; $i < $numRecords; $i++) {
               $record = $result->fetch_assoc();
               if ($i % 2 == 0) {
                  echo "\n" . '<tr id="actor-' . $record['actorid'] . '"><td>';
               } else {
                  echo "\n" . '<tr class="odd" id="actor-' . $record['actorid'] . '"><td>';
               }
               echo htmlspecialchars($record['first_names'] . ' ' . $record['last_name']);
               echo '</td><td>';
               echo htmlspecialchars($record['dob']);
               echo '</td><td>';
               echo '<img src="resources/delete.png" class="deleteMovieActor" width="16" height="16" alt="remove actor" data-movieid="' . $movieId . '" data-actorid="' . $record['actorid'] . '"/>';
               echo '</td></tr>';
            }
         } else {
            echo '<tr><td colspan="3">No actors assigned to this movie</td></tr>';
         }

         $result->free();
         $stmt->close();
      }
      ?>
   </table>
</div>

<div class="card">
   <h4>navigation</h4>
   <div class="actions">
      <a href="movie-actors.php" class="btn">back to all movies</a>
   </div>
</div>

<?php include('includes/foot.inc.php');
// footer info and closing tags
?> 