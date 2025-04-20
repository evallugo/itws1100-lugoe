<?php
//start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//include database connection
require_once 'conn.php';

//function to handle login
function handleLogin($db) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        //query to check user credentials
        $query = "SELECT user_id, username, password_hash FROM mySiteUsers WHERE username = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            //for simplicity, we're using plain text passwords as per instructions
            if ($password === $user['password_hash']) {
                //set session variables
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['logged_in'] = true;
                
                //redirect to prevent form resubmission
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                return "Invalid password. Please try again.";
            }
        } else {
            return "User not found. Please try again.";
        }
    }
    return "";
}

//function to handle logout
function handleLogout() {
    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

//function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

//function to check if user is admin
function isAdmin($db) {
    if (!isLoggedIn()) return false;
    
    $user_id = $_SESSION['user_id'];
    $query = "SELECT user_type FROM mySiteUsers WHERE user_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        return $user['user_type'] === 'admin';
    }
    return false;
}

//handle logout
handleLogout();

//handle login
$loginError = handleLogin($db);

//display login form or user info
if (isLoggedIn()) {
    echo '<div class="user-info">';
    echo 'Welcome ' . htmlspecialchars($_SESSION['username']) . '! ';
    echo '<a href="?logout=1" class="logout-btn">Logout</a>';
    echo '</div>';
} else {
    echo '<div class="login-form">';
    echo '<form method="post" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '">';
    echo '<div class="form-group">';
    echo '<label for="username">Username:</label>';
    echo '<input type="text" id="username" name="username" required>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="password">Password:</label>';
    echo '<input type="password" id="password" name="password" required>';
    echo '</div>';
    echo '<button type="submit" name="login" class="login-btn">Login</button>';
    echo '</form>';
    if (!empty($loginError)) {
        echo '<div class="error-message">' . htmlspecialchars($loginError) . '</div>';
    }
    echo '</div>';
}
?> 