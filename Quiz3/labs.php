<?php
$page_title = "Labs - Eva Lugo";
$page_class = "labs";
define('INCLUDED', true);

require_once __DIR__ . '/includes/init.inc.php';
require_once __DIR__ . '/includes/head.inc.php';
require_once __DIR__ . '/includes/nav.inc.php';
require_once __DIR__ . '/includes/conn.php';
?>

<div class="center">
    <div class="center-content">
        <h1>Labs</h1>
        
        <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
        <!-- Admin Controls -->
        <div class="admin-controls">
            <button id="addLabBtn" class="admin-btn">
                <i class="fas fa-plus"></i> Add New Lab
            </button>
        </div>
        <?php endif; ?>

        <div class="buttons">
            <?php
            $query = "SELECT * FROM myLabs ORDER BY name";
            $result = mysqli_query($conn, $query);

            if ($result) {
                while ($lab = mysqli_fetch_assoc($result)) {
                    echo '<div class="lab-item">';
                    echo '<a href="' . htmlspecialchars($lab['path']) . '" class="button">';
                    echo htmlspecialchars($lab['name']) . ' <i class="' . htmlspecialchars($lab['image']) . '"></i>';
                    echo '</a>';
                    
                    // Show delete button for admin
                    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
                        echo '<button class="delete-lab" data-id="' . $lab['id'] . '">';
                        echo '<i class="fas fa-trash"></i>';
                        echo '</button>';
                    }
                    echo '</div>';
                }
                mysqli_free_result($result);
            }
            ?>
        </div>
    </div>
</div>

<!-- Add Lab Modal (only visible to admin) -->
<?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
<div id="addLabModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Add New Lab</h2>
        <form id="addLabForm">
            <div class="form-group">
                <label for="labName">Lab Name:</label>
                <input type="text" id="labName" name="name" required>
            </div>
            <div class="form-group">
                <label for="labDescription">Description:</label>
                <textarea id="labDescription" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="labPath">Path:</label>
                <input type="text" id="labPath" name="path" required>
            </div>
            <button type="submit">Add Lab</button>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    // Show Add Lab Modal
    $("#addLabBtn").click(function() {
        $("#addLabModal").show();
    });

    // Close Modal
    $(".close").click(function() {
        $("#addLabModal").hide();
    });

    // Add Lab Form Submission
    $("#addLabForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "add_lab.php",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if(response.success) {
                    location.reload();
                } else {
                    alert(response.message);
                }
            }
        });
    });

    // Delete Lab
    $(".delete-lab").click(function() {
        if(confirm("Are you sure you want to delete this lab?")) {
            var labId = $(this).data("id");
            $.ajax({
                type: "POST",
                url: "delete_lab.php",
                data: { id: labId },
                dataType: "json",
                success: function(response) {
                    if(response.success) {
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                }
            });
        }
    });
});
</script>

<style>
.admin-controls {
    margin-bottom: 20px;
}

.admin-btn {
    background-color: hotpink;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.lab-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.delete-lab {
    background-color: #ff4444;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    margin-left: 10px;
    cursor: pointer;
}

.delete-lab:hover {
    background-color: #cc0000;
}
</style>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.inc.php'; ?>