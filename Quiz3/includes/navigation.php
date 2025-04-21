<a href="/iit/Quiz3/index.php"><i class="fas fa-home"></i> Home</a>
<a href="/iit/Quiz3/about.php"><i class="fa-solid fa-user"></i> About</a>
<a href="/iit/Quiz3/resume.php"><i class="fa-solid fa-file"></i> Resume</a>
<a href="/iit/Quiz3/labs.php"><i class="fa-solid fa-folder"></i> Labs</a>
<a href="https://github.com/evallugo" target="_blank" rel="noopener noreferrer">
    <i class="fa-brands fa-github"></i> GitHub
</a>
<a href="https://www.linkedin.com/in/eva-lugo" target="_blank" rel="noopener noreferrer">
    <i class="fa-brands fa-linkedin"></i> LinkedIn
</a>
<?php if(isset($_SESSION['user'])): ?>
    <span class="welcome">Welcome <?php echo htmlspecialchars($_SESSION['user']['name']); ?>!</span>
    <a href="/iit/Quiz3/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
<?php else: ?>
    <a href="/iit/Quiz3/login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
<?php endif; ?>