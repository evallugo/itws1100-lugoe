function updateProfile() {
    var nameInput = document.getElementById("nameInput").value;
    var bdInput = document.getElementById("bdInput").value;  //expecting MM/DD/YY or ideally YYYY-MM-DD (update placeholder as needed)
    var ImgInput = document.getElementById("ImgInput").value;
    var bdDInput = document.getElementById("bdDInput").value;
    var bdTInput = document.getElementById("bdTInput").value;
    var emailInput = document.getElementById("emailInput").value;

    if (nameInput) {
        document.getElementById("profileName").textContent = "Name: " + nameInput;
    }

    if (bdInput) {
        document.getElementById("profileBD").textContent = "Date of birth: " + bdInput;
        //save the birth date for the daily horoscope page
        localStorage.setItem('birthDate', bdInput);
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
        //use email as the unique user ID and store it
        localStorage.setItem('userId', emailInput);
    } else if (nameInput) {
        //fallback: use name if email not provided
        localStorage.setItem('userId', nameInput);
    }

    if (ImgInput) {
        document.getElementById("profileImg").src = ImgInput;
    }
}  