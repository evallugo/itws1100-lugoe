<?php 
  include('includes/init.inc.php'); // include the DOCTYPE and opening tags
  include('includes/functions.inc.php'); // functions
?>
<title>PHP &amp; MySQL - ITWS</title>   

<?php include('includes/head.inc.php'); ?>

<h1>PHP &amp; MySQL</h1>
      
<?php include('includes/menubody.inc.php'); ?>

<?php
// we'll need a database connection both for retrieving records and for
// inserting them.  let's get it up front and use it for both processes
// to avoid opening the connection twice.  if we make a good connection,
// we'll change the $dbOk flag.
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

// now let's process our form:
// have we posted?
$havePost = isset($_POST["save"]);

// let's do some basic validation
$errors = '';
if ($havePost) {

   // get the output and clean it for output on-screen.
   // first, let's get the output one param at a time.
   // could also output escape with htmlentities()
   $title = htmlspecialchars(trim($_POST["title"]));
   $year = htmlspecialchars(trim($_POST["year"]));

   $focusId = ''; // trap the first field that needs updating, better would be to save errors in an array

   if ($title == '') {
      $errors .= '<li>title may not be blank</li>';
      if ($focusId == '') $focusId = '#title';
   }
   if ($year == '') {
      $errors .= '<li>year may not be blank</li>';
      if ($focusId == '') $focusId = '#year';
   }

   if ($errors != '') {
      echo '<div class="messages"><h4>please correct the following errors:</h4><ul>';
      echo $errors;
      echo '</ul></div>';
      echo '<script type="text/javascript">';
      echo '  $(document).ready(function() {';
      echo '    $("' . $focusId . '").focus();';
      echo '  });';
      echo '</script>';
   } else {
      if ($dbOk) {
         // let's trim the input for inserting into mysql
         // note that aside from trimming, we'll do no further escaping because we
         // use prepared statements to put these values in the database.
         $titleForDb = trim($_POST["title"]);
         $yearForDb = trim($_POST["year"]);

         // setup a prepared statement. alternately, we could write an insert statement - but
         // *only* if we escape our data using addslashes() or (better) mysqli_real_escape_string().
         $insQuery = "insert into movies (`title`,`year`) values(?,?)";
         $statement = $db->prepare($insQuery);
         // bind our variables to the question marks
         $statement->bind_param("ss", $titleForDb, $yearForDb);
         // make it so:
         $statement->execute();

         // give the user some feedback
         echo '<div class="messages"><h4>success: ' . $statement->affected_rows . ' movie added to database.</h4>';
         echo $title . ' (' . $year . ')</div>';

         // close the prepared statement obj
         $statement->close();
      }
   }
}
?>

<h3>add movie</h3>
<form id="addForm" name="addForm" action="movies.php" method="post" onsubmit="return validateMovie(this);">
   <fieldset>
      <div class="formData">

         <label class="field" for="title">title:</label>
         <div class="value"><input type="text" size="60" value="<?php if ($havePost && $errors != '') {
                                                                     echo $title;
                                                                  } ?>" name="title" id="title" /></div>

         <label class="field" for="year">year:</label>
         <div class="value"><input type="text" size="4" maxlength="4" value="<?php if ($havePost && $errors != '') {
                                                                                    echo $year;
                                                                                 } ?>" name="year" id="year" /></div>

         <input type="submit" value="save" id="save" name="save" />
      </div>
   </fieldset>
</form>

<h3>movies</h3>
<table id="movieTable">
   <?php
   if ($dbOk) {

      $query = 'select * from movies order by title';
      $result = $db->query($query);
      $numRecords = $result->num_rows;

      echo '<tr><th>title:</th><th>year:</th><th></th></tr>';
      for ($i = 0; $i < $numRecords; $i++) {
         $record = $result->fetch_assoc();
         if ($i % 2 == 0) {
            echo "\n" . '<tr id="movie-' . $record['movieid'] . '"><td>';
         } else {
            echo "\n" . '<tr class="odd" id="movie-' . $record['movieid'] . '"><td>';
         }
         echo htmlspecialchars($record['title']);
         echo '</td><td>';
         echo htmlspecialchars($record['year']);
         echo '</td><td>';
         echo '<img src="resources/delete.png" class="deleteMovie" width="16" height="16" alt="delete movie"/>';
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
