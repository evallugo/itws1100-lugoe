<?php
session_start();
?>

<?php include("includes/head.inc.php"); ?>
<?php include("includes/menubody.inc.php"); ?>

<div class="content">
  <?php
  if (isset($_SESSION['username'])) {
      echo "<p>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</p>";
      echo '<p><a href="logout.php">Logout</a></p>';
  } else {
      include("loginform.inc.php"); 
  }
  ?>
</div>

<?php include("includes/foot.inc.php"); ?>
