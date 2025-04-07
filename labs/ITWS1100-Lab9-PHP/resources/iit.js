$(document).ready(function() {
  // Delete actor
  $('.deleteActor').click(function() {
    var actorId = $(this).parent().parent().attr('id').split('-')[1];
    if (confirm('Are you sure you want to delete this actor?')) {
      $.ajax({
        url: 'actor-delete.php',
        type: 'POST',
        data: { id: actorId },
        dataType: 'json',
        success: function(response) {
          if (response.errors) {
            $('#jsMessages').html('<div class="error">Error: ' + response.error + '</div>');
          } else {
            $('#actor-' + actorId).fadeOut('slow');
            $('#jsMessages').html('<div class="success">' + response.message + '</div>');
          }
        },
        error: function() {
          $('#jsMessages').html('<div class="error">Error: Could not connect to the server.</div>');
        }
      });
    }
  });

  // Delete movie
  $('.deleteMovie').click(function() {
    var movieId = $(this).parent().parent().attr('id').split('-')[1];
    if (confirm('Are you sure you want to delete this movie?')) {
      $.ajax({
        url: 'movie-delete.php',
        type: 'POST',
        data: { id: movieId },
        dataType: 'json',
        success: function(response) {
          if (response.errors) {
            $('#jsMessages').html('<div class="error">Error: ' + response.error + '</div>');
          } else {
            $('#movie-' + movieId).fadeOut('slow');
            $('#jsMessages').html('<div class="success">' + response.message + '</div>');
          }
        },
        error: function() {
          $('#jsMessages').html('<div class="error">Error: Could not connect to the server.</div>');
        }
      });
    }
  });
});

// Form validation
function validate(form) {
  var isValid = true;
  var focusId = '';

  // Check each input field
  $(form).find('input[type="text"]').each(function() {
    if ($(this).val() == '') {
      isValid = false;
      if (focusId == '') {
        focusId = '#' + $(this).attr('id');
      }
      $(this).addClass('error');
    } else {
      $(this).removeClass('error');
    }
  });

  // Check each select field
  $(form).find('select').each(function() {
    if ($(this).val() == '') {
      isValid = false;
      if (focusId == '') {
        focusId = '#' + $(this).attr('id');
      }
      $(this).addClass('error');
    } else {
      $(this).removeClass('error');
    }
  });

  // If not valid, focus on the first error field
  if (!isValid && focusId != '') {
    $(focusId).focus();
  }

  return isValid;
} 