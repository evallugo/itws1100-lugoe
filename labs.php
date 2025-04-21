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
</div>

<div class="buttons lab-grid">
    <?php
    // Query to get labs from database
    $query = "SELECT * FROM myLabs ORDER BY lab_number";
    $result = $db->query($query);
    
    if ($result && $result->num_rows > 0) {
        while ($lab = $result->fetch_assoc()) {
            echo '<a href="' . htmlspecialchars($lab['lab_link']) . '" class="lab-button">';
            echo '<i class="fa-solid fa-flask"></i> Lab ' . htmlspecialchars($lab['lab_number']);
            echo '</a>';
        }
    } else {
        // Fallback to static labs if no database entries
        $labs = [
            ['number' => 1, 'link' => 'labs/1/index.html'],
            ['number' => 2, 'link' => 'labs/2/index.html'],
            ['number' => 3, 'link' => 'labs/3/index.html'],
            ['number' => 4, 'link' => 'labs/4/index.html'],
            ['number' => 5, 'link' => 'labs/5/index.html'],
            ['number' => 6, 'link' => 'labs/6/index.html'],
            ['number' => 7, 'link' => 'labs/7/index.html'],
            ['number' => 8, 'link' => 'labs/8/index.html'],
            ['number' => 9, 'link' => 'labs/9/index.html'],
            ['number' => 10, 'link' => 'labs/10/index.html']
        ];
        
        foreach ($labs as $lab) {
            echo '<a href="' . $lab['link'] . '" class="lab-button">';
            echo '<i class="fa-solid fa-flask"></i> Lab ' . $lab['number'];
            echo '</a>';
        }
    }
    ?>
</div>

<div class="labs-content">
    <?php
    // Display lab content from database
    $query = "SELECT * FROM myLabs ORDER BY lab_number";
    $result = $db->query($query);
    
    if ($result && $result->num_rows > 0) {
        echo '<div class="labs-grid">';
        while ($lab = $result->fetch_assoc()) {
            echo '<div class="lab-card">';
            echo '<h2>Lab ' . htmlspecialchars($lab['lab_number']) . ': ' . htmlspecialchars($lab['lab_title']) . '</h2>';
            echo '<p>' . htmlspecialchars($lab['lab_description']) . '</p>';
            echo '<a href="' . htmlspecialchars($lab['lab_link']) . '" class="lab-link">View Lab <i class="fas fa-arrow-right"></i></a>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p class="no-labs">No lab content available.</p>';
    }
    ?>
</div>

<?php
// Include footer
require_once __DIR__ . '/Quiz3/includes/foot.inc.php';
?> 