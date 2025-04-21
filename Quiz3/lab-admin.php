<?php
session_start();
include("conn.php");
include("includes/head.inc.php");
include("includes/menubody.inc.php");

// Access control
if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== 'admin') {
    echo "<p>Access denied. Admins only.</p>";
    include("includes/foot.inc.php");
    exit();
}

// Add new lab
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_lab'])) {
    $title = trim($_POST['title']);
    $desc = trim($_POST['description']);
    $link = trim($_POST['link']);

    $stmt = $conn->prepare("INSERT INTO myLabs (title, description, link) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $desc, $link);
    $stmt->execute();
    echo "<p>Lab added successfully.</p>";
}

// Delete lab
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $conn->query("DELETE FROM myLabs WHERE labid = $delete_id");
    echo "<p>Lab deleted.</p>";
}
?>

<h2>Lab Management Panel</h2>

<form method="post" action="lab-admin.php">
  <label>Title:</label>
  <input type="text" name="title" required><br>

  <label>Description:</label>
  <textarea name="description" required></textarea><br>

  <label>Link:</label>
  <input type="text" name="link" required><br>

  <input type="submit" name="add_lab" value="Add Lab">
</form>

<hr>

<h3>Existing Labs:</h3>
<table border="1">
  <tr><th>ID</th><th>Title</th><th>Description</th><th>Link</th><th>Delete</th></tr>
  <?php
  $result = $conn->query("SELECT * FROM myLabs ORDER BY labid ASC");
  while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>{$row['labid']}</td>";
      echo "<td>" . htmlspecialchars($row['title']) . "</td>";
      echo "<td>" . htmlspecialchars($row['description']) . "</td>";
      echo "<td><a href='{$row['link']}' target='_blank'>View</a></td>";
      echo "<td><a href='lab-admin.php?delete={$row['labid']}' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";
      echo "</tr>";
  }
  ?>
</table>

<?php include("includes/foot.inc.php"); ?>
