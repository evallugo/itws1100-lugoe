<?php 
  include('includes/init.inc.php'); // include the DOCTYPE and opening tags
  include('includes/functions.inc.php'); // functions
?>
<title>PHP &amp; MySQL - ITWS</title>   

<?php include('includes/head.inc.php'); ?>

<h1>PHP &amp; MySQL</h1>
      
<?php include('includes/menubody.inc.php'); ?>

<?php
// We'll need a database connection both for retrieving records and for
// inserting them.  Let's get it up front and use it for both processes
// to avoid opening the connection twice.  If we make a good connection,
// we'll change the $dbOk flag.
$dbOk = false;

/* Create a new database connection object, passing in the host, username,
     password, and database to use. The "@" suppresses errors. */
@$db = new mysqli('localhost', 'phpmyadmin', 'phpmyadmin', 'iit');

if ($db->connect_error) {
   echo '<div class="messages">Could not connect to the database. Error: ';
   echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
} else {
   $dbOk = true;
}

// Now let's process our form:
// Have we posted?
$havePost = isset($_POST["save"]);

// Let's do some basic validation
$errors = '';
if ($havePost) {

   // Get the output and clean it for output on-screen.
   // First, let's get the output one param at a time.
   // Could also output escape with htmlentities()
   $movieId = htmlspecialchars(trim($_POST["movieId"]));
   $actorId = htmlspecialchars(trim($_POST["actorId"]));

   $focusId = ''; // trap the first field that needs updating, better would be to save errors in an array

   if ($movieId == '') {
      $errors .= '<li>Movie may not be blank</li>';
      if ($focusId == '') $focusId = '#movieId';
   }
   if ($actorId == '') {
      $errors .= '<li>Actor may not be blank</li>';
      if ($focusId == '') $focusId = '#actorId';
   }

   if ($errors != '') {
      echo '<div class="messages"><h4>Please correct the following errors:</h4><ul>';
      echo $errors;
      echo '</ul></div>';
      echo '<script type="text/javascript">';
      echo '  $(document).ready(function() {';
      echo '    $("' . $focusId . '").focus();';
      echo '  });';
      echo '</script>';
   } else {
      if ($dbOk) {
         // Let's trim the input for inserting into mysql
         // Note that aside from trimming, we'll do no further escaping because we
         // use prepared statements to put these values in the database.
         $movieIdForDb = trim($_POST["movieId"]);
         $actorIdForDb = trim($_POST["actorId"]);

         // Setup a prepared statement. Alternately, we could write an insert statement - but
         // *only* if we escape our data using addslashes() or (better) mysqli_real_escape_string().
         $insQuery = "insert into movie_actors (`movieid`,`actorid`) values(?,?)";
         $statement = $db->prepare($insQuery);
         // bind our variables to the question marks
         $statement->bind_param("ii", $movieIdForDb, $actorIdForDb);
         // make it so:
         $statement->execute();

         // give the user some feedback
         echo '<div class="messages"><h4>Success: ' . $statement->affected_rows . ' relationship added to database.</h4></div>';

         // close the prepared statement obj
         $statement->close();
      }
   }
}
?>

<h3>Add Movie-Actor Relationship</h3>
<form id="addForm" name="addForm" action="movie_actors.php" method="post" onsubmit="return validate(this);">
   <fieldset>
      <div class="formData">

         <label class="field" for="movieId">Movie:</label>
         <div class="value">
            <select name="movieId" id="movieId">
               <option value="">Select a movie</option>
               <?php
               if ($dbOk) {
                  $query = 'select * from movies order by title';
                  $result = $db->query($query);
                  $numRecords = $result->num_rows;
                  
                  for ($i = 0; $i < $numRecords; $i++) {
                     $record = $result->fetch_assoc();
                     echo '<option value="' . $record['movieid'] . '">' . htmlspecialchars($record['title']) . ' (' . htmlspecialchars($record['year']) . ')</option>';
                  }
                  
                  $result->free();
               }
               ?>
            </select>
         </div>

         <label class="field" for="actorId">Actor:</label>
         <div class="value">
            <select name="actorId" id="actorId">
               <option value="">Select an actor</option>
               <?php
               if ($dbOk) {
                  $query = 'select * from actors order by last_name';
                  $result = $db->query($query);
                  $numRecords = $result->num_rows;
                  
                  for ($i = 0; $i < $numRecords; $i++) {
                     $record = $result->fetch_assoc();
                     echo '<option value="' . $record['actorid'] . '">' . htmlspecialchars($record['last_name']) . ', ' . htmlspecialchars($record['first_names']) . '</option>';
                  }
                  
                  $result->free();
               }
               ?>
            </select>
         </div>

         <input type="submit" value="save" id="save" name="save" />
      </div>
   </fieldset>
</form>

<h3>Movie-Actor Relationships</h3>
<table id="movieActorTable">
   <?php
   if ($dbOk) {

      $query = 'SELECT m.title, m.year, a.last_name, a.first_names 
                FROM movies m 
                JOIN movie_actors ma ON m.movieid = ma.movieid 
                JOIN actors a ON ma.actorid = a.actorid 
                ORDER BY m.title, a.last_name';
      $result = $db->query($query);
      $numRecords = $result->num_rows;

      echo '<tr><th>Movie:</th><th>Actor:</th></tr>';
      for ($i = 0; $i < $numRecords; $i++) {
         $record = $result->fetch_assoc();
         if ($i % 2 == 0) {
            echo "\n" . '<tr><td>';
         } else {
            echo "\n" . '<tr class="odd"><td>';
         }
         echo htmlspecialchars($record['title']) . ' (' . htmlspecialchars($record['year']) . ')';
         echo '</td><td>';
         echo htmlspecialchars($record['last_name']) . ', ' . htmlspecialchars($record['first_names']);
         echo '</td></tr>';
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