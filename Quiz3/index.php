<?php
if (!defined('INCLUDED')) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $pageTitle = "Home";
    $bodyClass = "home";
    require_once __DIR__ . '/includes/conn.php';
    include __DIR__ . '/includes/header.php';
}

//check admin access
if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

//get counts
$labCount = $conn->query("SELECT COUNT(*) as count FROM myLabs")->fetch_assoc()['count'];
$projectCount = $conn->query("SELECT COUNT(*) as count FROM myProjects")->fetch_assoc()['count'];
$userCount = $conn->query("SELECT COUNT(*) as count FROM mySiteUsers")->fetch_assoc()['count'];

// Get projects from database
$sql = "SELECT * FROM myProjects ORDER BY id";
$result = $conn->query($sql);
$projects = [];
while ($row = $result->fetch_assoc()) {
    $projects[] = $row;
}
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

<?php 
if (!defined('INCLUDED')) {
    include __DIR__ . '/includes/footer.php';
} 
?>