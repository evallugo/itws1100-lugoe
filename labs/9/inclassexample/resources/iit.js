function validate(formObj) {
  // For actors form
  if (formObj.firstNames && formObj.lastName && formObj.dob) {
    if (formObj.firstNames.value == "") {
      alert("Please enter a first name");
      formObj.firstNames.focus();
      return false;
    }
    
    if (formObj.lastName.value == "") {
      alert("Please enter a last name");
      formObj.lastName.focus();
      return false;
    }
    
    if (formObj.dob.value == "") {
      alert("Please enter a date of birth");
      formObj.dob.focus();
      return false;
    }
  }
  
  // For movies form
  if (formObj.title && formObj.year) {
    if (formObj.title.value == "") {
      alert("Please enter a movie title");
      formObj.title.focus();
      return false;
    }
    
    if (formObj.year.value == "") {
      alert("Please enter a year");
      formObj.year.focus();
      return false;
    }
    
    // Check if year is a valid 4-digit number
    var yearPattern = /^\d{4}$/;
    if (!yearPattern.test(formObj.year.value)) {
      alert("Please enter a valid 4-digit year");
      formObj.year.focus();
      return false;
    }
  }
  
  // For movie-actor relationship form
  if (formObj.movieid && formObj.actorid) {
    if (formObj.movieid.value == "") {
      alert("Please select a movie");
      formObj.movieid.focus();
      return false;
    }
    
    if (formObj.actorid.value == "") {
      alert("Please select an actor");
      formObj.actorid.focus();
      return false;
    }
  }
    
  return true;
}


$(document).ready(function() {
  
  // focus the name field on first load of the page
  $("#firstNames").focus();
     
  $(".deleteActor").click(function() {
    if(confirm("Remove actor? (This action cannot be undone.)")) {
      
      // get the id of the clicked element's row
      var curId = $(this).closest("tr").attr("id");
      // Extract the db id of the actor from the dom id of the clicked element
      var actorId = curId.substr(curId.indexOf("-")+1);
      // Build the data to send. 
      var postData = "id=" + actorId;
      
      $.ajax({
        type: "post",
        url: "actor-delete.php",
        dataType: "json",
        data: postData,
        success: function(responseData, status){
          if (responseData.errors) {
            alert(responseData.errno + " " + responseData.error);
          } else {
            // remove the table row in which the image was clicked
            $("#" + curId).closest("tr").remove();
            
            // if a php generated message box is up, hide it:
            $(".messages").hide();
            
            // populate the js message box and show it:
            $("#jsMessages").html("<h4>Actor deleted</h4>").show();
            
            // re-zebra the table
            $("#actorTable tr").each(function(i){
              if (i % 2 == 0) {
                // we must compensate for the header row...
                $(this).addClass("odd"); 
              } else {
                $(this).removeClass("odd");
              }
            });
          }
        },
        error: function(msg) {
          // there was a problem
          alert(msg.status + " " + msg.statusText);
        }
      });
    }
  });

  // Handle movie deletion
  $(".deletemovie").click(function() {
    if(confirm("Remove movie? (This action cannot be undone.)")) {
      // get the id of the clicked element's row
      var curId = $(this).closest("tr").attr("id");
      // Extract the db id of the movie from the dom id of the clicked element
      var movieId = curId.substr(curId.indexOf("-")+1);
      // Build the data to send
      var postData = "id=" + movieId;
      
      $.ajax({
        type: "post",
        url: "movie-delete.php",
        dataType: "json",
        data: postData,
        success: function(responseData, status){
          if (responseData.errors) {
            alert(responseData.errno + " " + responseData.error);
          } else {
            // remove the table row in which the image was clicked
            $("#" + curId).closest("tr").remove();
            
            // if a php generated message box is up, hide it:
            $(".messages").hide();
            
            // populate the js message box and show it:
            $("#jsMessages").html("<h4>Movie deleted</h4>").show();
            
            // re-zebra the table
            $("#movieTable tr").each(function(i){
              if (i % 2 == 0) {
                $(this).addClass("odd"); 
              } else {
                $(this).removeClass("odd");
              }
            });
          }
        },
        error: function(msg) {
          alert(msg.status + " " + msg.statusText);
        }
      });
    }
  });

  // Handle movie-actor relationship deletion
  $(".deletemovieactor").click(function() {
    if(confirm("Remove this movie-actor relationship? (This action cannot be undone.)")) {
      var movieId = $(this).data("movieid");
      var actorId = $(this).data("actorid");
      var $row = $(this).closest("tr");
      
      $.ajax({
        type: "post",
        url: "relationship-delete.php",
        dataType: "json",
        data: {
          movieid: movieId,
          actorid: actorId
        },
        success: function(responseData, status){
          if (responseData.error) {
            alert(responseData.error);
          } else {
            // remove the table row
            $row.remove();
            
            // if a php generated message box is up, hide it:
            $(".messages").hide();
            
            // populate the js message box and show it:
            $("#jsMessages").html("<h4>Movie-Actor relationship deleted</h4>").show();
            
            // re-zebra the table
            $("#movieActorTable tr").each(function(i){
              if (i % 2 == 0) {
                $(this).removeClass("odd");
              } else {
                $(this).addClass("odd");
              }
            });
          }
        },
        error: function(msg) {
          alert(msg.status + " " + msg.statusText);
        }
      });
    }
  });
});
