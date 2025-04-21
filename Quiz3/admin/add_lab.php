<?php
$pageTitle = "Add Lab";
$bodyClass = "admin";
require_once '../includes/conn.php';
include '../includes/header.php';

// Check admin access
if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO myLabs (name, description, path, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $_POST['name'], $_POST['description'], $_POST['path'], $_POST['image']);
    
    if ($stmt->execute()) {
        header('Location: manage_labs.php');
        exit;
    } else {
        $error = "Error adding lab: " . $conn->error;
    }
}
?>

<div class="content-wrapper">
    <h1>Add New Lab</h1>
    
    <?php if (isset($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <form method="POST" class="admin-form">
        <div class="form-group">
            <label for="name">Lab Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="path">Path:</label>
            <input type="text" id="path" name="path" required>
        </div>
        
        <div class="form-group">
            <label for="image">Icon Class:</label>
            <input type="text" id="image" name="image" value="fas fa-flask">
        </div>
        
        <button type="submit" class="button">Add Lab</button>
        <a href="manage_labs.php" class="button secondary">Cancel</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?> 