<div class="header">
    <nav>
        <a href="/iit/index.php"><i class="fas fa-home"></i>Home</a>   
        <a href="/iit/Quiz3/aboutme.php"><i class="fa-solid fa-user"></i> About</a>
        <a href="/iit/Quiz3/resume.php"><i class="fa-solid fa-file"></i> Resume</a>
        <a href="/iit/Quiz3/labs.php"><i class="fa-solid fa-folder"></i> Labs</a>
        <a href="/iit/Quiz3/projects.php"><i class="fa-solid fa-code"></i> Projects</a>
        <a href="https://github.com/evallugo" target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-github"></i> GitHub
        </a>  
        <a href="https://www.linkedin.com/in/eva-lugo" target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-linkedin"></i> LinkedIn
        </a>
        <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
          <a href="/iit/Quiz3/manage_labs.php"><i class="fas fa-cogs"></i> Manage Labs</a>
        <?php endif; ?>

        <?php if(isset($_SESSION['user_name'])): ?>
            <span class="welcome-text">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</span>
            <a href="logout.php" class="login-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <?php else: ?>
          <a href="#" id="loginBtn" class="login-btn">
         <i class="fas fa-sign-in-alt"></i> Login
</a>
        <?php endif; ?>
    </nav>
</div>



<style>
/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: white;
    margin: 15% auto;
    padding: 20px;
    border-radius: 10px;
    width: 300px;
    position: relative;
}

.close {
    position: absolute;
    right: 20px;
    top: 10px;
    font-size: 28px;
    cursor: pointer;
    color: #666;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

.form-group input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.modal-content button {
    background-color: hotpink;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}

.modal-content button:hover {
    background-color: #ff369b;
}

.welcome-text {
    color: white;
    margin-right: 15px;
}

.login-btn {
    /* Add any specific styling for the login/logout button */
}
</style>

<script>
$(document).ready(function() {
    //get modal elements
    var modal = document.getElementById("loginModal");
    var btn = document.getElementById("loginBtn");
    var span = document.getElementsByClassName("close")[0];

    //open modal
    $("#loginBtn").click(function(e) {
        e.preventDefault();
        modal.style.display = "block";
    });

    //close modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    //close modal when clicking outside
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    //handle form submission
    $("#loginForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "login.php",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if(response.success) {
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert("An error occurred. Please try again.");
            }
        });
    });
});
</script> 