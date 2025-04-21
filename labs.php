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
        <p>Here are all my labs for Web Systems Development.</p>
        
        <div class="labs-grid">
            <?php
            $labs = [
                ['number' => 1, 'title' => 'Lab 1', 'description' => 'Introduction to Web Development - Git and Server Setup', 'link' => 'labs/1/index.html'],
                ['number' => 2, 'title' => 'Lab 2', 'description' => 'HTML and CSS Resume', 'link' => 'labs/2/lab3.html'],
                ['number' => 3, 'title' => 'Lab 3', 'description' => 'Personal Website', 'link' => 'labs/3/labs.html'],
                ['number' => 4, 'title' => 'Lab 4', 'description' => 'XML & RSS', 'link' => 'labs/4/index.html'],
                ['number' => 5, 'title' => 'Lab 5', 'description' => 'Javascript', 'link' => 'labs/5/lab5.html'],
                ['number' => 6, 'title' => 'Lab 6', 'description' => 'jQuery', 'link' => 'labs/6/lab6.html'],
                ['number' => 7, 'title' => 'Lab 7', 'description' => 'Project Mockups', 'link' => 'labs/7/lab7.html'],
                ['number' => 8, 'title' => 'Lab 8', 'description' => 'Dynamic Website', 'link' => 'labs/8/lab8.html'],
                ['number' => 9, 'title' => 'Lab 9', 'description' => 'Database', 'link' => 'labs/9/index.php'],
                ['number' => 10, 'title' => 'Lab 10', 'description' => 'Final Project', 'link' => 'labs/10/index.php']
            ];

            foreach ($labs as $lab) {
                echo '<div class="lab-card">';
                echo '<h2>Lab ' . $lab['number'] . ': ' . $lab['title'] . '</h2>';
                echo '<p>' . $lab['description'] . '</p>';
                echo '<a href="' . $lab['link'] . '" class="view-lab">View Lab <i class="fas fa-arrow-right"></i></a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

<?php
// Include footer
require_once __DIR__ . '/Quiz3/includes/foot.inc.php';
?> 