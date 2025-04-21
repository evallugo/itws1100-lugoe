<?php
$pageTitle = "Admin Dashboard";
$bodyClass = "admin";
require_once '../includes/conn.php';
include '../includes/header.php';

// Check admin access
if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// Get counts
$labCount = $conn->query("SELECT COUNT(*) as count FROM myLabs")->fetch_assoc()['count'];
$projectCount = $conn->query("SELECT COUNT(*) as count FROM myProjects")->fetch_assoc()['count'];
$userCount = $conn->query("SELECT COUNT(*) as count FROM mySiteUsers")->fetch_assoc()['count'];
?>

<div class="content-wrapper">
    <h1>Admin Dashboard</h1>
    
    <div class="admin-stats">
        <div class="stat-card">
            <h3>Labs</h3>
            <p class="stat-number"><?php echo $labCount; ?></p>
            <a href="manage_labs.php" class="button">Manage Labs</a>
        </div>
        
        <div class="stat-card">
            <h3>Projects</h3>
            <p class="stat-number"><?php echo $projectCount; ?></p>
            <a href="manage_projects.php" class="button">Manage Projects</a>
        </div>
        
        <div class="stat-card">
            <h3>Users</h3>
            <p class="stat-number"><?php echo $userCount; ?></p>
            <a href="manage_users.php" class="button">Manage Users</a>
        </div>
    </div>
    
    <div class="quick-actions">
        <h2>Quick Actions</h2>
        <a href="add_lab.php" class="button">Add New Lab</a>
        <a href="add_project.php" class="button">Add New Project</a>
        <a href="add_user.php" class="button">Add New User</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>