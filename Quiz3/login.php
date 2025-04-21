<?php
// login.php
session_start();
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Prepare SQL to prevent injection
    $stmt = $conn->prepare("SELECT * FROM mySiteUsers WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['name'];
        $_SESSION['usertype'] = $user['usertype'];
        header("Location: index.php");
        exit();
    } else {
        echo "<p>Login failed. Invalid username or password.</p>";
    }
}
?>
