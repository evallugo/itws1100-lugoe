<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Check if we have an ID
if (!isset($_POST['id'])) {
    echo json_encode(array('errors' => true, 'error' => 'No ID provided'));
    exit;
}

// Get the ID and make sure it's numeric
$id = trim($_POST['id']);
if (!is_numeric($id)) {
    echo json_encode(array('errors' => true, 'error' => 'Invalid ID'));
    exit;
}

// Connect to the database
@$db = new mysqli('localhost', 'phpmyadmin', 'phpmyadmin', 'iit');
if ($db->connect_error) {
    echo json_encode(array('errors' => true, 'error' => 'Could not connect to database'));
    exit;
}

// Delete the movie
$query = 'DELETE FROM movies WHERE movieid = ?';
$statement = $db->prepare($query);
$statement->bind_param('i', $id);
$statement->execute();

if ($statement->affected_rows > 0) {
    echo json_encode(array('errors' => false, 'message' => 'Movie deleted successfully'));
} else {
    echo json_encode(array('errors' => true, 'error' => 'Could not delete movie'));
}

// Close the database connection
$statement->close();
$db->close();
?> 