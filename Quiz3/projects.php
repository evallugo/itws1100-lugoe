<?php
$page_title = "Projects - Eva Lugo";
$page_class = "projects";
define('INCLUDED', true);

require_once __DIR__ . '/includes/init.inc.php';
require_once __DIR__ . '/includes/head.inc.php';
require_once __DIR__ . '/includes/nav.inc.php';
require_once __DIR__ . '/includes/conn.php';
?>
<link rel="stylesheet" href="styles.css">
<title><?php echo $page_title; ?></title>
<?php 
?>

<div class="center">
    <div class="center-content">
        <h1>Projects</h1>
        <div class="projects-container">
            <?php
            // Fetch projects from database
            $query = "SELECT * FROM myProjects ORDER BY last_updated DESC";
            $result = mysqli_query($conn, $query);

            if ($result) {
                while ($project = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="project-card">
                        <h2><i class="<?php echo htmlspecialchars($project['image']); ?>"></i> 
                            <?php echo htmlspecialchars($project['name']); ?></h2>
                        <p class="description"><?php echo htmlspecialchars($project['description']); ?></p>
                        <p class="team">Team Members: <?php echo htmlspecialchars($project['team_members']); ?></p>
                        <a href="<?php echo htmlspecialchars($project['path']); ?>" class="project-link">
                            View Project <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <?php
                }
                mysqli_free_result($result);
            } else {
                echo "Error loading projects: " . mysqli_error($conn);
            }
            ?>
        </div>
    </div>
</div>

<style>
/* Add these styles to your existing CSS or include them here */
.projects-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.project-card {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.project-card:hover {
    transform: translateY(-5px);
}

.project-card h2 {
    color: hotpink;
    margin-bottom: 15px;
}

.project-card .description {
    margin-bottom: 15px;
    color: #666;
}

.project-card .team {
    font-style: italic;
    color: #888;
    margin-bottom: 15px;
}

.project-link {
    display: inline-block;
    padding: 10px 20px;
    background-color: hotpink;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.project-link:hover {
    background-color: #ff369b;
}
</style>

<?php require_once __DIR__ . '/includes/footer.inc.php'; ?>