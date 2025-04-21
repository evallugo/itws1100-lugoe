<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo isset($page_title) ? $page_title : "Eva Lugo"; ?></title>
  <?php
  $base_path = dirname($_SERVER['PHP_SELF']);
  if ($base_path == '/') $base_path = '';
  ?>
  <link rel="stylesheet" href="<?php echo $base_path; ?>/labs/3/styles.css">
  <link rel="stylesheet" href="Quiz3/css/admin.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Alice&display=swap" rel="stylesheet">
  <!-- add jquery for ajax functionality -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="<?php echo isset($page_class) ? $page_class : 'index'; ?>">
<?php if ($page_class != 'index'): ?>
<div class="header">
  <nav>
    <a href="index.php"><i class="fas fa-home"></i> Home</a>
    <a href="aboutme.php"><i class="fas fa-user"></i> About Me</a>
    <a href="resume.php"><i class="fas fa-file-alt"></i> Resume</a>
    <a href="labs.php"><i class="fas fa-flask"></i> Labs</a>
    <a href="https://github.com/evallugo" target="_blank"><i class="fab fa-github"></i> GitHub</a>
    <a href="https://www.linkedin.com/in/eva-lugo" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a>
  </nav>
</div>
<?php endif; ?>
<div class="container"> 