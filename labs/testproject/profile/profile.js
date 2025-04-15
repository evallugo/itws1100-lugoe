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
  //Retrieve the input values
  const name = document.getElementById("nameInput").value;
  const birthDate = document.getElementById("bdInput").value;
  const imgURL = document.getElementById("ImgInput").value;

  // Validate birth date format (YYYY-MM-DD)
  const birthDateRegex = /^\d{4}-\d{2}-\d{2}$/;
  if (!birthDateRegex.test(birthDate)) {
    alert("Please enter your birth date in YYYY-MM-DD format");
    return;
  }

  // Validate that it's a real date
  const date = new Date(birthDate);
  if (isNaN(date.getTime())) {
    alert("Please enter a valid date");
    return;
  }

  //Store the profile info
  const profileData = {
      name,
      birthDate,
      imgURL
  };

  //Retrieve the user data
  const user = JSON.parse(localStorage.getItem("activeUser"));
  
  if (user) {
      //Store the profile data under a unique key 
      localStorage.setItem(`profile_${user.email}`, JSON.stringify(profileData));
      // Store birth date separately for horoscope page
      localStorage.setItem('birthDate', birthDate);
      localStorage.setItem('userId', user.email);
      applyProfileData(profileData);
  }

  document.getElementById("editSection").style.display = "none";
  document.getElementById("toggleButton").textContent = "Edit Profile";
}

function applyProfileData(data) {
  //Apply the profile information with the data
  if (data.name) {
      document.getElementById("profileName").textContent = "Name: " + data.name;
      document.getElementById("nameInput").value = data.name;
  }

  if (data.birthDate) {
      document.getElementById("profileBD").textContent = "Date of birth: " + data.birthDate;
      document.getElementById("bdInput").value = data.birthDate;
  }

  if (data.imgURL) {
      document.getElementById("profileImg").src = data.imgURL;
      document.getElementById("ImgInput").value = data.imgURL;
  }
}

function toggleEdit() {
  const editSection = document.getElementById("editSection");
  const toggleButton = document.getElementById("toggleButton");

  //Toggle between showing and hiding the edit section
  if (editSection.style.display === "none" || editSection.style.display === "") {
      editSection.style.display = "block"; 
      toggleButton.textContent = "Hide Editor";  
  } else {
      editSection.style.display = "none"; 
      toggleButton.textContent = "Edit Profile"; 
  }
}

window.onload = () => {
  //Retrieve the user data
  const user = JSON.parse(localStorage.getItem("activeUser"));

  //If no user is logged in, redirect them to the home page
  if (!user) {
      alert("You must be logged in to access your profile.");
      window.location.href = "../homepage/home.html"; 
      return;  
  }

  const userProfileKey = `profile_${user.email}`;
  const storedData = localStorage.getItem(userProfileKey);
  
  if (storedData) {
      applyProfileData(JSON.parse(storedData));
  } else {
      document.getElementById("profileName").textContent = "Name: " + user.name + " " + user.surname;
  }

  document.getElementById("editSection").style.display = "none";

  document.getElementById("logoutBtn").addEventListener("click", () => {
      localStorage.removeItem("activeUser");
      localStorage.removeItem("birthDate");
      localStorage.removeItem("userId");
      
      alert("You have been logged out.");
      window.location.href = "../homepage/home.html"; 
  });
};