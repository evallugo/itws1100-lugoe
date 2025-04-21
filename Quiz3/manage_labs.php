<?php
$page_title = "Manage Labs - Eva Lugo";
$page_class = "manage-labs";
define('INCLUDED', true);

require_once __DIR__ . '/includes/init.inc.php';
require_once __DIR__ . '/includes/head.inc.php';
require_once __DIR__ . '/includes/nav.inc.php';
require_once __DIR__ . '/includes/conn.php';

// Check if user is admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: index.php');
    exit;
}
?>

<div class="manage-labs-container">
    <h1>Manage Labs</h1>
    
    <!-- Add Lab Form -->
    <div class="form-section">
        <h2>Add New Lab</h2>
        <form id="addLabForm" method="POST">
            <div class="form-group">
                <label for="name">Lab Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="3"></textarea>
            </div>
            
            <div class="form-group">
                <label for="path">Path:</label>
                <input type="text" id="path" name="path" required>
            </div>
            
            <div class="form-group">
                <label for="image">Icon Class:</label>
                <input type="text" id="image" name="image" value="fas fa-flask">
            </div>
            
            <button type="submit" class="submit-btn">Add Lab</button>
        </form>
    </div>

    <!-- Labs List -->
    <div class="list-section">
        <h2>Existing Labs</h2>
        <table id="labsTable">
            <thead>
                <tr>
                    <th>Lab Name</th>
                    <th>Description</th>
                    <th>Path</th>
                    <th>Icon</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM myLabs ORDER BY name";
                $result = mysqli_query($conn, $query);

                while ($lab = mysqli_fetch_assoc($result)) {
                    echo "<tr data-id='" . $lab['id'] . "'>";
                    echo "<td>" . htmlspecialchars($lab['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($lab['description']) . "</td>";
                    echo "<td>" . htmlspecialchars($lab['path']) . "</td>";
                    echo "<td><i class='" . htmlspecialchars($lab['image']) . "'></i></td>";
                    echo "<td>";
                    echo "<button class='edit-btn' onclick='editLab(" . $lab['id'] . ")'><i class='fas fa-edit'></i></button>";
                    echo "<button class='delete-btn' onclick='deleteLab(" . $lab['id'] . ")'><i class='fas fa-trash'></i></button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Lab</h2>
        <form id="editLabForm">
            <input type="hidden" id="editId" name="id">
            <div class="form-group">
                <label for="editName">Lab Name:</label>
                <input type="text" id="editName" name="name" required>
            </div>
            <div class="form-group">
                <label for="editDescription">Description:</label>
                <textarea id="editDescription" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="editPath">Path:</label>
                <input type="text" id="editPath" name="path" required>
            </div>
            <div class="form-group">
                <label for="editImage">Icon Class:</label>
                <input type="text" id="editImage" name="image">
            </div>
            <button type="submit">Save Changes</button>
        </form>
    </div>
</div>

<style>
.manage-labs-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.form-section, .list-section {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

.form-group input, .form-group textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.submit-btn {
    background-color: hotpink;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

#labsTable {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

#labsTable th, #labsTable td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

#labsTable th {
    background-color: #f5f5f5;
}

.edit-btn, .delete-btn {
    padding: 5px 10px;
    margin: 0 5px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.edit-btn {
    background-color: #4CAF50;
    color: white;
}

.delete-btn {
    background-color: #f44336;
    color: white;
}

/* Modal styles already included in nav.inc.php */
</style>

<script>
$(document).ready(function() {
    // Add Lab Form Submission
    $('#addLabForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'add_lab.php',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    location.reload();
                } else {
                    alert(response.message);
                }
            }
        });
    });

    // Edit Lab Form Submission
    $('#editLabForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'edit_lab.php',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    location.reload();
                } else {
                    alert(response.message);
                }
            }
        });
    });
});

function editLab(id) {
    $.ajax({
        type: 'GET',
        url: 'get_lab.php',
        data: { id: id },
        dataType: 'json',
        success: function(lab) {
            $('#editId').val(lab.id);
            $('#editName').val(lab.name);
            $('#editDescription').val(lab.description);
            $('#editPath').val(lab.path);
            $('#editImage').val(lab.image);
            $('#editModal').show();
        }
    });
}

function deleteLab(id) {
    if(confirm('Are you sure you want to delete this lab?')) {
        $.ajax({
            type: 'POST',
            url: 'delete_lab.php',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    location.reload();
                } else {
                    alert(response.message);
                }
            }
        });
    }
}

// Close modal when clicking the X or outside
$('.close').click(function() {
    $('#editModal').hide();
});

$(window).click(function(e) {
    if($(e.target).hasClass('modal')) {
        $('#editModal').hide();
    }
});
</script>

<?php require_once __DIR__ . '/includes/footer.inc.php'; ?>