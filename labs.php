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

<div class="labs">
    <div class="labs-intro">
        <h1>My Labs</h1>
        <p>Here are all my labs for Web Systems Development.</p>
    </div>
    
    <div class="lab-grid">
        <?php
        // Query to get all labs from the database
        $query = "SELECT * FROM myLabs ORDER BY lab_number";
        $result = $db->query($query);
        
        if ($result && $result->num_rows > 0) {
            while ($lab = $result->fetch_assoc()) {
                $lab_title = "Lab " . $lab['lab_number'];
                if (!empty($lab['lab_link'])) {
                    echo '<a href="' . htmlspecialchars($lab['lab_link']) . '" class="lab-button">';
                    echo '<div class="lab-content">';
                    echo '<h2 class="lab-title">' . $lab_title . '</h2>';
                    echo '<i class="fa-solid fa-flask lab-icon"></i>';
                    echo '<p class="lab-description">' . htmlspecialchars($lab['lab_description']) . '</p>';
                    echo '</div>';
                    echo '</a>';
                }
            }
        } else {
            echo '<p class="no-labs">No labs found in the database.</p>';
        }
        ?>
    </div>
</div>

<?php
// Include footer
require_once __DIR__ . '/Quiz3/includes/foot.inc.php';
?> 