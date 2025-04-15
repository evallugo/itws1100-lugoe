<?php 
  include('includes/init.inc.php'); // include the DOCTYPE and opening tags
  include('includes/functions.inc.php'); // functions
?>
<title>PHP &amp; MySQL - ITWS</title>   

<?php include('includes/head.inc.php'); ?>

<h1>PHP &amp; MySQL</h1>
      
<?php include('includes/menubody.inc.php'); ?>

<?php
// We'll need a database connection both for retrieving records and for
// inserting them.  Let's get it up front and use it for both processes
// to avoid opening the connection twice.  If we make a good connection,
// we'll change the $dbOk flag.
$dbOk = false;

/* Create a new database connection object, passing in the host, username,
   password, and database to use. The "@" suppresses errors. */
@$db = new mysqli('localhost', 'root', 'PRLugo22!', 'iit');

if ($db->connect_error) {
   echo '<div class="messages">Could not connect to the database. Error: ' . $db->connect_errno . ' - ' . $db->connect_error . '</div>';
} else {
   $dbOk = true;
}

// Initialize variables
$title = '';
$year = '';
$errors = [];
$havePost = false;

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
   $havePost = true;
   $title = trim($_POST['title']);
   $year = trim($_POST['year']);
   
   // Validate input
   if (empty($title)) {
      $errors[] = 'Title is required';
   }
   
   if (empty($year)) {
      $errors[] = 'Year is required';
   } elseif (!preg_match('/^\d{4}$/', $year)) {
      $errors[] = 'Year must be a 4-digit number';
   }
   
   // If no errors, insert the movie
   if (empty($errors) && $dbOk) {
      $insertQuery = "INSERT INTO movies (title, year) VALUES (?, ?)";
      $statement = $db->prepare($insertQuery);
      $statement->bind_param("ss", $title, $year);
      
      if ($statement->execute()) {
         echo '<div class="messages">Movie added successfully!</div>';
         // Clear the form
         $title = '';
         $year = '';
         $havePost = false;
      } else {
         echo '<div class="messages">Error adding movie: ' . $db->error . '</div>';
      }
      
      $statement->close();
   } else {
      echo '<div class="messages">';
      foreach ($errors as $error) {
         echo '<div class="error">' . $error . '</div>';
      }
      echo '</div>';
   }
}
?>

<h3>Add Movie</h3>
<form id="addMovieForm" name="addMovieForm" action="movies.php" method="post">
   <fieldset>
      <div class="formData">

         <label class="field" for="title">Title:</label>
         <div class="value"><input type="text" size="60" value="<?php echo htmlspecialchars($title); ?>" name="title" id="title" /></div>

         <label class="field" for="year">Year:</label>
         <div class="value"><input type="text" size="4" maxlength="4" value="<?php echo htmlspecialchars($year); ?>" name="year" id="year" /></div>

         <input type="submit" value="save" id="save" name="save" />
      </div>
   </fieldset>
</form>

<h3>Movies</h3>
<table id="movieTable">
   <?php
   if ($dbOk) {

      $query = 'select * from movies order by title';
      $result = $db->query($query);
      $numRecords = $result->num_rows;

      echo '<tr><th>Title:</th><th>Year:</th><th></th></tr>';
      for ($i = 0; $i < $numRecords; $i++) {
         $record = $result->fetch_assoc();
         if ($i % 2 == 0) {
            echo "\n" . '<tr id="movie-' . $record['movieid'] . '"><td>';
         } else {
            echo "\n" . '<tr class="odd" id="movie-' . $record['movieid'] . '"><td>';
         }
         echo htmlspecialchars($record['title']);
         echo '</td><td>';
         echo htmlspecialchars($record['year']);
         echo '</td><td>';
         echo '<img src="resources/delete.png" class="deleteMovie" data-id="' . $record['movieid'] . '" width="16" height="16" alt="delete movie"/>';
         echo '</td></tr>';
      }

      $result->free();

      // Finally, let's close the database
      $db->close();
   }

   ?>
</table>

<script>
document.addEventListener('DOMContentLoaded', function() {
   // Add event listeners to all delete buttons
   const deleteButtons = document.querySelectorAll('.deleteMovie');
   
   deleteButtons.forEach(button => {
      button.addEventListener('click', function() {
         if (confirm('Are you sure you want to delete this movie?')) {
            const movieId = this.getAttribute('data-id');
            
            // Create form data
            const formData = new FormData();
            formData.append('movieid', movieId);
            
            // Send delete request
            fetch('movie-delete.php', {
               method: 'POST',
               body: formData
            })
            .then(response => response.json())
            .then(data => {
               if (data.success) {
                  // Remove the row from the table
                  this.closest('tr').remove();
                  alert('Movie deleted successfully');
               } else {
                  alert('Error: ' + data.message);
               }
            })
            .catch(error => {
               console.error('Error:', error);
               alert('An error occurred while deleting the movie');
            });
         }
      });
   });
});
</script>

<?php include('includes/foot.inc.php'); 
  // footer info and closing tags
?>
