<?php
session_start();
require_once 'includes/conn.php';

//verify admin access
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //sanitize input data
    $id = (int)$_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $path = mysqli_real_escape_string($conn, $_POST['path']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);
    
    //update lab details
    $query = "UPDATE myLabs SET name = ?, description = ?, path = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $name, $description, $path, $image, $id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating lab']);
    }
    
    $stmt->close();
}
?>