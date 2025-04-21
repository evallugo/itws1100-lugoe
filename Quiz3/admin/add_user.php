<?php
$pageTitle = "Add User";
$bodyClass = "admin";
require_once '../includes/conn.php';
include '../includes/header.php';

// Check admin access
if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO mySiteUsers (username, password, name, user_type) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", 
        $_POST['username'], 
        $_POST['password'], // In production, use password_hash()
        $_POST['name'],
        $_POST['user_type']
    );
    
    if ($stmt->execute()) {
        header('Location: manage_users.php');
        exit;
    } else {
        $error = "Error adding user: " . $conn->error;
    }
}
?>

<div class="content-wrapper">
    <h1>Add New User</h1>
    
    <?php if (isset($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <form method="POST" class="admin-form">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="user_type">User Type:</label>
            <select id="user_type" name="user_type" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        
        <button type="submit" class="button">Add User</button>
        <a href="manage_users.php" class="button secondary">Cancel</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?> 