<?php 
  include('includes/init.inc.php'); 
  include('includes/functions.inc.php'); 
?>
<title>PHP &amp; MySQL - ITWS</title>   

<?php include('includes/head.inc.php'); ?>

<h1>PHP &amp; MySQL</h1>
   
<?php include('includes/menubody.inc.php'); ?>

<h2>Movies & Actors</h2>
<p>Below is a list of movies and their corresponding actors:</p>

<table>
  <tr>
    <th>Movie Title</th>
    <th>Actor</th>
  </tr>

<?php
  echo '<div class="messages">Attempting to connect to the database...</div>'; // Debug message

  @$db = new mysqli('127.0.0.1', 'root', 'root', 'iitF23');

  if ($db->connect_error) {
    echo '<div class="messages">Could not connect to the database. Error: ';
    echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
  } else {
    echo '<div class="messages">Database connection successful.</div>'; // Debug message

    $query = "SELECT movies.title, actors.first_name, actors.last_name 
              FROM movies 
              JOIN movie_actor ON movies.movieid = movie_actor.movie_id 
              JOIN actors ON actors.actorid = movie_actor.actor_id 
              ORDER BY movies.title";

    echo '<div class="messages">Attempting to execute query...</div>'; // Debug message

    $result = $db->query($query);

    if ($result) {
      echo '<div class="messages">Query executed successfully.</div>'; // Debug message

      // Check if there are results
      if ($result->num_rows > 0) {
        echo '<div class="messages">Results found: ' . $result->num_rows . '</div>'; // Debug message
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" . htmlspecialchars($row['title']) . "</td>";
          echo "<td>" . htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) . "</td></tr>";
        }
      } else {
        // No results found
        echo "<tr><td colspan='2'>No movies and actors found.</td></tr>";
      }
      $result->free();
    } else {
      // Query error
      echo "<tr><td colspan='2'>Error in query execution: " . $db->error . "</td></tr>";
    }

    $db->close();
    echo '<div class="messages">Database connection closed.</div>'; // Debug message
  }
?>

</table>

<?php include('includes/foot.inc.php'); ?>