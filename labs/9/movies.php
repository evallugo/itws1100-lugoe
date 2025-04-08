<?php
// movies.php

// --- Database Connection Code (Using the example provided) ---
$dbOk = false;

// Create a new database connection object, passing in the host, username, password, and database name.
// The "@" symbol suppresses errors.
@ $db = new mysqli('localhost', 'root', 'root', 'iit');

if ($db->connect_error) {
    echo '<div class="messages">Could not connect to the database. Error: ';
    echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
} else {
    $dbOk = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Movies List</title>
  <style>
    /* Basic styling for the movies table */
    table {
      border-collapse: collapse;
      width: 80%;
      margin: 20px auto;
    }
    th, td {
      border: 1px solid #333;
      padding: 8px 12px;
      text-align: left;
    }
    th {
      background-color: #f4f4f4;
    }
    h1 {
      text-align: center;
      font-family: Arial, Helvetica, sans-serif;
    }
    .messages {
      color: red;
      text-align: center;
      font-family: Arial, Helvetica, sans-serif;
    }
  </style>
</head>
<body>
  <h1>Movies List</h1>
  <?php
  // Only proceed if the database connection was established successfully.
  if ($dbOk) {
      // --- Query the movies table ---
      $sql = "SELECT movie_id, title, release_year FROM movies";
      $result = $db->query($sql);

      // Check for query errors.
      if (!$result) {
          die("<div class='messages'>Query Error: " . $db->error . "</div>");
      }
      ?>

      <table>
        <thead>
          <tr>
            <th>Movie ID</th>
            <th>Title</th>
            <th>Release Year</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Loop through each movie record and display it.
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($row['movie_id']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['release_year']) . "</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='3'>No movies found.</td></tr>";
          }
          ?>
        </tbody>
      </table>
      <?php
      // --- End of movies table display ---
  } else {
      // If the database connection failed.
      echo '<p class="messages">Database connection failed. Please check your connection details.</p>';
  }
  ?>
</body>
</html>
