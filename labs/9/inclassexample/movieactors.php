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
?>

<h3>Movie Actors</h3>
<table id="movieActorTable">
<?php
  if ($dbOk) {
    $query = 'SELECT * FROM relationship ORDER BY movieid';
    $result = $db->query($query);

    if ($result) {
      echo '<tr><th>Movie ID:</th><th>Actor ID:</th><th></th></tr>';
      
      while ($record = $result->fetch_assoc()) {
        $rowClass = ($i % 2 == 0) ? '' : 'class="odd"';
        echo "<tr $rowClass><td>{$record['movieid']}</td><td>{$record['actorid']}</td><td>";
        echo '<img src="resources/delete.png" class="deletemovieactor" width="16" height="16" alt="delete movie actor"/>';
        echo '</td></tr>';
      }

      $result->free();
    } else {
      echo '<div class="messages">Error retrieving records from the database.</div>';
    }

    // Finally, let's close the database
    $db->close();
  }
?>
</table>

<?php include('includes/foot.inc.php');
  // footer info and closing tags
?>