<?php
//set page variables
$page_title = "Eva Lugo";
$page_class = "index";
define('INCLUDED', true);

//include the required files
require_once __DIR__ . '/Quiz3/includes/init.inc.php';
require_once __DIR__ . '/Quiz3/includes/header.php';
?>

<div class="center">
  <div class="center-content">
    <h1>Eva Lugo</h1>
    <div class="buttons">
      <a href="aboutme.php">
        About Me <i class="fa-solid fa-user"></i>
      </a>
      <a href="resume.php">
        Resume <i class="fa-solid fa-file"></i>
      </a>
      <a href="labs.php">
        Labs <i class="fa-solid fa-folder"></i>
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

<?php 
// Include Quiz3 content if needed
// include __DIR__ . '/Quiz3/index.php';

require_once __DIR__ . '/Quiz3/includes/foot.inc.php'; 
?> 