<!-- LOGIN MODAL -->
<div id="loginModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close" title="Close">&times;</span>
    <h3>Login</h3>
    <div id="loginError" style="color:red; display:none;"></div>
    <form
      id="loginForm"
      action="/iit/Quiz3/login.php"
      method="post"
      autocomplete="off"
    >
      <div class="form-group">
        <label for="login-username">Username</label>
        <input
          type="text"
          id="login-username"
          name="username"
          required
          autocomplete="username"
        >
      </div>
      <div class="form-group">
        <label for="login-password">Password</label>
        <input
          type="password"
          id="login-password"
          name="password"
          required
          autocomplete="current-password"
        >
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</div>

<script>
$(document).ready(function() {
  // 1) Open the modal
  $('#loginBtn').on('click', function(e) {
    e.preventDefault();
    $('#loginModal').fadeIn(200);
  });

  // 2) Close on × click
  $('.close').on('click', function() {
    $('#loginModal').fadeOut(200);
  });

  // 3) Close if clicking outside modal-content
  $(window).on('click', function(e) {
    if ($(e.target).is('#loginModal')) {
      $('#loginModal').fadeOut(200);
    }
  });

  // 4) AJAX login
  $('#loginForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
      url: $(this).attr('action'),      // "/iit/Quiz3/login.php"
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
        $('#loginError')
          .text('Server error, please try again.')
          .show();
      }
    });
  });
});
</script>
