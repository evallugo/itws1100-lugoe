<?php

$pageTitle = "Login";
$bodyClass = "login";
require_once 'conn.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM mySiteUsers WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($user = $result->fetch_assoc()) {
        if ($password === $user['password']) { //in production, use password_verify()
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'type' => $user['user_type']
            ];
            header('Location: index.php');
            exit;
        }
    }
    $error = "Invalid username or password";
}
?>

<div class="content-wrapper">
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <form method="POST" class="login-form">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
