<?php
//set page variables
$page_title = "Manage Labs - Eva Lugo";
$page_class = "admin-page";

//nclude necessary files
include('../includes/init.inc.php');
include('../includes/head.inc.php');
include('../includes/menu.inc.php');
include('../includes/login.inc.php');

//include database connection
require_once '../conn.php';

//check if user is logged in and is admin
if (!isLoggedIn() || !isAdmin($db)) {
    echo '<div class="content"><h1>Access Denied</h1><p>You must be logged in as an admin to access this page.</p></div>';
    include('../includes/foot.inc.php');
    exit();
}

//handle form submissions
$message = '';

//add new lab
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_lab'])) {
    $lab_number = $_POST['lab_number'];
    $lab_title = $_POST['lab_title'];
    $lab_description = $_POST['lab_description'];
    $lab_link = $_POST['lab_link'];
    
    $query = "INSERT INTO myLabs (lab_number, lab_title, lab_description, lab_link) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("isss", $lab_number, $lab_title, $lab_description, $lab_link);
    
    if ($stmt->execute()) {
        $message = "Lab added successfully!";
    } else {
        $message = "Error adding lab: " . $db->error;
    }
}

//delete lab
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $lab_id = $_GET['delete'];
    
    $query = "DELETE FROM myLabs WHERE lab_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $lab_id);
    
    if ($stmt->execute()) {
        $message = "Lab deleted successfully!";
    } else {
        $message = "Error deleting lab: " . $db->error;
    }
}
?>

<div class="content">
    <h1>Manage Labs</h1>
    
    <?php if (!empty($message)): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    
    <div class="admin-container">
        <div class="add-lab-form">
            <h2>Add New Lab</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="lab_number">Lab Number:</label>
                    <input type="number" id="lab_number" name="lab_number" required>
                </div>
                
                <div class="form-group">
                    <label for="lab_title">Lab Title:</label>
                    <input type="text" id="lab_title" name="lab_title" required>
                </div>
                
                <div class="form-group">
                    <label for="lab_description">Lab Description:</label>
                    <textarea id="lab_description" name="lab_description" rows="4"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="lab_link">Lab Link:</label>
                    <input type="text" id="lab_link" name="lab_link">
                </div>
                
                <button type="submit" name="add_lab" class="btn">Add Lab</button>
            </form>
        </div>
        
        <div class="labs-list">
            <h2>Current Labs</h2>
            <?php
            //Query to get all labs from the database
            $query = "SELECT * FROM myLabs ORDER BY lab_number";
            $result = $db->query($query);
            
            if ($result && $result->num_rows > 0) {
                echo '<table class="admin-table">';
                echo '<thead><tr><th>ID</th><th>Number</th><th>Title</th><th>Description</th><th>Link</th><th>Actions</th></tr></thead>';
                echo '<tbody>';
                
                while ($lab = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($lab['lab_id']) . '</td>';
                    echo '<td>' . htmlspecialchars($lab['lab_number']) . '</td>';
                    echo '<td>' . htmlspecialchars($lab['lab_title']) . '</td>';
                    echo '<td>' . htmlspecialchars($lab['lab_description']) . '</td>';
                    echo '<td>' . htmlspecialchars($lab['lab_link']) . '</td>';
                    echo '<td><a href="?delete=' . $lab['lab_id'] . '" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this lab?\')">Delete</a></td>';
                    echo '</tr>';
                }
                
                echo '</tbody></table>';
            } else {
                echo '<p>No labs found in the database.</p>';
            }
            ?>
        </div>
    </div>
</div>

<?php
//include footer
include('../includes/foot.inc.php');
?> 