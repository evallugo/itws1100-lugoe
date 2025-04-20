<?php
//include login functions
require_once 'login.inc.php';

//function to build the menu
function buildMenu($db) {
    $menu = '<nav class="main-nav">';
    $menu .= '<ul>';
    $menu .= '<li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>';
    $menu .= '<li><a href="aboutme.php"><i class="fas fa-user"></i> About Me</a></li>';
    $menu .= '<li><a href="resume.php"><i class="fas fa-file-alt"></i> Resume</a></li>';
    $menu .= '<li><a href="labs.php"><i class="fas fa-flask"></i> Labs</a></li>';
    $menu .= '<li><a href="projects.php"><i class="fas fa-project-diagram"></i> Projects</a></li>';
    
    //add admin options if user is logged in and is admin
    if (isLoggedIn() && isAdmin($db)) {
        $menu .= '<li><a href="admin/manage_labs.php"><i class="fas fa-cogs"></i> Manage Labs</a></li>';
    }
    
    $menu .= '</ul>';
    $menu .= '</nav>';
    
    return $menu;
}

//output the menu
echo buildMenu($db);
?> 