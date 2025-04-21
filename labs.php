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
        <h1>Labs</h1>
        <div class="buttons">
            <?php
            // Query to get all labs from the database
            $query = "SELECT * FROM myLabs ORDER BY lab_number";
            $result = $db->query($query);
            
            if ($result && $result->num_rows > 0) {
                while ($lab = $result->fetch_assoc()) {
                    echo '<a href="' . htmlspecialchars($lab['lab_link']) . '">';
                    echo 'Lab ' . htmlspecialchars($lab['lab_number']) . ' <i class="fas fa-flask"></i>';
                    echo '</a>';
                }
            } else {
                // Fallback message if no labs found in database
                echo '<p class="no-labs">No labs found in the database.</p>';
            }
            ?>
        </div>
    </div>
</div>

<?php
// Include footer
require_once __DIR__ . '/Quiz3/includes/foot.inc.php';
?> 