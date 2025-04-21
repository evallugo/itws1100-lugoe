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

<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
  e.preventDefault();
  fetch('login.php', {
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
