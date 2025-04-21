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
            <img src="labs/3/=headsho.jpeg" alt="Eva Lugo">
        </div>
        
        <div class="bio">
            <p>Hello! I'm Eva Lugo, a student at Rensselaer Polytechnic Institute (RPI) studying Information Technology and Web Science.</p>
            
            <p>I'm passionate about web development and creating user-friendly applications. Throughout my coursework at RPI, I've gained experience in various web technologies and programming languages. I enjoy solving complex problems and creating elegant solutions.</p>
            
            <p>When I'm not coding, I enjoy exploring new technologies, reading about tech trends, and contributing to open-source projects. I'm always eager to learn new skills and take on challenging projects.</p>
            
            <div class="skills">
                <h2>Technical Skills</h2>
                <ul>
                    <li class="bullet">HTML5 & CSS3</li>
                    <li class="bullet">JavaScript & jQuery</li>
                    <li class="bullet">PHP & MySQL</li>
                    <li class="bullet">Python & Java</li>
                    <li class="bullet">Git Version Control</li>
                    <li class="bullet">Responsive Web Design</li>
                </ul>
            </div>
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