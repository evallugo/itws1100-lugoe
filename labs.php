<?php
// Set page variables
$page_title = "Labs - Eva Lugo";
$page_class = "labs";

// Include necessary files
require_once __DIR__ . '/Quiz3/includes/init.inc.php';
require_once __DIR__ . '/Quiz3/includes/head.inc.php';

// Include database connection
require_once __DIR__ . '/Quiz3/conn.php';
?>

<div class="center">
    <div class="center-content">
        <h1>My Labs</h1>
        <div class="buttons">
            <?php
            // Query to get all labs from the database
            $query = "SELECT * FROM myLabs ORDER BY lab_number";
            $result = $db->query($query);
            
            if ($result && $result->num_rows > 0) {
                while ($lab = $result->fetch_assoc()) {
                    echo '<a href="labs/' . $lab['lab_number'] . '/index.html">';
                    echo 'Lab ' . htmlspecialchars($lab['lab_number']) . ' ';
                    echo '<i class="fa-solid fa-flask"></i>';
                    echo '</a>';
                }
            } else {
                // If no labs in database, show default labs
                for ($i = 1; $i <= 10; $i++) {
                    if ($i != 3) { // Skip lab 3 as it's your website
                        echo '<a href="labs/' . $i . '/index.html">';
                        echo 'Lab ' . $i . ' ';
                        echo '<i class="fa-solid fa-flask"></i>';
                        echo '</a>';
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

<?php
// Include footer
require_once __DIR__ . '/Quiz3/includes/foot.inc.php';
?> 