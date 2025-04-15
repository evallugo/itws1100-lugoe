function updateProfile() {
    var nameInput = document.getElementById("nameInput").value;
    var bdInput = document.getElementById("bdInput").value;
    var ImgInput = document.getElementById("ImgInput").value;
    var bdDInput = document.getElementById("bdDInput").value;
    var bdTInput = document.getElementById("bdTInput").value;
    var emailInput = document.getElementById("emailInput").value;

    // Validate birth date format
    if (bdInput) {
        // Check if the date matches YYYY-MM-DD format
        var dateRegex = /^\d{4}-\d{2}-\d{2}$/;
        if (!dateRegex.test(bdInput)) {
            alert("Please enter the birth date in YYYY-MM-DD format (e.g., 1995-06-15)");
            return;
        }
        
        // Validate if it's a real date
        var birthDate = new Date(bdInput);
        if (isNaN(birthDate.getTime())) {
            alert("Please enter a valid date");
            return;
        }

        document.getElementById("profileBD").textContent = "Date of birth: " + bdInput;
        localStorage.setItem('birthDate', bdInput);
    }

    if (nameInput) {
        document.getElementById("profileName").textContent = "Name: " + nameInput;
    }

    if (bdDInput) {
        document.getElementById("profileBDP").textContent = "Place of birth: " + bdDInput;
    }

    if (bdTInput) {
        document.getElementById("profileBDT").textContent = "Time of birth: " + bdTInput;
        localStorage.setItem('birthTime', bdTInput);
    }

    if (emailInput) {
        document.getElementById("profileEmail").textContent = "Email: " + emailInput;
        localStorage.setItem('userId', emailInput);
    } else if (nameInput) {
        localStorage.setItem('userId', nameInput);
    }

    if (ImgInput) {
        document.getElementById("profileImg").src = ImgInput;
    }

    // Show success message
    alert("Profile updated successfully!");
}

// Function to handle logout
function logout() {
    // Clear user data from localStorage
    localStorage.removeItem('userId');
    localStorage.removeItem('birthDate');
    localStorage.removeItem('birthTime');
    localStorage.removeItem('lastHoroscope');
    localStorage.removeItem('userData');
    
    // Redirect to homepage
    window.location.href = "../homepage/home.html";
}

// Initialize profile page
window.onload = function() {
    // Check if user is logged in
    var userId = localStorage.getItem('userId');
    if (!userId) {
        // Redirect to homepage if not logged in
        window.location.href = "../homepage/home.html";
        return;
    }
    
    // Load user data
    var userData = JSON.parse(localStorage.getItem('userData') || '{}');
    if (userData.name) {
        document.getElementById("nameInput").value = userData.name;
        document.getElementById("profileName").textContent = "Name: " + userData.name;
    }
    
    if (userData.surname) {
        document.getElementById("surnameInput").value = userData.surname;
    }
    
    if (userData.email) {
        document.getElementById("emailInput").value = userData.email;
        document.getElementById("profileEmail").textContent = "Email: " + userData.email;
    }
    
    // Load existing profile data if available
    var birthDate = localStorage.getItem('birthDate');
    var birthTime = localStorage.getItem('birthTime');
    
    if (birthDate) {
        document.getElementById("bdInput").value = birthDate;
        document.getElementById("profileBD").textContent = "Date of birth: " + birthDate;
    }
    
    if (birthTime) {
        document.getElementById("bdTInput").value = birthTime;
        document.getElementById("profileBDT").textContent = "Time of birth: " + birthTime;
    }
    
    // Add logout button if it doesn't exist
    if (!document.getElementById("logoutBtn")) {
        var logoutBtn = document.createElement("button");
        logoutBtn.id = "logoutBtn";
        logoutBtn.textContent = "Logout";
        logoutBtn.onclick = logout;
        document.querySelector(".profileEdit").appendChild(logoutBtn);
    }
};  