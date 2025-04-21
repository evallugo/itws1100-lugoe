<?php
$page_type = 'plain';
$page_title = "About Me - Eva Lugo";
$page_class = "about";
define('INCLUDED', true);

require_once __DIR__ . '/includes/init.inc.php';
require_once __DIR__ . '/includes/head.inc.php';
require_once __DIR__ . '/includes/nav.inc.php';
?>

<link rel="stylesheet" href="styles.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Alice&display=swap" rel="stylesheet">

<div class="center">
  <div class="center-content">
    <h1>About Me</h1>
    <img src="headsho.jpeg" alt="Eva Lugo" class="profile-pic">
    <div class="bio">
      <p>Hello! My name is Eva Lugo, and I am currently pursuing a dual Bachelor of Science degree in Information Technologies and Web Sciences and Computer Science at Rensselaer Polytechnic Institute. I am passionate about web development...</p>
      <!-- (keep all your <p> content here as-is, it's all good) -->
    </div>
  </div>
</div>

<!-- LOGIN MODAL -->
<div id="loginModal" class="modal" style="display:none;">
  <div class="modal-content" style="padding:20px; background:white; border-radius:10px;">
    <span onclick="document.getElementById('loginModal').style.display='none'" style="float:right; cursor:pointer;">&times;</span>
    <h3>Login</h3>
    <div id="loginError" style="color:red; display:none;"></div>
    <form id="loginForm">
      <label>Username:</label><br>
      <input type="text" name="username" required><br><br>
      <label>Password:</label><br>
      <input type="password" name="password" required><br><br>
      <input type="submit" value="Login">
    </form>
  </div>
</div>

<!-- LOGIN SCRIPT -->
<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
  e.preventDefault();
  fetch('login.php', { // you're already in Quiz3 so no prefix needed
    method: 'POST',
    body: new FormData(this)
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      location.reload();
    } else {
      document.getElementById('loginError').innerText = data.message;
      document.getElementById('loginError').style.display = 'block';
    }
  });
});
</script>

<?php require_once __DIR__ . '/includes/footer.inc.php'; ?>
