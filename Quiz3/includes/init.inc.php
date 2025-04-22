<?php
// includes/init.inc.php

//start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//    belongs here—NO HTML, NO output of any kind!
