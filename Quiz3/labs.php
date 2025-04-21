<?php
$pageTitle = "Labs";
$bodyClass = "labs";
require_once 'conn.php';
include 'includes/header.php';

//get labs from database
$sql = "SELECT * FROM myLabs ORDER BY id";
$result = $conn->query($sql);
$labs = [];
while ($row = $result->fetch_assoc()) {
    $labs[] = $row;
}
?>

<div class="center">
    <div class="center-content">
        <h1>Labs</h1>
        <div class="buttons">
            <?php foreach ($labs as $lab): ?>
                <a href="<?php echo htmlspecialchars($lab['path']); ?>" class="button">
                    <?php echo htmlspecialchars($lab['name']); ?> 
                    <i class="<?php echo htmlspecialchars($lab['image']); ?>"></i>
                </a>
            <?php endforeach; ?>
        </div>
        
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['type'] === 'admin'): ?>
            <div class="admin-controls">
                <h2>Manage Labs</h2>
                <a href="admin/add_lab.php" class="button admin">Add New Lab</a>
                <a href="admin/manage_labs.php" class="button admin">Manage Labs</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>