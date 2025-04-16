<?php
// Actor deletion handler

// Create database connection
// The "@" suppresses connection errors - they are handled below
@ $db = new mysqli('localhost', 'root', 'PRLugo22!', 'iit');

if ($db->connect_error) {
    // Handle connection errors
    $connectErrors = array(
        'errors' => true,
        'errno' => mysqli_connect_errno(),
        'error' => mysqli_connect_error()
    );
    echo json_encode($connectErrors);
} else {
    if (isset($_POST["id"])) {
        // Cast actor ID to integer for security
        $actorId = (int) $_POST["id"];
        
        // Prepare and execute deletion query
        $query = "delete from actors where actorid = ?";
        $statement = $db->prepare($query);
        $statement->bind_param("i",$actorId);
        $statement->execute();
        
        // Return success response
        $success = array('errors'=>false,'message'=>'Delete successful');
        echo json_encode($success);
        
        // Clean up resources
        $statement->close();
        $db->close();
    }
}
?>