<?php
// Set page variables
$page_title = "Projects - Eva Lugo";
$page_class = "projects-page";

// Include necessary files
include('Quiz3/includes/init.inc.php');
include('Quiz3/includes/head.inc.php');
include('Quiz3/includes/menu.inc.php');
include('Quiz3/includes/login.inc.php');

// Include database connection
require_once 'Quiz3/conn.php';
?>

<div class="content">
    <h1>My Projects</h1>
    
    <div class="projects-container">
        <?php
        // Query to get all projects from the database
        $query = "SELECT * FROM myProjects ORDER BY project_id";
        $result = $db->query($query);
        
        if ($result && $result->num_rows > 0) {
            echo '<div class="projects-grid">';
            
            while ($project = $result->fetch_assoc()) {
                echo '<div class="project-card">';
                echo '<h2>' . htmlspecialchars($project['project_title']) . '</h2>';
                
                if (!empty($project['project_description'])) {
                    echo '<p>' . htmlspecialchars($project['project_description']) . '</p>';
                }
                
                if (!empty($project['project_technologies'])) {
                    echo '<p class="technologies"><strong>Technologies:</strong> ' . htmlspecialchars($project['project_technologies']) . '</p>';
                }
                
                if (!empty($project['project_link'])) {
                    echo '<a href="' . htmlspecialchars($project['project_link']) . '" class="project-link" target="_blank">View Project</a>';
                }
                
                echo '</div>';
            }
            
            echo '</div>';
        } else {
            echo '<p>No projects found in the database.</p>';
        }
        ?>
    </div>
</div>

<?php
// Include footer
include('Quiz3/includes/foot.inc.php');
?> 