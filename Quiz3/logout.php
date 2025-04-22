<?php
//start session to access session data
session_start();

//destroy all session data
session_destroy();

//redirect to home page
header("Location: ../index.php");
exit;
?>
