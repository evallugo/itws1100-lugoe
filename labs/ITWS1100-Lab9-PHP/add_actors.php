<?php
// Create a new database connection object
@$db = new mysqli('localhost', 'phpmyadmin', 'phpmyadmin', 'iit');

if ($db->connect_error) {
   die('Could not connect to the database. Error: ' . $db->connect_errno . ' - ' . $db->connect_error);
}

// Sample actors data
$actors = array(
   array('first_names' => 'Tom', 'last_name' => 'Hanks', 'dob' => '1956-07-09'),
   array('first_names' => 'Meryl', 'last_name' => 'Streep', 'dob' => '1949-06-22'),
   array('first_names' => 'Leonardo', 'last_name' => 'DiCaprio', 'dob' => '1974-11-11'),
   array('first_names' => 'Scarlett', 'last_name' => 'Johansson', 'dob' => '1984-11-22'),
   array('first_names' => 'Morgan', 'last_name' => 'Freeman', 'dob' => '1937-06-01'),
   array('first_names' => 'Emma', 'last_name' => 'Watson', 'dob' => '1990-04-15'),
   array('first_names' => 'Brad', 'last_name' => 'Pitt', 'dob' => '1963-12-18')
);

// Insert actors into the database
$successCount = 0;
foreach ($actors as $actor) {
   $query = "INSERT INTO actors (first_names, last_name, dob) VALUES (?, ?, ?)";
   $stmt = $db->prepare($query);
   $stmt->bind_param("sss", $actor['first_names'], $actor['last_name'], $actor['dob']);
   
   if ($stmt->execute()) {
      $successCount++;
   }
   
   $stmt->close();
}

echo "Successfully added $successCount actors to the database.";

// Close the database connection
$db->close();
?> 