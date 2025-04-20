<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "mySite");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get footer text from database
$sql = "SELECT footerText FROM myFooter WHERE id = 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $footerText = $row['footerText'];
} else {
    $footerText = "© 2024 Eva Lugo. All rights reserved.";
}

mysqli_close($conn);
?>

<footer>
    <p><?php echo $footerText; ?></p>
</footer>
</body>
</html>
