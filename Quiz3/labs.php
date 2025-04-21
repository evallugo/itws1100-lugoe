<?php
$page_title = "Labs - Eva Lugo";
$page_class = "labs";
define('INCLUDED', true);

require_once __DIR__ . '/includes/init.inc.php';
require_once __DIR__ . '/includes/head.inc.php';
require_once __DIR__ . '/includes/nav.inc.php';
require_once __DIR__ . '/includes/conn.php';
?>
<link rel="stylesheet" href="styles.css">

<div class="center">
    <div class="center-content">
        <h1>Labs</h1>

        <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
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
                    echo '<a href="/iit/' . htmlspecialchars($lab['path']) . '" class="button">';
                    echo htmlspecialchars($lab['name']) . ' <i class="' . htmlspecialchars($lab['image']) . '"></i>';
                    echo '</a>';

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

<?php require_once __DIR__ . '/includes/loginmodal.inc.php'; ?>

<?php require_once __DIR__ . '/includes/footer.inc.php'; ?>
