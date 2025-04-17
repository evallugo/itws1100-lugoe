<?php 
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  include('includes/init.inc.php'); // include the DOCTYPE and opening tags
  include('includes/functions.inc.php'); // functions
?>
<title>PHP &amp; MySQL - ITWS</title>   

<?php include('includes/head.inc.php'); ?>

<h1>PHP &amp; MySQL</h1>
      
<?php include('includes/menubody.inc.php'); ?>

<?php
  $dbOk = false;

  /* Create a new database connection object, passing in the host, username,
     password, and database to use. The "@" suppresses errors. */
  @ $db = new mysqli('localhost', 'root', 'PRLugo22!', 'iit');

  if ($db->connect_error) {
    echo '<div class="messages">Could not connect to the database. Error: ';
    echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
  } else {
    $dbOk = true;
  }

  // Process form submission
  $havePost = isset($_POST["save"]);
  $errors = '';

  if ($havePost) {
    // Get and clean the form data
    $movieid = htmlspecialchars(trim($_POST["movieid"]));
    $actorid = htmlspecialchars(trim($_POST["actorid"]));

    $focusId = '';

    if ($movieid == '') {
      $errors .= '<li>Movie may not be blank</li>';
      if ($focusId == '') $focusId = '#movieid';
    }
    if ($actorid == '') {
      $errors .= '<li>Actor may not be blank</li>';
      if ($focusId == '') $focusId = '#actorid';
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
        // Check if relationship already exists
        $checkQuery = "SELECT COUNT(*) as count FROM relationship WHERE movieid = ? AND actorid = ?";
        $checkStmt = $db->prepare($checkQuery);
        $movieidForDb = (int)trim($_POST["movieid"]);
        $actoridForDb = (int)trim($_POST["actorid"]);
        $checkStmt->bind_param("ii", $movieidForDb, $actoridForDb);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $count = $checkResult->fetch_assoc()['count'];
        $checkStmt->close();

        if ($count > 0) {
          echo '<div class="messages"><h4>Error: This movie-actor relationship already exists.</h4></div>';
        } else {
          // Insert using prepared statement
          $insQuery = "INSERT INTO relationship (movieid, actorid) VALUES (?,?)";
          $statement = $db->prepare($insQuery);
          // bind our variables as integers
          $statement->bind_param("ii", $movieidForDb, $actoridForDb);
          $statement->execute();

          // Get the movie and actor details for the success message
          $movieQuery = "SELECT title FROM movies WHERE movieid = ?";
          $movieStmt = $db->prepare($movieQuery);
          $movieStmt->bind_param("i", $movieidForDb);
          $movieStmt->execute();
          $movieResult = $movieStmt->get_result();
          $movieTitle = $movieResult->fetch_assoc()['title'];
          $movieStmt->close();

          $actorQuery = "SELECT first_name, last_name FROM actors WHERE actorid = ?";
          $actorStmt = $db->prepare($actorQuery);
          $actorStmt->bind_param("i", $actoridForDb);
          $actorStmt->execute();
          $actorResult = $actorStmt->get_result();
          $actor = $actorResult->fetch_assoc();
          $actorName = $actor['first_name'] . ' ' . $actor['last_name'];
          $actorStmt->close();

          // Provide detailed feedback
          echo '<div class="messages"><h4>Success: ' . $statement->affected_rows . ' relationship added to the database.</h4>';
          echo 'Added ' . htmlspecialchars($actorName) . ' to movie "' . htmlspecialchars($movieTitle) . '"</div>';

          $statement->close();
        }
      }
    }
  }
?>

<h3>Add Movie-Actor Relationship</h3>
<form id="addForm" name="addForm" action="movieactors.php" method="post">
  <fieldset>
    <div class="formData">
      <label class="field" for="movieid">Movie:</label>
      <div class="value">
        <select name="movieid" id="movieid">
          <option value="">Select a Movie</option>
          <?php
            if ($dbOk) {
              $query = 'SELECT movieid, title, year FROM movies ORDER BY title';
              $result = $db->query($query);
              while ($record = $result->fetch_assoc()) {
                echo '<option value="' . $record['movieid'] . '">' . 
                     htmlspecialchars($record['title']) . ' (' . $record['year'] . ')</option>';
              }
              $result->free();
            }
          ?>
        </select>
      </div>

      <label class="field" for="actorid">Actor:</label>
      <div class="value">
        <select name="actorid" id="actorid">
          <option value="">Select an Actor</option>
          <?php
            if ($dbOk) {
              $query = 'SELECT actorid, first_name, last_name FROM actors ORDER BY last_name, first_name';
              $result = $db->query($query);
              while ($record = $result->fetch_assoc()) {
                echo '<option value="' . $record['actorid'] . '">' . 
                     htmlspecialchars($record['first_name']) . ' ' . 
                     htmlspecialchars($record['last_name']) . '</option>';
              }
              $result->free();
            }
          ?>
        </select>
      </div>

      <input type="submit" value="save" id="save" name="save"/>
    </div>
  </fieldset>
</form>

<h3>Movie-Actor Relationships</h3>
<table id="movieActorTable">
<?php
  if ($dbOk) {
    $query = 'SELECT m.title, m.year, a.first_name, a.last_name, r.movieid, r.actorid 
              FROM relationship r 
              JOIN movies m ON r.movieid = m.movieid 
              JOIN actors a ON r.actorid = a.actorid 
              ORDER BY m.title, a.last_name, a.first_name';
    $result = $db->query($query);
    $numRecords = $result->num_rows;

    echo '<tr><th>Movie</th><th>Year</th><th>Actor</th><th></th></tr>';
    for ($i = 0; $i < $numRecords; $i++) {
      $record = $result->fetch_assoc();
      if ($i % 2 == 0) {
        echo "\n".'<tr id="movieactor-' . $record['movieid'] . '-' . $record['actorid'] . '"><td>';
      } else {
        echo "\n".'<tr class="odd" id="movieactor-' . $record['movieid'] . '-' . $record['actorid'] . '"><td>';
      }
      echo htmlspecialchars($record['title']) . '</td><td>';
      echo htmlspecialchars($record['year']) . '</td><td>';
      echo htmlspecialchars($record['first_name']) . ' ' . htmlspecialchars($record['last_name']);
      echo '</td><td>';
      echo '<img src="resources/delete.png" class="deletemovieactor" width="16" height="16" alt="delete movie actor relationship" data-movieid="' . 
           $record['movieid'] . '" data-actorid="' . $record['actorid'] . '"/>';
      echo '</td></tr>';
    }

    $result->free();
  }
?>
</table>

<?php 
  // Only close the database connection at the very end
  if ($dbOk) {
    $db->close();
  }
  include('includes/foot.inc.php');
?>
