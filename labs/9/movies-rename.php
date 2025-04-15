<?php
include('includes/init.inc.php'); // include the DOCTYPE and opening tags
include('includes/functions.inc.php'); // functions
require_once("db.php"); // connects to the database
?>

<title>Movie Cast</title>
<?php include('includes/head.inc.php'); ?>

<h1>Movies and Cast</h1>

<?php include('includes/menubody.inc.php'); ?>

<?php
$query = "
    SELECT m.title, GROUP_CONCAT(CONCAT(a.first_names, ' ', a.last_name) SEPARATOR ', ') AS actors
    FROM movies m
    JOIN relationship r ON m.movieid = r.movieid
    JOIN actors a ON a.actorid = r.actorid
    GROUP BY m.movieid
    ORDER BY m.title
";

$result = $db->query($query);
?>

<div id="bodyBlock">
  <h3>Movie Cast List</h3>
  <table id="actorTable">
    <tr>
      <th>Movie Title</th>
      <th>Actors</th>
    </tr>
    <?php
    $rowNum = 0;
    while ($row = $result->fetch_assoc()) {
      $rowClass = ($rowNum++ % 2 == 0) ? ' class="odd"' : '';
      echo "<tr$rowClass>";
      echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
      echo "<td>" . htmlspecialchars($row["actors"]) . "</td>";
      echo "</tr>";
    }
    $result->free();
    $db->close();
    ?>
  </table>
</div>

<?php include('includes/foot.inc.php'); // footer info and closing tags ?>
