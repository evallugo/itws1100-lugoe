// Function to toggle the edit section visibility
function toggleEdit() {
    const editSection = document.getElementById('editSection');
    const toggleButton = document.getElementById('toggleButton');
    
    if (editSection.style.display === 'none' || !editSection.style.display) {
        editSection.style.display = 'block';
        toggleButton.textContent = 'Cancel Edit';
        
        // Pre-fill current values
        const userData = JSON.parse(localStorage.getItem('userData'));
        const birthDate = localStorage.getItem('birthDate');
        
        document.getElementById('nameInput').value = userData.name || '';
        document.getElementById('surnameInput').value = userData.surname || '';
        document.getElementById('bdInput').value = birthDate || '';
    } else {
        editSection.style.display = 'none';
        toggleButton.textContent = 'Edit Profile';
    }
}

// Function to update the profile
function updateProfile() {
    const userId = localStorage.getItem('userId');
    if (!userId) {
        window.location.href = "../homepage/home.html";
        return;
    }

    const nameInput = document.getElementById('nameInput');
    const surnameInput = document.getElementById('surnameInput');
    const bdInput = document.getElementById('bdInput');
    const imgInput = document.getElementById('ImgInput');

    // Validate birth date format
    const birthDateRegex = /^\d{4}-\d{2}-\d{2}$/;
    if (bdInput.value && !birthDateRegex.test(bdInput.value)) {
        alert("Please enter birth date in YYYY-MM-DD format");
        return;
    }

    // Get current users array
    const users = JSON.parse(localStorage.getItem("beyondUsers")) || [];
    const userIndex = users.findIndex(user => user.email === userId);

    if (userIndex !== -1) {
        // Update user data in the stored users array
        if (nameInput.value) users[userIndex].name = nameInput.value;
        if (surnameInput.value) users[userIndex].surname = surnameInput.value;
        if (bdInput.value) users[userIndex].birthDate = bdInput.value;
        
        // Save updated users array
        localStorage.setItem("beyondUsers", JSON.stringify(users));

        // Update current session data
        const userData = {
            name: nameInput.value || users[userIndex].name,
            surname: surnameInput.value || users[userIndex].surname,
            email: userId
        };
        localStorage.setItem('userData', JSON.stringify(userData));

        // Update birth date in session
        if (bdInput.value) {
            localStorage.setItem('birthDate', bdInput.value);
        }
    }

    // Update display
    displayProfile();
    
    // Hide edit section
    document.getElementById('editSection').style.display = 'none';
    document.getElementById('toggleButton').textContent = 'Edit Profile';

    alert("Profile updated successfully!");
}

function displayProfile() {
    const userId = localStorage.getItem('userId');
    const userData = JSON.parse(localStorage.getItem('userData'));
    const birthDate = localStorage.getItem('birthDate');

    if (!userId || !userData) {
        window.location.href = "../homepage/home.html";
        return;
    }

    document.getElementById('profileName').textContent = `Name: ${userData.name} ${userData.surname}`;
    document.getElementById('profileEmail').textContent = `Email: ${userId}`;
    document.getElementById('profileBD').textContent = `Date of birth: ${birthDate || 'Not set'}`;

    if (userData.birthDate) {
        document.getElementById('profileBD').textContent = `Date of birth: ${userData.birthDate}`;
        document.getElementById('bdInput').value = userData.birthDate;
    }
    if (userData.imgUrl) {
        const profileImg = document.getElementById('profileImg');
        profileImg.src = userData.imgUrl;
        profileImg.onerror = function() {
            // If image fails to load, just show the text
            profileImg.style.display = 'none';
            const textElement = document.createElement('div');
            textElement.textContent = 'Profile Picture';
            textElement.style.textAlign = 'center';
            textElement.style.padding = '20px';
            profileImg.parentNode.appendChild(textElement);
        };
    }
}

// Function to handle logout
function logout() {
    localStorage.removeItem('userId');
    localStorage.removeItem('userData');
    localStorage.removeItem('birthDate');
    window.location.href = '../homepage/home.html';
}

// Initialize the page
window.addEventListener('DOMContentLoaded', () => {
    // Check if user is logged in
    const userId = localStorage.getItem('userId');
    if (!userId) {
        window.location.href = '../homepage/home.html';
        return;
    }

    // Add logout event listener
    document.getElementById('logoutBtn').addEventListener('click', logout);

    // Load user data
    const userData = JSON.parse(localStorage.getItem('userData') || '{}');
    
    if (userData.name) {
        document.getElementById('profileName').textContent = `Name: ${userData.name} ${userData.surname || ''}`;
        document.getElementById('nameInput').value = userData.name;
    }
    if (userData.surname) {
        document.getElementById('surnameInput').value = userData.surname;
    }
    if (userData.birthDate) {
        document.getElementById('profileBD').textContent = `Date of birth: ${userData.birthDate}`;
        document.getElementById('bdInput').value = userData.birthDate;
    }
    if (userData.imgUrl) {
        const profileImg = document.getElementById('profileImg');
        profileImg.src = userData.imgUrl;
        profileImg.onerror = function() {
            // If image fails to load, just show the text
            profileImg.style.display = 'none';
            const textElement = document.createElement('div');
            textElement.textContent = 'Profile Picture';
            textElement.style.textAlign = 'center';
            textElement.style.padding = '20px';
            profileImg.parentNode.appendChild(textElement);
        };
    }
    
    document.getElementById('profileEmail').textContent = `Email: ${userId}`;

    // Display profile on page load
    displayProfile();
});