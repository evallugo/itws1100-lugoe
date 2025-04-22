<?php
$page_title = "Projects - Eva Lugo";
$page_class = "projects";
define('INCLUDED', true);

// include required files
require_once __DIR__ . '/includes/init.inc.php';
require_once __DIR__ . '/includes/head.inc.php';
require_once __DIR__ . '/includes/nav.inc.php';
require_once __DIR__ . '/includes/conn.php';

// enable mysqli error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>
<link rel="stylesheet" href="styles.css">

<div class="center">
  <div class="center-content">
    <h1>Projects</h1>
    <div class="projects-container">
      <?php
      // fetch all projects ordered by id
      $query = "SELECT * FROM myProjects ORDER BY id DESC";
      $result = mysqli_query($conn, $query);

      // display each project
      while ($project = mysqli_fetch_assoc($result)) {
          ?>
          <div class="project-card">
            <h2>
              <i class="<?php echo htmlspecialchars($project['image']); ?>"></i>
              <?php echo htmlspecialchars($project['name']); ?>
            </h2>
            <p class="description">
              <?php echo htmlspecialchars($project['description']); ?>
            </p>
            <?php if (!empty($project['url'])): ?>
              <a href="<?php echo htmlspecialchars($project['url']); ?>"
                 class="project-link" target="_blank" rel="noopener">
                View Project <i class="fas fa-arrow-right"></i>
              </a>
            <?php endif; ?>
          </div>
          <?php
      }

      mysqli_free_result($result);
      ?>
    </div>
  </div>
</div>

<?php
require_once __DIR__ . '/includes/loginmodal.inc.php';
require_once __DIR__ . '/includes/footer.inc.php';
?>
