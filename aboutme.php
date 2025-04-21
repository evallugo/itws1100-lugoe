<?php
// Set page variables
$page_title = "About Me - Eva Lugo";
$page_class = "about";

// Include necessary files
require_once __DIR__ . '/Quiz3/includes/init.inc.php';
require_once __DIR__ . '/Quiz3/includes/head.inc.php';
?>

<div class="content-wrapper">
    <h1>About Me</h1>
    
    <div class="about-container">
        <div class="profile-pic">
            <img src="labs/3/images/profile.jpg" alt="Eva Lugo">
        </div>
        
        <div class="bio">
            <p>Hello! I'm Eva Lugo, a student at Rensselaer Polytechnic Institute (RPI) studying Information Technology and Web Science.</p>
            
            <p>I'm passionate about web development and creating user-friendly applications. This website showcases my work throughout the ITWS-1100 course, where I've learned various web technologies including HTML, CSS, JavaScript, PHP, and more.</p>
            
            <p>When I'm not coding, I enjoy exploring new technologies, reading, and spending time outdoors.</p>
            
            <h2>Skills</h2>
            <ul>
                <li class="bullet">HTML5 & CSS3</li>
                <li class="bullet">JavaScript & jQuery</li>
                <li class="bullet">PHP & MySQL</li>
                <li class="bullet">Responsive Web Design</li>
                <li class="bullet">Git Version Control</li>
            </ul>
        </div>
    </div>
    
    <div class="buttons">
        <a href="index.php">
            Home <i class="fa-solid fa-home"></i>
        </a>
        <a href="resume.php">
            Resume <i class="fa-solid fa-file"></i>
        </a>
        <a href="labs.php">
            Labs <i class="fa-solid fa-folder"></i>
        </a>
    </div>
</div>

<?php
// Include footer
require_once __DIR__ . '/Quiz3/includes/foot.inc.php';
?> 