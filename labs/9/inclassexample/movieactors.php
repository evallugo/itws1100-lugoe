<?php 
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
      $errors .= '<li>Movie ID may not be blank</li>';
      if ($focusId == '') $focusId = '#movieid';
    }
    if ($actorid == '') {
      $errors .= '<li>Actor ID may not be blank</li>';
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
        // Prepare data for insertion
        $movieidForDb = trim($_POST["movieid"]);
        $actoridForDb = trim($_POST["actorid"]);

        // Insert using prepared statement
        $insQuery = "INSERT INTO movie_actor (`movie_id`,`actor_id`) VALUES (?,?)";
        $statement = $db->prepare($insQuery);
        $statement->bind_param("ss", $movieidForDb, $actoridForDb);
        $statement->execute();

        // Provide feedback
        echo '<div class="messages"><h4>Success: ' . $statement->affected_rows . ' relationship added to the database.</h4>';
        echo 'Movie ID: ' . $movieid . ', Actor ID: ' . $actorid . '</div>';

        $statement->close();
      }
    }
  }
?>

<h3>Add Movie-Actor Relationship</h3>
<form id="addForm" name="addForm" action="movieactors.php" method="post" onsubmit="return validate(this);">
  <fieldset>
    <div class="formData">
      <label class="field" for="movieid">Movie ID:</label>
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

      <label class="field" for="actorid">Actor ID:</label>
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
    $query = 'SELECT m.title, m.year, a.first_name, a.last_name, ma.movie_id, ma.actor_id 
              FROM movie_actor ma 
              JOIN movies m ON ma.movie_id = m.movieid 
              JOIN actors a ON ma.actor_id = a.actorid 
              ORDER BY m.title, a.last_name, a.first_name';
    $result = $db->query($query);

    if ($result) {
      echo '<tr><th>Movie</th><th>Year</th><th>Actor</th><th></th></tr>';
      
      $i = 0;
      while ($record = $result->fetch_assoc()) {
        $rowClass = ($i % 2 == 0) ? '' : 'class="odd"';
        echo "<tr $rowClass>";
        echo "<td>" . htmlspecialchars($record['title']) . "</td>";
        echo "<td>" . htmlspecialchars($record['year']) . "</td>";
        echo "<td>" . htmlspecialchars($record['first_name']) . " " . 
             htmlspecialchars($record['last_name']) . "</td>";
        echo '<td><img src="resources/delete.png" class="deletemovieactor" width="16" height="16" alt="delete movie actor relationship" data-movieid="' . 
             $record['movie_id'] . '" data-actorid="' . $record['actor_id'] . '"/></td>';
        echo '</tr>';
        $i++;
      }

      $result->free();
    } else {
      echo '<div class="messages">Error retrieving records from the database.</div>';
    }

    // Close the database connection
    $db->close();
  }
?>
</table>

<?php include('includes/foot.inc.php');
  // footer info and closing tags
?>
