<?php 
// Include necessary files
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
// Create database connection
@$db = new mysqli('localhost', 'root', 'PRLugo22!', 'iitF23');

if ($db->connect_error) {
    echo '<div class="messages">Could not connect to the database. Error: ';
    echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
} else {
    // Query to fetch movies and their corresponding actors
    $query = "SELECT movies.title, actors.first_name, actors.last_name 
              FROM movies 
              JOIN movie_actor ON movies.movieid = movie_actor.movie_id 
              JOIN actors ON actors.actorid = movie_actor.actor_id 
              ORDER BY movies.title";

    $result = $db->query($query);

    if ($result) {
        // Display results if found
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . htmlspecialchars($row['title']) . "</td>";
                echo "<td>" . htmlspecialchars($row['first_name']) . " " . 
                     htmlspecialchars($row['last_name']) . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No movies and actors found.</td></tr>";
        }
        $result->free();
    } else {
        echo "<tr><td colspan='2'>Error in query execution: " . $db->error . "</td></tr>";
    }

    $db->close();
}
?>

</table>

<?php include('includes/foot.inc.php'); ?>