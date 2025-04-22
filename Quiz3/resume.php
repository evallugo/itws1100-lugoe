<?php
$page_type  = 'plain';
$page_title = "Eva Lugo – Resume";
$page_class = "resume";
define('INCLUDED', true);

require_once __DIR__ . '/includes/init.inc.php';
require_once __DIR__ . '/includes/head.inc.php';
require_once __DIR__ . '/includes/nav.inc.php';
?>

<!-- page‑specific styles matching your resume.html -->
<style>
  body.plain {
    font-family: 'Times New Roman', Times, serif;
    margin: 0;
    padding: 20px;
    width: 95%;
    max-width: 800px;
    margin: auto;
    font-size: 15px;
    line-height: 1.1;
    background: white;
    color: black;
  }

  h1 {
    text-align: center;
    padding: 60px 0;
    margin-bottom: 0;
    font-variant: small-caps;
    color: hotpink;
  }

  #contactInfo {
    text-align: center;
    border-top: 1px solid #333;
    border-bottom: 1px solid #333;
    padding: 4px 0;
    margin-bottom: 18px;
  }

  #contactInfo a {
    color: black;
    text-decoration: none;
  }

  .section-title {
    margin-top: 30px;
    margin-bottom: 10px;
    font-size: 18px;
    font-weight: bold;
    border-bottom: 1px solid #333;
    padding-bottom: 4px;
  }

  .section {
    margin-bottom: 20px;
  }

  .subsection {
    margin-bottom: 10px;
    font-size: 15px;
  }

  .dates {
    float: right;
    white-space: nowrap;
    font-weight: bold;
  }

  ul {
    padding: 0;
    list-style: none;
    margin: 0;
  }

  li {
    margin: 4px 0;
    padding-left: 20px;
    text-indent: -20px;
  }

  .indented {
    margin-left: 20px;
  }

  .bullet::before {
    content: "• ";
    margin-right: 10px;
  }
</style>

<h1>Eva Lugo</h1>

<div id="contactInfo">
  Madison, CT | <a href="mailto:lugoe@rpi.edu">lugoe@rpi.edu</a> | 
  <a href="https://www.linkedin.com/in/eva-lugo/" target="_blank">linkedin.com/in/eva-lugo</a> | (203)-343-2688
</div>

<div class="section">
  <div class="section-title">EDUCATION</div>
  <div class="subsection">
    <div>
      <strong>Rensselaer Polytechnic Institute</strong>, Troy, NY
      <span class="dates">Expected Graduation Year: May 2028</span>
    </div>
    <div>Bachelor of Science: Computer Science and Information Technology and Web Sciences</div>
    <div>
      <em>Awards:</em> Rensselaer Leadership Award, Women's Leadership Award, Rensselaer Recognition Award
    </div>
  </div>
  <div class="subsection">
    <div>
      <strong>Daniel Hand High School</strong>, Madison, CT
      <span class="dates">Graduation Date: June 2024</span>
    </div>
    <div>
      <em>Awards:</em> The Connecticut State Seal of Biliteracy, The Reverence Franklin A. Bower Madison Rotary Foundation Scholarship
    </div>
    <div>GPA: 3.8</div>
  </div>
</div>

<div class="section">
  <div class="section-title">WORK EXPERIENCE</div>
  <div class="subsection">
    <div>
      <strong>Self‑Employed Care and Household Provider</strong>, Madison, CT
      <span class="dates">Jan. 2021 – Present</span>
    </div>
    <ul>
      <li><em>Nanny</em>, <em>Pet Sitter</em>, <em>House Sitter</em></li>
      <li class="bullet indented">
        Provided attentive care, oversaw and managed household operations, and maintained clear communication with clients
      </li>
      <li class="bullet indented">Resolved conflicts efficiently and quietly</li>
      <li class="bullet indented">
        Assisted over 100 families with children ages ranging from 9 mo. – 13 yo. and households on the CT Shoreline
      </li>
    </ul>
  </div>
</div>

<div class="section">
  <div class="section-title">EXTRACURRICULARS</div>
  <!-- repeat for each subsection -->
  <div class="subsection">
    <div>
      <strong>Society of Hispanic Professional Engineers RPI Chapter</strong>, Troy, NY
      <span class="dates">Sep. 2024 – Present</span>
    </div>
    <ul>
      <li><em>Fundraising Committee Member</em></li>
      <li class="bullet indented">
        Collaborate with members to develop and execute fundraising initiatives and increase community engagement
      </li>
      <li><em>Member</em></li>
      <li class="bullet indented">
        Attending workshops to develop professionally through leadership and community outreach
      </li>
    </ul>
  </div>
  <!-- …and so on for all your other subsections… -->
</div>

<div class="section">
  <div class="section-title">SKILLS</div>
  <ul>
    <li><strong>Fluent Languages:</strong> English and Spanish</li>
    <li><strong>Programming Languages:</strong> Python, Java, C++, HTML, CSS</li>
    <li class="bullet indented">
      Time management, Communication, Marketing, Interpersonal Skills, Adaptability, Problem‑Solving
    </li>
  </ul>
</div>

<?php
// shared modal & footer
require_once __DIR__ . '/includes/loginmodal.inc.php';
require_once __DIR__ . '/includes/footer.inc.php';
?>
