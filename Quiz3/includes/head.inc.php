<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo isset($page_title) ? $page_title : "Eva Lugo"; ?></title>
  <link rel="stylesheet" href="labs/3/styles.css">
  <link rel="stylesheet" href="Quiz3/css/admin.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Alice&display=swap" rel="stylesheet">
  <!-- add jquery for ajax functionality -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="<?php echo isset($page_class) ? $page_class : 'index'; ?>"> 