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
document.addEventListener("DOMContentLoaded", () => {
  const signupBtn = document.querySelector("#signupBtn");
  const loginBtn = document.querySelector("#loginBtn");

  //Sign up Handler
  signupBtn.addEventListener("click", () => {
      const name = document.getElementById("nameInput").value.trim();
      const surname = document.getElementById("surnameInput").value.trim();
      const email = document.getElementById("emailInput").value.trim().toLowerCase();
      const password = document.getElementById("pwInput").value.trim();

      const errorMessages = [];

      if (!name) errorMessages.push("First name is required.");
      if (!surname) errorMessages.push("Last name is required.");
      if (!email || !validateEmail(email)) errorMessages.push("A valid email is required.");
      if (!password || !validatePassword(password)) {
          errorMessages.push("Password must have at least 7 characters, one letter, and one number.");
      }

      if (errorMessages.length > 0) {
          alert(errorMessages.join("\n"));
          return;
      }

      const users = JSON.parse(localStorage.getItem("beyondUsers")) || [];

      const userExists = users.some(user => user.email === email);
      if (userExists) {
          alert("An account with this email already exists. Try logging in.");
          return;
      }

      const newUser = { name, surname, email, password };
      users.push(newUser);
      localStorage.setItem("beyondUsers", JSON.stringify(users));

      alert("Sign up successful! You can now log in.");
  });

  //Login handler
  loginBtn.addEventListener("click", () => {
      const email = prompt("Enter your email:").trim().toLowerCase();
      const password = prompt("Enter your password:").trim();

      const users = JSON.parse(localStorage.getItem("beyondUsers")) || [];

      const matchedUser = users.find(user => user.email === email && user.password === password);

      if (matchedUser) {
          alert(`Welcome back, ${matchedUser.name}!`);
          localStorage.setItem("activeUser", JSON.stringify(matchedUser));
          // Redirect to profile page
          window.location.href = "profile.html";
      } else {
          alert("Invalid email or password.");
      }
  });

  function validateEmail(email) {
      const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return re.test(email.toLowerCase());
  }

  function validatePassword(password) {
      const hasLetter = /[a-zA-Z]/.test(password);
      const hasNumber = /[0-9]/.test(password);
      return password.length >= 7 && hasLetter && hasNumber;
  }
});
