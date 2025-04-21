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
    
    <div class="buttons lab-grid">
        <?php
        // For now, let's display static lab buttons until database is set up
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
            echo 'Lab ' . $lab['number'];
            echo '<i class="fa-solid fa-flask"></i>';
            echo '</a>';
        }
        ?>
    </div>
</div>

<?php
// Include footer
require_once __DIR__ . '/Quiz3/includes/foot.inc.php';
?> 