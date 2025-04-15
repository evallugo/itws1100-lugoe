document.addEventListener('DOMContentLoaded', function() {
    // Check if user is already logged in
    var userId = localStorage.getItem('userId');
    if (userId) {
        // Redirect to profile page if already logged in
        window.location.href = "../profile/profile.html";
        return;
    }
    
    // Get form elements
    var nameInput = document.getElementById("nameInput");
    var surnameInput = document.getElementById("surnameInput");
    var emailInput = document.getElementById("emailInput");
    var pwInput = document.getElementById("pwInput");
    var loginBtn = document.querySelector("#SignLogBox button:first-of-type");
    var signupBtn = document.querySelector("#SignLogBox button:last-of-type");
    
    // Add event listeners
    if (loginBtn) {
        loginBtn.addEventListener("click", function() {
            // For demo purposes, we'll just set a default user and redirect
            // In a real app, you would validate credentials
            localStorage.setItem('userId', 'demo@example.com');
            localStorage.setItem('userData', JSON.stringify({
                name: 'Demo',
                surname: 'User',
                email: 'demo@example.com'
            }));
            
            // Redirect to profile page
            window.location.href = "../profile/profile.html";
        });
    }
    
    if (signupBtn) {
        signupBtn.addEventListener("click", function() {
            // Validate inputs
            if (!nameInput.value || !surnameInput.value || !emailInput.value || !pwInput.value) {
                alert("Please fill in all fields");
                return;
            }
            
            // Validate password
            var password = pwInput.value;
            var hasLetter = /[a-zA-Z]/.test(password);
            var hasNumber = /[0-9]/.test(password);
            var isLongEnough = password.length >= 7;
            
            if (!hasLetter || !hasNumber || !isLongEnough) {
                alert("Password must contain at least one letter, one number, and be at least 7 characters long");
                return;
            }
            
            // Store user data
            var userData = {
                name: nameInput.value,
                surname: surnameInput.value,
                email: emailInput.value
            };
            
            localStorage.setItem('userId', emailInput.value);
            localStorage.setItem('userData', JSON.stringify(userData));
            
            // Redirect to profile page
            window.location.href = "../profile/profile.html";
        });
    }
});
