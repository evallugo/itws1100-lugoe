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
  @ $db = new mysqli('localhost', 'root', 'PRLugo22!', 'iit');
 
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
    $movieid = htmlspecialchars(trim($_POST["movieid"]));
    $title = htmlspecialchars(trim($_POST["title"]));
    $year = htmlspecialchars(trim($_POST["year"]));

    $focusId = ''; // trap the first field that needs updating, better would be to save errors in an array

    if ($movieid == '') {
      $errors .= '<li>movieid may not be blank</li>';
      if ($focusId == '') $focusId = '#movieid';
    }
    if ($title == '') {
      $errors .= '<li>Title may not be blank</li>';
      if ($focusId == '') $focusId = '#title';
    }
    if ($year == '') {
      $errors .= '<li>year may not be blank</li>';
      if ($focusId == '') $focusId = '#year';
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
        // Let's trim the input for inserting into MySQL
        // Note that aside from trimming, we'll do no further escaping because we
        // use prepared statements to put these values in the database.
        $movieidForDb = trim($_POST["movieid"]);
        $titleForDb = trim($_POST["title"]);
        $yearForDb = trim($_POST["year"]);

        // Setup a prepared statement. Alternately, we could write an insert statement - but
        // *only* if we escape our data using addslashes() or (better) mysqli_real_escape_string().
        $insQuery = "INSERT INTO movies (`movieid`,`title`,`year`) VALUES (?,?,?)";
        $statement = $db->prepare($insQuery);
        // bind our variables to the question marks
        $statement->bind_param("iss", $movieidForDb, $titleForDb, $yearForDb);
        // make it so:
        $statement->execute();

        // give the user some feedback
        echo '<div class="messages"><h4>Success: ' . $statement->affected_rows . ' movie added to the database.</h4>';
        echo $movieid . ' ' . $title . ', made ' . $year . '</div>';

        // close the prepared statement obj
        $statement->close();
      }
    }
  }
?>

<h3>Add Movie</h3>
<form id="addForm" name="addForm" action="movies.php" method="post" onsubmit="return validate(this);">
  <fieldset>
    <div class="formData">

      <label class="field" for="movieid">Movie(id):</label>
      <div class="value"><input type="text" size="60" value="<?php if($havePost && $errors != '') { echo $movieid; } ?>" name="movieid" id="movieid"/></div>

      <label class="field" for="title">Title:</label>
      <div class="value"><input type="text" size="60" value="<?php if($havePost && $errors != '') { echo $title; } ?>" name="title" id="title"/></div>

      <label class="field" for="year">Year:</label>
      <div class="value"><input type="text" size="10" maxlength="10" value="<?php if($havePost && $errors != '') { echo $year; } ?>" name="year" id="year"/> <em>yyyy</em></div>

      <input type="submit" value="save" id="save" name="save"/>
    </div>
  </fieldset>
</form>

<h3>Movies</h3>
<table id="movieTable">
<?php
  if ($dbOk) {

    $query = 'select * from movies order by movieid';
    $result = $db->query($query);
    $numRecords = $result->num_rows;

    echo '<tr><th>Movie ID:</th><th>Title:</th><th>Year:</th><th></th></tr>';
    for ($i=0; $i < $numRecords; $i++) {
      $record = $result->fetch_assoc();
      if ($i % 2 == 0) {
        echo "\n".'<tr id="movie-' . $record['movieid'] . '"><td>';
      } else {
        echo "\n".'<tr class="odd" id="movie-' . $record['movieid'] . '"><td>';
      }
      echo htmlspecialchars($record['movieid']) . '</td><td>';
      echo htmlspecialchars($record['title']);
      echo '</td><td>';
      echo htmlspecialchars($record['year']);
      echo '</td><td>';
      echo '<img src="resources/delete.png" class="deletemovie" width="16" height="16" alt="delete movie"/>';
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
