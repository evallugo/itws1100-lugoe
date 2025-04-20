<?php
// Set page variables
$page_title = "About Me - Eva Lugo";
$page_class = "about-page";

// Include necessary files
include('Quiz3/includes/init.inc.php');
include('Quiz3/includes/head.inc.php');
include('Quiz3/includes/menu.inc.php');
include('Quiz3/includes/login.inc.php');
?>

<div class="content">
    <h1>About Me</h1>
    
    <div class="about-container">
        <div class="about-text">
            <p>Hello! I'm Eva Lugo, a student at Rensselaer Polytechnic Institute (RPI) studying Information Technology and Web Science.</p>
            
            <p>I'm passionate about web development and creating user-friendly applications. This website showcases my work throughout the ITWS-1100 course, where I've learned various web technologies including HTML, CSS, JavaScript, PHP, and more.</p>
            
            <p>When I'm not coding, I enjoy exploring new technologies, reading, and spending time outdoors.</p>
            
            <h2>Skills</h2>
            <ul>
                <li>HTML5 & CSS3</li>
                <li>JavaScript & jQuery</li>
                <li>PHP & MySQL</li>
                <li>Responsive Web Design</li>
                <li>Git Version Control</li>
            </ul>
        </div>
        
        <div class="about-image">
            <!-- You can add your image here -->
            <img src="labs/3/images/profile.jpg" alt="Eva Lugo" class="profile-img">
        </div>
    </div>
</div>

<?php
// Include footer
include('Quiz3/includes/foot.inc.php');
?> 