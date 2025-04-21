<?php
require_once 'conn.php';
$sql = "SELECT copyright_text, year FROM myFooter LIMIT 1";
$result = $conn->query($sql);
$footer = $result->fetch_assoc();
?>
<div class="footer">
    <?php echo htmlspecialchars($footer['copyright_text'] . ' ' . $footer['year']); ?>
</div>
</body>
</html>