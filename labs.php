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
    <h1>My Labs</h1>
    
    <div class="labs-container">
        <?php
        // Query to get all labs from the database
        $query = "SELECT * FROM myLabs ORDER BY lab_number";
        $result = $db->query($query);
        
        if ($result && $result->num_rows > 0) {
            echo '<div class="buttons">';
            
            while ($lab = $result->fetch_assoc()) {
                $lab_title = "Lab " . $lab['lab_number'];
                if (!empty($lab['lab_link'])) {
                    echo '<a href="' . htmlspecialchars($lab['lab_link']) . '" class="visible">';
                    echo $lab_title . ' <i class="fa-solid fa-flask"></i>';
                    echo '</a>';
                }
            }
            
            echo '</div>';
        } else {
            echo '<p>No labs found in the database.</p>';
        }
        ?>
        
        <div class="buttons">
            <a href="index.php">
                Home <i class="fa-solid fa-home"></i>
            </a>
            <a href="aboutme.php">
                About Me <i class="fa-solid fa-user"></i>
            </a>
            <a href="resume.php">
                Resume <i class="fa-solid fa-file"></i>
            </a>
        </div>
    </div>
</div>

<?php
// Include footer
require_once __DIR__ . '/Quiz3/includes/foot.inc.php';
?> 