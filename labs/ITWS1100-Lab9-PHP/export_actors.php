<?php
// Create a new database connection object, passing in the host, username,
// password, and database to use. The "@" suppresses errors.
@$db = new mysqli('localhost', 'phpmyadmin', 'phpmyadmin', 'iit');

if ($db->connect_error) {
   die('Could not connect to the database. Error: ' . $db->connect_errno . ' - ' . $db->connect_error);
}

// Query for actors born on or after 1960
$query = "SELECT * FROM actors WHERE dob >= '1960-01-01' ORDER BY last_name";
$result = $db->query($query);

if (!$result) {
   die('Query failed: ' . $db->error);
}

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="actors.csv"');

// Create a file pointer connected to PHP output
$output = fopen('php://output', 'w');

// Set column headers
fputcsv($output, array('Last Name', 'First Names', 'Date of Birth'));

// Output each row of the data
while ($row = $result->fetch_assoc()) {
   fputcsv($output, array($row['last_name'], $row['first_names'], $row['dob']));
}

// Close the file pointer
fclose($output);

// Free the result set
$result->free();

// Close the database connection
$db->close();
?> 