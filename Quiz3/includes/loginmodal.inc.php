<?php //includes/loginmodal.inc.php ?>
<!-- login modal -->
<div id="loginModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Login</h3>
    <div id="loginError" style="color:red; display:none;"></div>
    <form id="loginForm" action="includes/login.php" method="post">
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
  //open modal
  $('#loginBtn').on('click', function(e) {
    e.preventDefault();
    $('#loginModal').fadeIn(200);
  });

  //close on ×
  $('.close').on('click', function() {
    $('#loginModal').fadeOut(200);
  });

  //close if click outside content
  $(window).on('click', function(e) {
    if ($(e.target).is('#loginModal')) {
      $('#loginModal').fadeOut(200);
    }
  });

  //handle form submit
  $('#loginForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
      url: 'includes/login.php',
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
      error: function(xhr, status, err) {
        //no more alert(), just console.error
        console.error('Login AJAX error:', status, err, xhr.responseText);
      }
    });
  });
});
</script>

