<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user_type'] === 'admin') {
    require_once 'includes/conn.php';

    // get form data with null coalescing
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $path = $_POST['path'] ?? '';
    $image = 'fas fa-flask'; 

    //validate required fields and insert
    if ($name && $path) {
        $stmt = $conn->prepare("INSERT INTO myLabs (name, description, path, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $description, $path, $image);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Insert failed.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Name and path are required.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Unauthorized request.']);
}
?>
