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
    // Get and validate form data
    $movieid = isset($_POST["movieid"]) ? trim($_POST["movieid"]) : '';
    $actorid = isset($_POST["actorid"]) ? trim($_POST["actorid"]) : '';

    if ($movieid == '') {
      $errors .= '<li>Please select a movie</li>';
    }
    if ($actorid == '') {
      $errors .= '<li>Please select an actor</li>';
    }

    if ($errors != '') {
      echo '<div class="messages"><h4>Please correct the following errors:</h4><ul>';
      echo $errors;
      echo '</ul></div>';
    } else if ($dbOk) {
      // Insert the relationship
      $insQuery = "INSERT INTO relationship (movieid, actorid) VALUES (?, ?)";
      $statement = $db->prepare($insQuery);
      $statement->bind_param("ii", $movieid, $actorid);
      
      if ($statement->execute()) {
        echo '<div class="messages"><h4>Success: Relationship added to database.</h4></div>';
      } else {
        echo '<div class="messages"><h4>Error: Could not add relationship. The relationship might already exist.</h4></div>';
      }
      $statement->close();
    }
  }
?>

<h3>Add Movie-Actor Relationship</h3>
<form id="addForm" name="addForm" action="movieactors.php" method="post" onsubmit="return validate(this);">
  <fieldset>
    <div class="formData">
      <label class="field" for="movieid">Select Movie:</label>
      <div class="value">
        <select name="movieid" id="movieid">
          <option value="">-- Select a Movie --</option>
          <?php
          if ($dbOk) {
              $query = 'SELECT movieid, title FROM movies ORDER BY title';
              $result = $db->query($query);
              
              while ($movie = $result->fetch_assoc()) {
                  echo "<option value='{$movie['movieid']}'>{$movie['title']}</option>";
              }
              $result->free();
          }
          ?>
        </select>
      </div>

      <label class="field" for="actorid">Select Actor:</label>
      <div class="value">
        <select name="actorid" id="actorid">
          <option value="">-- Select an Actor --</option>
          <?php
          if ($dbOk) {
              $query = 'SELECT actorid, CONCAT(firstNames, " ", lastName) as name FROM actors ORDER BY lastName';
              $result = $db->query($query);
              
              while ($actor = $result->fetch_assoc()) {
                  echo "<option value='{$actor['actorid']}'>{$actor['name']}</option>";
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

<h3>Movie Actors</h3>
<table id="movieActorTable">
<?php
  if ($dbOk) {
    // Query to show movie titles and actor names
    $query = 'SELECT m.title, CONCAT(a.firstNames, " ", a.lastName) as actor_name, 
              r.movieid, r.actorid 
              FROM relationship r 
              JOIN movies m ON r.movieid = m.movieid 
              JOIN actors a ON r.actorid = a.actorid 
              ORDER BY m.title';
    
    $result = $db->query($query);

    if ($result) {
      echo '<tr><th>Movie Title:</th><th>Actor Name:</th><th></th></tr>';
      
      $i = 0;
      while ($record = $result->fetch_assoc()) {
        $rowClass = ($i % 2 == 0) ? '' : 'class="odd"';
        echo "<tr $rowClass>";
        echo "<td>{$record['title']}</td>";
        echo "<td>{$record['actor_name']}</td>";
        echo '<td><img src="resources/delete.png" class="deletemovieactor" width="16" height="16" alt="delete movie actor"/></td>';
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