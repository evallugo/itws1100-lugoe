<?php
$page_title  = "Projects - Eva Lugo";
$page_class  = "projects";
define('INCLUDED', true);

require_once __DIR__ . '/includes/init.inc.php';
require_once __DIR__ . '/includes/head.inc.php';
require_once __DIR__ . '/includes/nav.inc.php';
require_once __DIR__ . '/includes/conn.php';
?>

<link rel="stylesheet" href="styles.css">

<div class="center">
  <div class="center-content">
    <h1>Projects</h1>
    <div class="projects-container">

      <?php
      // 1) Use a real column in ORDER BY; here we'll use id DESC to show newest first
      $query  = "SELECT * FROM myProjects ORDER BY id DESC";
      $result = mysqli_query($conn, $query);

      if (! $result) {
          // helpful debug—will show SQL error if something's wrong
          echo "<p>Error loading projects: " . mysqli_error($conn) . "</p>";
      }
      else {
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
                <!-- If you have no team_members column, omit this line -->
                <!-- <p class="team">Team Members: …</p> -->

                <a
                  href="<?php echo htmlspecialchars($project['url']); ?>"
                  target="_blank"
                  class="project-link"
                >
                  View Project <i class="fas fa-arrow-right"></i>
                </a>
              </div>
              <?php
          }
          mysqli_free_result($result);
      }
      ?>

    </div>
  </div>
</div>

<?php
require_once __DIR__ . '/includes/loginmodal.inc.php';
require_once __DIR__ . '/includes/footer.inc.php';
?>
