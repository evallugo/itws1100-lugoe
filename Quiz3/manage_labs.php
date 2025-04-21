<?php
session_start();
define('INCLUDED', true);

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: index.php");
    exit;
}

require_once __DIR__ . '/includes/init.inc.php';
require_once __DIR__ . '/includes/head.inc.php';
require_once __DIR__ . '/includes/nav.inc.php';
require_once __DIR__ . '/includes/conn.php';
?>

<link rel="stylesheet" href="iit.css">
<script src="jquery-1.4.3.min.js"></script>
<script src="iit.js"></script>

<div id="bodyBlock">
    <div id="jsMessages" class="messages" style="display:none;"></div>

    <h3>Add New Lab</h3>
    <form action="add_lab.php" method="post">
        <div class="field">Name:</div>
        <div class="value"><input type="text" name="name" required></div>

        <div class="field">Description:</div>
        <div class="value"><input type="text" name="description"></div>

        <div class="field">Path:</div>
        <div class="value"><input type="text" name="path" required></div>

        <input type="hidden" name="image" value="fas fa-flask">
        <div class="field">&nbsp;</div>
        <div class="value"><input type="submit" value="Add Lab"></div>
    </form>

    <h3>Current Labs</h3>
    <table id="labTable">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Path</th>
            <th>Delete</th>
        </tr>
        <?php
        $query = "SELECT * FROM myLabs ORDER BY id ASC";
        $result = mysqli_query($conn, $query);
        $rowIndex = 0;
        if ($result) {
            while ($lab = mysqli_fetch_assoc($result)) {
                $rowClass = ($rowIndex % 2 == 1) ? "odd" : "";
                echo '<tr id="lab-' . $lab['id'] . '" class="' . $rowClass . '">';
                echo '<td>' . htmlspecialchars($lab['id']) . '</td>';
                echo '<td>' . htmlspecialchars($lab['name']) . '</td>';
                echo '<td>' . htmlspecialchars($lab['description']) . '</td>';
                echo '<td>' . htmlspecialchars($lab['path']) . '</td>';
                echo '<td><img src="delete.png" class="deleteLab" style="cursor:pointer;"></td>';
                echo '</tr>';
                $rowIndex++;
            }
            mysqli_free_result($result);
        }
        ?>
    </table>
</div>

<?php require_once __DIR__ . '/includes/foot.inc.php'; ?>
