<?php
// Set page variables
$page_title = "Labs - Eva Lugo";
$page_class = "labs-page";

// Include necessary files
require_once __DIR__ . '/Quiz3/includes/init.inc.php';
require_once __DIR__ . '/Quiz3/includes/head.inc.php';
require_once __DIR__ . '/Quiz3/includes/menu.inc.php';
require_once __DIR__ . '/Quiz3/includes/login.inc.php';

// Include database connection
require_once __DIR__ . '/Quiz3/conn.php';
?>

<div class="content">
    <h1>My Labs</h1>
    
    <div class="labs-container">
        <?php
        // Query to get all labs from the database
        $query = "SELECT * FROM myLabs ORDER BY lab_number";
        $result = $db->query($query);
        
        if ($result && $result->num_rows > 0) {
            echo '<div class="labs-grid">';
            
            while ($lab = $result->fetch_assoc()) {
                echo '<div class="lab-card">';
                echo '<h2>' . htmlspecialchars($lab['lab_title']) . '</h2>';
                
                if (!empty($lab['lab_description'])) {
                    echo '<p>' . htmlspecialchars($lab['lab_description']) . '</p>';
                }
                
                if (!empty($lab['lab_link'])) {
                    echo '<a href="' . htmlspecialchars($lab['lab_link']) . '" class="lab-link">View Lab</a>';
                }
                
                echo '</div>';
            }
            
            echo '</div>';
        } else {
            echo '<p>No labs found in the database.</p>';
        }
        ?>
    </div>
</div>

<?php
// Include footer
require_once __DIR__ . '/Quiz3/includes/foot.inc.php';
?> 