<?php 
  include('includes/init.inc.php'); // include the DOCTYPE and opening tags
  include('includes/functions.inc.php'); // functions
?>
<title>PHP &amp; MySQL - ITWS</title>   

<?php include('includes/head.inc.php'); ?>

<h1>PHP &amp; MySQL</h1>
      
<?php include('includes/menubody.inc.php'); ?>

<?php
// We'll need a database connection
$dbOk = false;

/* Create a new database connection object, passing in the host, username,
   password, and database to use. The "@" suppresses errors. */
@$db = new mysqli('localhost', 'root', 'PRLugo22!', 'iit');

if ($db->connect_error) {
   echo '<div class="messages">Could not connect to the database. Error: ';
   echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
} else {
   $dbOk = true;
}
?>

<h3>Movies and Their Actors</h3>
<table id="movieActorTable">
   <?php
   if ($dbOk) {
      // Query to get movies and their actors
      $query = 'SELECT m.title, m.year, a.first_names, a.last_name
                FROM movies m
                LEFT JOIN movie_actor ma ON m.movieid = ma.movieid
                LEFT JOIN actors a ON ma.actorid = a.actorid
                ORDER BY m.title, a.last_name';
      
      $result = $db->query($query);
      $numRecords = $result->num_rows;
      
      if ($numRecords > 0) {
         echo '<tr><th>Movie:</th><th>Year:</th><th>Actor:</th></tr>';
         
         $currentMovie = '';
         $rowClass = '';
         
         for ($i = 0; $i < $numRecords; $i++) {
            $record = $result->fetch_assoc();
            
            // If this is a new movie, reset the row class
            if ($record['title'] != $currentMovie) {
               $currentMovie = $record['title'];
               $rowClass = ($rowClass == 'odd') ? '' : 'odd';
            }
            
            echo "\n" . '<tr class="' . $rowClass . '"><td>';
            
            // Only show the movie title if it's a new movie
            if ($i == 0 || $record['title'] != $currentMovie) {
               echo htmlspecialchars($record['title']);
            }
            
            echo '</td><td>';
            
            // Only show the year if it's a new movie
            if ($i == 0 || $record['title'] != $currentMovie) {
               echo htmlspecialchars($record['year']);
            }
            
            echo '</td><td>';
            
            // Show the actor name if there is one
            if ($record['first_names'] && $record['last_name']) {
               echo htmlspecialchars($record['last_name']) . ', ';
               echo htmlspecialchars($record['first_names']);
            } else {
               echo '<em>No actors assigned</em>';
            }
            
            echo '</td></tr>';
         }
      } else {
         echo '<tr><td colspan="3">No movies with actors found.</td></tr>';
      }
      
      $result->free();
      
      // Finally, let's close the database
      $db->close();
   }
   ?>
</table>

<?php include('includes/foot.inc.php'); 
  // footer info and closing tags
?> 