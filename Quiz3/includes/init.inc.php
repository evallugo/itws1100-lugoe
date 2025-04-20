<?php
//start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//set default page title and class if not set
if (!isset($page_title)) {
    $page_title = "Eva Lugo";
}

if (!isset($page_class)) {
    $page_class = "default-page";
}

//include database connection
require_once __DIR__ . '/../conn.php';
?> 