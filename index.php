<?php
//set page variables
$page_title = "Eva Lugo";
$page_class = "index";
define('INCLUDED', true);

//include the required files
require_once __DIR__ . '/Quiz3/includes/init.inc.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <!-- Update CSS path to point to Quiz3 directory -->
    <link rel="stylesheet" href="Quiz3/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alice&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
</head>
<body class="<?php echo $page_class; ?>">

<div class="header">
    <nav>
        <a href="index.php"><i class="fas fa-home"></i> Home</a>
        <a href="Quiz3/aboutme.php"><i class="fa-solid fa-user"></i> About</a>
        <a href="Quiz3/resume.php"><i class="fa-solid fa-file"></i> Resume</a>
        <a href="Quiz3/labs.php"><i class="fa-solid fa-folder"></i> Labs</a>
        <a href="Quiz3/projects.php"><i class="fa-solid fa-code"></i> Projects</a>
        <a href="https://github.com/evallugo" target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-github"></i> GitHub
        </a>  
        <a href="https://www.linkedin.com/in/eva-lugo" target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-linkedin"></i> LinkedIn
        </a>
        <?php if(isset($_SESSION['user_name'])): ?>
            <span class="welcome-text">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</span>
            <a href="Quiz3/logout.php" class="login-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <?php else: ?>
            <a href="#" id="loginBtn" class="login-btn"><i class="fas fa-sign-in-alt"></i> Login</a>
        <?php endif; ?>
    </nav>
</div>

<div class="center">
  <div class="center-content">
    <h1>Eva Lugo</h1>
    <div class="buttons">
      <a href="Quiz3/aboutme.php">
        About Me <i class="fa-solid fa-user"></i>
      </a>
      <a href="Quiz3/resume.php">
        Resume <i class="fa-solid fa-file"></i>
      </a>
      <a href="Quiz3/labs.php">
        Labs <i class="fa-solid fa-folder"></i>
      </a>
      <a href="Quiz3/projects.php">
        Projects <i class="fa-solid fa-code"></i>
      </a>
      <a href="https://github.com/evallugo" target="_blank" rel="noopener noreferrer">
        GitHub <i class="fa-brands fa-github"></i>
      </a>   
      <a href="https://www.linkedin.com/in/eva-lugo" target="_blank" rel="noopener noreferrer">
        LinkedIn <i class="fa-brands fa-linkedin"></i>
      </a>       
    </div>
  </div>
</div>

<!-- Include login modal -->
<?php include __DIR__ . '/Quiz3/includes/nav.inc.php'; ?>

<?php 
// Include Quiz3 content if needed
// include __DIR__ . '/Quiz3/index.php';

require_once __DIR__ . '/Quiz3/includes/footer.inc.php'; 
?> 

<script>
$(document).ready(function() {
    // Update login.php path
    $("#loginForm").attr('action', 'Quiz3/login.php');
    
    $("#loginForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "Quiz3/login.php",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if(response.success) {
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert("An error occurred. Please try again.");
            }
        });
    });
});
</script>
</body>
</html> 