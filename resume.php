<?php
// Set page variables
$page_title = "Resume - Eva Lugo";
$page_class = "resume";

// Include necessary files
require_once __DIR__ . '/Quiz3/includes/init.inc.php';
require_once __DIR__ . '/Quiz3/includes/head.inc.php';
?>

<div class="content-wrapper">
    <h1>Resume</h1>
    
    <div id="contactInfo">
        <p>
            Eva Lugo | 
            <a href="mailto:lugoe@rpi.edu">lugoe@rpi.edu</a> | 
            <a href="https://linkedin.com/in/evalugo" target="_blank">LinkedIn</a> | 
            <a href="https://github.com/evalugo" target="_blank">GitHub</a>
        </p>
    </div>
    
    <div class="section">
        <div class="section-title">Education</div>
        <div class="subsection">
            <span class="dates">Expected May 2025</span>
            <strong>Rensselaer Polytechnic Institute</strong>, Troy, NY<br>
            Bachelor of Science in Information Technology and Web Science
        </div>
    </div>
    
    <div class="section">
        <div class="section-title">Technical Skills</div>
        <ul>
            <li class="bullet">Web Development: HTML5, CSS3, JavaScript, PHP, MySQL</li>
            <li class="bullet">Programming: Python, Java, C++</li>
            <li class="bullet">Tools & Technologies: Git, VS Code, XAMPP, Linux</li>
            <li class="bullet">Web Design: Responsive Design, UI/UX Principles</li>
        </ul>
    </div>
    
    <div class="section">
        <div class="section-title">Projects</div>
        <div class="subsection">
            <strong>Personal Portfolio Website</strong>
            <ul>
                <li class="bullet">Developed a responsive personal website using HTML, CSS, and JavaScript</li>
                <li class="bullet">Implemented dynamic content loading using PHP and MySQL</li>
                <li class="bullet">Created an admin interface for content management</li>
            </ul>
        </div>
    </div>
    
    <div class="section">
        <div class="section-title">Experience</div>
        <div class="subsection">
            <span class="dates">Summer 2023</span>
            <strong>Web Development Intern</strong>, Company Name
            <ul>
                <li class="bullet">Assisted in developing and maintaining company websites</li>
                <li class="bullet">Implemented responsive design principles</li>
                <li class="bullet">Collaborated with team members on various projects</li>
            </ul>
        </div>
    </div>
    
    <div class="buttons">
        <a href="index.php">
            Home <i class="fa-solid fa-home"></i>
        </a>
        <a href="aboutme.php">
            About Me <i class="fa-solid fa-user"></i>
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