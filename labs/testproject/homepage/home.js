document.addEventListener('DOMContentLoaded', function() {
    // Clear all stored user data
    localStorage.clear();
    
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
            const email = prompt("Enter your email:").trim().toLowerCase();
            const password = prompt("Enter your password:").trim();

            const users = JSON.parse(localStorage.getItem("beyondUsers")) || [];
            const matchedUser = users.find(user => user.email === email && user.password === password);

            if (matchedUser) {
                alert(`Welcome back, ${matchedUser.name}!`);
                localStorage.setItem('userId', matchedUser.email);
                localStorage.setItem('userData', JSON.stringify({
                    name: matchedUser.name,
                    surname: matchedUser.surname,
                    email: matchedUser.email
                }));
                window.location.href = "../profile/profile.html";
            } else {
                alert("Invalid email or password.");
            }
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

            const email = emailInput.value.trim().toLowerCase();
            const users = JSON.parse(localStorage.getItem("beyondUsers")) || [];

            // Check if user already exists
            if (users.some(user => user.email === email)) {
                alert("An account with this email already exists. Please log in instead.");
                return;
            }
            
            // Store user data
            const userData = {
                name: nameInput.value,
                surname: surnameInput.value,
                email: email,
                password: password
            };
            
            users.push(userData);
            localStorage.setItem("beyondUsers", JSON.stringify(users));
            
            // Clear the form
            nameInput.value = '';
            surnameInput.value = '';
            emailInput.value = '';
            pwInput.value = '';
            
            // Show success message and prompt to log in
            alert("Sign up successful! Please log in with your email and password.");
        });
    }
});
