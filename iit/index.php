<?php
$page_title = "Eva Lugo";
$page_class = "index";
define('INCLUDED', true);

// Update the path to point to Quiz3 directory
require_once __DIR__ . '/Quiz3/includes/init.inc.php';
require_once __DIR__ . '/Quiz3/includes/head.inc.php';
require_once __DIR__ . '/Quiz3/includes/nav.inc.php';
?>

<div class="center">
  <div class="center-content">
    <h1>Eva Lugo</h1>
    <div class="buttons">
      <a href="Quiz3/aboutme.php">
        About Me <i class="fa-solid fa-user"></i>
      </a>
      <a href="Quiz3/resume.php">
        Resume <i class="fa-solid fa-file"></i>
      </a>
      <a href="Quiz3/labs.php">
        Labs <i class="fa-solid fa-folder"></i>
      </a>
      <a href="Quiz3/projects.php">
        Projects <i class="fa-solid fa-code"></i>
      </a>
      <a href="https://github.com/evallugo" target="_blank" rel="noopener noreferrer">
        GitHub <i class="fa-brands fa-github"></i>
      </a>   
      <a href="https://www.linkedin.com/in/eva-lugo" target="_blank" rel="noopener noreferrer">
        LinkedIn <i class="fa-brands fa-linkedin"></i>
      </a>       
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/Quiz3/includes/footer.inc.php'; ?> 