<?php
// includes/init.inc.php

// 1) Start session if none exists
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2) Any other bootstrapping (error reporting, timezone, config)
//    belongs here—NO HTML, NO output of any kind!
