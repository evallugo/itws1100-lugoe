<?php
include('includes/init.inc.php');
include('includes/functions.inc.php');
?>
<title>Quick Add - ITWS</title>

<?php include('includes/head.inc.php'); ?>

<h1>Quick Add</h1>

<?php include('includes/menubody.inc.php'); ?>

<?php
$dbOk = false;

@$db = new mysqli('localhost', 'root', 'root', 'iit');

if ($db->connect_error) {
   echo '<div class="messages">could not connect to the database. error: ';
   echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
} else {
   $dbOk = true;
}

$actorMessage = '';
$movieMessage = '';

// Process actor form
if (isset($_POST["addActor"])) {
   $firstNames = htmlspecialchars(trim($_POST["firstNames"]));
   $lastName = htmlspecialchars(trim($_POST["lastName"]));
   $dob = htmlspecialchars(trim($_POST["dob"]));
   
   if ($firstNames == '' || $lastName == '' || $dob == '') {
      $actorMessage = '<div class="messages"><h4>error: all fields are required</h4></div>';
   } else {
      if ($dbOk) {
         $firstNamesForDb = trim($_POST["firstNames"]);
         $lastNameForDb = trim($_POST["lastName"]);
         $dobForDb = trim($_POST["dob"]);
         
         $insQuery = "insert into actors (`first_names`,`last_name`,`dob`) values(?,?,?)";
         $statement = $db->prepare($insQuery);
         $statement->bind_param("sss", $firstNamesForDb, $lastNameForDb, $dobForDb);
         $statement->execute();
         
         $actorMessage = '<div class="messages"><h4>success: ' . $statement->affected_rows . ' actor added to database.</h4>';
         $actorMessage .= $firstNames . ' ' . $lastName . ', born ' . $dob . '</div>';
         
         $statement->close();
      }
   }
}

// Process movie form
if (isset($_POST["addMovie"])) {
   $title = htmlspecialchars(trim($_POST["title"]));
   $year = htmlspecialchars(trim($_POST["year"]));
   
   if ($title == '' || $year == '') {
      $movieMessage = '<div class="messages"><h4>error: all fields are required</h4></div>';
   } else {
      if ($dbOk) {
         $titleForDb = trim($_POST["title"]);
         $yearForDb = trim($_POST["year"]);
         
         $insQuery = "insert into movies (`title`,`year`) values(?,?)";
         $statement = $db->prepare($insQuery);
         $statement->bind_param("ss", $titleForDb, $yearForDb);
         $statement->execute();
         
         $movieMessage = '<div class="messages"><h4>success: ' . $statement->affected_rows . ' movie added to database.</h4>';
         $movieMessage .= $title . ' (' . $year . ')</div>';
         
         $statement->close();
      }
   }
}

// Close the database connection
if ($dbOk) {
   $db->close();
}
?>

<div class="card">
   <h3>quick add actor</h3>
   <form id="quickActorForm" name="quickActorForm" action="quick-add.php" method="post" onsubmit="return validate(this);">
      <fieldset>
         <div class="formData">
            <label class="field" for="firstNames">first name(s):</label>
            <div class="value"><input type="text" size="60" name="firstNames" id="firstNames" /></div>
            
            <label class="field" for="lastName">last name:</label>
            <div class="value"><input type="text" size="60" name="lastName" id="lastName" /></div>
            
            <label class="field" for="dob">date of birth:</label>
            <div class="value"><input type="text" size="10" maxlength="10" name="dob" id="dob" /> <em>yyyy-mm-dd</em></div>
            
            <input type="submit" value="add actor" id="addActor" name="addActor" />
         </div>
      </fieldset>
   </form>
   <?php echo $actorMessage; ?>
</div>

<div class="card">
   <h3>quick add movie</h3>
   <form id="quickMovieForm" name="quickMovieForm" action="quick-add.php" method="post" onsubmit="return validateMovie(this);">
      <fieldset>
         <div class="formData">
            <label class="field" for="title">title:</label>
            <div class="value"><input type="text" size="60" name="title" id="title" /></div>
            
            <label class="field" for="year">year:</label>
            <div class="value"><input type="text" size="4" maxlength="4" name="year" id="year" /></div>
            
            <input type="submit" value="add movie" id="addMovie" name="addMovie" />
         </div>
      </fieldset>
   </form>
   <?php echo $movieMessage; ?>
</div>

<div class="card">
   <h3>quick links</h3>
   <div class="actions">
      <a href="index.php" class="btn">view all actors</a>
      <a href="movies.php" class="btn">view all movies</a>
      <a href="movie-actors.php" class="btn">view movie-actor relationships</a>
   </div>
</div>

<?php include('includes/foot.inc.php'); ?> 