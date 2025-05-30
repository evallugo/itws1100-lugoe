<?php
// header template with common meta tags and resources
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($page_title); ?></title>
  <link rel="stylesheet" href="/iit/Quiz3/styles.css">
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    rel="stylesheet"
  >
  <link
    href="https://fonts.googleapis.com/css2?family=Alice&display=swap"
    rel="stylesheet"
  >
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
</head>
<body class="<?php echo (isset($page_type) && $page_type==='plain')?'plain':''; ?>">
