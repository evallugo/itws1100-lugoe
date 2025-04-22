<?php
session_start();
require_once 'includes/conn.php';

//verify admin access
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

//fetch lab details by id
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    $query = "SELECT * FROM myLabs WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($lab = $result->fetch_assoc()) {
        echo json_encode($lab);
    } else {
        echo json_encode(['success' => false, 'message' => 'Lab not found']);
    }
    
    $stmt->close();
}
?>