<?php
$page_type  = 'plain';
$page_title = "About Me – Eva Lugo";
$page_class = "about";
define('INCLUDED', true);

// Initialize session, etc.
require_once __DIR__ . '/includes/init.inc.php';
// Outputs <head>… and opens <body>
require_once __DIR__ . '/includes/head.inc.php';
// Outputs your <nav>
require_once __DIR__ . '/includes/nav.inc.php';
?>

<link rel="stylesheet" href="styles.css">

<!-- page‑specific styles to float the profile-pic -->
<style>
  .profile-pic {
    float: left;
    width: 200px;
    height: auto;
    margin: 0 20px 20px 0;
    border-radius: 10px;
  }

  /* clear the float after the bio block */
  .bio::after {
    content: "";
    display: table;
    clear: both;
  }

  /* on small screens, stack image above text */
  @media (max-width: 600px) {
    .profile-pic {
      float: none;
      display: block;
      margin: 0 auto 20px;
      width: 100%;
    }
  }
</style>

<div class="center">
  <div class="center-content">
    <h1>About Me</h1>
    <img src="headsho.jpeg" alt="Eva Lugo" class="profile-pic">

    <div class="bio">
      <p>Hello! My name is Eva Lugo, and I am currently pursuing a dual Bachelor of Science degree in Information Technologies and Web Sciences and Computer Science at Rensselaer Polytechnic Institute. I am passionate about web development and eager to explore how technology can enhance user experiences, streamline communication, and drive innovation in digital spaces. My goal is to develop and implement digital solutions that improve accessibility, engagement, and functionality across various platforms.</p>

      <p>As a dedicated student at RPI, I have had the opportunity to strengthen my programming and problem-solving skills through academic coursework and projects. My commitment to excellence has been recognized through multiple awards and scholarships, including the Rensselaer Leadership Award, Women's Leadership Award, Connecticut Seal of Biliteracy, and the Madison Rotary Foundation Scholarship. These achievements reflect my dedication to academics, leadership, and continuous learning, as well as my passion for using technology to create meaningful and effective solutions.</p>

      <p>Through my academic studies and independent projects, I have developed technical and analytical skills that allow me to solve complex problems and create innovative digital experiences. My technical expertise includes programming languages such as Python, Java, C++, HTML, and CSS. Along with my technical background, I have also cultivated soft skills that are essential for success in my field. I possess strong leadership and communication abilities, allowing me to effectively manage tasks and collaborate with teams. My proficiency in time management enables me to balance academic, extracurricular, and professional responsibilities, while my problem-solving skills allow me to approach challenges with creativity and adaptability. With a strong foundational knowledge in these areas, I am eager to apply my skills in professional environments focused on web development and digital technology.</p>

      <p>Currently, I work as a nanny in Madison, CT, where I have gained valuable experience that has strengthened my responsibility, adaptability, and time management skills. Over the past several years, I have provided care for children ranging from 9 months to 13 years old, as well as house-sitting and pet-sitting services for families in my community. My role requires me to balance multiple tasks simultaneously, ensuring organization, reliability, and clear communication with families. These experiences have fostered my ability to manage responsibilities efficiently, solve problems in real-time, and develop meaningful relationships with the people I work with. Balancing my academic pursuits in technology with my professional experiences in childcare has equipped me with a unique blend of technical and interpersonal skills that I can bring to any future career opportunity.</p>

      <p>Beyond academics, I actively participate in organizations that promote personal growth, community engagement, and leadership development. I am a Multimedia Chair for Alianza Latina, RPI's Latin cultural organization, where I manage social media content, branding, and advertising to promote events and initiatives that celebrate Hispanic and Latinx culture. This role has allowed me to apply my skills in digital strategy, branding, and outreach, enhancing the organization's visibility while fostering engagement within the campus community.</p>

      <p>Additionally, I am an active member of the Society of Hispanic Professional Engineers (SHPE), where I connect with other students and professionals in STEM fields. In this organization, I participate in networking events, mentorship programs, and leadership workshops, further expanding my skills and knowledge in the technical industry. My involvement in these organizations reinforces my commitment to diversity, inclusion, and professional growth, as well as my desire to continue building leadership experience within the technology community.</p>

      <p>My passion for web development drives my ambition to design and develop user-friendly and innovative digital experiences. I am particularly interested in how technology can improve online accessibility, streamline workflows, and create engaging digital interactions. In the future, I hope to work on real-world projects that integrate technology, design, and efficiency to enhance the user experience.</p>
    </div>
  </div>
</div>

<?php
// Injects the shared login modal + JS
require_once __DIR__ . '/includes/loginmodal.inc.php';
// Closes </body></html>
require_once __DIR__ . '/includes/footer.inc.php';
?>
