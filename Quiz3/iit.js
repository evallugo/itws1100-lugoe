$(document).ready(function() {
  $(".deleteLab").click(function() {
    if (confirm("Are you sure you want to delete this lab?")) {
      var curId = $(this).closest("tr").attr("id");
      var labId = curId.split("-")[1];
      $.ajax({
        type: "POST",
        url: "delete_lab.php",
        dataType: "json",
        data: { id: labId },
        success: function(response) {
          if (response.success) {
            $("#" + curId).remove();
            $("#jsMessages").html("<h4>Lab deleted</h4>").show();
            //re-zebra
            $("#labTable tr").removeClass("odd").each(function(i) {
              if (i % 2 === 1) $(this).addClass("odd");
            });
          } else {
            alert(response.message);
          }
        },
        error: function(msg) {
          alert(msg.status + " " + msg.statusText);
        }
      });
    }
  });
});


