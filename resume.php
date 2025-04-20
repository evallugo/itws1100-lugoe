<?php
// Set page variables
$page_title = "Resume - Eva Lugo";
$page_class = "resume-page";

// Include necessary files
include('Quiz3/includes/init.inc.php');
include('Quiz3/includes/head.inc.php');
include('Quiz3/includes/menu.inc.php');
include('Quiz3/includes/login.inc.php');
?>

<div class="content">
    <h1>Resume</h1>
    
    <div class="resume-container">
        <div class="resume-header">
            <h2>Eva Lugo</h2>
            <p>Information Technology and Web Science Student</p>
            <p>Rensselaer Polytechnic Institute</p>
        </div>
        
        <div class="resume-section">
            <h3>Education</h3>
            <div class="resume-item">
                <h4>Rensselaer Polytechnic Institute</h4>
                <p>Bachelor of Science in Information Technology and Web Science</p>
                <p>Expected Graduation: May 2025</p>
            </div>
        </div>
        
        <div class="resume-section">
            <h3>Skills</h3>
            <ul class="skills-list">
                <li>HTML5 & CSS3</li>
                <li>JavaScript & jQuery</li>
                <li>PHP & MySQL</li>
                <li>Responsive Web Design</li>
                <li>Git Version Control</li>
                <li>Web Development</li>
                <li>Database Management</li>
            </ul>
        </div>
        
        <div class="resume-section">
            <h3>Projects</h3>
            <div class="resume-item">
                <h4>Personal Portfolio Website</h4>
                <p>Developed a responsive personal website showcasing my work and skills using HTML, CSS, and JavaScript.</p>
            </div>
            <div class="resume-item">
                <h4>Database-Driven Web Application</h4>
                <p>Created a dynamic web application using PHP and MySQL to manage and display content.</p>
            </div>
        </div>
        
        <div class="resume-section">
            <h3>Experience</h3>
            <div class="resume-item">
                <h4>Web Development Intern</h4>
                <p>Company Name | Summer 2023</p>
                <ul>
                    <li>Assisted in developing and maintaining company websites</li>
                    <li>Implemented responsive design principles</li>
                    <li>Collaborated with team members on various projects</li>
                </ul>
            </div>
        </div>
        
        <div class="resume-section">
            <h3>Contact</h3>
            <p>Email: lugoe@rpi.edu</p>
            <p>LinkedIn: linkedin.com/in/evalugo</p>
            <p>GitHub: github.com/evalugo</p>
        </div>
    </div>
</div>

<?php
// Include footer
include('Quiz3/includes/foot.inc.php');
?> 