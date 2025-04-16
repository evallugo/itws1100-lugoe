// Function to toggle the edit section visibility
function toggleEdit() {
    const editSection = document.getElementById('editSection');
    editSection.style.display = editSection.style.display === 'none' ? 'block' : 'none';
}

// Function to update the profile
function updateProfile() {
    const name = document.getElementById('nameInput').value;
    const surname = document.getElementById('surnameInput').value;
    const birthDate = document.getElementById('bdInput').value;
    const imgUrl = document.getElementById('ImgInput').value;

    // Validate birth date format
    const birthDateRegex = /^\d{4}-\d{2}-\d{2}$/;
    if (!birthDateRegex.test(birthDate)) {
        alert('Please enter birth date in YYYY-MM-DD format');
        return;
    }

    // Validate date is valid
    const date = new Date(birthDate);
    if (isNaN(date.getTime())) {
        alert('Please enter a valid date');
        return;
    }

    // Store the updated information
    const userData = {
        name: name,
        surname: surname,
        birthDate: birthDate,
        imgUrl: imgUrl || '../default-profile.svg'
    };

    localStorage.setItem('userData', JSON.stringify(userData));
    localStorage.setItem('birthDate', birthDate);

    // Update display
    document.getElementById('profileName').textContent = `Name: ${name} ${surname}`;
    document.getElementById('profileBD').textContent = `Date of birth: ${birthDate}`;
    document.getElementById('profileEmail').textContent = `Email: ${localStorage.getItem('userId')}`;
    
    // Update profile image with error handling
    const profileImg = document.getElementById('profileImg');
    if (imgUrl) {
        // Create a temporary image to test the URL
        const tempImg = new Image();
        tempImg.onerror = function() {
            // If image fails to load, use default
            profileImg.src = '../default-profile.svg';
            alert('Failed to load image URL. Using default profile picture.');
        };
        tempImg.onload = function() {
            // If image loads successfully, use it
            profileImg.src = imgUrl;
        };
        tempImg.src = imgUrl;
    } else {
        profileImg.src = '../default-profile.svg';
    }

    // Hide edit section
    document.getElementById('editSection').style.display = 'none';
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
        const tempImg = new Image();
        tempImg.onerror = function() {
            profileImg.src = '../default-profile.svg';
        };
        tempImg.onload = function() {
            profileImg.src = userData.imgUrl;
        };
        tempImg.src = userData.imgUrl;
    }
    
    document.getElementById('profileEmail').textContent = `Email: ${userId}`;
});