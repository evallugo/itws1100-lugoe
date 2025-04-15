<?php 
  include('includes/init.inc.php'); // include the DOCTYPE and opening tags
  include('includes/functions.inc.php'); // functions
?>
<title>PHP &amp; MySQL - ITWS</title>   

<?php include('includes/head.inc.php'); ?>

<h1>PHP &amp; MySQL</h1>
      
<?php include('includes/menubody.inc.php'); ?>

<p>Build the movie forms and output here.</p>
<?php
$messages = array();
require_once("db.php");

if (isset($_POST["save"])) {
    $title = trim($_POST["title"]);
    $year = trim($_POST["year"]);

    if ($title == "") {
        $messages[] = "You must specify a movie title";
    } else if ($year == "") {
        $messages[] = "You must specify a release year";
    } else {
        $stmt = $db->prepare("INSERT INTO movies (title, year) VALUES (?, ?)");
        $stmt->execute([$title, $year]);
        $messages[] = "Movie saved successfully!";
    }
}

if (isset($_GET["delete"])) {
    $delete_id = intval($_GET["delete"]);
    $stmt = $db->prepare("DELETE FROM movies WHERE movieid = ?");
    $stmt->execute([$delete_id]);
    $messages[] = "Movie deleted.";
}

$stmt = $db->query("SELECT * FROM movies ORDER BY title");
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if (count($messages) > 0): ?>
  <div class="messages">
    <?php foreach ($messages as $m): ?>
      <p><?php echo htmlentities($m); ?></p>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<form method="post">
  <fieldset>
    <legend>Add a Movie</legend>
    <div class="field">Title:</div>
    <div class="value"><input type="text" name="title" size="40" /></div>
    <div class="field">Year:</div>
    <div class="value"><input type="text" name="year" size="10" /></div>
    <div class="value"><input type="submit" name="save" value="Save" /></div>
  </fieldset>
</form>

<h3>Movie List</h3>
<table id="actorTable">
  <tr>
    <th>Title</th>
    <th>Year</th>
    <th>Delete</th>
  </tr>

  <?php
  $rowNum = 0;
  foreach ($movies as $movie):
    $rowClass = ($rowNum++ % 2 == 0) ? ' class="odd"' : '';
  ?>
    <tr<?php echo $rowClass; ?>>
      <td><?php echo htmlentities($movie["title"]); ?></td>
      <td><?php echo htmlentities($movie["year"]); ?></td>
      <td><a href="movies.php?delete=<?php echo $movie["movieid"]; ?>" onclick="return confirm('Are you sure?');">delete</a></td>
    </tr>
  <?php endforeach; ?>
</table>


<?php include('includes/foot.inc.php'); 
  // footer info and closing tags
?>
