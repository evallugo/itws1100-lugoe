<?php
session_start();
include("conn.php");
include("includes/head.inc.php");
include("includes/menubody.inc.php");
?>

<h2>Labs</h2>

<div class="labs-list">
<?php
$result = $conn->query("SELECT * FROM myLabs ORDER BY labid ASC");
while ($lab = $result->fetch_assoc()) {
    echo "<div class='lab-card'>";
    echo "<h3>" . htmlspecialchars($lab['title']) . "</h3>";
    echo "<p>" . htmlspecialchars($lab['description']) . "</p>";
    echo "<a href='" . htmlspecialchars($lab['link']) . "' target='_blank'>View Lab</a>";
    echo "</div>";
}
?>
</div>

<?php include("includes/foot.inc.php"); ?>
