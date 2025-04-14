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