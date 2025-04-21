<?php
$pageTitle = "Edit Lab";
$bodyClass = "admin";
require_once '../includes/conn.php';
include '../includes/header.php';

// Check admin access
if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("UPDATE myLabs SET name=?, description=?, path=?, image=? WHERE id=?");
    $stmt->bind_param("ssssi", 
        $_POST['name'], 
        $_POST['description'], 
        $_POST['path'],
        $_POST['image'],
        $id
    );
    
    if ($stmt->execute()) {
        header('Location: manage_labs.php');
        exit;
    } else {
        $error = "Error updating lab: " . $conn->error;
    }
}

// Get lab data
$stmt = $conn->prepare("SELECT * FROM myLabs WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$lab = $stmt->get_result()->fetch_assoc();

if (!$lab) {
    header('Location: manage_labs.php');
    exit;
}
?>

<div class="content-wrapper">
    <h1>Edit Lab</h1>
    
    <?php if (isset($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <form method="POST" class="admin-form">
        <div class="form-group">
            <label for="name">Lab Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($lab['name']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($lab['description']); ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="path">Path:</label>
            <input type="text" id="path" name="path" value="<?php echo htmlspecialchars($lab['path']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="image">Icon Class:</label>
            <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($lab['image']); ?>">
        </div>
        
        <button type="submit" class="button">Update Lab</button>
        <a href="manage_labs.php" class="button secondary">Cancel</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?>