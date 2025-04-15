function updateProfile() {
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