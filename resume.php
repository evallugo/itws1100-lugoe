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
        <p>Eva Lugo | lugoe@rpi.edu | Troy, NY</p>
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
            <li class="bullet">Programming Languages: Python, Java, JavaScript</li>
            <li class="bullet">Web Development: HTML5, CSS3, PHP, MySQL</li>
            <li class="bullet">Tools & Technologies: Git, VS Code, XAMPP</li>
            <li class="bullet">Design: Adobe Creative Suite, Figma</li>
        </ul>
    </div>

    <div class="section">
        <div class="section-title">Experience</div>
        <div class="subsection">
            <span class="dates">Summer 2023</span>
            <strong>Web Development Intern</strong>, Company Name<br>
            <ul>
                <li class="bullet">Developed and maintained responsive websites using HTML, CSS, and JavaScript</li>
                <li class="bullet">Collaborated with team members to implement new features and fix bugs</li>
                <li class="bullet">Optimized website performance and improved user experience</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Projects</div>
        <div class="subsection">
            <strong>Personal Portfolio Website</strong>
            <ul>
                <li class="bullet">Designed and developed a responsive portfolio website using HTML, CSS, and JavaScript</li>
                <li class="bullet">Implemented dynamic content loading with PHP and MySQL</li>
                <li class="bullet">Created an admin interface for content management</li>
            </ul>
        </div>
        <div class="subsection">
            <strong>Database Management System</strong>
            <ul>
                <li class="bullet">Built a web-based database management system using PHP and MySQL</li>
                <li class="bullet">Implemented user authentication and authorization</li>
                <li class="bullet">Created an intuitive interface for data manipulation</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Leadership & Activities</div>
        <div class="subsection">
            <strong>Web Technologies Group</strong>, RPI
            <ul>
                <li class="bullet">Participate in weekly coding workshops and hackathons</li>
                <li class="bullet">Collaborate with peers on web development projects</li>
            </ul>
        </div>
    </div>
</div>

<?php
// Include footer
require_once __DIR__ . '/Quiz3/includes/foot.inc.php';
?> 