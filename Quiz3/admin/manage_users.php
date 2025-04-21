<?php
$pageTitle = "Manage Users";
$bodyClass = "admin";
require_once '../includes/conn.php';
include '../includes/header.php';

// Check admin access
if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = (int)$_POST['delete'];
    $stmt = $conn->prepare("DELETE FROM mySiteUsers WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Get all users
$result = $conn->query("SELECT id, username, name, user_type FROM mySiteUsers ORDER BY id");
?>

<div class="content-wrapper">
    <h1>Manage Users</h1>
    
    <a href="add_user.php" class="button">Add New User</a>
    
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Name</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['user_type']); ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $user['id']; ?>" 
                           class="button small">Edit</a>
                        <?php if ($user['id'] !== $_SESSION['user']['id']): ?>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="delete" value="<?php echo $user['id']; ?>">
                                <button type="submit" class="button small danger" 
                                        onclick="return confirm('Are you sure you want to delete this user?')">
                                    Delete
                                </button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?> 