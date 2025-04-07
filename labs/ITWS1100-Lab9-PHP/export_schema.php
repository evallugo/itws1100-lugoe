<?php
// This script will generate a SQL file with the schema for the iit database
// You can run this script and then use the generated SQL file for your submission

// Database connection details
$host = 'localhost';
$username = 'phpmyadmin';
$password = 'phpmyadmin';
$database = 'iit';

// Connect to the database
@$db = new mysqli($host, $username, $password, $database);

if ($db->connect_error) {
   die('Could not connect to the database. Error: ' . $db->connect_errno . ' - ' . $db->connect_error);
}

// Set the output file
$outputFile = 'iit.sql';
$output = fopen($outputFile, 'w');

// Write the header
fwrite($output, "-- iit database schema\n");
fwrite($output, "-- Generated on " . date('Y-m-d H:i:s') . "\n\n");

// Get all tables
$query = "SHOW TABLES";
$result = $db->query($query);

while ($row = $result->fetch_row()) {
   $tableName = $row[0];
   
   // Get the create table statement
   $query = "SHOW CREATE TABLE `$tableName`";
   $result2 = $db->query($query);
   $row2 = $result2->fetch_row();
   $createTable = $row2[1];
   
   // Write the create table statement
   fwrite($output, $createTable . ";\n\n");
   
   // Get the data
   $query = "SELECT * FROM `$tableName`";
   $result3 = $db->query($query);
   
   while ($row3 = $result3->fetch_assoc()) {
      $columns = array_keys($row3);
      $values = array_values($row3);
      
      // Format the values
      $formattedValues = array();
      foreach ($values as $value) {
         if ($value === null) {
            $formattedValues[] = 'NULL';
         } else {
            $formattedValues[] = "'" . $db->real_escape_string($value) . "'";
         }
      }
      
      // Write the insert statement
      fwrite($output, "INSERT INTO `$tableName` (`" . implode('`, `', $columns) . "`) VALUES (" . implode(', ', $formattedValues) . ");\n");
   }
   
   fwrite($output, "\n");
}

// Close the file
fclose($output);

echo "Database schema exported to $outputFile successfully.";

// Close the database connection
$db->close();
?> 