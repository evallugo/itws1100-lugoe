<?php
$pageTitle = "Manage Labs";
$bodyClass = "admin";
require_once '../conn.php';
include '../includes/header.php';

//check if user is admin
if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

//handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = (int)$_POST['delete'];
    $stmt = $conn->prepare("DELETE FROM myLabs WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

//get all labs
$result = $conn->query("SELECT * FROM myLabs ORDER BY id");
?>

<div class="content-wrapper">
    <h1>Manage Labs</h1>
    
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Path</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($lab = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($lab['id']); ?></td>
                    <td><?php echo htmlspecialchars($lab['name']); ?></td>
                    <td><?php echo htmlspecialchars($lab['description']); ?></td>
                    <td><?php echo htmlspecialchars($lab['path']); ?></td>
                    <td>
                        <a href="edit_lab.php?id=<?php echo $lab['id']; ?>" class="button small">Edit</a>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="delete" value="<?php echo $lab['id']; ?>">
                            <button type="submit" class="button small danger" 
                                    onclick="return confirm('Are you sure you want to delete this lab?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>