<?php
$page_type = 'plain';
$page_title = "About Me - Eva Lugo";
$page_class = "about";
define('INCLUDED', true);

require_once __DIR__ . '/includes/init.inc.php';
require_once __DIR__ . '/includes/head.inc.php';
require_once __DIR__ . '/includes/nav.inc.php';
?>

<link rel="stylesheet" href="styles.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Alice&display=swap" rel="stylesheet">

<div class="center">
  <div class="center-content">
    <h1>About Me</h1>
    <img src="headsho.jpeg" alt="Eva Lugo" class="profile-pic">
    <div class="bio">
      <!-- Keep all your <p> content here as-is -->
      <p>Hello! My name is Eva Lugo...</p>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/loginmodal.inc.php'; ?>

<?php require_once __DIR__ . '/includes/footer.inc.php'; ?>
