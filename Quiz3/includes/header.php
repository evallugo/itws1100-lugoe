<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?> - Eva Lugo</title>
    <link rel="stylesheet" href="/iit/Quiz3/css/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alice&display=swap" rel="stylesheet">
</head>
<body class="<?php echo $bodyClass; ?>">
    <div class="header">
        <nav>
            <?php include 'navigation.php'; ?>
        </nav>
    </div>