<?php
// Connect to the database using PDO
try {
    $db = new PDO('mysql:host=localhost;dbname=iit;charset=utf8', 'root', 'PRLugo22!');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '<div class="messages">Could not connect to the database. Error: ' . $e->getMessage() . '</div>';
    exit();
}
?>
