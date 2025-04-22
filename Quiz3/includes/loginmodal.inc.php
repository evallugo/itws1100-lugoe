<div id="loginModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Login</h3>
    <div id="loginError" style="color:red; display:none;"></div>
    <form id="loginForm">
      <div class="form-group">
        <label>Username:</label>
        <input type="text" name="username" required>
      </div>
      <div class="form-group">
        <label>Password:</label>
        <input type="password" name="password" required>
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</div>


<script>
$(document).ready(function() {
  // Open the modal when #loginBtn is clicked
  $('#loginBtn').on('click', function(e) {
    e.preventDefault();
    $('#loginModal').fadeIn(200);
  });

  // Close modal when the × is clicked
  $('.close').on('click', function() {
    $('#loginModal').fadeOut(200);
  });

  // Also close if user clicks outside modal-content
  $(window).on('click', function(e) {
    if ($(e.target).is('#loginModal')) {
      $('#loginModal').fadeOut(200);
    }
  });

  // Handle login form submission
  $('#loginForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
      url: 'login.php',
      type: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function(resp) {
        if (resp.success) {
          location.reload();
        } else {
          $('#loginError').text(resp.message).show();
        }
      },
      error: function() {
        $('#loginError').text('Server error, please try again').show();
      }
    });
  });
});
</script>
